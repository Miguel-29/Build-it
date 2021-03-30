<div class="">
    <div class="d-flex row col-md-12" >
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <a class="header-brand" href="{{URL::to('clientes/ultimas-noticias')}}">
                <img src="{{URL::to('assets/front/images/imagenes/logo-built-it.png')}}" class="header-brand-img" alt="Klast logo">
            </a>
        </div>
        @php
            $url = '/assets/front/images/user.png';
            $proyecto = '#';
            $perfil = '#';
            $pagina = \App\Models\Admin\Pagina::where('asociada_a','navbar')->where('estado','activo')->get();
            $rutaNombre = \Request::route()->getName();
            if(!(strpos($rutaNombre, 'dashboard-' ) === false)){
                $active;
            }  
            if(Auth::user() !== null){
                $user = auth()->user();
                if($user->hasRole('Cliente')){
                    $proyecto = 'clientes/crear-proyecto/'.$user->iduserrelacion.'/paso-1';
                    $cliente = \App\Models\Front\Cliente::find($user->iduserrelacion);
                    $perfil = '/clientes/perfil-cliente/'.$cliente->idcliente;
                    if($cliente->image !== NULL){
                        $url = '/uploads/front/cliente/general/'.$cliente->idcliente.'/'.$cliente->image;
                    }
                }elseif($user->hasRole('Freelancer')){
                    $freelancer = \App\Models\Front\Freelancer::find($user->iduserrelacion);
                    $perfil = '/clientes/perfil-freelancer/'.$freelancer->idfreelancer;

                    if($freelancer->image !== NULL){
                        $url = '/uploads/front/freelancer/general/'.$freelancer->idfreelancer.'/'.$freelancer->image;
                    }
                }elseif($user->hasRole('Empresa')){
                    $empresa = \App\Models\Front\Empresa::find($user->iduserrelacion);
                    $perfil = '/clientes/perfil-empresa/'.$empresa->idempresa;

                    if($empresa->image !== NULL){
                        $url = '/uploads/front/empresa/general/'.$empresa->idempresa.'/'.$empresa->image;
                    }
                }elseif($user->hasRole('Proveedor')){

                    $proveedor = \App\Models\Front\Proveedor::find($user->iduserrelacion);
                    $perfil = '/clientes/perfil-proveedor/'.$proveedor->idproveedor;

                    if($proveedor->image !== NULL){
                        $url = '/uploads/front/proveedor/general/'.$proveedor->idproveedor.'/'.$proveedor->image;
                    }
                }
            }else{
                $url = '/assets/front/images/user.png';
            }
        @endphp

        <div class="d-flex ml-auto col-md-9" style="display: flex; justify-content: flex-end">
            <div class="Klast-navbar" id="headerMenuCollapse">
                <div class="container">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link proyecto @if($rutaNombre == 'clientes.get-noticias' || $rutaNombre == 'clientes.get-post')active selected @endif" href="{{URL::to('clientes/ultimas-noticias')}}">
                                <span> Inicio</span>
                            </a>
                        </li>
                        @if($user->hasRole('Cliente'))
                            <li class="nav-item">
                                <a class="nav-link proyecto @if(!(strpos($rutaNombre, 'proyectos.' ) === false)) active selected @endif"  href="{{URL::to($proyecto)}}"><span>Crea tu proyecto</span></a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link proyecto @if($rutaNombre == 'clientes.get-contratistas')active selected @endif" href="{{URL::to('clientes/ver-contratistas')}}"><span>Contratistas</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link proyecto" href="#"><span>Pasantes</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link proyecto @if($rutaNombre == 'clientes.get-proveedores')active selected @endif" href="{{URL::to('clientes/ver-proveedores')}}"><span>Proveedores</span></a>
                        </li>

                        @foreach ($pagina as $paginas)
                            <li class="nav-item">
                                <a class="nav-link proyecto @if($rutaNombre == 'clientes.contenidos')active selected @endif" href="{{URL::to('clientes/contenidos/'.$paginas->ruta_pagina)}}"><span>{{$paginas->titulo}}</span></a>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link proyecto @if($rutaNombre == 'clientes.beneficios')active selected @endif" href="{{URL::to('clientes/beneficios')}}"><span>Beneficios</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dropdown mt-1">
                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar avatar-md brround" style="background-image: url({{$url}})"></span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                    <div class="text-center">
                        <a href="#" class="dropdown-item text-center font-weight-sembold text-dark user">
                            @if(Auth::user() !== null) 
                                {{Auth::user()->name}}
                            @endif
                        </a>
                        <span class="text-center user-semi-title text-dark">
                            @if(Auth::user() !== null) 
                                <?php
                                $usuarios =Auth::user();
                                $roles = $usuarios->getRoleNames();
                                $reemplazo =array('"','[',']');
                                $texto=str_replace($reemplazo,'',$roles); 
                                echo $texto;
                                ?>
                            @endif
                        </span>
                        <div class="dropdown-divider"></div>
                    </div>
                    <a class="dropdown-item" href="{{URL::to($perfil)}}">
                        Tú Perfil
                    </a>
                    @if($user->hasRole('Cliente'))

                        <a class="dropdown-item" href="{{URL::to('clientes/'.$user->iduserrelacion.'/cliente/mis-proyectos/')}}">
                            Tus Proyectos
                        </a>

                    @endif
                    @if($user->hasRole('Freelancer'))

                        <a class="dropdown-item" href="{{URL::to('clientes/'.$user->iduserrelacion.'/freelancer/mis-proyectos/')}}">
                            Tus Proyectos Asociados
                        </a>

                    @endif
                    @if($user->hasRole('Empresa'))

                        <a class="dropdown-item" href="{{URL::to('clientes/'.$user->iduserrelacion.'/empresa/mis-proyectos/')}}">
                            Tus Proyectos Asociados
                        </a>

                    @endif
                    @if($user->hasRole('Proveedor'))

                        <a class="dropdown-item" href="{{URL::to('clientes/'.$user->iduserrelacion.'/proveedor/mis-proyectos/')}}">
                            Tus Proyectos Asociados
                        </a>

                    @endif
                    <a class="dropdown-item" href="{{URL::to('clientes/ver-contratistas')}}">
                        Profesionales / Empresas
                    </a>
                    <a class="dropdown-item" href="{{ URL::to('/logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="dropdown-icon mdi mdi-logout-variant"></i>Salir</a>
                    <form id="logout-form" action="{{ URL::to('/logout') }}"
                    method="POST" style="display: none;">
                    @csrf
                    </form>
                </div>
            </div>
        </div>
        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
        <span class="header-toggler-icon"></span>
        </a>
    </div>
</div>
