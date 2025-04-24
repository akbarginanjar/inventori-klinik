<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255|unique:suppliers,nama_supplier',
            'no_telepon' => 'required|string|max:20|unique:suppliers,no_telepon',
            'alamat' => 'required|string',
        ], [
            'nama_supplier.unique' => 'Nama supplier sudah ada, mohon masukkan nama supplier yang lain.',
            'no_telepon.unique' => 'Nomor telepon sudah terdaftar, mohon masukkan nomor telepon yang lain.',
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255|unique:suppliers,nama_supplier,' . $supplier->id,
            'no_telepon' => 'required|string|max:20|unique:suppliers,no_telepon,' . $supplier->id,
            'alamat' => 'required|string',
        ], [
            'nama_supplier.unique' => 'Nama supplier sudah ada, mohon masukkan nama supplier yang lain.',
            'no_telepon.unique' => 'Nomor telepon sudah terdaftar, mohon masukkan nomor telepon yang lain.',
        ]);

        // Update data supplier setelah validasi berhasil
        $supplier->update($request->all());

        return redirect()->route('admin.suppliers.index')->with('warning', 'Supplier berhasil diperbarui.');
    }


    public function destroy(Supplier $supplier)
    {
        if (Supplier::has('s_masuk')->find($supplier->id)) {
            return redirect()->route('admin.suppliers.index')->with('danger', 'Supplier ini tidak bisa dihapus karena masih mempunyai stok masuk!');
        }
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('danger', 'Supplier berhasil dihapus.');
    }
}
