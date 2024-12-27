@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h2 mb-4">{{ $title }}</h1>
    <form action="{{ route('gejala.update', $gejala->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Untuk mengindikasikan update -->
        
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="kode_gejala" class="form-label">Kode Gejala</label>
                    <input type="text" class="form-control" id="kode_gejala" name="kode_gejala" value="{{ old('kode_gejala', $gejala->kode_gejala) }}" required>
                    @error('kode_gejala') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_gejala" class="form-label">Nama Gejala</label>
                    <input type="text" class="form-control" id="nama_gejala" name="nama_gejala" value="{{ old('nama_gejala', $gejala->nama_gejala) }}" required>
                    @error('nama_gejala') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('gejala.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
