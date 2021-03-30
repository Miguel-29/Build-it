@extends('front.layouts.proyecto')
@section('content')
<style>
    #more {display: none;}
    .slick-track
    {
    display: flex !important;
    }
    .slick-slide
    {
        height: inherit !important;
    }

    .slick-prev {
        left: -20px;
    }
    .slick-next {
        right: -20px;
    }

    .slick-prev:before {
        content: "<";
        color: #e4e4e4;
        font-size: 30px;
    }

    .slick-next:before {
        content: ">";
        color:#e4e4e4;
        font-size: 30px;
    }
</style>
<div class="container">
    <img src="{{URL::to('assets/front/images/imagenes/home/b-ultimas-noticias.jpg')}}" alt="Últimas Noticias">
    <div class="row general-view proveedor-info" style="margin-left: 0; margin-right: 0">
        <div  style="width: 70%; height: 1000px; overflow-y: scroll;">
            <div class="card">
                <div class="card-body">
                    @php
                        $cuentaNoticias = 0;
                        $cuentaT = 0;
                        $total = 0;
                    @endphp
  

                    @foreach ($posts as $post)
                        @if ($cuentaNoticias === 2)
                            <span id="more">
                        @endif
                            <div class="row">
                                @foreach ($post->categorias as $categorias)
                                    @if ($categorias->nombre !== 'Noticias')
                                        <div class="col-md-11 col-lg-11">
                                            <h1>{{$categorias->nombre}}</h1>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="col-md-12">
                                                <img src="/uploads/posts/{{$post->idpost}}/{{$post->imagenSmall}}" style="width: 500px; height: 200px"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="col-md-12">
                                                <h5>{{$post->titulo}}</h5>
                                                <p align="justify">{{substr($post->resumenDescripcion, 0, 500)}}</p>
                                                <a href="{{URL::to('clientes/ultimas-noticias/post/'.$post->idpost)}}">Ver Más</a>
                                            </div>
                                        </div>
                                        @php $cuentaNoticias = $cuentaNoticias+1; @endphp
                                    @endif 
                                @endforeach
                            </div>
                            <hr>
                        @if($cuentaNoticias == $cuentaB)
                            </span>
                        @endif
                    @endforeach
                    @if($cuentaNoticias > 2)
                        <div class="row justify-content-center">
                            <button onclick="myFunction()" class="btn btn-link" style="border: 0px" id="myBtn">Mostrar más +</button>
                            <span id="dots"></span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div  style="width: 30%">
            <div class="card" style="background-color: #ffffff; height: 100%">

                <div class="card-body justify-content-center" style="
                padding-right: 10px;
                padding-top: 10px;
                padding-left: 10px;
                padding-bottom: 10px;">
                    <div class="anuncios-empresas justify-content-center" style="margin: 0 auto;width: 90%">
                        @foreach ($anuncios as $anuncio)
                            @foreach ($anuncio->categorias as $categorias)
                                @if ($categorias->nombre == 'Anuncios - Empresas')

                                    <div class="">
                                        <a href="{{URL::to('clientes/beneficios')}}" style="color: black" target="_blank">
                                            <div class="row" style="margin-right: 0">
                                                
                                                    <div class="col-md-6" style="display: flex;align-items: center; text-align: center;">
                                                        <img src="/uploads/posts/{{$anuncio->idpost}}/{{$anuncio->imagenSmall}}" style="margin:0 auto;width: 70px; height: 70px;"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{!!$anuncio->descripcion!!}</p>
                                                    </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                    <hr style="margin-top: 0.4rem; margin-bottom: 0.9rem;">
                    <div class="anuncios-contratistas justify-content-center" style="margin: 0 auto;width: 90%">
                        @foreach ($freelancers as $freelancer)
                            @if($freelancer->disciplinas->count() > 0)
                                <div class="">
                                    <a href="{{URL::to('clientes/perfil-freelancer/'.$freelancer->idfreelancer)}}" style="color: black" target="_blank">
                                        <div class="row" style="margin-right: 0">
                                                <div class="" style="width:50%; display: flex;align-items: center; text-align: center;">
                                                    @php
                                                        $url = '/assets/front/images/user-2.png';
                                                        if($freelancer->image !== NULL){
                                                            $url = '/uploads/front/freelancer/general/'.$freelancer->idfreelancer.'/'.$freelancer->image;
                                                        }
                                                        $disciplina = $freelancer->disciplinas->last();
                                                        if($freelancer->disciplinas->count() > 1){
                                                            $disciplina = $disciplina->nombre.', entre otras.';
                                                        }else{
                                                            $disciplina = $disciplina->nombre;
                                                        }
                                        
                                                       
                                                        $nombre = explode(' ',$freelancer->nombres);
                                                        $apellido = explode(' ',$freelancer->apellidos);
                                                        if(count($apellido) > 1){
                                                            $apellido = $apellido[1];
                                                        }else{
                                                            $apellido = $apellido[0];
                                                        }
                                                    @endphp
                                                    <img  src="{{$url}}" style="object-fit: cover;
                                                    border-radius: 50%;margin:0 auto;width: 70px; height: 70px;"/>
                                                </div>
                                                <div class="" style="width: 50%">
                                                    <p align="left" style="font-size: 12px;"><b>{{$nombre[0]}} {{$apellido}}</b>
                                                        <br>Freelancer
                                                        <br>{{$disciplina}}
                                                    </p>
                                                </div>
                                        </div>
                                    </a>
                                </div>

                            @endif
                        @endforeach
                        @foreach ($empresas as $empresa)
                            @if($empresa->disciplinas->count() > 0)
                                <div class="">
                                    <a href="{{URL::to('clientes/perfil-empresa/'.$empresa->idempresa)}}" style="color: black" target="_blank">
                                        <div class="row" style="margin-right: 0">
                                                <div class="" style=" width: 50%;display: flex;align-items: center; text-align: center;">
                                                    @php
                                                        $url = '/assets/front/images/user-3.png';
                                                        if($empresa->image !== NULL){
                                                            $url = '/uploads/front/empresa/general/'.$empresa->idempresa.'/'.$empresa->image;
                                                        }
                                                        $disciplina = $empresa->disciplinas->last();
                                                        if($empresa->disciplinas->count() > 1){
                                                            $disciplina = $disciplina->nombre.', entre otras.';
                                                        }else{
                                                            $disciplina = $disciplina->nombre;
                                                        }

                                                    @endphp
                                                    <img  src="{{$url}}" style="object-fit: cover;
                                                    border-radius: 50%;margin:0 auto;width: 70px; height: 70px;"/>
                                                </div>
                                                <div class="" style=" width: 50%;">
                                                    <p align="left" style="font-size: 12px;"><b>{{$empresa->razon_social}}</b>
                                                        <br>Empresa
                                                        <br>{{$disciplina}}
                                                    </p>
                                                </div>
                                        </div>
                                    </a>
                                </div>

                            @endif
                        @endforeach
                    </div>
                    <hr style="margin-top: 0.4rem; margin-bottom: 0.9rem;">
                    <div class="anuncios-universidades justify-content-center" style="margin: 0 auto;width: 90%">
                        @foreach ($anuncios as $anuncio)
                            @foreach ($anuncio->categorias as $categorias)
                                @if ($categorias->nombre == 'Anuncios - Universidades')

                                    <div class="">
                                        <a href="{{URL::to('clientes/beneficios')}}" style="color: black" target="_blank">
                                            <div class="row" style="margin-right: 0">
                                                
                                                    <div class="" style="width: 50%;display: flex;align-items: center; text-align: center;">
                                                        <img src="/uploads/posts/{{$anuncio->idpost}}/{{$anuncio->imagenSmall}}" style="margin:0 auto;width: 70px; height: 70px;"/>
                                                    </div>
                                                    <div class="" style=" width: 50%;">
                                                        <p>{!!$anuncio->descripcion!!}</p>
                                                    </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <!--<div class="card ">
                <div class="card-body">
                    <div class="card card-aside bg-primary">
                        <div class="card-body d-flex flex-column">
                            <h4><a href="#" class="text-white">Burguer King</a></h4>
                            <div class="text-muted text-white">Some quick example text to build on the card title and make up the bulk of the card's </div>
                        </div>
                        <a href="#" class="card-aside-column br-tr-7 br-br-7 w-50" style="background-image: url(assets/images/photos/20.jpg)"></a>
                    </div>
                    <div class="card card-aside bg-primary">
                        <div class="card-body d-flex flex-column">
                            <h4><a href="#" class="text-white">Universidad Santo Tomas</a></h4>
                            <div class="text-muted text-white">Some quick example text to build on the card title and make up the bulk of the card's </div>
                        </div>
                        <a href="#" class="card-aside-column br-tr-7 br-br-7 w-50" style="background-image: url(assets/images/photos/20.jpg)"></a>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
    $(document).ready(function(){
        $('.anuncios-empresas').slick({
            autoplay: true,
            autoplaySpeed: 3500,
        });
        $('.anuncios-contratistas').slick({
            autoplay: true,
            autoplaySpeed: 2500,
        });
        $('.anuncios-universidades').slick({
            autoplay: true,
            autoplaySpeed: 3000,
        });
    });

    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Mostrar más +";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Mostrar menos -";
            moreText.style.display = "inline";
        }

    }
</script>
@stop