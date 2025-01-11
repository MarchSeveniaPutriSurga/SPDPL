@extends('user.layouts.index')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <h2 class="text-center">Proses Diagnosis</h2>
            <hr>

            @if(isset($gejalaPertama))
                <div class="text-center">
                    <h5 class="mb-4">Apakah Anda mengalami gejala berikut?</h5>
                    <p class="fs-6 fw-bold text-dark">{{ $gejalaPertama->nama_gejala }}</p>
                </div>

                <form id="form-diagnosis">
                    @csrf
                    <input type="hidden" name="idgejala" value="{{ $gejalaPertama->id }}">
                    <div class="d-flex justify-content-center gap-4 mt-4">
                        <button type="button" id="btn-yes" class="btn btn-success">Ya</button>
                        <button type="button" id="btn-no" class="btn btn-danger">Tidak</button>
                    </div>
                </form>
            @else
                <p class="text-center">Tidak ada gejala yang ditemukan.</p>
                <div class="text-center mt-3">
                    <a href="{{ route('diagnose') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal untuk penyakit tidak terdeteksi -->
<div class="modal fade" id="penyakitUnidentifiedModal" tabindex="-1" aria-labelledby="penyakitUnidentifiedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="penyakitUnidentifiedModalLabel">Penyakit Tidak Terdeteksi</h5>
            </div>
            <div class="modal-body text-center">
                Maaf, tidak ada penyakit yang terdeteksi berdasarkan gejala yang Anda pilih. Kami sarankan untuk segera berkonsultasi dengan dokter.
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a href="{{ route('diagnose') }}" class="btn btn-primary">Oke</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-diagnosis');

    document.getElementById('btn-yes').addEventListener('click', () => submitForm('true'));
    document.getElementById('btn-no').addEventListener('click', () => submitForm('false'));

    function submitForm(value) {
        const formData = new FormData(form);
        formData.append('value', value);

        fetch("{{ route('diagnosis.process') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal memuat data. Silakan coba lagi.');
            }
            return response.json();
        })
        .then(data => {
            console.log('Response from server:', data); // Debugging

            if (data.nextGejala) {
                // Update gejala berikutnya
                const nextGejalaElement = document.querySelector('p.fs-6.fw-bold.text-dark');
                if (nextGejalaElement) {
                    nextGejalaElement.textContent = data.nextGejala.nama_gejala;
                }
                const idGejalaInput = document.querySelector('input[name="idgejala"]');
                if (idGejalaInput) {
                    idGejalaInput.value = data.nextGejala.id;
                }
            } else if (data.idPenyakit) {
                // Redirect ke halaman hasil
                window.location.href = "{{ route('diagnose.result') }}?id=" + data.idPenyakit.id;
            } else if (data.penyakitUnidentified) {
                // Tampilkan modal jika penyakit tidak terdeteksi
                const modalElement = document.getElementById('penyakitUnidentifiedModal');
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            } else {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }
});
</script>
@endsection
