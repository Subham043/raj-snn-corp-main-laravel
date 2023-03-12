<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover">


    @include('admin.includes.common_head')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('admin.includes.header')

            @include('admin.includes.menu')

             <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                @yield('content')

                @include('admin.includes.footer')

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

        <!-- JAVASCRIPT -->
        @include('admin.includes.common_script')

        <!-- App js -->
        <script src="{{ asset('admin/js/main.js') }}"></script>
        @yield('javascript')
    </body>


</html>
