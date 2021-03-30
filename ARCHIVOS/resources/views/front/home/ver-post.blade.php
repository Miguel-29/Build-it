@extends('front.layouts.proyecto')
@section('content')
<div class="container">
    <img src="{{URL::to('assets/front/images/imagenes/home/b-ultimas-noticias.jpg')}}" alt="Últimas Noticias">

    <div class="row general-view proveedor-info">
        <div class="col-sm-12">
            <div class="card" style="background-color: #ffffff;">
                <div class="card-header">
                    <div class="card-title"><br>{{ $post->titulo }}</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img style="display:block; margin:auto;" src="/uploads/posts/{{$post->idpost}}/{{$post->imagenSmall}}"/>
                            <hr>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <p align="justify">{!!$post->descripcion!!}</p>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('clientes/ultimas-noticias') }}'">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>

</script>
@stop