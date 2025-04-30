<?php

namespace App\Http\Controllers;

use App\Exports\SMasukExport;
use App\Imports\SMasukImport;
use App\Models\S_Masuk;
use App\Models\Obat;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class S_MasukController extends Controller
{
    public function index()
    {
        $sMasuks = S_Masuk::with(['obat', 'supplier', 'user'])->get();
        return view('admin.s_masuk.index', compact('sMasuks'));
    }

    public function create()
    {
        $obats = Obat::all();
        $suppliers = Supplier::all();
        return view('admin.s_masuk.create', compact('obats', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'obat_id' => 'required|exists:obats,id',
            'qty' => 'required|integer|min:1',
        ]);

        $lastEntry = S_Masuk::latest('created_at')->first();
        $lastCode = $lastEntry ? intval(substr($lastEntry->kode_obat_masuk, 3)) : 0;
        $newCode = 'SM-' . str_pad($lastCode + 1, 5, '0', STR_PAD_LEFT);

        // Create new S_Masuk entry
        $sMasuk = S_Masuk::create([
            'kode_obat_masuk' => $newCode,
            'tanggal_masuk' => $request->tanggal_masuk,
            'supplier_id' => $request->supplier_id,
            'obat_id' => $request->obat_id,
            'qty' => $request->qty,
            'user_id' => Auth::id(),
        ]);

        // Update the stock of the related Obat
        $obat = Obat::find($request->obat_id);
        if ($obat) {
            $obat->stok += $request->qty;
            $obat->save();
        }

        return redirect()->route('admin.s_masuk.index')->with('success', 'Stok Masuk berhasil ditambahkan.');
    }

    public function edit(S_Masuk $s_masuk)
    {
        $obats = Obat::all();
        $suppliers = Supplier::all();
        return view('admin.s_masuk.edit', compact('s_masuk', 'obats', 'suppliers'));
    }

    public function update(Request $request, S_Masuk $s_masuk)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'obat_id' => 'required|exists:obats,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Find the existing Obat and reduce the old quantity from its stock
        $oldObat = $s_masuk->obat;
        if ($oldObat) {
            $oldObat->stok -= $s_masuk->qty;
            $oldObat->save();
        }

        // Update S_Masuk entry
        $s_masuk->update([
            'tanggal_masuk' => $request->tanggal_masuk,
            'supplier_id' => $request->supplier_id,
            'obat_id' => $request->obat_id,
            'qty' => $request->qty,
            'user_id' => Auth::id(),
        ]);

        // Update the stock of the new Obat
        $newObat = Obat::find($request->obat_id);
        if ($newObat) {
            $newObat->stok += $request->qty;
            $newObat->save();
        }

        return redirect()->route('admin.s_masuk.index')->with('warning', 'Stok Masuk berhasil diperbarui.');
    }

    public function destroy(S_Masuk $s_masuk)
    {
        // Reduce stock of the related Obat when deleting
        $obat = $s_masuk->obat;
        if ($obat) {
            $obat->stok -= $s_masuk->qty;
            $obat->save();
        }

        $s_masuk->delete();
        return redirect()->route('admin.s_masuk.index')->with('danger', 'Stok Masuk berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return Excel::download(new SMasukExport($startDate, $endDate), 'stok_masuk.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new SMasukImport, $request->file('file'));

        return back()->with('success', 'Data Berhasil Diimpor.');
    }
}
