<?php
namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosisController extends Controller
{
    private $allGejala;

    public function __construct()
    {
        $this->allGejala = Gejala::get('id')->count();
    }

    private function newDiagnosis()
    {
        $modelDiagnosis = new Diagnosis();
        $modelDiagnosis->user_id = Auth::user()->id;
        $modelDiagnosis->tanggal_konsultasi = now();
        return $modelDiagnosis;
    }

    private function lastDiagnosis()
    {
        return Diagnosis::where('user_id',  Auth::user()->id)->get()->last();
    }

    private function checkDiagnosis($idGejala)
    {
        $lastDiagnosis = $this->lastDiagnosis();

        if ($idGejala === 1) {
            return $this->newDiagnosis();
        }

        if ($lastDiagnosis->penyakit_id === null) {
            $answerLog = json_decode($lastDiagnosis->answer_log, true) ?? [];
            $maxAnswerLog = max(array_keys($answerLog));

            if ($maxAnswerLog === $this->allGejala) {
                return $this->newDiagnosis();
            }

            $lastDiagnosis->tanggal_konsultasi = now();
            $lastDiagnosis->save();

            return $lastDiagnosis;
        }

        return $this->newDiagnosis();
    }

    public function showQuestion()
    {
        $gejalaPertama = Gejala::first();
        return view('user.dashboard.diagnosa.diagnose', compact('gejalaPertama'));
    }

    //ini yang bisa langsung muncul hasil diagnosanya ketika semua gejala true
    public function diagnosis(Request $request)
    {
        $request->validate([
            'idgejala' => ['required', 'numeric', 'max:' . $this->allGejala, 'min:1'],
        ]);
    
        // Simpan jawaban user saat ini
        $requestFakta = [
            $request->idgejala => filter_var($request->value, FILTER_VALIDATE_BOOLEAN)
        ];
    
        // Ambil atau buat diagnosis baru
        $modelDiagnosis = $this->checkDiagnosis((int) $request->idgejala);
    
        // Update answer log dengan jawaban baru
        $answerLog = json_decode($modelDiagnosis->answer_log, true) ?? [];
        $answerLog = $answerLog + $requestFakta;
        $modelDiagnosis->answer_log = json_encode($answerLog);
        $modelDiagnosis->save();
    
        // Simpan ke session untuk digunakan di view hasil
        session(['answerLog' => $answerLog]);
    
        // Cari gejala berikutnya yang belum dijawab
        $nextGejala = Gejala::whereNotIn('id', array_keys($answerLog))->first();
    
        // Proses inferensi forward chaining
        $rules = Rule::get(['penyakit_id', 'gejala_id']);
        $aturanPenyakit = [];
    
        // Kelompokkan gejala berdasarkan penyakit
        foreach ($rules as $rule) {
            if (!isset($aturanPenyakit[$rule->penyakit_id])) {
                $aturanPenyakit[$rule->penyakit_id] = [];
            }
            $aturanPenyakit[$rule->penyakit_id][] = $rule->gejala_id;
        }
    
        // Filter hanya gejala yang dijawab YA
        $fakta = array_filter($answerLog, function($value) {
            return $value === true;
        });
    
        $terdeteksi = false;
        $penyakit = null;
    
        // Proses inferensi forward chaining
        foreach ($aturanPenyakit as $penyakitId => $gejalaList) {
            // Dapatkan semua gejala yang diperlukan untuk penyakit ini
            $gejalaRequired = array_unique($gejalaList);
            $matchCount = 0;
    
            // Periksa apakah semua gejala yang diperlukan terpenuhi
            foreach ($gejalaRequired as $gejalaId) {
                if (isset($fakta[$gejalaId]) && $fakta[$gejalaId] === true) {
                    $matchCount++;
                }
            }
    
            // Penyakit terdeteksi hanya jika semua gejala yang diperlukan terpenuhi
            if ($matchCount === count($gejalaRequired)) {
                $terdeteksi = true;
                if ($modelDiagnosis->penyakit_id === null) {
                    $modelDiagnosis->penyakit_id = $penyakitId;
                    $modelDiagnosis->save();
                }
                $penyakit = Penyakit::where('id', $penyakitId)->first('id');
                break; // Keluar dari loop karena sudah menemukan penyakit yang cocok
            }
        }
    
        // Jika penyakit sudah terdeteksi, jangan lanjutkan ke gejala berikutnya
        if ($terdeteksi) {
            return response()->json([
                'idDiagnosis' => $modelDiagnosis->id,
                'idPenyakit' => $penyakit ?? null,
                'penyakitTeridentifikasi' => true, // Menandakan penyakit sudah terdeteksi
            ]);
        }
    
        // Jika masih ada gejala berikutnya, tampilkan
        if ($nextGejala) {
            return response()->json([
                'nextGejala' => $nextGejala
            ]);
        }
    
        // Jika sudah mencapai gejala terakhir tapi tidak ada penyakit yang terdeteksi
        if (!$terdeteksi && $request->idgejala == $this->allGejala) {
            return response()->json([
                'penyakitUnidentified' => true,
                'idPenyakit' => null,
                'idDiagnosis' => $modelDiagnosis->id,
            ]);
        }
    
        return response()->json([
            'idDiagnosis' => $modelDiagnosis->id,
            'idPenyakit' => $penyakit ?? null
        ]);
    }
    

    public function showResult(Request $request)
    {
        $penyakit = Penyakit::find($request->id);
        $diagnosis = Diagnosis::where('user_id', Auth::id())->first(); // atau gunakan kondisi lain jika diperlukan

        // Cek apakah diagnosis ada
        if (!$diagnosis) {
            return redirect()->back()->with('error', 'Diagnosis tidak ditemukan.');
        }
        $rekomendasiObat = $penyakit->rekomendasi_obat ?? 'Tidak ada rekomendasi obat.';
        $pencegahan = $penyakit->deskripsi_solusi ?? 'Tidak ada informasi pencegahan.';
        $answerLog = session('answerLog', []);
        $user = Auth::user();

        // Filter hanya gejala yang dijawab YA
        $gejalaYa = array_filter($answerLog, function ($value) {
            return $value === true;
        });

        // Ambil data gejala berdasarkan ID gejala yang dijawab YA
        $gejalaTerpilih = Gejala::whereIn('id', array_keys($gejalaYa))->get();

        $data1 = [
            'diagnosis' => $diagnosis,
            'penyakit' => $penyakit,
            'gejalaTerpilih' => $gejalaTerpilih,
            'rekomendasiObat' => $rekomendasiObat,
            'pencegahan' => $pencegahan,
            'user' => $user,
        ];
        
        if($request->get('export') == 'pdf'){
            $pdf = Pdf::loadView('user.dashboard.diagnosa.cetakpdf', $data1);
            return $pdf->stream('Hasil Diagnosa.pdf');
        }

        return view('user.dashboard.diagnosa.result', [
            'penyakit' => $penyakit,
            'gejalaTerpilih' => $gejalaTerpilih,
            'rekomendasiObat' => $rekomendasiObat,
            'pencegahan' => $pencegahan,
        ]);
    }

    public function showHistory()
    {
        $riwayat = Diagnosis::with(['penyakit', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('tanggal_konsultasi', 'desc')
            ->get();

        foreach ($riwayat as $item) {
            // Decode answer_log dari JSON
            $answerLog = json_decode($item->answer_log, true) ?? [];

            // Filter hanya gejala yang dijawab YA (true)
            $gejalaIds = array_keys(array_filter($answerLog, fn($value) => $value === true));

            // Ambil nama gejala berdasarkan ID yang dipilih
            $item->gejala_dialami = Gejala::whereIn('id', $gejalaIds)->pluck('nama_gejala')->implode(', ');
        }

        return view('user.dashboard.riwayat-diagnosis', compact('riwayat'));
    }

}