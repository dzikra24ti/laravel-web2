@extends('admin.template')
@section('title', 'Edit Pelanggan')
@section('content')

        <div class="py-4">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}"> {{-- Diperbaiki: Mengarahkan ke rute dashboard --}}
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </a>
                    </li>
                    {{-- Perbaikan: Breadcrumb Pelanggan harus mengarah ke index --}}
                    <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data</li> {{-- Diperbaiki: Teks Breadcrumb --}}
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Edit Pelanggan</h1>
                    <p class="mb-0">Form untuk mengedit data pelanggan.</p> {{-- Diperbaiki: Menghilangkan kata 'baru' --}}
                </div>
                <div>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        {{-- PERBAIKAN UTAMA: ACTION FORM --}}
                        {{-- Mengarahkan ke rute pelanggan.update dan menambahkan parameter pelanggan_id --}}
                        <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST">
                            @csrf
                            {{-- Digunakan untuk spoofing metode menjadi PUT/PATCH untuk operasi UPDATE --}}
                            @method('PUT')

                            <div class="row mb-4">
                                <div class="col-lg-4 col-sm-6">
                                    <!-- First Name -->
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First name</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                               value="{{ $dataPelanggan->first_name }}" required> {{-- Diisi dengan data lama --}}
                                    </div>

                                    <!-- Last Name -->
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last name</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control"
                                               value="{{ $dataPelanggan->last_name }}" required> {{-- Diisi dengan data lama --}}
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <!-- Birthday -->
                                    <div class="mb-3">
                                        <label for="birthday" class="form-label">Birthday</label>
                                        <input type="date" id="birthday" name="birthday" class="form-control"
                                               value="{{ $dataPelanggan->birthday }}"> {{-- Diisi dengan data lama --}}
                                    </div>

                                    <!-- Gender -->
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" name="gender" class="form-select">
                                            <option value="">-- Pilih --</option>
                                            {{-- Menambahkan 'selected' jika data lama cocok dengan opsi --}}
                                            <option value="Male" {{ $dataPelanggan->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $dataPelanggan->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ $dataPelanggan->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12">
                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                               value="{{ $dataPelanggan->email }}" required> {{-- Diisi dengan data lama --}}
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                               value="{{ $dataPelanggan->phone }}"> {{-- Diisi dengan data lama --}}
                                    </div>

                                    <!-- Buttons -->
                                    <div class="mt-4"> {{-- Tambahkan sedikit margin atas agar tombol tidak terlalu mepet --}}
                                        <button type="submit" class="btn btn-info">Simpan Perubahan</button> {{-- Diperbaiki: Teks tombol --}}
                                        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
