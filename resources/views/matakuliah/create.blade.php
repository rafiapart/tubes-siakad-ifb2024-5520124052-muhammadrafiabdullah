@extends('layouts.app')

@section('header', 'Tambah Mata Kuliah')

@section('content')
<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="{{ route('matakuliah.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode Mata Kuliah</label>
                <input type="text" name="kode_matakuliah" maxlength="8" class="form-control" value="{{ old('kode_matakuliah') }}" required>
                <small class="text-muted">Harus 8 karakter, contoh: IF010101</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah" class="form-control" value="{{ old('nama_matakuliah') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" min="1" max="6" class="form-control" value="{{ old('sks') }}" required>
            </div>
            <button type="submit" class="btn btn-dark">Simpan</button>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
