@extends('layouts.app')

@section('header', 'Edit Dosen')

@section('content')
<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="{{ route('dosen.update', $dosen) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">NIDN</label>
                <input type="text" class="form-control" value="{{ $dosen->nidn }}" disabled>
                <small class="text-muted">NIDN tidak dapat diubah</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Dosen</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $dosen->nama) }}" required>
            </div>
            <button type="submit" class="btn btn-dark">Update</button>
            <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
