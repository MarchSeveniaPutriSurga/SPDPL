@extends('user.layouts.index')

@section('content')
<div class="container-fluid text-center">
    <div class="row gy-4 align-items-center features-item mb-3">
        <span class="brand-text font-weight-bold" style="font-size: 3rem; font-weight: bold; display: block;">
            <span style="color: #AE445A;">Gastro</span><span style="color: #740938;">Care</span>
        </span>
          <p>
            Apakah Anda sering merasakan gangguan pada lambung, namun bingung dengan apa yang sebenarnya terjadi? Sistem Pakar kami hadir 
            untuk membantu Anda mengenali penyakit lambung yang mungkin Anda alami dengan lebih mudah dan akurat. Dengan hanya memasukkan gejala 
            yang Anda rasakan, sistem kami akan memberikan rekomendasi diagnosis yang tepat, sehingga Anda dapat segera mendapatkan penanganan yang sesuai. Jangan tunda lagi, mulailah cek kondisi kesehatan lambung Anda sekarang dan temukan solusi terbaik untuk kesejahteraan Anda!
          </p>
        <div class="d-flex mt-4 justify-content-center">
            <a href="{{ route('diagnosis.index') }}" class="btn btn-custom"><span>Cek Sekarang</span></a>
        </div>
    </div>
</div>
@endsection