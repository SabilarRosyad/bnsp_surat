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
        <div class="mt-4">
            <div class="card shadow-lg border-0 rounded-4 p-4 d-flex flex-row align-items-center" style="background:linear-gradient(135deg,#f8fafc 80%,#e9ecef 100%);">
                <img src="{{ asset('images/foto1.jpg') }}" alt="Foto Profil" style="width:150px;height:200px;object-fit:cover;" class="rounded-3 border border-2 border-secondary me-4 shadow">
                <div>
                    <h4 class="fw-bold mb-3" style="letter-spacing:1px;">Aplikasi Arsip Surat Desa Karangduren</h4>
                    <p class="mb-2">Aplikasi ini dibuat oleh:</p>
                    <table class="table table-borderless mb-0" style="font-size:1rem;">
                        <tr><td class="fw-semibold text-secondary">Nama</td><td>: Muhammad Sabilar Rosyad</td></tr>
                        <tr><td class="fw-semibold text-secondary">Prodi</td><td>: D4 Teknik Informatika</td></tr>
                        <tr><td class="fw-semibold text-secondary">NIM</td><td>: 2141720113</td></tr>
                        <tr><td class="fw-semibold text-secondary">Tanggal</td><td>: 30 September 2025</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection