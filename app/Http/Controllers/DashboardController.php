<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Obat;
use App\Models\S_Masuk;
use App\Models\S_Keluar;

class DashboardController extends Controller
{
    public function index()
    {
        $supplierCount = Supplier::count();
        $obatCount = Obat::count();
        $stokMasukCount = S_Masuk::count();
        $stokKeluarCount = S_Keluar::count();

        return view('admin.dashboard', compact('supplierCount', 'obatCount', 'stokMasukCount', 'stokKeluarCount'));
    }
}
