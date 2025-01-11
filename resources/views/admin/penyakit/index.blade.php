@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column justify-content-between align-items-start pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 welcome-message">{{ $title }}</h1>
    </div>

    <div class="card shadow mb-4" style="margin: 10px;">
        <div class="card-body">
            <div>
                <a href="{{ route('penyakit.create') }}" class="btn btn-primary mb-3">Create New Penyakit</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Kode Penyakit</th>
                            <th scope="col">Nama Penyakit</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Deskripsi Solusi</th>
                            <th scope="col">Rekomendasi Obat</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyakit as $penyakit)
                        <tr>
                            <td>{{ $penyakit->kode_penyakit }}</td>
                            <td>{{ $penyakit->nama_penyakit }}</td>
                            <td>{{ $penyakit->deskripsi }}</td>
                            <td>{{ $penyakit->deskripsi_solusi }}</td>
                            <td>{{ $penyakit->rekomendasi_obat }}</td>
                            <td>
                                <a href="{{ route('penyakit.edit', $penyakit->id) }}" class="badge bg-info"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('penyakit.destroy', $penyakit->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
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
