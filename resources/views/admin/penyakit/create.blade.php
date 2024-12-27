@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h2 mb-4">{{ $title }}</h1>
    <form action="{{ route('penyakit.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="kode_penyakit" class="form-label">Kode Penyakit</label>
                    <input type="text" class="form-control" id="kode_penyakit" name="kode_penyakit" value="{{ old('kode_penyakit') }}" required>
                    @error('kode_penyakit') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                    <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" value="{{ old('nama_penyakit') }}" required>
                    @error('nama_penyakit') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi_solusi" class="form-label">Deskripsi Solusi</label>
                    <textarea class="form-control" id="deskripsi_solusi" name="deskripsi_solusi" required>{{ old('deskripsi_solusi') }}</textarea>
                    @error('deskripsi_solusi') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rekomendasi_obat" class="form-label">Rekomendasi Obat</label>
                    <textarea class="form-control" id="rekomendasi_obat" name="rekomendasi_obat" required>{{ old('rekomendasi_obat') }}</textarea>
                    @error('rekomendasi_obat') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
