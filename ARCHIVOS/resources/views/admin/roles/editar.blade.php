@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Editar Rol {{ $rol->name }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Editar Rol </a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Rol</li>
            </ol>
        </div>
        {!!Form::model($rol,array('action'=>array('RolesController@actualizar',$rol->id),'method'=>'post','class'=>'card'))!!}
        <div class="card-body ">
            <div class="row">
                {!!Form::label('name','Nombre del Rol',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::text('name',null,array('placeholder'=>'Ingrese el nombre del
                        rol','class'=>'form-control'))!!}
                        <span class="help-block has-error"> {{ $errors->first('name') }}</span>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        {!!Form::submit('Editar Rol',array('class'=>'btn btn-success ml-auto'))!!}
                        <button type="button" class="btn btn-blue ml-auto"
                            onclick="document.location.href='{{ URL::to('roles/') }}'">Volver</button>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@stop