@extends('app-layout.content')

@section('content')
    <div class="container">

        <h2>Edit Stok Keluar</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Edit Stok Keluar</li>
        </ol>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.s_keluar.update', $s_keluar) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="admin">Admin</label>
                        <input type="text" name="" id="" value="{{ $s_keluar->user->name }}"
                            class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control"
                            value="{{ $s_keluar->tanggal_keluar }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="obat_id">Obat</label>
                        <select name="obat_id" id="obat_id" class="form-control" required>
                            @foreach ($obats as $obat)
                                <option value="{{ $obat->id }}" {{ $obat->id == $s_keluar->obat_id ? 'selected' : '' }}>
                                    {{ $obat->nama_obat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="qty">Jumlah</label>
                        <input type="number" name="qty" id="qty" class="form-control"
                            value="{{ $s_keluar->qty }}" required min="1">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Simpan Peerubahan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <a href="{{ route('admin.s_keluar.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
