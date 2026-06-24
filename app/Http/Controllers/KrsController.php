<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\MataKuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    /**
     * Mahasiswa: lihat KRS milik sendiri + daftar mata kuliah yang bisa diambil.
     */
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        abort_unless($mahasiswa, 403, 'Akun anda belum terhubung dengan data mahasiswa. Hubungi admin.');

        $krs = Krs::with('mataKuliah')
            ->where('npm', $mahasiswa->npm)
            ->get();

        $diambil = $krs->pluck('kode_matakuliah');

        $mataKuliahTersedia = MataKuliah::whereNotIn('kode_matakuliah', $diambil)
            ->orderBy('nama_matakuliah')
            ->get();

        $totalSks = $krs->sum(fn ($item) => $item->mataKuliah->sks ?? 0);

        return view('krs.index', compact('mahasiswa', 'krs', 'mataKuliahTersedia', 'totalSks'));
    }

    public function exportPdf()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        abort_unless($mahasiswa, 403, 'Akun anda belum terhubung dengan data mahasiswa.');

        $krs = Krs::with('mataKuliah')
            ->where('npm', $mahasiswa->npm)
            ->get();

        $totalSks = $krs->sum(fn($item) => $item->mataKuliah->sks ?? 0);

        $pdf = Pdf::loadView('krs.pdf', compact('mahasiswa', 'krs', 'totalSks'));

        return $pdf->download('KRS-' . $mahasiswa->npm . '.pdf');
    }

    /**
     * Mahasiswa: ambil mata kuliah (tambah ke KRS).
     */
    public function store(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        abort_unless($mahasiswa, 403, 'Akun anda belum terhubung dengan data mahasiswa. Hubungi admin.');

        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'string', 'exists:matakuliah,kode_matakuliah'],
        ]);

        $sudahAmbil = Krs::where('npm', $mahasiswa->npm)
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->exists();

        if ($sudahAmbil) {
            return back()->with('error', 'Mata kuliah ini sudah ada di KRS anda.');
        }

        Krs::create([
            'npm' => $mahasiswa->npm,
            'kode_matakuliah' => $validated['kode_matakuliah'],
        ]);

        return redirect()->route('krs.index')->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    /**
     * Mahasiswa: drop / hapus mata kuliah dari KRS miliknya sendiri.
     */
    public function destroy(Krs $krs)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        abort_unless($mahasiswa && $krs->npm === $mahasiswa->npm, 403, 'Anda tidak dapat menghapus KRS mahasiswa lain.');

        $krs->delete();

        return redirect()->route('krs.index')->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }

    /**
     * Admin: lihat seluruh KRS semua mahasiswa (bonus: pencarian & filter).
     */
    public function all(Request $request)
    {
        $search = $request->query('search');

        $krs = Krs::with(['mahasiswa', 'mataKuliah'])
            ->when($search, function ($query, $search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('npm', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('krs.all', compact('krs', 'search'));
    }
}
