@extends('layout.master')

@section('title', 'Hasil Pencarian Buku')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-2">Hasil Pencarian Buku</h1>

    <a href="{{ route('buku.create') }}" class="btn btn-primary mb-2">
        + Tambah Buku
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"></button>
    </div>
@endif

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('buku.search') }}"
              method="GET"
              class="d-flex flex-wrap gap-2">

            <label for="cari" class="visually-hidden">
                Cari buku
            </label>

            <input type="text"
                   id="cari"
                   name="cari"
                   value="{{ $cari }}"
                   class="form-control"
                   style="max-width: 320px;"
                   placeholder="Cari judul atau penulis...">

            <button type="submit" class="btn btn-outline-primary">
                Cari
            </button>

            <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                Kembali ke Data Buku
            </a>
        </form>
    </div>
</div>

@if ($jumlah_hasil > 0)
    <div class="alert alert-success">
        Ditemukan <strong>{{ $jumlah_hasil }}</strong> data dengan kata kunci
        <strong>{{ $cari }}</strong>.
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Tanggal Terbit</th>
                        <th style="min-width: 150px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data_buku as $buku)
                        <tr>
                            <td>{{ $no + $loop->iteration }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>
                                Rp {{ number_format($buku->harga, 0, ',', '.') }}
                            </td>
                            <td>
                                {{ $buku->tgl_terbit->format('d/m/Y') }}
                            </td>

                            <td>
                                <a href="{{ route('buku.edit', $buku->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('buku.destroy', $buku->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-body">
            {{ $data_buku->links() }}
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <h2 class="h5">Data "{{ $cari }}" tidak ditemukan.</h2>

        <p class="mb-0">
            Coba gunakan kata kunci lain atau kembali ke daftar buku.
        </p>
    </div>
@endif
@endsection