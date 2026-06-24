@extends('layouts.app')

@section('header', 'Tambah Dosen')

@section('content')
<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="{{ route('dosen.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">NIDN</label>
                <input type="text" name="nidn" maxlength="10" class="form-control" value="{{ old('nidn') }}" required>
                <small class="text-muted">Harus 10 karakter</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Dosen</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <button type="submit" class="btn btn-dark">Simpan</button>
            <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
