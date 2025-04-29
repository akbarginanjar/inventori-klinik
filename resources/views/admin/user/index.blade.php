@extends('app-layout.content')

@section('content')
    <div class="container">
        
        <h2>Daftar User</h2>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>

        {{-- <div class="mb-3">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
        </div> --}}

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

                <table class="table mt-3" id="data_table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->level }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $user->id }})"
                                        class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
