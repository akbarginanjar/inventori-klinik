<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();
        return view('admin.jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('admin.jenis.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis',
        ], [
            'nama_jenis.unique' => 'Nama jenis obat sudah ada, mohon masukkan nama jenis obat yang lain.'
        ]);

        Jenis::create($request->all());

        return redirect()->route('admin.jenis.index')->with('success', 'Jenis Obat berhasil ditambahkan.');
    }

    public function edit(Jenis $jeni)
    {
        return view('admin.jenis.edit', compact('jeni'));
    }

    public function update(Request $request, Jenis $jeni)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis',
        ], [
            'nama_jenis.unique' => 'Nama jenis obat sudah ada, mohon masukkan nama jenis obat yang lain.'
        ]);

        $jeni->update($request->all());

        return redirect()->route('admin.jenis.index')->with('warning', 'Jenis Obat berhasil diperbarui.');
    }

    public function destroy(Jenis $jeni)
    {
        $jeni->delete();
        return redirect()->route('admin.jenis.index')->with('danger', 'Jenis Obat berhasil dihapus.');
    }
}
