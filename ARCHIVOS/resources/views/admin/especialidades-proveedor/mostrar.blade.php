@extends('admin.layouts.default')
@section('content')
<div class="side-app" style="height:670px">
    <div class="page-header">
        <h4 class="page-title"></h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Consultar Especialidad Proveedor</li>
        </ol>
    </div>
    <div class="card">
        <div class="card-header bg-blue br-tr-7 br-tl-7">
            <h3 class="card-title text-white">Consultar Especialidad Proveedor: <strong>{{ $especialidad->nombre }}</strong></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">{!!Form::label('nombre','Nombre ',array('class' => 'form-label'))!!}</strong>
                        {{ $especialidad->nombre }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success ml-auto"
                        onclick="document.location.href='{{ URL::to('especialidades-proveedor/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop