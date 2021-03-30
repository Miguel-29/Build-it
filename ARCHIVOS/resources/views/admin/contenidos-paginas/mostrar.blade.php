@extends('admin.layouts.default')
@section('content')
<div class="side-app" >
    <div class="page-header">
        <h4 class="page-title"></h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Consultar Contenido de Página</li>
        </ol>
    </div>
    <div class="card">
        <div class="card-header bg-blue br-tr-7 br-tl-7">
            <h3 class="card-title text-white">Consultar Contenido de Página: <strong>{{ $contenido->nombre }}</strong></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('nombre','Nombre ',array('class' => 'form-label'))!!}</strong>
                        {{ $contenido->nombre }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('idpagina','Página',array('class' => 'form-label'))!!}</strong>
                            {{$contenido->paginas->titulo}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('descripcion','Descripcion',array('class' => 'form-label'))!!}</strong>
                            {!!$contenido->descripcion!!}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('imagen','Imagen',array('class' => 'form-label'))!!}
                        </strong>
                        @if( $contenido->imagen == "" )
                            <input type="file" name="imagen" id="imagen" class="dropify" disabled
                                data-default-file="{{ URL::asset('assets/admin/images/19.jpg') }}">
                        @else
                            <input type="file" name="imagen" id="imagen" class="dropify" disabled
                                data-default-file="/uploads/paginas/{{$contenido->idpagina}}/contenidos/{{ $contenido->idcontenido }}/{{ $contenido->imagen }}">
                        @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('estado','Estado',array('class' => 'form-label'))!!}</strong>
                            {{$contenido->estado}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success ml-auto"
                        onclick="document.location.href='{{ URL::to('contenidos-paginas/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop