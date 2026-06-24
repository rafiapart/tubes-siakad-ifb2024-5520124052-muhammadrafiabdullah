@extends('layouts.app')

@section('header', 'Semua KRS Mahasiswa')

@section('content')
<form method="GET" class="d-flex gap-2 mb-3" style="max-width: 400px;">
    <input type="text" name="search" class="form-control" placeholder="Cari nama / NPM..." value="{{ $search }}">
    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
</form>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($krs as $item)
                    <tr>
                        <td>{{ $item->npm }}</td>
                        <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                        <td>{{ $item->kode_matakuliah }}</td>
                        <td>{{ $item->mataKuliah->nama_matakuliah ?? '-' }}</td>
                        <td>{{ $item->mataKuliah->sks ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">Belum ada data KRS.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $krs->links() }}</div>
@endsection
