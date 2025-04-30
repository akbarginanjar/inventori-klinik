<?php

namespace App\Http\Controllers;

use App\Exports\SKeluarExport;
use App\Imports\SKeluarImport;
use App\Models\Notifikasi;
use App\Models\S_Keluar;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class S_KeluarController extends Controller
{
    public function index()
    {
        $sKeluars = S_Keluar::with(['obat', 'user'])->get();
        return view('admin.s_keluar.index', compact('sKeluars'));
    }

    public function create()
    {
        $obats = Obat::all();
        return view('admin.s_keluar.create', compact('obats'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal_keluar' => 'required|date',
            'obat_id' => 'required|exists:obats,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Cek stok obat
        $obat = Obat::findOrFail($request->obat_id);
        if ($request->qty > $obat->stok) {
            return redirect()->back()->with('error', 'Stok Obat kurang.');
        }

        // Generate kode_obat_keluar
        $kodeObatKeluar = 'SK-' . str_pad(S_Keluar::max('id') + 1, 5, '0', STR_PAD_LEFT);

        // Simpan data
        $s_keluar = new S_Keluar();
        $s_keluar->kode_obat_keluar = $kodeObatKeluar;
        $s_keluar->tanggal_keluar = $request->tanggal_keluar;
        $s_keluar->obat_id = $request->obat_id;
        $s_keluar->qty = $request->qty;
        $s_keluar->user_id = Auth::id(); // pastikan ini ditambahkan juga
        $s_keluar->save();

        // Update stok obat
        $obat->stok -= $request->qty;
        $obat->save();

        $cekNotif = Notifikasi::where('obat_id', $obat->id)->where(
            'tanggal',
            date('Y-m-d', strtotime(now()))
        )->first();
        // Update notif
        if ($cekNotif == null && $obat->stok <= 20) {
            $notifikasi = new Notifikasi();
            $notifikasi->tanggal = now();
            $notifikasi->slug = Str::slug($obat->nama_obat);
            $notifikasi->obat_id = $obat->id;
            $notifikasi->low_stok = $obat->stok;
            $notifikasi->is_read = false;
            $notifikasi->save();
        }

        return redirect()->route('admin.s_keluar.index')->with('success', 'Stok keluar berhasil ditambahkan.');
    }

    public function edit(S_Keluar $s_keluar)
    {
        $obats = Obat::all();
        return view('admin.s_keluar.edit', compact('s_keluar', 'obats'));
    }

    public function update(Request $request, S_Keluar $s_keluar)
    {
        $request->validate([
            'tanggal_keluar' => 'required|date',
            'obat_id' => 'required|exists:obats,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Find the existing Obat and increase the old quantity back to its stock
        $oldObat = $s_keluar->obat;
        if ($oldObat) {
            $oldObat->stok += $s_keluar->qty;
            $oldObat->save();
        }

        // Update S_Keluar entry
        $s_keluar->update([
            'tanggal_keluar' => $request->tanggal_keluar,
            'obat_id' => $request->obat_id,
            'qty' => $request->qty,
            'user_id' => Auth::id(),
        ]);

        // Update the stock of the new Obat
        $newObat = Obat::find($request->obat_id);
        if ($newObat) {
            $newObat->stok -= $request->qty;
            $newObat->save();
        }

        $cekNotif = Notifikasi::where('obat_id', $newObat->id)->where(
            'tanggal',
            date('Y-m-d', strtotime(now()))
        )->first(); // Update notif
        if (!$cekNotif && $newObat->stok <= 20) {
            $notifikasi = new Notifikasi();
            $notifikasi->tanggal = now();
            $notifikasi->slug = Str::slug($newObat->nama_obat);
            $notifikasi->obat_id = $newObat->id;
            $notifikasi->low_stok = $newObat->stok;
            $notifikasi->is_read = false;
            $notifikasi->save();
        }

        return redirect()->route('admin.s_keluar.index')->with('warning', 'Stok Keluar berhasil diperbarui.');
    }

    public function destroy(S_Keluar $s_keluar)
    {
        $obat = $s_keluar->obat;
        if ($obat) {
            $obat->stok += $s_keluar->qty;
            $obat->save();
        }

        $s_keluar->delete();
        return redirect()->route('admin.s_keluar.index')->with('danger', 'Stok Keluar berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return Excel::download(new SKeluarExport($startDate, $endDate), 'stok_keluar.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new SKeluarImport, $request->file('file'));

        return back()->with('success', 'Data Berhasil Diimpor.');
    }
}
