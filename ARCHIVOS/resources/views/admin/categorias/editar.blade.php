@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Editar Categoria {{ $categoria->nombre }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Editar Categoria </a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Categoria</li>
            </ol>
        </div>
        {!!Form::model($categoria,array('action'=>array('Admin\CategoriasController@actualizar',$categoria->idcategoria),'method'=>'post','class'=>'card'))!!}
        <div class="card-body ">
            <div class="row">
                {!!Form::label('nombre','Nombre de la categoria',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::text('nombre',null,array('placeholder'=>'Ingrese el nombre de la categoría','class'=>'form-control'))!!}
                        <span class="help-block has-error"> {{ $errors->first('nombre') }}</span>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        {!!Form::submit('Editar Categoria',array('class'=>'btn btn-success ml-auto'))!!}
                        <button type="button" class="btn btn-blue ml-auto"
                            onclick="document.location.href='{{ URL::to('categorias/') }}'">Volver</button>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@stop