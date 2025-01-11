<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;

class DashboardRuleController extends Controller
{
    public function index()
    {
        // Menggunakan join untuk mengurutkan rule berdasarkan nama penyakit
        $rule = Rule::join('penyakit', 'rule.penyakit_id', '=', 'penyakit.id')
                    ->with('gejala')
                    ->orderBy('penyakit.nama_penyakit') 
                    ->get(['rule.*', 'penyakit.nama_penyakit']); 

        return view('admin.pengetahuan.index', compact('rule'))->with('title', 'Daftar Rule');
    }

    public function create()
    {
        // Ambil penyakit dan gejala untuk form create
        $penyakit = Penyakit::select('id', 'nama_penyakit')->orderByDesc('updated_at')->get();
        $gejala = Gejala::select('id', 'nama_gejala', 'kode_gejala')->orderByDesc('updated_at')->get();

        return view('admin.pengetahuan.create', compact('penyakit', 'gejala'))->with('title', 'Tambah Pengetahuan');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'penyakit_id' => 'required|exists:penyakit,id', 
            'gejala_id' => 'required|array', 
            'gejala_id.*' => 'exists:gejala,id',
        ]);

        // Ambil ID penyakit yang dipilih dan ID gejala yang dipilih
        $penyakitId = (int) $request->input('penyakit_id'); 
        $gejalaIds = $request->input('gejala_id'); 
        
        // Simpan setiap relasi rule
        foreach ($gejalaIds as $gejalaId) {
            Rule::create([
                'penyakit_id' => $penyakitId,
                'gejala_id' => (int) $gejalaId,
            ]);
        }

        return redirect()->route('rule.index')->with('success', 'Rule berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Ambil rule yang akan diedit
        $rule = Rule::with(['penyakit:id,nama_penyakit', 'gejala:id,nama_gejala'])->findOrFail($id);

        // Ambil data penyakit dan gejala untuk form
        $penyakit = Penyakit::select('id', 'nama_penyakit')->orderByDesc('updated_at')->get();
        $gejala = Gejala::select('id', 'nama_gejala')->orderByDesc('updated_at')->get();

        // Ambil rule yang memiliki gejala sama tapi penyakit berbeda
        $existingRules = Rule::where('gejala_id', '!=', $rule->gejala_id)
            ->with('penyakit:id,nama_penyakit')
            ->get();

        return view('admin.pengetahuan.edit', compact('rule', 'penyakit', 'gejala', 'existingRules'))->with('title', 'Edit Pengetahuan');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'penyakit_id' => 'required|exists:penyakit,id',
            'gejala_id' => 'required|array|max:1',
            'gejala_id.*' => 'exists:gejala,id',
        ]);

        // Ambil penyakit dan gejala dari request
        $penyakitId = $request->input('penyakit_id');
        $gejalaIds = $request->input('gejala_id');

        // Cek duplikasi gejala
        $existingRules = Rule::where('penyakit_id', $penyakitId)
                            ->whereIn('gejala_id', $gejalaIds)
                            ->where('id', '!=', $id) // Kecuali rule yang sedang diedit
                            ->exists();

        if ($existingRules) {
            return back()->withErrors(['gejala_id' => 'Salah satu gejala yang dipilih sudah digunakan pada penyakit ini.'])->withInput();
        }

        // Update data rule
        $rule = Rule::findOrFail($id);
        $rule->penyakit_id = $penyakitId;
        $rule->gejala_id = implode(',', $gejalaIds);
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Rule berhasil diubah');
    }

    public function checkDuplicateGejala(Request $request)
    {
        $penyakitId = $request->query('penyakit_id');
        $gejalaId = $request->query('gejala_id');

        $exists = Rule::where('penyakit_id', $penyakitId)
                    ->where('gejala_id', $gejalaId)
                    ->exists();

        return response()->json(['exists' => $exists]);
    }

    public function destroy($id)
    {
        // Hapus rule
        $rule = Rule::findOrFail($id);
        $rule->delete();
        return redirect()->route('rule.index')->with('success', 'Data berhasil dihapus.');
    }
}
