@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">
<div class="d-flex flex-column justify-content-between align-items-start pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 welcome-message">{{ $title }}</h1>
</div>
    <div class="card shadow mb-4" style="margin: 10px;">
        <div class="card-body">
            <div>
                <a href="{{ route('gejala.create') }}" class="btn btn-primary mb-3">Create New Recipe</a>
            </div>
            <div class="table-responsive" >
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Kode Gejala</th>
                            <th scope="col">Nama Gejala</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gejala as $gejala)
                        <tr>
                            <td>{{ $gejala->kode_gejala }}</td>
                            <td>{{ $gejala->nama_gejala }}</td>
                            <td>
                                <a href="{{ route('gejala.edit', $gejala->id) }}" class="badge bg-info"><i class="fa-solid fa-pen"></i></i></a>
                                <form action="{{ route('gejala.destroy', $gejala->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')"><i class="fa-solid fa-trash-can"></i></button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
    });
</script>
@endif

@endsection