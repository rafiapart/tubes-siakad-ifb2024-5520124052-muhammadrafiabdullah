<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $mataKuliah = MataKuliah::when($search, function ($query, $search) {
                $query->where('nama_matakuliah', 'like', "%{$search}%")
                      ->orWhere('kode_matakuliah', 'like', "%{$search}%");
            })
            ->orderBy('nama_matakuliah')
            ->paginate(10)
            ->withQueryString();

        return view('matakuliah.index', compact('mataKuliah', 'search'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'string', 'size:8', 'unique:matakuliah,kode_matakuliah'],
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ], [
            'kode_matakuliah.size' => 'Kode mata kuliah harus terdiri dari 8 karakter.',
            'kode_matakuliah.unique' => 'Kode mata kuliah ini sudah terdaftar.',
        ]);

        MataKuliah::create($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $validated = $request->validate([
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ]);

        $matakuliah->update($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
