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
        <h2 class="mt-4">Arsip Surat</h2>
        <p>Berikut ini adalah surat yang telah terbit dan diarsipkan.<br>Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="GET" action="{{ route('letters.index') }}" class="mb-3 d-flex align-items-center">
            <label for="search" class="me-2">Cari surat:</label>
            <input type="text" name="search" id="search" class="form-control me-2" style="max-width:300px;" placeholder="search" value="{{ request('search') }}">
            <button class="btn btn-dark" type="submit">Cari!</button>
        </form>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Nomor Surat</th>
                        <th>Diarsipkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($letters as $letter)
                    <tr>
                        <td>{{ $letter->title }}</td>
                        <td>{{ $letter->kategori ?? '-' }}</td>
                        <td>{{ $letter->nomor_surat ?? '-' }}</td>
                        <td>{{ $letter->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('letters.show', $letter->id) }}" class="btn btn-outline-primary btn-sm me-1"><i class="bi bi-eye"></i> Lihat</a>
                            <a href="{{ route('letters.download', $letter->id) }}" class="btn btn-outline-warning btn-sm me-1"><i class="bi bi-download"></i> Unduh</a>
                            <form action="{{ route('letters.destroy', $letter->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada surat ditemukan.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- Modal Konfirmasi Hapus -->
        <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Apakah Anda yakin ingin menghapus surat ini?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="btnYaHapus">Ya!</button>
              </div>
            </div>
          </div>
        </div>
        <script>
            console.log("Bootstrap Modal available? =>", typeof bootstrap !== 'undefined' ? bootstrap.Modal : "NOT LOADED");
            let formToDelete;
            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    formToDelete = this.closest('form');
                    var modal = new bootstrap.Modal(document.getElementById('modalHapus'));
                    modal.show();
                });
            });
            document.getElementById('btnYaHapus').addEventListener('click', function() {
                if (formToDelete) formToDelete.submit();
            });
        </script>
        {{ $letters->links() }}
        <a href="{{ route('letters.create') }}" class="btn btn-outline-dark mt-3">Arsipkan Surat..</a>
    </div>
</div>

@endsection