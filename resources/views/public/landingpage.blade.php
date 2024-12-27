@extends('public.index')

@section('content')
<div class="container">
  <div class="container-fluid">
    <div class="row gy-4">
      <div class="col-lg-6 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
        <img src="{{ asset('img/landingpage.png') }}" class="img-fluid animated" alt="">
      </div>
      <div class="col-lg-6  d-flex flex-column justify-content-center text-center text-md-start" data-aos="fade-in">
        <span class="brand-text font-weight-bold" style="font-size: 3rem; font-weight: bold; display: block;">
            <span style="color: #AE445A;">Gastro</span><span style="color: #740938;">Care</span>
        </span>
        <p>merupakan sistem pakar cerdas yang dirancang untuk membantu mendiagnosis dan memberikan solusi awal 
            terhadap berbagai penyakit lambung dan masalah pencernaan. Dengan basis pengetahuan dari para ahli 
            medis dan teknologi terkini. <br>
            <b>GastroCare</b> mampu menganalisis gejala secara cepat dan akurat, sekaligus 
            memberikan edukasi tentang pencegahan serta penanganan yang tepat. Sistem ini hadir untuk mempermudah 
            masyarakat mengenali kondisi kesehatan lambung mereka, mendukung langkah perawatan dini, dan meningkatkan 
            kesadaran akan pentingnya menjaga kesehatan sistem pencernaan.</p>
        <div class="d-flex mt-4 justify-content-center justify-content-md-start">
          <a href="{{ route('login') }}" class="download-btn"><span>Cek Sekarang</span></a>
        </div>
      </div>
    </div>
</div>
</div>
@endsection
