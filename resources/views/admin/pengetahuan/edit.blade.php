@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column justify-content-between align-items-start pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 welcome-message">{{ $title }}</h1>
    </div>

    <form action="{{ route('rule.update', $rule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="penyakit_id" class="form-label">Penyakit</label>
                    <select class="form-control" id="penyakit_id" name="penyakit_id" required>
                        <option value="">Pilih Penyakit</option>
                        @foreach($penyakit as $item)
                            <option value="{{ $item->id }}" {{ $rule->penyakit_id == $item->id ? 'selected' : '' }}>{{ $item->nama_penyakit }}</option>
                        @endforeach
                    </select>
                    @error('penyakit_id') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Gejala</label>
                    <div class="row">
                        @foreach($gejala as $item)
                            <div class="form-check">
                                <input class="form-check-input gejala-checkbox" type="checkbox" id="gejala_{{ $item->id }}" name="gejala_id[]" value="{{ $item->id }}" 
                                {{ in_array($item->id, old('gejala_id', explode(',', $rule->gejala_id))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="gejala_{{ $item->id }}">
                                    <b>{{ $item->kode_gejala }}</b>, {{ $item->nama_gejala }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('gejala_id') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="d-flex my-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/dashboard/rule" class="btn btn-secondary ms-3">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const gejalaCheckboxes = document.querySelectorAll('.gejala-checkbox');
        const penyakitSelect = document.getElementById('penyakit_id');

        async function handleCheckboxChange(checkbox) {
            const checkedCount = Array.from(gejalaCheckboxes).filter(cb => cb.checked).length;

            if (checkedCount > 1) {
                await Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Anda hanya bisa memilih satu gejala.',
                    confirmButtonText: 'OK',
                });

                checkbox.checked = false; // Batalkan pilihan terakhir
                return; // Jangan lanjutkan ke pengecekan duplikasi
            }

            if (checkbox.checked) {
                const penyakitId = penyakitSelect.value;

                // Kirim AJAX untuk memeriksa apakah gejala ini sudah digunakan
                const response = await fetch(`/check-duplicate-gejala?penyakit_id=${penyakitId}&gejala_id=${checkbox.value}`);
                const data = await response.json();

                if (data.exists) {
                    await Swal.fire({
                        icon: 'error',
                        title: 'Duplikasi Gejala',
                        text: 'Gejala ini sudah digunakan untuk penyakit yang dipilih.',
                        confirmButtonText: 'OK',
                    });

                    checkbox.checked = false; // Batalkan pilihan
                }
            }
        }

        gejalaCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => handleCheckboxChange(checkbox));
        });
    });
</script>


@endsection
