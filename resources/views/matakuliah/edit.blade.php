@extends('layouts.app')

@section('header', 'Edit Mata Kuliah')

@section('content')
<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="{{ route('matakuliah.update', $matakuliah) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Kode Mata Kuliah</label>
                <input type="text" class="form-control" value="{{ $matakuliah->kode_matakuliah }}" disabled>
                <small class="text-muted">Kode tidak dapat diubah</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah" class="form-control" value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" min="1" max="6" class="form-control" value="{{ old('sks', $matakuliah->sks) }}" required>
            </div>
            <button type="submit" class="btn btn-dark">Update</button>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
