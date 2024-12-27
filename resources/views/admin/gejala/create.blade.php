@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h2 mb-4">{{ $title }}</h1>
    <form action="{{ route('gejala.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="kode_gejala" class="form-label">Kode Gejala</label>
                    <input type="text" class="form-control" id="kode_gejala" name="kode_gejala" value="{{ old('kode_gejala') }}" required>
                    @error('kode_gejala') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_gejala" class="form-label">Nama Gejala</label>
                    <input type="text" class="form-control" id="nama_gejala" name="nama_gejala" value="{{ old('nama_gejala') }}" required>
                    @error('nama_gejala') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
