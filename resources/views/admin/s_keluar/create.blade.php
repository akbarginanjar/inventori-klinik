@extends('app-layout.content')

@section('content')
    <div class="container">
        <h2>Tambah Stok Keluar</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Tambah Stok Keluar</li>
        </ol>
        @if (session('error'))
            <div class="alert alert-danger mt-2 d-flex justify-content-between align-items-center">
                <div>
                    {{ session('error') }}
                </div>
                <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.s_keluar.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="admin">Admin</label>
                        <input type="text" name="" id="" value="{{ Auth::user()->name }}"
                            class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="obat_id">Obat</label>
                        <select name="obat_id" id="obat_id" class="form-control" required>
                            @foreach ($obats as $obat)
                                <option value="{{ $obat->id }}">{{ $obat->nama_obat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="qty">Jumlah</label>
                        <input type="number" name="qty" id="qty" class="form-control" required min="1">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <a href="{{ route('admin.s_keluar.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        $( '#obat_id' ).select2( {
            theme: 'bootstrap-5'
        } );
    </script>
@endsection
