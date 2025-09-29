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
        <h2 class="mt-4 mb-4">Tambah Kategori Surat</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3 row items-center">
                <label class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">ID Berikutnya</label>
                <div class="col-sm-9">
                    <input type="text" class="border rounded px-3 py-2 w-full bg-gray-100 text-gray-500" value="{{ $nextId }}" readonly>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="name" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
            </div>
            <div class="mb-3 row items-center">
                <label for="description" class="col-sm-3 block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <div class="col-sm-9">
                    <input type="text" name="description" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300">
                </div>
            </div>
            <div class="mb-3 flex gap-2">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-dark mt-3">&lt;&lt; Kembali</a>
                <button type="submit" class="btn btn-outline-dark mt-3">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection