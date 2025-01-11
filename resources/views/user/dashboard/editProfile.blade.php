@extends('user.layouts.index')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex flex-column justify-content-between align-items-start pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 welcome-message">{{ $title }}</h1>
    </div>

    <!-- Edit Profile Card -->
    <div class="card">
        <div class="card-body">
            <!-- Form Edit User Profile -->
            <form action="{{ route('user_profiles.update') }}" method="POST">
                @csrf
                @method('PUT') <!-- Method PUT untuk update -->

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', Auth::user()->name) }}" 
                                placeholder="Masukkan nama">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', Auth::user()->email) }}" 
                                placeholder="Masukkan email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="telepon" 
                                name="telepon" 
                                value="{{ old('telepon', $profile->telepon ?? '') }}" 
                                placeholder="Masukkan nomor telepon">
                            @error('telepon')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" id="gender">
                                <option value="" disabled {{ is_null($profile->gender) ? 'selected' : '' }}>Pilih Gender</option>
                                <option value="Male" {{ $profile->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $profile->gender === 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="umur" 
                                name="umur" 
                                value="{{ old('umur', $profile->umur_asli ?? '') }}" 
                                placeholder="Masukkan umur">
                            @error('umur')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
