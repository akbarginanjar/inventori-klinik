<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::where('is_read', 0)->get();
        return view('admin.notifikasi.index', compact('notifikasi'));
    }
    public function detail($id, $slug)
    {
        $notifikasi = Notifikasi::find($id);
        if ($notifikasi->is_read == 0) {
            $notifikasi->is_read = 1;
            $notifikasi->save();
        }
        return view('admin.notifikasi.detail', compact('notifikasi'));
    }
}
