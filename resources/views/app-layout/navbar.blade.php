<nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top shadow-sm">
    <div class="container-fluid justify-content-between">
  
      <!-- Logo, Nama Klinik, dan Tombol Toggle -->
      <div class="d-flex align-items-center">
        <img src="{{asset('images/logo-hegar.png')}}" style="width: 60px;" alt="">
        <p class="mb-0 ms-2 me-3" style="font-weight: bold; font-size: 20px;">Klinik Pratama Hegar</p>
        <button class="btn btn-outline-dark" id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
      </div>
  
      <!-- Wrapper dropdown di kanan -->
<div class="collapse navbar-collapse justify-content-end me-3" id="navbarNavDarkDropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::user()->name }}
      </a>
      <ul class="dropdown-menu dropdown-menu-end me-4">
        <li><a href="/admin/users" class="dropdown-item">Edit Akun</a></li>
        <li><a class="dropdown-item" type="button" href="{{ route('logout') }}" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
      </ul>
  </div>
  
  
    </div>
  </nav>
  