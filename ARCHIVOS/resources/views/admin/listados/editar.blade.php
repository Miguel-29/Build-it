@extends('admin.layouts.default')
@section('content')
<div class="side-app" style="height:670px">
    <div class="page-header">
        <h4 class="page-title">Editar Listado {{ $listado->nombre }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Editar Listado</li>
        </ol>
    </div>
    {!!Form::model($listado,array('action'=>array('Admin\ListadosController@actualizar',$listado->idlistado),'method'=>'post','class'=>'card'))!!}
    <div class="card-body ">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('nombre','Nombre',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::text('nombre',null,array('placeholder'=>'Ingrese el nombre de la
                        Familia','class'=>'form-control'))!!}
                        <span class="help-block has-error"> {{ $errors->first('nombre') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('descripcion','Descripción',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::textarea('descripcion', null,array('placeholder'=>'Ingrese la descripción de la
                        Familia','class'=>'form-control', 'rows' => '3'))!!}
                        <span class="help-block has-error">
                            {{ $errors->first('descripcion') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::submit('Editar',array('class'=>'btn btn-success ml-auto'))!!}
                    <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('listados/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@stop
