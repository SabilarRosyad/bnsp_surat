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
        <h2 class="mt-4">Kategori Surat</h2>
        <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.<br>Klik "Tambah" pada kolom aksi untuk menambahkan kategori baru.</p>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="GET" action="{{ route('categories.index') }}" class="mb-3 d-flex align-items-center">
            <label for="search" class="me-2">Cari kategori:</label>
            <input type="text" name="search" id="search" class="form-control me-2" style="max-width:300px;" placeholder="search" value="{{ request('search') }}">
            <button class="btn btn-dark" type="submit">Cari!</button>
        </form>
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-sm bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">ID Kategori</th>
                    <th class="px-4 py-2 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">Nama Kategori</th>
                    <th class="px-4 py-2 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">Keterangan</th>
                    <th class="px-4 py-2 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $category->id }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $category->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $category->description }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600 d-flex align-items-center gap-1">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-eye">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="bg-danger text-white px-3 py-1 rounded text-xs btn-hapus-kategori" style="background:#dc3545;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-4 py-2">Tidak ada kategori ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
                {{ $categories->links() }}
                <a href="{{ route('categories.create') }}" class="btn btn-success mt-3">[ + ] Tambah Kategori Baru...</a>

                <!-- Modal Konfirmasi Hapus Kategori -->
                <div class="modal fade" id="modalHapusKategori" tabindex="-1" aria-labelledby="modalHapusKategoriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalHapusKategoriLabel">Konfirmasi Hapus Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus kategori ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger" id="btnYaHapusKategori">Ya!</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                let formToDeleteKategori;
                document.querySelectorAll('.btn-hapus-kategori').forEach(btn => {
                        btn.addEventListener('click', function(e) {
                                formToDeleteKategori = this.closest('form');
                                var modal = new bootstrap.Modal(document.getElementById('modalHapusKategori'));
                                modal.show();
                        });
                });
                document.getElementById('btnYaHapusKategori').addEventListener('click', function() {
                        if (formToDeleteKategori) formToDeleteKategori.submit();
                });
                </script>
    </div>
</div>
@endsection