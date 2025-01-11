@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column justify-content-between align-items-start pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 welcome-message">{{ $title }}</h1>
    </div>

    <form action="{{ route('rule.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="penyakit_id" class="form-label">Penyakit</label>
                    <select class="form-control" id="penyakit_id" name="penyakit_id" required>
                        <option value="">Pilih Penyakit</option>
                        @foreach($penyakit as $item)
                            <option value="{{ $item->id }}" {{ old('penyakit_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_penyakit }}</option>
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
                                <input class="form-check-input" type="checkbox" id="gejala_{{ $item->id }}" name="gejala_id[]" value="{{ $item->id }}" {{ in_array($item->id, old('gejala_id', [])) ? 'checked' : '' }}>
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

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
