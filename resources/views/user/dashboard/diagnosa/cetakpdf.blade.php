<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <h2 class="text-center">Hasil Diagnosis</h2>
            <hr> 
            <h1>Detail Pasien: {{ $user->name }}</h1>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $user->profile->telepon ?? '-' }}</p>
            <p><strong>Umur:</strong> {{ $user->profile->umur ?? '-' }}</p>
            <p><strong>Gender:</strong> {{ ucfirst($user->profile->gender ?? '-') }}</p>
            <hr>
            <p><strong>Penyakit:</strong> {{ $diagnosis->penyakit->nama_penyakit }}</p>
            <p><strong>Pencegahan:</strong> {{ $diagnosis->penyakit->deskripsi_solusi }}</p>
            <p><strong>Rekomendasi Obat:</strong> {{ $diagnosis->penyakit->rekomendasi_obat }}</p>
            
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
</body>
</html>