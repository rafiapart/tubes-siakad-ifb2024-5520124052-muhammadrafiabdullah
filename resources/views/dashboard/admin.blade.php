@extends('layouts.app')

@section('header', 'Dashboard Admin')

@section('content')
<div class="row g-3">
    <div class="col-md-3 col-6">
        <div class="card card-stat shadow-sm">
            <div class="card-body">
                <div class="text-muted small">Total Dosen</div>
                <div class="fs-3 fw-bold">{{ $totalDosen }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card card-stat shadow-sm">
            <div class="card-body">
                <div class="text-muted small">Total Mahasiswa</div>
                <div class="fs-3 fw-bold">{{ $totalMahasiswa }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card card-stat shadow-sm">
            <div class="card-body">
                <div class="text-muted small">Mata Kuliah</div>
                <div class="fs-3 fw-bold">{{ $totalMataKuliah }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card card-stat shadow-sm">
            <div class="card-body">
                <div class="text-muted small">Jadwal Aktif</div>
                <div class="fs-3 fw-bold">{{ $totalJadwal }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 shadow-sm">
    <div class="card-body">
        <h6 class="fw-bold mb-1">Total Entri KRS</h6>
        <p class="fs-4 mb-0">{{ $totalKrs }} entri mata kuliah diambil mahasiswa</p>
    </div>
</div>
@endsection
