<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return view('dashboard.admin', [
                'totalDosen' => Dosen::count(),
                'totalMahasiswa' => Mahasiswa::count(),
                'totalMataKuliah' => MataKuliah::count(),
                'totalJadwal' => Jadwal::count(),
                'totalKrs' => Krs::count(),
            ]);
        }

        $mahasiswa = $user->mahasiswa;

        $krs = $mahasiswa
            ? Krs::with('mataKuliah')->where('npm', $mahasiswa->npm)->get()
            : collect();

        $totalSks = $krs->sum(fn ($item) => $item->mataKuliah->sks ?? 0);

        return view('dashboard.mahasiswa', compact('mahasiswa', 'krs', 'totalSks'));
    }
}
