@extends('app-layout.content')

@section('content')
    <div class="container">
        
        <h2>Tambah Supplier</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Supplier</li>
        </ol>
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.suppliers.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="nama_supplier" 
                        class="form-control @error('nama_supplier') is-invalid @enderror" 
                        value="{{ old('nama_supplier') }}" required>
                        @error('nama_supplier')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="no_telepon">No Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon" 
                        class="form-control @error('no_telepon') is-invalid @enderror" 
                        value="{{ old('no_telepon') }}" required>
                        @error('no_telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" title="Simpan">Simpan</button>
                    <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
                    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
