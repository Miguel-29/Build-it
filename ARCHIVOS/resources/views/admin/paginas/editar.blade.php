@extends('admin.layouts.default')
@section('content')
<div class="side-app" >
    <div class="page-header">
        <h4 class="page-title">Editar Página: {{ $pagina->titulo }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Editar Página</li>
        </ol>
    </div>
    {!!Form::model($pagina,array('action'=>array('Admin\PaginasController@actualizar',$pagina->idpagina),'method'=>'post','class'=>'card','files'=>'true'))!!}
    <div class="card-body ">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('titulo','Titulo de la pagina',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::text('titulo',null,array('placeholder'=>'Ingrese el titulo de la pagina','class'=>'form-control'))!!}
                        <span class="help-block has-error"> {{ $errors->first('titulo') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('ruta_pagina','Ruta de la pagina',array('class' => 'form-label'))!!}
                <div class=" row col-md-12">
                    <div class="col-sm-5">
                        {{ asset('/') }}clientes/contenidos/
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::text('ruta_pagina',null,array('placeholder'=>'Ingrese la ruta de la pagina, sin espacios, ni carácteres especiales.','class'=>'form-control'))!!}
                            <span class="help-block has-error"> {{ $errors->first('ruta_pagina') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('imagen_header','Imagen del Header',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        @if ( $pagina->imagen_header == "" )
                            <input type="file" name="imagen_header" id="imagen_header" class="dropify" data-default-file="{{ URL::asset('assets/admin/images/19.jpg') }}" >
                        @else
                            <input type="file" name="imagen_header" id="imagen_header" class="dropify" data-default-file="/uploads/paginas/{{$pagina->idpagina}}/{{ $pagina->imagen_header }}" >
                        @endif
                        <span class="help-block has-error"> {{$errors->first('imagen_header')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                {!!Form::label('asociada_a','Asociada a la sección',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::select('asociada_a', [
                        'quienes_somos' => '¿Quienes Somos?',
                        'soporte' => 'Soporte',
                        'navbar' => 'Barra de Navegación'],
                        null,
                        array('class'=>'form-control')
                        )!!}
                    <span class="help-block has-error"> {{ $errors->first('asociada_a') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                {!!Form::label('estado','Estado de la página',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::select('estado', [
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo'],
                        null,
                        array('class'=>'form-control')
                        )!!}
                        <span class="help-block has-error"> {{ $errors->first('estado') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::submit('Editar',array('class'=>'btn btn-success ml-auto'))!!}
                    <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('paginas/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@stop
