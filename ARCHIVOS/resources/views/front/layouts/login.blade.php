<!doctype html>
<html lang="en" dir="ltr">
	<head>
        @include('front.includes.head')
	</head>
	<body>
        @yield('content')             
        @include('front.includes.scripts')
        @include('front.includes.modales')
        @yield('scriptsown')
    </body>
</html>