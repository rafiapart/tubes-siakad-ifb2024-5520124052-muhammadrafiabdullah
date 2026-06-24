@extends('layouts.app')

@section('header', 'Edit Jadwal')

@section('content')
<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="{{ route('jadwal.update', $jadwal) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Mata Kuliah</label>
                <select name="kode_matakuliah" class="form-select" required>
                    @foreach ($mataKuliahList as $mk)
                        <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>
                            {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Dosen Pengajar</label>
                <select name="nidn" class="form-select" required>
                    @foreach ($dosenList as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn', $jadwal->nidn) == $dosen->nidn ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" maxlength="1" class="form-control" value="{{ old('kelas', $jadwal->kelas) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hari</label>
                <select name="hari" class="form-select" required>
                    @foreach ($hariList as $hari)
                        <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jam</label>
                <input type="time" name="jam" class="form-control" value="{{ old('jam', \Illuminate\Support\Carbon::parse($jadwal->jam)->format('H:i')) }}" required>
            </div>
            <button type="submit" class="btn btn-dark">Update</button>
            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
