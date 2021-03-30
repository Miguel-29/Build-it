@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Crear Post</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Crear Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Post</li>
            </ol>
        </div>
        {!!Form::open(array('url'=>'posts/crear','method'=>'post','class'=>'card','files'=>'true'))!!}
        <div class="card-body ">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('titulo','Titulo del post',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::text('titulo',old('titulo'),array('placeholder'=>'Ingrese el titulo del post','class'=>'form-control'))!!}
                            <span class="help-block has-error"> {{ $errors->first('titulo') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('resumenDescripcion','Resumen del post',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::textarea('resumenDescripcion',old('resumenDescripcion'),array('placeholder'=>'Ingrese el resumen del post','class'=>'form-control'))!!}
                            <span class="help-block has-error"> {{ $errors->first('resumenDescripcion') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    {!!Form::label('descripcion','Descripcion del post',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::textarea('descripcion',old('descripcion'),array('placeholder'=>'Ingrese la descripcion del post','class'=>'form-control description'))!!}
                            <span class="help-block has-error"> {{ $errors->first('descripcion') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('imagenFull','Imagen Full',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            <input type="file" name="imagenFull" id="imagenFull" class="dropify" >
                            <span class="help-block has-error"> {{$errors->first('imagenFull')}}</span>
                        </div>
                    </div>    
                </div>
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('imagenSmall','Imagen Small',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            <input type="file" name="imagenSmall" id="imagenSmall" class="dropify" >
                            <span class="help-block has-error"> {{$errors->first('imagenSmall')}}</span>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('idcategoria','Seleccione a que categorías pertenece el post',array('class' => 'form-label'))!!}
                    <table id="example" class="table card-table table-vcenter text-nowrap" style="width:100%">
                        <tbody>
                           @foreach($categorias as $valor)
                              <tr>
                                 <td>
                                    <div class="custom-controls-stacked">
                                       <label class="custom-control custom-checkbox">
                                         <input type="checkbox" class="custom-control-input" name="items[]"
                                         id="item_{{ $valor->idcategoria }}" value="{{ $valor->idcategoria }}">
                                         <span class="custom-control-label"></span>
                                       </label>
                                    </div>
                                 </td>
                                 <td>{{ $valor->nombre }}</td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                </div>
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('estado','Estado del post',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::select('estado', [
                            'publicado' => 'Publicado',
                            'no_publicado' => 'No publicado'],
                            old('estado'),
                            array('class'=>'form-control')
                            )!!}
                            <span class="help-block has-error"> {{$errors->first('estado')}}</span>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        {!!Form::submit('Crear un nuevo post',array('class'=>'btn btn-success ml-auto'))!!}
                        <button type="button" class="btn btn-blue ml-auto"
                            onclick="document.location.href='{{ URL::to('posts/') }}'">Volver</button>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@stop