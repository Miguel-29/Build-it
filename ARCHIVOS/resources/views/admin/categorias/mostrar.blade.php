@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Consultar Categoria </a></li>
                <li class="breadcrumb-item active" aria-current="page">Consultar Categoria</li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header bg-blue br-tr-7 br-tl-7">
                <h3 class="card-title text-white">Consultar Categoria: <strong>{{$categoria->nombre}}</strong></h3>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        <p><strong style="color: #1C4E8B">Nombre de la Categoria: </strong>{{$categoria->nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-success ml-auto"
                            onclick="document.location.href='{{ URL::to('categorias/') }}'">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop