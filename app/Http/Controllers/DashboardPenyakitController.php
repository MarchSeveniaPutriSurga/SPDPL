<?php

namespace App\Http\Controllers;
use App\Models\Penyakit;

use Illuminate\Http\Request;

class DashboardPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyakit = Penyakit::all();
        return view('admin.penyakit.index', compact('penyakit'))->with('title', 'Daftar Penyakit');
    }

    // Menampilkan form untuk membuat penyakit baru
    public function create()
    {
        return view('admin.penyakit.create')->with('title', 'Tambah Penyakit');
    }

    // Menyimpan penyakit baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_penyakit' => 'required|unique:penyakit',
            'nama_penyakit' => 'required',
            'deskripsi' => 'required',
            'deskripsi_solusi' => 'required',
            'rekomendasi_obat' => 'required',
        ]);

        Penyakit::create($request->all());

        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit penyakit
    public function edit(Penyakit $penyakit)
    {
        return view('admin.penyakit.edit', compact('penyakit'))->with('title', 'Edit Penyakit');
    }

    // Menyimpan perubahan penyakit
    public function update(Request $request, Penyakit $penyakit)
    {
        $request->validate([
            'kode_penyakit' => 'required|unique:penyakit,kode_penyakit,' . $penyakit->id,
            'nama_penyakit' => 'required',
            'deskripsi' => 'required',
            'deskripsi_solusi' => 'required',
            'rekomendasi_obat' => 'required',
        ]);

        $penyakit->update($request->all());

        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil diupdate!');
    }

    // Menghapus penyakit
    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil dihapus!');
    }
}
