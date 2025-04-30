@extends('app-layout.content')

@section('content')
    <div class="container">
        <h2>Detail Notifikasi</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Detail Notifikasi</li>
        </ol>
        <div class="card bg-light col-sm-6">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="">
                                <center>
                                    <i class="fa-solid fa-bell fa-lg"></i>
                                </center>
                            </div>
                            <div class="ms-3">
                                <div style="font-size: 11px;" class="text-primary">Detail Notifikasi</div>
                                <div style="font-size: 17px;">Stok Obat <b>{{ $notifikasi->obat->nama_obat }}</b> sudah
                                    <b>{{ $notifikasi->low_stok }}</b> hampir habis
                                    <div style="font-size: 13px;" class="">23-03-2025</div>
                                </div>
                                <br>
                                <div style="font-size: 11px;">Nama Obat</div>
                                <b>{{ $notifikasi->obat->nama_obat }}</b>
                                <div style="font-size: 11px;">Kode</div>
                                <b>{{ $notifikasi->obat->kode_obat }}</b>
                                <div style="font-size: 11px;">Jenis</div>
                                <b>{{ $notifikasi->obat->jenis->nama_jenis }}</b>
                                <br><br>
                                <a href="/admin/s_masuk" class="btn btn-outline-primary btn-sm"
                                    style="margin-top: 10px;">Lakukan Stok Masuk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
