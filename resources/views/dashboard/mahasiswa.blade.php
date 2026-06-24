@extends('layouts.app')

@section('header', 'Dashboard Mahasiswa')

@section('content')
@if (!$mahasiswa)
    <div class="alert alert-warning">
        Akun anda belum terhubung dengan data mahasiswa. Hubungi admin untuk menautkan NPM anda.
    </div>
@else
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-stat shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">NPM</div>
                    <div class="fs-5 fw-bold">{{ $mahasiswa->npm }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Dosen Wali</div>
                    <div class="fs-5 fw-bold">{{ $mahasiswa->dosenWali->nama ?? '-' }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Total SKS Diambil</div>
                    <div class="fs-5 fw-bold">{{ $totalSks }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-semibold">Mata Kuliah yang Sedang Diambil</div>
        <div class="card-body p-0">
            <table class="table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($krs as $item)
                        <tr>
                            <td>{{ $item->kode_matakuliah }}</td>
                            <td>{{ $item->mataKuliah->nama_matakuliah ?? '-' }}</td>
                            <td>{{ $item->mataKuliah->sks ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada mata kuliah yang diambil. Silakan ke menu "KRS Saya".</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
