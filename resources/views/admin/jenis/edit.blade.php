@extends('app-layout.content')

@section('content')
    <div class="container">
        <h2>Edit Jenis Obat</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Jenis Obat</li>
        </ol>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.jenis.update', $jeni) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_jenis">Nama Jenis</label>
                        <input type="text" name="nama_jenis" id="nama_jenis" class="form-control" value="{{ old('nama_jenis', $jeni->nama_jenis) }}" required>
                        @if($errors->has('nama_jenis'))
                        <div class="text-danger">
                            {{ $errors->first('nama_jenis') }}
                        </div>
                        @endif
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" title="Edit">Simpan Perubahan</button>
                    <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
                    <a href="{{ route('admin.jenis.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
