@extends('layouts.app')

@section('header', 'Jadwal Perkuliahan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <form method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Cari hari / mata kuliah / dosen..." value="{{ $search }}">
        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
    </form>
    @if (auth()->user()->isAdmin())
        <a href="{{ route('jadwal.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-lg"></i> Tambah Jadwal
        </a>
    @endif
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>Dosen Pengajar</th>
                    @if (auth()->user()->isAdmin())
                        <th class="text-end">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwal as $item)
                    <tr>
                        <td>{{ $item->hari }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($item->jam)->format('H:i') }}</td>
                        <td>{{ $item->mataKuliah->nama_matakuliah ?? '-' }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->dosen->nama ?? '-' }}</td>
                        @if (auth()->user()->isAdmin())
                            <td class="text-end">
                                <a href="{{ route('jadwal.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('jadwal.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-3">Belum ada data jadwal.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $jadwal->links() }}</div>
@endsection
