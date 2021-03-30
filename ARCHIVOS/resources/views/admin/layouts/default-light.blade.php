<!doctype html>
<html lang="en" dir="ltr">
	<head>
        @include('admin.includes.head')
	</head>
	<body class="login-img">
        <div id="global-loader" ></div>
        <div class="page">
            <div class="page-single">
                <div class="container">
                    @yield('contenido')
                </div>
            </div>
        </div>
	</body>
    @include('admin.includes.scripts')
    @include('admin.includes.modales')
    @yield('scriptsown')
</html>

