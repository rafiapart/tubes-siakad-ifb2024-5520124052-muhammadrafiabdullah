<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    private array $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    /**
     * Bisa diakses admin maupun mahasiswa (lihat jadwal).
     * Tombol tambah/edit/hapus hanya ditampilkan untuk admin di view.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $jadwal = Jadwal::with(['dosen', 'mataKuliah'])
            ->when($search, function ($query, $search) {
                $query->where('hari', 'like', "%{$search}%")
                      ->orWhereHas('mataKuliah', function ($q) use ($search) {
                          $q->where('nama_matakuliah', 'like', "%{$search}%");
                      })
                      ->orWhereHas('dosen', function ($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      });
            })
            ->orderBy('hari')
            ->orderBy('jam')
            ->paginate(10)
            ->withQueryString();

        return view('jadwal.index', compact('jadwal', 'search'));
    }

    public function create()
    {
        $dosenList = Dosen::orderBy('nama')->get();
        $mataKuliahList = MataKuliah::orderBy('nama_matakuliah')->get();
        $hariList = $this->hariList;

        return view('jadwal.create', compact('dosenList', 'mataKuliahList', 'hariList'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateJadwal($request);

        Jadwal::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $jadwal)
    {
        $dosenList = Dosen::orderBy('nama')->get();
        $mataKuliahList = MataKuliah::orderBy('nama_matakuliah')->get();
        $hariList = $this->hariList;

        return view('jadwal.edit', compact('jadwal', 'dosenList', 'mataKuliahList', 'hariList'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $this->validateJadwal($request);

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    private function validateJadwal(Request $request): array
    {
        return $request->validate([
            'kode_matakuliah' => ['required', 'string', 'exists:matakuliah,kode_matakuliah'],
            'nidn' => ['required', 'string', 'exists:dosen,nidn'],
            'kelas' => ['required', 'string', 'size:1'],
            'hari' => ['required', 'string', 'in:' . implode(',', $this->hariList)],
            'jam' => ['required', 'date_format:H:i'],
        ], [
            'kode_matakuliah.exists' => 'Mata kuliah yang dipilih tidak ditemukan.',
            'nidn.exists' => 'Dosen yang dipilih tidak ditemukan.',
            'kelas.size' => 'Kelas hanya boleh 1 karakter, contoh: A.',
        ]);
    }
}
