@extends('front.layouts.proyecto')
@section('content')
<style>
.foto-perfil {
    object-fit: cover;
    border-radius:50%;
    width: 150px;
    height: 150px;
}

.datosPersona{
    display: flex;
    justify-content: center;
    align-content: center;
    flex-direction: column;
}
</style>
<div class="container">
    <div class="row general-view profesionales-info">
        <div class="perfil-nombre col-md-12">
            <div class="card" style="background-color: #ffffff;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3" style="text-align: center">
                            @php
                                $url = '/assets/front/images/user-2.png';
                                if($cliente->image !== NULL){
                                    $url = '/uploads/front/cliente/general/'.$cliente->idcliente.'/'.$cliente->image;
                                }
                                $user = auth()->user();
                            @endphp
                            <img class="foto-perfil" src="{{$url}}"/>
                        </div>
                        <div class="col-md-6 col-lg-6 datosPersona">
                            @if($cliente->tipo_persona == 'natural')
                                <h1>{{$cliente->nombre_razon_social}} {{$cliente->apellidos}}</h1>
                            @else
                                <h1>{{$cliente->nombre_razon_social}}</h1>

                            @endif
                            <h3>Cliente</h3>
                        </div>
                        <div class="col-md-3 col-lg-3"></div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="perfil-datos col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="background-color: #ffffff;">
                        <div class="card-header">
                            <div class="card-title"><img src="{{URL::to('assets/front/images/imagenes/buildit.png')}}"/></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h6>Acerca de ti</h6>
                                    <p style="color: #FF9603; font-size: 8px">Proyectos desarrollados con nosotros</p>
                                    @foreach ($cliente->proyectos as $proyectos)
                                        @if($proyectos->nombre !== NULL)
                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left">{{$proyectos->nombre}}</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list">
                                <li>Perfil</li>
                            </ul>
                            <div class="content_wrapper">
                                <div class="tab_content">
                                    <div class="table-responsive">
                                        <div class="card" style="background-color: #ffffff;">
                                            <div class="card-header">
                                                <div class="card-title"><br>Información</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1 col-lg-1 "></div>
                                                    <div class="col-md-11 col-lg-11 ">
                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Nombre (s):</b> {{$cliente->nombre_razon_social}}</p>
                                                        @if($cliente->tipo_persona == 'natural')
                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Apellidos:</b> {{$cliente->apellidos}}</p><h1></h1>
                                                        @endif
                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Ciudad de residencia:</b> {{$cliente->ciudad}}</p>
                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>País:</b> {{$cliente->pais}}</p>
                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Tipo de documento:</b> {{$cliente->tipo_documento}}</p>
                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Documento:</b> {{$cliente->documento}}</p>
                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Edad:</b> {{$cliente->edad}}</p>
                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Correo:</b> {{$cliente->email}}</p>
                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Celular:</b> {{$cliente->celular}}</p>
                                                        <br>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($user->hasRole('Cliente'))
                                                @if($cliente->idcliente == $user->iduserrelacion)
                                                    <div class="card-footer" style="color: black">
                                                        <div class="row">
                                                            <div class="col-md-8"></div>
                                                            <div class="col-md-4">
                                                                <a href="{{URL::to('clientes/editar-perfil/clientes/'.$cliente->idcliente)}}" class="btn btn-primary ml-auto">Editar Perfil</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                @endif
                                            @endif
                                        </div>                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
    $(function(e) {
        $(".first_tab").champ();
        $(".accordion_example").champ({
            plugin_type: "accordion",
            side: "left",
            active_tab: "3",
            controllers: "true"
        });

        $(".second_tab").champ({
            plugin_type: "tab",
            side: "right",
            active_tab: "1",
            controllers: "false"
        });

    });

</script>
@endsection
