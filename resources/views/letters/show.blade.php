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
        <h2 class="mt-4">Arsip Surat &gt;&gt; Lihat</h2>
        <div class="mb-3">
            <strong>Nomor:</strong> {{ $letter->nomor_surat }}<br>
            <strong>Kategori:</strong> {{ $letter->kategori }}<br>
            <strong>Judul:</strong> {{ $letter->title }}<br>
            <strong>Waktu Unggah:</strong> {{ $letter->created_at->format('Y-m-d H:i') }}
        </div>
        <div class="border mb-3" style="height:400px;overflow:auto;background:#eee;display:flex;align-items:center;justify-content:center;">
            <iframe src="{{ asset('storage/' . $letter->file_path) }}" width="90%" height="380px"></iframe>
        </div>
        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('letters.index') }}" class="btn btn-secondary">&lt;&lt; Kembali</a>
            <a href="{{ route('letters.download', $letter->id) }}" class="btn btn-warning">Unduh</a>
            <a href="{{ route('letters.edit', $letter->id) }}" class="btn btn-info">Edit/Ganti File</a>
        </div>
    </div>
</div>
@endsection