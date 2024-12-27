@extends('user.layouts.index')

@section('content')
    <div class="container">
        <div class="d-flex my-3">
            <a href="{{ route('diagnose') }}" class="btn btn-custom ms-auto">
                Keluar
            </a>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <h2 class="text-center">Hasil Diagnosis</h2>
                <hr>

                @if($penyakit)
                    <h5>Nama Penyakit:</h5>
                    <p>{{ $penyakit->nama_penyakit }}</p>
                    <h5>Pencegahan:</h5>
                    <p>{{ $pencegahan }}</p>
                    <h5>Rekomendasi Obat:</h5>
                    <p>{{ $rekomendasiObat }}</p>
                @else
                    <p class="text-center">Tidak ditemukan penyakit berdasarkan gejala yang dipilih.</p>
                @endif

                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Gejala</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gejalaTerpilih as $gejala)
                            <tr>
                                <td>{{ $gejala->nama_gejala }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
@endsection
