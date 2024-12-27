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
                                    {{ $item->nama_gejala }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('gejala_id') 
                        <div class="text-danger">{{ $message }}</div> 
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

<script>
    // Batasi hanya satu checkbox yang dapat dipilih
    const checkboxes = document.querySelectorAll('.gejala-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            // Cek jika lebih dari satu yang dipilih
            const selectedCheckboxes = document.querySelectorAll('.gejala-checkbox:checked');
            if (selectedCheckboxes.length > 1) {
                alert('Hanya boleh memilih satu gejala.');
                checkbox.checked = false;  // Batalkan pilihan
            }
        });
    });
</script>

@endsection
