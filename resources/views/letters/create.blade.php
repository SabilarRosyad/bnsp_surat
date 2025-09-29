@extends('layouts.app')

@section('content')
<style>
    .menu-link {
        font-weight: 500;
        padding: 10px 15px;
        border-radius: 8px;
        color: #212529;
        transition: all 0.3s ease;
        display: block;
    }

    .menu-link:hover {
        background-color: #e0e0e0; 
        text-decoration: none;
    }
</style>

<div class="row">
    <div class="col-md-2 bg-light" style="min-height: 100vh; border-radius: 12px 0 0 12px;">
        <ul class="nav flex-column mb-4 mt-4 text-center">
            <li class="nav-item mb-3">
                <span class="fw-bold text-dark" style="font-size:16px;letter-spacing:1px;">Menu</span>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link menu-link" href="{{ route('letters.index') }}">Arsip</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link menu-link" href="{{ route('categories.index') }}">Kategori Surat</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link menu-link" href="{{ route('about') }}">About</a>
            </li>
        </ul>
    </div>
    <div class="col-md-9">
        <h2 class="mt-4">Arsip Surat &gt;&gt; Unggah</h2>
        <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.<br>
        <strong>Catatan:</strong><br>
        &bull; Gunakan file berformat PDF
        </p>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('letters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row items-center">
                <label for="nomor_surat" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Nomor Surat</label>
                <div class="col-sm-9">
                    <input type="text" name="nomor_surat" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="kategori" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <div class="col-sm-9">
                    <select name="kategori" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="title" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="date" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <div class="col-sm-9">
                    <input type="date" name="date" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="file" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">File Surat (PDF)</label>
                <div class="col-sm-6">
                    <input type="file" name="file" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" accept="application/pdf" required>
                </div>
            </div>
            <div class="mb-3 flex gap-2">
                <button type="button" class="btn btn-outline-dark mt-3" onclick="window.location='{{ route('letters.index') }}'">&lt;&lt; Kembali</button>
                <button type="submit" class="btn btn-outline-dark mt-3">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection