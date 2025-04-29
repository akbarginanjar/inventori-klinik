@extends('app-layout.content')

@section('content')
    <div class="container">
        <h2>Tambah Jenis Obat</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Jenis Obat</li>
        </ol>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.jenis.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_jenis">Nama Jenis</label>
                        <input type="text" name="nama_jenis" id="nama_jenis" 
                        class="form-control @error('nama_jenis') is-invalid @enderror" 
                        value="{{ old('nama_jenis') }}" required>
                        @error('nama_jenis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" title="Simpan">Simpan</button>
                    <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
                    <a href="{{ route('admin.jenis.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
