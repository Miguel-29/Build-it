@extends('admin.layouts.default')
@section('content')
<div class="side-app" style="height:670px">
    <div class="page-header">
        <h4 class="page-title">Crear Permiso</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Crear Permiso</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear Permiso</li>
        </ol>
    </div>
    {!!Form::open(array('url'=>'permisos/crear','method'=>'post','class'=>'card'))!!}
    <div class="card-body">
        <div class="row">
            {!!Form::label('name','Nombre del permiso',array('class' => 'form-label'))!!}
            <div class="col-md-12">
                <div class="form-group has-default bmd-form-group">
                    {!!Form::text('name',old('name'),array('placeholder'=>'Ingrese el nombre de permiso','class'=>'form-control'))!!}
                    <span class="help-block has-error">
                        {{ $errors->first('name') }}</span>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::submit('Crear un nuevo permiso',array('class'=>'btn btn-success ml-auto'))!!}
                    <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('permisos/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@stop