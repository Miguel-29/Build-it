@extends('front.layouts.default')
@section('content')
<style>
    .imagenLP{
        position: relative;
        display: inline-block;	
    }
    .descripcionT{
        position: absolute;
        top: 40%;
        right: 10%;
        left: 10%;
        font-size: 25px;
        color: white;	
    }

    .colorText{
        background-color: #FF9603; 
        width: 150px;
        height: 40px;
        font-size: 15px;
        vertical-align: middle;
        color: white;	
    }

    .empresas {
        display: flex;
        align-items: center;
        background-color: #668398;
    }

    .slick-prev {
        left: -10px;
    }
    .slick-next {
        right: -10px;
    }

    .slick-prev:before {
        content: "<";
        color: black;
        font-size: 30px;
    }

    .slick-next:before {
        content: ">";
        color: black;
        font-size: 30px;
    }
    .fotos img { margin:0 auto; }

    .slick-track
    {
    display: flex !important;
    }
    .slick-slide
    {
        height: inherit !important;
    }

    .textoEmpresas {
        display: table-cell;
        vertical-align: middle;
        font-size: 30px;
        color: white;
    }

    .disciplinas {
        display: flex;
        align-items: center;
        text-align:center;
        height: 100px;
        background-color: #668398;
    }


    .textoDisciplinas {
        display:inline-block;
        vertical-align: middle;
        font-size: 30px;
        color: white;
    }

    .funciones {
        display: flex;
        align-items: center;
        text-align:center;
        height: 100px;
        background-color: #668398;
    }


    .textoFunciones {
        display:inline-block;
        vertical-align: middle;
        font-size: 30px;
        color: white;
    }

    .categoriasDiv {
        display: flex;
        align-items: center;
        text-align:center;
        background-color: #153556;
    }


    .textoCategorias {
        display:inline-block;
        vertical-align: middle;
        font-size: 18px;
        color: white;
    }

    .imagenCarrusel {
        /* IMPORTANTE */
        text-align: center;
    }

    .centrado {
    text-align: center;
    font-size: 20px;
    
    }
</style>
    <div class="container-fluid">
        <div class="row general-view profesionales-info">
            <div class="inicio-crear-p col-md-12">
                @foreach ($posts as $post)
                    @foreach ($post->categorias as $categorias)
                        @if ($categorias->nombre == "Imagen Landing Page")
                            <div class="imagenLP">
                                <img src="/uploads/posts/{{$post->idpost}}/{{$post->imagenFull}}"/>
                                <div class="descripcionT">{!!$post->descripcion!!}</div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
            <div class="inicio-categorias col-md-12">                
                @foreach ($posts as $post)
                    @foreach ($post->categorias as $categorias)
                        @if ($categorias->nombre == "Con licencia de construccion")
                            <div class="col-md-12 imagenCarrusel">
                                <div class="col-md-12">
                                    <img class="img-fluid" style="width:75px;height: 100px" src="/uploads/posts/{{$post->idpost}}/{{$post->imagenFull}}" >
                                </div><br>
                                <div class="col-md-12">
                                    <p>{!!$post->descripcion!!}</p>
                                </div>    
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
            <div class="col-md-4 col-lg-4">
                @foreach ($posts as $post)
                    @foreach ($post->categorias as $categorias)
                        @if($categorias->nombre == "Categorias para tus proyectos")
                            <div class="col-md-12 imagenCarrusel">
                                <img class="img-fluid" src="/uploads/posts/{{$post->idpost}}/{{$post->imagenFull}}" style="height: 400px;">
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
            <div class="col-md-4 col-lg-4">
                @foreach ($posts as $post)
                    @foreach ($post->categorias as $categorias)
                        @if ($categorias->nombre == "Sin licencia de construccion")
                            <div class="col-md-12 imagenCarrusel">
                                <div class="col-md-12">
                                    <img class="img-fluid" style="width:75px; height: 100px" src="/uploads/posts/{{$post->idpost}}/{{$post->imagenFull}}" >
                                </div><br>
                                <div class="col-md-12">
                                    <p>{!!$post->descripcion!!}</p>
                                </div>    
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <center><a><b>Ver más tipos de proyectos</b></a></center>
                    </div>
                <div class="col-md-3"></div>
                <div class="card border" style="border: 3px solid #153556 !important;">
                    <div class="card-header">
                        <div class="card-title">¿Cómo Funciona?</div>
                    </div>
                    <div class="card-body">
                        <div class="row">                            
                            @foreach ($posts as $post)
                                @foreach ($post->categorias as $categorias)
                                    @if ($categorias->nombre == "Crea tu proyecto")
                                        <div class="" style="width: 20%">
                                            <div class="col-md-12 titulo-crea">
                                                <p align="center" style="color: black"><b>{!!$post->titulo!!}</b></p>
                                            </div>
                                            <div class="col-md-12">
                                                <img style="display:block; margin:auto;" src="/uploads/posts/{{$post->idpost}}/{{$post->imagenFull}}" width="166" height="137"/>
                                            </div>
                                            <div class="col-md-12">
                                                <p>{!!$post->descripcion!!}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach                            
                        </div>
                        <div class="col-md-12">
                            <p align="right" style="color: #ff9800">ver más {{'>'}}</p>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="inicio-empresas-aliadas text-center col-md-12" style="background-color: #ffffff">
                    <div>
                        <p>EMPRESAS ALIADAS</p>
                        <div class="mx-auto" style="height: 4px; width: 50px; background-color: orange">                            
                        </div>
                    </div>
                    <div class="fotos">
                        @php $i = 0; @endphp
                        @foreach ($posts as $post)
                            @foreach ($post->categorias as $categorias)
                                @if ($categorias->nombre == "Empresas Aliadas")
                                    <div class="" >
                                        <img class="img-fluid" src="/uploads/posts/{{$post->idpost}}/{{$post->imagenFull}}" style="height: 100px">
                                    </div>
                                    @php $i = $i+1; @endphp
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                    <p>Cómo ser parte de <b>BUILD IT</b> <button class="btn btn-info">ENTÉRATE</button></p>  
                </div>
            </div>
            <div class="inicio-noticia col-md-12">
                <div class="card noticia-landing" style="background-color: #ffffff;">
                    <div class="card-header">
                        <div class="card-title"></div>
                    </div>
                    <div class="card-body noticia-landing-text">
                        <div class="row">
                            @foreach ($posts as $post)
                                @foreach ($post->categorias as $categorias)
                                    @if ($categorias->nombre == "Noticia Landing Page")
                                        <div class="col-md-6 col-lg-6">
                                            <div class="col-md-12">
                                                <h5>{{$post->titulo}}</h5>
                                                <p>{!!$post->descripcion!!}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="col-md-12">
                                                <img style="display:block; margin:auto;" src="/uploads/posts/{{$post->idpost}}/{{$post->imagenFull}}"/>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="disciplinas col-md-12 col-lg-12">
                <div class="col-md-1"></div>
                <div class="textoDisciplinas col-md-10">
                    <b class="centrado">Disciplinas de nuestros Profesionales y/o Empresas</b>
                </div>
                <div class="col-md-1"></div>

            </div>
            <div class="inicio-disciplinas col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-lg-2"></div>
                            <div class="col-md-3 col-lg-3">
                                @php 
                                    $cuenta = $disciplinas->count() / 3;
                                    $cuenta = round($cuenta);
                                    $acumulador = 0;
                                    $segundoB = [];
                                    $tercerB = [];
                                @endphp
                                @foreach ($disciplinas as $disciplina)
                                    @if($acumulador < $cuenta)
                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left">{{$disciplina->nombre}}</p>
                                    @elseif($acumulador < $cuenta*2)
                                        @php
                                            $segundoB[] = $disciplina->nombre;
                                        @endphp
                                    @else
                                        @php
                                            $tercerB[] = $disciplina->nombre;
                                        @endphp
                                    @endif
                                    @php $acumulador = $acumulador+1; @endphp
                                @endforeach
                            </div>
                            <div class="col-md-3 col-lg-3">
                                @foreach ($segundoB as $item)
                                    <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left">{{$item}}</p>
                                @endforeach
                            </div>
                            <div class="col-md-3 col-lg-3">
                                @foreach ($tercerB as $item)
                                    <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left">{{$item}}</p>
                                @endforeach
                            </div>

                            <div class="col-md-1 col-lg-1"></div>
                        </div>
                    </div>
                    <div class="card-footer" style="color: black">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <p align="center">¿Tu disciplina hace parte del sector de la construcción, pero encuentras en nuestra lista?</p>
                                <p align="center"><a href="#" style="color: #FF9603">Contactános {{'>'}}</a></p>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="funciones col-md-12 col-lg-12">
                <div class="col-md-1"></div>
                <div class="textoFunciones col-md-10">
                    <b class="centrado">Otras funciones de las empresas que encontrarás en Build it</b>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="inicio-funciones col-md-12">
                <div class="card funciones-landing" style="background-color: #ffffff;">
                    <div class="card-header">
                        <div class="card-title"></div>
                    </div>
                    <div class="card-body funciones-landing-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3"></div>
                            <div class="col-md-3 col-lg-3">

                                @php 
                                    $espeCount = $especialidades->count() / 2;
                                    $espeCount = round($espeCount);
                                    $acumulador = 0;
                                    $segundoE = [];
                                @endphp

                                @foreach ($especialidades as $especialidad)
                                    @if($acumulador < $espeCount)
                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left">{{$especialidad->nombre}}</p>
                                    @else
                                        @php
                                            $segundoE[] = $especialidad->nombre;
                                        @endphp
                                    @endif
                                    @php $acumulador = $acumulador+1; @endphp
                                @endforeach
                            </div>
                            <div class="col-md-3 col-lg-3">
                                @foreach ($segundoE as $item)
                                    <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="max-width: 18px">{{$item}}</p>
                                @endforeach
                            </div>
                            <div class="col-md-3 col-lg-3"></div>
                        </div>
                    </div>
                    <div class="card-footer" style="color: black">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <p align="center">¿La función de tu empresa hace parte del sector de la construcción, pero no la encuentras en nuestra lista?</p>
                                <p align="center"><a href="#" style="color: #FF9603">Contactános {{'>'}}</a></p>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scriptsown')

    <script language="javascript">
    $(document).ready(function(){
        $('.fotos').slick({
            slidesToShow: 4,
            autoplay: true,
            autoplaySpeed: 700,
        });
    });
    </script>
@endsection

