<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Diagnosis;
use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataPasienController extends Controller
{
    // Menampilkan daftar semua pasien
    public function index()
    {
        $users = User::with('profile')
            // ->whereHas('profile') // Pastikan hanya user yang memiliki profil
            // ->get();
            ->where('role', 'user') // Memfilter berdasarkan role 'user'
            ->where('id', '!=', Auth::id()) // Pastikan admin tidak ikut
            ->get();

        return view('admin.pasien.data-pasien', compact('users'));
    }

    // Menampilkan riwayat diagnosis pasien berdasarkan ID user
    public function show($id)
    {
        $user = User::with('profile')->findOrFail($id);
        $riwayat = Diagnosis::with(['penyakit', 'user'])
            ->where('user_id', $id)
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

        return view('admin.pasien.history', compact('user', 'riwayat'));
    }
}
