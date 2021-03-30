<!doctype html>
<html lang="en" dir="ltr">
	<head>
        @include('front.includes.head')
	</head>
	<body class="">
		<div id="global-loader" ></div>
		<div class="page">
            <div class="page-main">
                <!-- Navbar-->
                <div class="header py-4" style="position: fixed;top: 0;width: 100%; z-index:1040;">
                    @include('front.includes.navbarproyecto')
                </div>
                <div class="my-3 my-md-5">
                    @yield('content') 
                </div>
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