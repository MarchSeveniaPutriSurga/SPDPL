@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="d-flex my-3">
        <a href="{{ route('patients.index') }}" class="btn btn-custom ms-auto">
            Keluar
        </a>
    </div>
   <div class="card">
        <div class="card-body">
            <h1>Detail Pasien: {{ $user->name }}</h1>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $user->profile->telepon ?? '-' }}</p>
            <p><strong>Umur:</strong> {{ $user->profile->umur ?? '-' }}</p>
            <p><strong>Gender:</strong> {{ ucfirst($user->profile->gender ?? '-') }}</p>
            <br>
            <hr>
            <br>
            <h2>Riwayat Diagnosis</h2>
            @if($riwayat->isEmpty())
                <p>Tidak ada riwayat diagnosis.</p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal Konsultasi</th>
                        <th>Gejala Dialami</th>
                        <th>Hasil Diagnosis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $item)
                    <tr>
                        <td>{{ ($item->tanggal_konsultasi) ->format('d M Y')}}</td>
                        <td>{{ $item->gejala_dialami }}</td>
                        <td>{{ $item->penyakit->nama_penyakit ?? 'Tidak terdeteksi' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
   </div>
</div>
@endsection