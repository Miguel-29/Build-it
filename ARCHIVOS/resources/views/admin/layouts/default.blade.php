<!doctype html>
<html lang="en" dir="ltr">
	<head>
        @include('admin.includes.head')
	</head>
	<body class="app sidebar-mini rtl">
		<div id="global-loader" ></div>
		<div class="page">
			<div class="page-main">
				<!-- Navbar-->
				<header class="app-header header">
                    @include('admin.includes.horizontal-menu')
				</header>
				
                <!-- Sidebar menu-->
                <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            	@include('admin.includes.vertical-menu')
			
				<div class="app-content my-3 my-md-5">
					<div class="side-app">
                        @yield('content') 
					</div>
					
					<!--footer-->
					@include('admin.includes.footer')
					<!-- End Footer-->
				</div>
			</div>
		</div>
		
		<!-- Back to top -->
		<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
    </body>
    @include('admin.includes.scripts')
    @include('admin.includes.modales')
    @yield('scriptsown')
</html>

