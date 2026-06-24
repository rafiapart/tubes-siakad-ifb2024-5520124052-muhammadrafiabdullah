@extends('layouts.app')

@section('header', 'Data Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <form method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Cari nama / kode..." value="{{ $search }}">
        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
    </form>
    <a href="{{ route('matakuliah.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg"></i> Tambah Mata Kuliah
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mataKuliah as $item)
                    <tr>
                        <td>{{ $item->kode_matakuliah }}</td>
                        <td>{{ $item->nama_matakuliah }}</td>
                        <td>{{ $item->sks }}</td>
                        <td class="text-end">
                            <a href="{{ route('matakuliah.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('matakuliah.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus mata kuliah ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data mata kuliah.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $mataKuliah->links() }}</div>
@endsection
