@extends('admin.layouts.default')
@section('content')
<div class="side-app" style="height:670px">
    <div class="page-header">
        <h4 class="page-title">Crear Listado</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Crear Listado</li>
        </ol>
    </div>
    {!!Form::open(array('url'=>'listados/crear','method'=>'post','class'=>'card'))!!}
    <div class="card-body ">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('nombre','Nombre del listado',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::text('nombre',old('nombre'),array('placeholder'=>'Ingrese el nombre del listado','class'=>'form-control'))!!}
                        <span class="help-block has-error"> {{ $errors->first('nombre') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('descripcion','Descripción del listado',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::textarea('descripcion', old('descripcion'),array('placeholder'=>'Ingrese la descripción del listado','class'=>'form-control', 'rows' => '3'))!!}
                        <span class="help-block has-error">
                            {{ $errors->first('descripcion') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::submit('Crear',array('class'=>'btn btn-success ml-auto'))!!}
                    <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('listados/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@stop
