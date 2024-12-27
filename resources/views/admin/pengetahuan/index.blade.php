@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column justify-content-between align-items-start pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 welcome-message">{{ $title }}</h1>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow mb-4" style="margin: 10px;">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('rule.create') }}" class="btn btn-primary">Tambah Pengetahuan</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Penyakit</th>
                            <th scope="col">Gejala</th>
                            <th scope="col" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rules as $item)
<tr>
    <!-- Menampilkan nama penyakit -->
    <td>{{ $item->penyakit->nama_penyakit }}</td>

    <!-- Menampilkan gejala -->
    <td>
        @if($item->gejala)
            <span>{{ $item->gejala->nama_gejala }}</span><br>
        @else
            <span>Gejala tidak ditemukan</span><br>
        @endif
    </td>                      

    <!-- Aksi -->
    <td>
        <a href="{{ route('rule.edit', $item->id) }}" class="badge bg-info"><i class="fa-solid fa-pen"></i></a>
        <form action="{{ route('rule.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="badge bg-danger border-0"><i class="fa-solid fa-trash-can"></i></button>
        </form>
    </td>
</tr>
@endforeach

                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
