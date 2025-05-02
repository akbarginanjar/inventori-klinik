@extends('app-layout.content')

@section('content')
    <div class="container">

        <h2>Daftar Nama Obat</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">Obat</li>
        </ol>
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
        <div class="card">
            <div class="card-body">

                <a href="{{ route('admin.obat.create') }}" class="btn btn-primary" title="Tambah Obat"><i
                        class="fas fa-plus"></i> Tambah Obat</a>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importObatModal">
                    Impor Obat
                </button>

                <br><br>

                <table class="table mt-3" id="data_table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Stok</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obats as $index => $obat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $obat->kode_obat }}</td>
                                <td>{{ $obat->nama_obat }}</td>
                                <td>{{ $obat->stok }}</td>
                                <td>{{ $obat->jenis->nama_jenis }}</td>
                                <td>
                                    <a href="{{ route('admin.obat.edit', $obat) }}" class="btn btn-warning btn-sm"
                                        title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                    <form id="delete-form-{{ $obat->id }}"
                                        action="{{ route('admin.obat.destroy', $obat) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $obat->id }})"
                                            class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Modal Import Obat -->
            <div class="modal fade" id="importObatModal" tabindex="-1" aria-labelledby="importObatModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form action="/admin/import-obat" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importObatModalLabel">Impor Data Obat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Upload File Excel</label>
                                    <input type="file" name="file" accept=".xlsx, .xls" class="form-control" required>
                                    <small class="text-muted">* Format: Nama Obat, Jenis Obat</small><br>
                                    <a href="{{ asset('excel_template/template_import_obat.xlsx') }}" class="text-primary"
                                        download>Unduh Template Excel</a>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Impor</button>
                            </div>
                        </div>
                    </form>
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
