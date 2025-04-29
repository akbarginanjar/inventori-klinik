@extends('app-layout.content')

@section('content')
    <div class="container">
        
        <h2>Edit Nama Obat</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Obat</li>
        </ol>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.obat.update', $obat) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ $obat->nama_obat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_id">Jenis Obat</label>
                        <select name="jenis_id" id="jenis_id" class="form-control" required>
                            @foreach($jenis as $jeni)
                            <option value="{{ $jeni->id }}" {{ $jeni->id == $obat->jenis_id ? 'selected' : '' }}>
                                {{ $jeni->nama_jenis }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" title="Edit">Simpan Perubahan</button>
                    <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
                    <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
