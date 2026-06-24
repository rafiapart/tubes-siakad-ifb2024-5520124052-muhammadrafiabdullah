<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $mahasiswa = Mahasiswa::with('dosenWali')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('npm', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('mahasiswa.index', compact('mahasiswa', 'search'));
    }

    public function create()
    {
        $dosenList = Dosen::orderBy('nama')->get();

        return view('mahasiswa.create', compact('dosenList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => ['required', 'string', 'size:10', 'unique:mahasiswa,npm'],
            'nama' => ['required', 'string', 'max:50'],
            'nidn' => ['nullable', 'string', 'exists:dosen,nidn'],
        ], [
            'npm.size' => 'NPM harus terdiri dari 10 karakter.',
            'npm.unique' => 'NPM ini sudah terdaftar.',
            'nidn.exists' => 'Dosen wali yang dipilih tidak ditemukan.',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosenList = Dosen::orderBy('nama')->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'dosenList'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:50'],
            'nidn' => ['nullable', 'string', 'exists:dosen,nidn'],
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
