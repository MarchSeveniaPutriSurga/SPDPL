@extends('public.index')
@section('content')
<body class="body1">
    <div class="container section-title mt-5" data-aos="fade-up" data-aos-delay="100">
        <span class="brand-text font-weight-bold" style="font-size: 2rem; font-weight: bold; display: block;">
            <span><b>Alur Sistem</b></span> 
        </span>
      </div>
    <div class="timeline">
        <div class="connector-container">
            <svg class="connector-svg" id="connectorSvg"></svg>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="year">Registrasi dan Login</div>
                <div class="description">
                    Pengguna harus melakukan registrasi dan login terlebih dahulu untuk mengakses sistem pakar. Jika belum memiliki akun GastroCare silahkan melakukan registasi terlebih dahulu.
                </div>
            </div>
            <div class="timeline-icon icon-1">
                <div class="icon-inner">
                    <img src="{{ asset('img/alurLogin.png') }}" alt="Icon 1">
                </div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="year">Proses Diagnosa</div>
                <div class="description">
                    Pengguna dapat mulai mendiagnosa penyakit dengan menjawab pertanyaan gejala (YA atau TIDAK). Sistem akan menggunakan metode forward chaining untuk mencocokkan gejala dengan penyakit yang sesuai berdasarkan aturan dalam tabel pengetahuan.
                </div>
            </div>
            <div class="timeline-icon icon-2">
                <div class="icon-inner">
                    <img src="{{ asset('img/alurDiagnosa.png') }}" alt="Icon 2">
                </div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="year">Hasil Diagnosa</div>
                <div class="description">
                    Setelah diagnosa selesai, sistem menampilkan daftar penyakit yang sesuai dengan gejala yang dipilih, lengkap dengan solusi pencegahan dan rekomendasi obat jika tersedia.
                </div>
            </div>
            <div class="timeline-icon icon-3">
                <div class="icon-inner">
                    <img src="{{ asset('img/alurHasil.png') }}" alt="Icon 3">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function createSmoothPath() {
        const svg = document.getElementById('connectorSvg');
        const timelineItems = document.querySelectorAll('.timeline-item');
        const timeline = document.querySelector('.timeline');
        
        svg.innerHTML = '';
        svg.style.width = timeline.offsetWidth + 'px';
        svg.style.height = timeline.offsetHeight + 'px';

        const timelineRect = timeline.getBoundingClientRect();
        const points = Array.from(timelineItems).map(item => {
            const icon = item.querySelector('.timeline-icon');
            const rect = icon.getBoundingClientRect();
            return {
                x: rect.left + rect.width / 2 - timelineRect.left,
                y: rect.top + rect.height / 2 - timelineRect.top
            };
        });

        const amplitude = 280; // Amplitude untuk lengkungan garis
        let pathD = `M ${points[0].x},${points[0].y}`;
        
        // Membuat lintasan yang lebih melengkung
        for (let i = 0; i < points.length - 1; i++) {
            const current = points[i];
            const next = points[i + 1];
            const cp1 = {
                x: current.x + amplitude,
                y: current.y
            };
            const cp2 = {
                x: next.x - amplitude,
                y: next.y
            };
            pathD += ` C ${cp1.x},${cp1.y} ${cp2.x},${cp2.y} ${next.x},${next.y}`;
        }

        const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
        path.setAttribute("d", pathD);
        path.setAttribute("fill", "none");
        path.setAttribute("stroke", "#FF9E80");
        path.setAttribute("stroke-width", "3");
        path.setAttribute("stroke-dasharray", "8,12"); // Garis putus-putus
        path.setAttribute("stroke-linecap", "round");

        svg.appendChild(path);
    }

    window.addEventListener('load', createSmoothPath);
    window.addEventListener('resize', createSmoothPath);
</script>
@endpush