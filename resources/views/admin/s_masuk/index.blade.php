@extends('app-layout.content')

@section('content')
    <div class="container">
        
        <h2>Daftar Stok Masuk</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Stok Masuk</li>
        </ol>

        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <a href="{{ route('admin.s_masuk.create') }}" class="btn btn-primary">Tambah Stok Masuk</a>
                    <a href="/admin/export-smasuk" class="btn btn-success">Ekspor Excel</a>
                    {{-- <a href class="btn btn-info" data-toggle="modal" data-target="#importModal">Impor Excel</a> --}}
                    
                    <!-- Laporan Button -->
                    {{-- <button class="btn btn-secondary" data-toggle="modal" data-target="#laporanModal">Laporan</button> --}}
                </div>
                
                @if (session('success'))
                <div class="alert alert-success mt-2 d-flex justify-content-between align-items-center">
                    <div>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                @if (session('warning'))
                <div class="alert alert-warning mt-2 d-flex justify-content-between align-items-center">
                    <div>
                        {{ session('warning') }}
                    </div>
                    <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                @if (session('danger'))
                <div class="alert alert-danger mt-2 d-flex justify-content-between align-items-center">
                    <div>
                        {{ session('danger') }}
                    </div>
                    <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
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
                
                <table class="table mt-3" id="data_table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Masuk</th>
                            <th>Tanggal Masuk</th>
                            <th>Supplier</th>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sMasuks as $s_masuk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s_masuk->kode_obat_masuk }}</td>
                            <td>{{ $s_masuk->tanggal_masuk }}</td>
                            <td>{{ $s_masuk->supplier->nama_supplier }}</td>
                            <td>{{ $s_masuk->obat->nama_obat }}</td>
                            <td>{{ $s_masuk->qty }}</td>
                            <td>
                                <a href="{{ route('admin.s_masuk.edit', $s_masuk) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form id="delete-form-{{ $s_masuk->id }}"
                                    action="{{ route('admin.s_masuk.destroy', $s_masuk) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $s_masuk->id }})"
                                        class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Laporan Modal -->
                    <div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-labelledby="laporanModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="laporanModalLabel">Laporan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="#" method="GET">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="start_date">Tanggal Mulai:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">Tanggal Akhir:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Impor Modal -->
                <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Excel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/admin/import-smasuk" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Pilih File Excel</label>
                                        <input class="form-control" type="file" id="file" name="file"
                                        accept=".xlsx,.xls">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
            <script>
                $(document).ready(function() {
            $('#data_table').DataTable();
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                console.log('result', result)
                if (result.isConfirmed) {
                    // Submit form or send a request to delete the data
                    document.getElementById(`delete-form-${id}`).submit();
                }
            })
        }
    </script>
@endsection
