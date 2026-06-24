@extends('layouts.app')

@section('header', 'Tambah Mahasiswa')

@section('content')
<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="{{ route('mahasiswa.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">NPM</label>
                <input type="text" name="npm" maxlength="10" class="form-control" value="{{ old('npm') }}" required>
                <small class="text-muted">Harus 10 karakter</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Dosen Wali</label>
                <select name="nidn" class="form-select">
                    <option value="">-- Tidak ada --</option>
                    @foreach ($dosenList as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>
                            {{ $dosen->nama }} ({{ $dosen->nidn }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-dark">Simpan</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
