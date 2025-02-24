<!DOCTYPE html>
<html>
<head>
	@include('admin.layouts.head')
</head>
<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
    	<!-- Sidebar -->
    	@include('admin.layouts.sidebar')

        <!-- Main Container -->
        <div class="main-content">
        	<!-- Top Nav -->
            @include('admin.layouts.top-nav')

            {{-- csrf --}}
            @csrf

            @yield('content')

        </div>
        <!-- Footer -->
    	@include('admin.layouts.footer')
    </div>
<!-- jquery latest version -->
<script src="{{ asset('public/backend/js/jquery-3.5.1.min.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{ asset('public/backend/js/popper.min.js') }}"></script>
<script src="{{ asset('public/backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/backend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/backend/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery.slicknav.min.js') }}"></script>
<!-- others plugins -->
<script src="{{ asset('public/backend/js/plugins.js') }}"></script>
<script src="{{ asset('public/backend/js/scripts.js') }}"></script>

<script defer src="{{ asset('public/backend/js/all.js') }}"></script>
@yield('js')
<script type="text/javascript" src="{{ asset('public/backend/js/selectize.js') }}"></script>
</body>
</html>
