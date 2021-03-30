@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Crear Rol</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Crear Rol</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Rol</li>
            </ol>
        </div>
        {!!Form::open(array('url'=>'roles/crear','method'=>'post','class'=>'card'))!!}
        <div class="card-body ">
            <div class="row">
                {!!Form::label('name','Nombre del permiso',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::text('name',old('name'),array('placeholder'=>'Ingrese el nombre del rol','class'=>'form-control'))!!}
                        <span class="help-block has-error"> {{ $errors->first('name') }}</span>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        {!!Form::submit('Crear un nuevo Rol',array('class'=>'btn btn-success ml-auto'))!!}
                        <button type="button" class="btn btn-blue ml-auto"
                            onclick="document.location.href='{{ URL::to('roles/') }}'">Volver</button>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@stop