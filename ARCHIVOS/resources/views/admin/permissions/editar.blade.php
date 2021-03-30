@extends('admin.layouts.default')
@section('content')
<div class="side-app" style="height:670px">
    <div class="page-header">
        <h4 class="page-title">Editar Permiso {{ $permiso->name }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Editar Permiso </a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Permiso</li>
        </ol>
    </div>
    {!!Form::model($permiso,array('action'=>array('Admin\PermissionsController@actualizar',$permiso->id),'method'=>'post','class'=>'card'))!!}
    <div class="card-body ">
        <div class="row">
            {!!Form::label('name','Nombre del permiso',array('class' => 'form-label'))!!}
            <div class="col-md-12">
                <div class="form-group has-default bmd-form-group">
                    {!!Form::text('name',null,array('placeholder'=>'Ingrese el nombre del permiso','class'=>'form-control'))!!}
                    <span class="help-block has-error"> {{ $errors->first('name') }}</span>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::submit('Editar Permiso',array('class'=>'btn btn-success ml-auto'))!!}
                    <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('permisos/') }}'">Volver</button>
                </div>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@stop