<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Klinik Pratama Hegar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />


  {{-- select2 --}}
  <!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    body {
      overflow-x: hidden;
    }
    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 65px;
      left: 0;
      background-color: white;
      transition: all 0.3s ease;
      border-right: 1px solid #c8c8c877;
      padding: 10px;
      z-index: 1030; /* tambahkan ini */
    }

    .sidebar a {
      color: black;
      display: block;
      padding: 12px 20px;
      text-decoration: none;
      margin-bottom: 2px;
      color: black;
    }
    .sidebar a:hover {
      background: rgb(233, 233, 233);
      color: black;
      border-radius: 10px;
    }
    .sidebar .active {
      background: rgb(25, 90, 255);
      color: white;
      border-radius: 10px;
    }
    .content {
      margin-left: 250px;
      padding: 60px 20px 20px;
      transition: all 0.3s ease;
    }
    .sidebar.hide {
      margin-left: -250px;
    }
    .content.full {
      margin-left: 0;
    }
    @media (max-width: 768px) {
      .sidebar {
        margin-left: -250px;
      }
      .sidebar.show {
        margin-left: 0;
      }
      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  @include('app-layout.navbar')

  <div class="sidebar shadow-sm" id="sidebar">
    <br>
    <div style="font-size: 10px; margin-left: 20px;" class="mb-1">MENU</div>
    <a href="/home" class="{{Request::is('home') ? 'active' : ''}}"><i class="nav-icon fas fa-home me-2"></i> Dashboard</a>
    <a href="/admin/suppliers" class="{{Request::is('admin/suppliers') ? 'active' : ''}}"><i class="nav-icon fas fa-truck me-2"></i> Suppliers</a>
    <a href="/admin/jenis" class="{{Request::is('admin/jenis') ? 'active' : ''}}"><i class="nav-icon fas fa-pills me-2"></i> Jenis Obat</a>
    <a href="/admin/obat" class="{{Request::is('admin/obat') ? 'active' : ''}}"><i class="nav-icon fas fa-capsules me-2"></i> Nama Obat</a>
    <a href="/admin/s_masuk" class="{{Request::is('admin/s_masuk') ? 'active' : ''}}"><i class="nav-icon fas fa-inbox me-2"></i> Stok Masuk</a>
    <a href="/admin/s_keluar" class="{{Request::is('admin/s_keluar') ? 'active' : ''}}"><i class="nav-icon fas fa-box me-2"></i> Stok Keluar</a>
    <a href="/admin/users" class="{{Request::is('admin/users') ? 'active' : ''}}"><i class="nav-icon fas fa-users-cog me-2"></i> Users</a>
  </div>

  <!-- Main Content -->
  <div class="content" id="content">
    <br>
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


  <script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('hide');
      sidebar.classList.toggle('show');
      content.classList.toggle('full');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
