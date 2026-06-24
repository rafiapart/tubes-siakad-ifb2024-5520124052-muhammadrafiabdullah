@extends('layouts.app')

@section('header', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <form method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Cari nama / NPM..." value="{{ $search }}">
        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
    </form>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Dosen Wali</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $item)
                    <tr>
                        <td>{{ $item->npm }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->dosenWali->nama ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('mahasiswa.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data mahasiswa ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data mahasiswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $mahasiswa->links() }}</div>
@endsection
