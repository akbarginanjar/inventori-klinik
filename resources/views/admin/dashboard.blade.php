@extends('app-layout.content')

@section('content')
    <div class="container">
        <h2 class="m-0">Beranda</h2>
<br>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- Supplier box -->
                    <div class="col-lg-3 col-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h3>{{ $supplierCount }}</h3>
                                <p>Supplier</p>
                            </div>
                            <a href="{{ route('admin.suppliers.index') }}" class="card-footer bg-info nav-link text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- Obat box -->
                    <div class="col-lg-3 col-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h3>{{ $obatCount }}</h3>
                                <p>Obat</p>
                            </div>
                            <a href="{{ route('admin.obat.index') }}" class="card-footer bg-warning nav-link text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- Stok Masuk box -->
                    <div class="col-lg-3 col-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h3>{{ $stokMasukCount }}</h3>
                                <p>Stok Masuk</p>
                            </div>
                            <a href="{{ route('admin.s_masuk.index') }}" class="card-footer bg-success nav-link text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- Stok Keluar box -->
                    <div class="col-lg-3 col-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h3>{{ $stokKeluarCount }}</h3>
                                <p>Stok Keluar</p>
                            </div>
                            <a href="{{ route('admin.s_keluar.index') }}" class="card-footer bg-danger nav-link text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
        <!-- /.content -->
    </div>
@endsection
