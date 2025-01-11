@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1>Data Pasien</h1> <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Umur</th>
                        <th>Gender</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->profile->telepon ?? '-' }}</td>
                        <td>{{ $user->profile->umur ?? '-' }}</td>
                        <td>{{ ucfirst($user->profile->gender ?? '-') }}</td>
                        <td>
                            <a href="{{ route('patients.history', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection