@extends('admin.layouts.default')
@section('content')
<div class="side-app" style="height:670px">
    <div class="page-header">
        <h4 class="page-title">Editar Opcion {{ $opcion->nombre }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Editar Opcion</li>
        </ol>
    </div>
    {!!Form::model($opcion,array('action'=>array('Admin\OpcionListadoController@actualizar',$opcion->idopcion),'method'=>'post','class'=>'card'))!!}
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
                {!!Form::label('idlistado','Listado asociado',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        <select name="idlistado" id="idlistado" class="form-control">
                            <option value="" disabled>Seleccione un listado</option>
                            @foreach($listados as $listado)
                                <option value="{{ $listado->idlistado }}" @if($opcion->idlistado == $listado->idlistado) selected @endif>{{ $listado->nombre }}</option>
                            @endforeach
                        </select>
                        <span class="help-block has-error"> {{ $errors->first('idlistado') }}</span>
                    </div>
                </div>
            </div>   
        </div>
        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::submit('Editar',array('class'=>'btn btn-success ml-auto'))!!}
                    
                    <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('listados/'.$opcion->idlistado.'/opcionlistados') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@stop
