<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Jenis;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::with('jenis')->get();
        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        $jenis = Jenis::all();
        return view('admin.obat.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis_id' => 'required|exists:jenis,id',
        ]);

        // Ambil kode obat terakhir
        $lastObat = Obat::orderBy('kode_obat', 'desc')->first();

        // Generate kode obat baru
        if (!$lastObat) {
            $kodeObat = 'KH-00001';
        } else {
            $lastKode = $lastObat->kode_obat;
            $number = (int) substr($lastKode, 5);
            $newNumber = str_pad($number + 1, 5, '0', STR_PAD_LEFT);
            $kodeObat = 'KH-' . $newNumber;
        }

        // Buat obat baru dengan kode yang digenerate
        Obat::create([
            'kode_obat' => $kodeObat,
            'nama_obat' => $request->nama_obat,
            'stok' => $request->stok ?? 0, // Set stok to 0 if not provided
            'jenis_id' => $request->jenis_id,
        ]);

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil ditambahkan dengan kode ' . $kodeObat);
    }

    public function edit(Obat $obat)
    {
        $jenis = Jenis::all();
        return view('admin.obat.edit', compact('obat', 'jenis'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis_id' => 'required|exists:jenis,id',
        ]);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'jenis_id' => $request->jenis_id,
        ]);

        return redirect()->route('admin.obat.index')->with('warning', 'Obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        if ($obat->stok > 0) {
            return redirect()->route('admin.obat.index')->with('danger', 'Obat ini tidak bisa dihapus karena masih mempunyai stok!');
        }
        $obat->delete();
        return redirect()->route('admin.obat.index')->with('danger', 'Obat berhasil dihapus.');
    }
}
