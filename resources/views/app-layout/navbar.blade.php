@php
    use App\Models\Notifikasi;
    $notifikasi = Notifikasi::where('is_read', 0)->get();
@endphp
<nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top shadow-sm">
    <div class="container-fluid justify-content-between">

        <!-- Logo, Nama Klinik, dan Tombol Toggle -->
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/logo-hegar.png') }}" style="width: 60px;" alt="">
            <p class="mb-0 ms-2 me-3" style="font-weight: bold; font-size: 20px;">Klinik Pratama Hegar</p>
            <button class="btn btn-outline-dark" id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
        </div>

        <!-- Notifikasi dan Username -->
        <div class="d-flex align-items-center me-3">

            <!-- Notifikasi Dropdown -->
            <div class="dropdown me-4 position-relative">
                <a class="text-dark nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bell fa-lg"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown" style="width: 300px;">
                    <li class="dropdown-header">Notifikasi</li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @if (count($notifikasi) > 0)

                        @foreach ($notifikasi as $item)
                            <li><a class="dropdown-item"
                                    href="/admin/notifikasi/detail/{{ $item->id }}/{{ $item->slug }}">
                                    <div class="card">
                                        <div class="p-2" style="font-size: 13px;">
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                            Stok Obat <b>{{ $item->obat->nama_obat }}</b> sudah
                                            <b>{{ $item->low_stok }}</b>
                                            <br>
                                            <div style="font-size: 11px;">{{ date('d-m-Y', strtotime($item->tanggal)) }}
                                            </div>
                                        </div>
                                    </div>
                                </a></li>
                        @endforeach
                    @else
                        <li class="text-center">Tidak Ada notifikasi</li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-center" href="/admin/notifikasi">Lihat semua notifikasi</a></li>
                </ul>
            </div>

            <!-- Username Dropdown -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDarkDropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end me-4">
                    <li><a href="/admin/users" class="dropdown-item">Edit Akun</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>

        </div>

    </div>
</nav>
