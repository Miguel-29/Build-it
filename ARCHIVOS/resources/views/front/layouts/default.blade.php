<!doctype html>
<html lang="en" dir="ltr">
	<head>
        @include('front.includes.head')
	</head>
	<body class="">
		<div id="global-loader" ></div>
		<div class="page login-img">
            <!-- Navbar-->
            <div class="header py-4" style="position: fixed;top: 0;width: 100%; z-index:1040;">
                @include('front.includes.navbar')
            </div>
			<div class="page-single">
                @yield('content') 
            </div>
            <footer class="footer">
                <!--footer-->
                @include('front.includes.footer')
                <!-- End Footer-->
            </footer>
		</div>
    </body>
@include('front.includes.scripts')
@include('front.includes.modales')
@yield('scriptsown')
</html>