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
        // Menambahkan eager loading untuk penyakit dan gejala
        $rules = Rule::with(['penyakit', 'gejala'])->get();
        return view('admin.pengetahuan.index', compact('rules'))->with('title', 'Daftar Rule');
    }

    public function create()
    {
        // Ambil penyakit dan gejala untuk form create
        $penyakit = Penyakit::select('id', 'nama_penyakit')->orderByDesc('updated_at')->get();
        $gejala = Gejala::select('id', 'nama_gejala')->orderByDesc('updated_at')->get();

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
        // Ambil rule, penyakit, dan gejala untuk form edit
        $rule = Rule::with(['penyakit:id,nama_penyakit', 'gejala:id,nama_gejala'])->findOrFail($id);
        $penyakit = Penyakit::select('id', 'nama_penyakit')->orderByDesc('updated_at')->get();
        $gejala = Gejala::select('id', 'nama_gejala')->orderByDesc('updated_at')->get();

        return view('admin.pengetahuan.edit', compact('rule', 'penyakit', 'gejala'))->with('title', 'Edit Pengetahuan');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'penyakit_id' => 'required|exists:penyakit,id',
            'gejala_id' => 'required|array',
            'gejala_id.*' => 'exists:gejala,id',
        ]);

        // Update rule
        $rule = Rule::findOrFail($id);
        $rule->penyakit_id = $request->input('penyakit_id');
        $rule->gejala_id = implode(',', $request->input('gejala_id')); // Menyimpan gejala sebagai array string
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Rule berhasil diubah');
    }

    public function destroy($id)
    {
        // Hapus rule
        $rule = Rule::findOrFail($id);
        $rule->delete();
        return redirect()->route('rule.index')->with('success', 'Data berhasil dihapus.');
    }
}
