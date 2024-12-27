@extends('user.layouts.index')

@section('content')
<div class="container">
    <h1 class="mb-4">Riwayat Diagnosa</h1>
    
    @if($riwayat->isEmpty())
        <div class="alert alert-info">
            Anda belum memiliki riwayat diagnosa.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Konsultasi</th>
                    <th>Nama Penyakit</th>
                    <th>Gejala yang Dialami</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayat as $diagnosis)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($diagnosis->tanggal_konsultasi)->format('d M Y') }}</td>
                        <td>{{ $diagnosis->penyakit->nama_penyakit ?? 'Tidak Teridentifikasi' }}</td>
                        <td>{{ $diagnosis->gejala_dialami }}</td>                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
