@extends('app-layout.content')

@section('content')
    <div class="container">        
        <h2>Notifikasi</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Semua Notifikasi</li>
        </ol>
        <div class="card bg-light">
            <div class="card-body">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="">
                                <center>
                                    <i class="fa-solid fa-bell fa-lg"></i>
                                </center>
                            </div>
                            <div class="ms-3">
                                <div style="font-size: 11px;" class="text-primary">Notifikasi</div>
                                <div  style="font-size: 17px;">Stok Obat <b>Paramex</b> sudah <b>20</b> hampir habis 
                                </div>
                                <div style="font-size: 13px;">23-03-2025</div>
                                <a href="/admin/notifikasi/detail" class="btn btn-outline-primary btn-sm" style="margin-top: 10px;">Lihat Notifikasi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="">
                                <center>
                                    <i class="fa-solid fa-bell fa-lg"></i>
                                </center>
                            </div>
                            <div class="ms-3">
                                <div style="font-size: 11px;" class="text-primary">Notifikasi</div>
                                <div  style="font-size: 17px;">Stok Obat <b>Paramex</b> sudah <b>10</b> hampir habis 
                                </div>
                                <div style="font-size: 13px;">23-03-2025</div>
                                <a href="/admin/notifikasi/detail" class="btn btn-outline-primary btn-sm" style="margin-top: 10px;">Lihat Notifikasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection