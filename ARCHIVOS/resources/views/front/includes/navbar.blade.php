@php
    $rutaNombre = \Request::route()->getName();
@endphp
<div class="container-fluid">
    <div class="d-flex login-nav">
        <a class="header-brand" href="{{URL::to('clientes/ultimas-noticias')}}">
            <img src="{{URL::to('assets/front/images/imagenes/logo-built-it.png')}}" class="header-brand-img" alt="Klast logo">
        </a>
        <div class="col-md-10">
            <div id="headerMenuCollapse">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link @if($rutaNombre == 'clientes.index') active selected @endif" href="{{URL::to('clientes')}}"><span>Regístrate</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($rutaNombre == 'clientes.login') active selected @endif" href="{{URL::to('auth-user')}}"><button type="button" style=" text-transform: capitalize;" class="btn btn-info">Iniciar sesión</button></a>
                    </li>
                </ul>   
            </div>
        </div>
        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
        <span class="header-toggler-icon"></span>
        </a>
    </div>
</div>
