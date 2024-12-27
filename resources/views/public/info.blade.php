@extends('public.index')

@section('content')
<div class="container">
  <div class="container-fluid">
    <div class="container section-title mt-5" data-aos="fade-up" data-aos-delay="100">
      <span class="brand-text font-weight-bold" style="font-size: 3rem; font-weight: bold; display: block;">
        <span style="color: #AE445A;">Gastro</span><span style="color: #740938;">Care</span>
      </span>
      <p class="fst-italic">
        Sebuah sistem pakar untuk mendiagnosis penyakit lambung.
      </p>
    </div>
  
    <div class="row gy-4 align-items-center features-item">
        <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
          <img src="{{ asset('img/info.png') }}" class="img-fluid" alt="">
        </div>
        <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
          <h3 class="fst-italic" style="font-weight: bold;">GastroCare</h3>
          <p>
            Sistem ini bertujuan untuk membantu mendiagnosa berbagai jenis penyakit lambung seperti 
            gastritis, tukak lambung, GERD, dan lain-lain. Sistem ini dirancang menggunakan kercedasan buatan 
            yang dapat melakukan diagnosis dini dari gejala-gejala penyakit lambung tanpa bertemu dengan dokter 
            secara langsung serta memberikan saran pengobatan yang sesuai dengan hasil diagnosis. Sistem ini 
            bekerja dengan mengumpulkan gejala yang dialami oleh pasien, kemudian menganalisisnya 
            menggunakan basis pengetahuan yang telah di pogramkan. User akan memasukkan gejala yang dirasakan 
            di antarmuka pengguna, seperti nyeri perut, mual, muntah, atau masalah pencernaan lainnya. Kemudian 
            sistem membandingkan gejala tersebut dengan pola penyakit lambung yang umum, seperti tukak 
            lambung, gastritis, penyakit refluks lambung (GERD), dan lainnya.
          </p>
    </div>
  
    <div class="row gy-4 align-items-center features-item mb-3">
      <div data-aos="fade-up" data-aos-delay="200">
        <p>
          Sistem pakar ini mencakup berbagai jenis penyakit yang terkait dengan gangguan lambung, yang dapat didiagnosis 
          berdasarkan gejala yang diberikan. Beberapa penyakit yang tersedia dalam sistem ini antara lain Gastroesofagus 
          (GERD), Kanker Lambung, Gastroenteritis, Gastritis, dan Tukak Lambung.
        </p>
        <ul>
          <li><b>Gastroesofagus (GERD)</b> merupakan asam lambung naik ke esofagus atau kerongkongan, itu disebut penyakit asam lambung</li>
          <li><b>Kanker Lambung</b> merupakan pertumbuhan sel lambung yang tidak normal dan tidak terkendali adalah penyebab kanker lambung. Pertumbuhan ini terjadi karena perubahan genetik yang terjadi pada sel lambung.</li>
          <li><b> Gastritis</b>  biasanya disebut maag oleh orang awam, adalah peradangan lambung yang disebabkan oleh peningkatan sekresi asam lambung, yang menyebabkan iritasi dan peradangan pada lambung</li>
          <li><b>Gastroenteritis</b> disebut sebagai flu perut, adalah infeksi pada usus atau perut yang disebabkan oleh beberapa jenis virus. Ini dapat menyebabkan mual, muntah, diare, kram perut, dan terkadang demam</li>
          <li><b>Tukak Lambung</b> dikenal sebagai penyakit luka lambung (PUD), terjadi karena ketidakseimbangan antara faktor agresif seperti sekresi </li>
        </ul>
      </div>
    </div>
    
  </div>
</div>
@endsection