@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Editar parametro {{$parametro->nombre}}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Editar parametro </a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar parametro</li>
            </ol>
        </div>
        {!!Form::model($parametro,array('action'=>array('Admin\ParametrosController@actualizar',$parametro->idparametro),'method'=>'post','class'=>'card'))!!}
        <div class="card-body ">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    {!!Form::label('nombre','Nombre del parametro',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::text('nombre',null,array('placeholder'=>'Ingrese el nombre del
                            parametro','class'=>'form-control'))!!}
                            <span class="help-block has-error"> {{$errors->first('nombre')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    {!!Form::label('valor','Valor del Parametro',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::text('valor',null,array('placeholder'=>'Ingrese el valor del
                            parametro','class'=>'form-control'))!!}
                            <span class="help-block has-error"> {{$errors->first('valor')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        {!!Form::submit('Editar parametro',array('class'=>'btn btn-success ml-auto'))!!}
                        <button type="button" class="btn btn-blue ml-auto"
                            onclick="document.location.href='{{ URL::to('parametros/') }}'">Volver</button>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@stop