<!DOCTYPE html>
<html lang="en">
@include('app-layout.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('AdminLTE/dist/img/logo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div> --}}

        @include('app-layout.navbar')

        @include('app-layout.sidebar')

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('isi')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        @include('app-layout.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('app-layout.script')
</body>

</html>
