<?php

namespace App\Http\Controllers;
use App\Models\Gejala;

use Illuminate\Http\Request;

class DashboardGejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gejala = Gejala::all();
        return view('admin.gejala.index', compact('gejala'))->with('title', 'Daftar Gejala');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gejala.create')->with('title', 'Tambah Gejala');
    }

    // Menyimpan gejala baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required|unique:gejala',
            'nama_gejala' => 'required',
        ]);

        Gejala::create($request->all());

        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit gejala
    public function edit(Gejala $gejala)
    {
        return view('admin.gejala.edit', compact('gejala'))->with('title', 'Edit Gejala');
    }

    // Menyimpan perubahan gejala
    public function update(Request $request, Gejala $gejala)
    {
        $request->validate([
            'kode_gejala' => 'required|unique:gejala,kode_gejala,' . $gejala->id,
            'nama_gejala' => 'required',
        ]);

        $gejala->update($request->all());

        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diupdate!');
    }

    // Menghapus gejala
    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil dihapus!');
    }
}
