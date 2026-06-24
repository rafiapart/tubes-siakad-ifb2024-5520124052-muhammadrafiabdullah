@extends('layouts.app')

@section('header', 'Edit Mahasiswa')

@section('content')
<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">NPM</label>
                <input type="text" class="form-control" value="{{ $mahasiswa->npm }}" disabled>
                <small class="text-muted">NPM tidak dapat diubah</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $mahasiswa->nama) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Dosen Wali</label>
                <select name="nidn" class="form-select">
                    <option value="">-- Tidak ada --</option>
                    @foreach ($dosenList as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn', $mahasiswa->nidn) == $dosen->nidn ? 'selected' : '' }}>
                            {{ $dosen->nama }} ({{ $dosen->nidn }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-dark">Update</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
