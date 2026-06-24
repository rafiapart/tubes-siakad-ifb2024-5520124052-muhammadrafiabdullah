@extends('layouts.app')

@section('header', 'KRS Saya')

@section('content')
<div class="row g-3">
    <div class="col-lg-7">
        <div class="card shadow-sm mb-3">
        <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
                    <span>Mata Kuliah yang Diambil</span>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="badge bg-dark">Total SKS: {{ $totalSks }}</span>
                        <a href="{{ route('krs.export-pdf') }}" class="btn btn-sm btn-outline-danger">
                            🖨️ Export PDF
                        </a>
                    </div>
                </div>
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
                        @forelse ($krs as $item)
                            <tr>
                                <td>{{ $item->kode_matakuliah }}</td>
                                <td>{{ $item->mataKuliah->nama_matakuliah ?? '-' }}</td>
                                <td>{{ $item->mataKuliah->sks ?? '-' }}</td>
                                <td class="text-end">
                                    <form action="{{ route('krs.destroy', $item) }}" method="POST" onsubmit="return confirm('Drop mata kuliah ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Drop</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">Belum ada mata kuliah yang diambil.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Ambil Mata Kuliah</div>
            <div class="card-body">
                <form method="POST" action="{{ route('krs.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Mata Kuliah</label>
                        <select name="kode_matakuliah" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach ($mataKuliahTersedia as $mk)
                                <option value="{{ $mk->kode_matakuliah }}">{{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
                            @endforeach
                        </select>
                        @if ($mataKuliahTersedia->isEmpty())
                            <small class="text-muted">Semua mata kuliah yang tersedia sudah anda ambil.</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Tambah ke KRS</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
