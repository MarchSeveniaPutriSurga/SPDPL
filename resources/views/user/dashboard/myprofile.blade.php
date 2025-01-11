@extends('user.layouts.index')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-5">
        <span class="ms-3 text-dark user-name fs-8"><b>Hello!!</b> {{ $profile->user->name ?? Auth::user()->name }}</span>
        <a href="{{ route('user_profiles.edit') }}" class="btn btn-custom ms-auto">
            Edit Profile
        </a>
    </div>

    <!-- Profile Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column justify-content-between align-items-start pt-3 pb-2 mb-3 border-bottom">
                <h4>{{ $title }}</h4>
            </div>
            <!-- User Details -->
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" value="{{ $profile->user->name ?? Auth::user()->name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $profile->user->email ?? Auth::user()->email }}" disabled>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" value="{{ $profile->telepon ?? 'Belum diisi' }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control" value="{{ $profile->gender ?? 'Belum diisi' }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Umur</label>
                        <input type="text" class="form-control" value="{{ $profile->umur ?? 'Belum diisi' }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
