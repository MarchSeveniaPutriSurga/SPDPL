<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $data = [
            'jumlahPengguna' => $this->jumlahPengguna(),
            'jumlahPenyakit' => $this->jumlahPenyakit(),
            'jumlahGejala' => $this->jumlahGejala(),
            'jumlahDiagnosis' => $this->jumlahDiagnosis(),
            'diagnosisPenyakit' => $this->diagnosisPenyakit(),
        ];

        return view('admin.dashboard', $data);
    }

    public function jumlahPengguna()
    {
        $jumlahPengguna = User::where('role', 'user')->count();
        return $jumlahPengguna;
    }

    public function jumlahPenyakit()
    {
        $jumlahPenyakit = Penyakit::count();
        return $jumlahPenyakit;
    }

    public function jumlahGejala()
    {
        $jumlahGejala = Gejala::count();
        return $jumlahGejala;
    }

    public function jumlahDiagnosis()
    {
        $jumlahDiagnosis = Diagnosis::count();
        return $jumlahDiagnosis;
    }

    public function diagnosisPenyakit()
    {
        $data = Diagnosis::selectRaw('count(*) as count, penyakit_id')->groupBy('penyakit_id')->get()->toArray();
        $penyakit = Penyakit::get(['id', 'nama_penyakit'])->toArray();
        $penyakit = array_column($penyakit, 'nama_penyakit', 'id');
        $data = array_map(function ($item) use ($penyakit) {
            $item['penyakit'] = $penyakit[$item['penyakit_id']] ?? null;
            return $item;
        }, $data);
        return $data;
    }
}
