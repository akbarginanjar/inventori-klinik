@extends('app-layout.content')

@section('content')
    <div class="container">
        <h2>Edit Stok Masuk</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Stok Masuk</li>
        </ol>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.s_masuk.update', $s_masuk) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2r">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="{{ $s_masuk->tanggal_masuk }}" required>
                    </div>
                    <div class="form-group mb-2r">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == $s_masuk->supplier_id ? 'selected' : '' }}>
                                {{ $supplier->nama_supplier }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2r">
                        <label for="obat_id">Obat</label>
                        <select name="obat_id" id="obat_id" class="form-control" required>
                            @foreach($obats as $obat)
                            <option value="{{ $obat->id }}" {{ $obat->id == $s_masuk->obat_id ? 'selected' : '' }}>
                                {{ $obat->nama_obat }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2r">
                        <label for="qty">Jumlah</label>
                        <input type="number" name="qty" id="qty" class="form-control" value="{{ $s_masuk->qty }}" required min="1">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <a href="{{ route('admin.s_masuk.index') }}" class="btn btn-secondary">Kembali</a>
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
