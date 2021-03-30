@extends('admin.layouts.default')
@section('content')
<div class="side-app" >
    <div class="page-header">
        <h4 class="page-title"></h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Consultar Página</li>
        </ol>
    </div>
    <div class="card">
        <div class="card-header bg-blue br-tr-7 br-tl-7">
            <h3 class="card-title text-white">Consultar Página: <strong>{{ $pagina->titulo }}</strong></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('titulo','Titulo ',array('class' => 'form-label'))!!}</strong>
                        {{ $pagina->titulo }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('ruta_pagina','Ruta',array('class' => 'form-label'))!!}</strong>
                            {{ asset('/') }}clientes/contenidos/{{$pagina->ruta_pagina}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('imagen_header','Imagen',array('class' => 'form-label'))!!}
                        </strong>
                        @if( $pagina->imagen_header == "" )
                            <input type="file" name="imagen_header" id="imagen_header" class="dropify" disabled
                                data-default-file="{{ URL::asset('assets/admin/images/19.jpg') }}">
                        @else
                            <input type="file" name="imagen_header" id="imagen_header" class="dropify" disabled
                                data-default-file="/uploads/paginas/{{$pagina->idpagina}}/{{ $pagina->imagen_header }}">
                        @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('asociada_a','Asociada a ',array('class' => 'form-label'))!!}</strong>
                        {{ $pagina->asociada_a }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('estado','Estado',array('class' => 'form-label'))!!}</strong>
                            {{$pagina->estado}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success ml-auto"
                        onclick="document.location.href='{{ URL::to('paginas/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop