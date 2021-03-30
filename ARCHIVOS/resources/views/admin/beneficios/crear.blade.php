@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Crear beneficio</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Crear beneficio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear beneficio</li>
            </ol>
        </div>
        {!!Form::open(array('url'=>'beneficios/crear','method'=>'post','class'=>'card','files'=>'true'))!!}
        <div class="card-body ">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    {!!Form::label('titulo','Titulo del beneficio',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::text('titulo',old('titulo'),array('placeholder'=>'Ingrese el titulo del beneficio','class'=>'form-control'))!!}
                            <span class="help-block has-error"> {{ $errors->first('titulo') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    {!!Form::label('descripcion','Descripcion del beneficio',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            {!!Form::textarea('descripcion',old('descripcion'),array('placeholder'=>'Ingrese la descripcion del beneficio','class'=>'form-control description'))!!}
                            <span class="help-block has-error"> {{ $errors->first('descripcion') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('imagen','Imagen',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            <input type="file" name="imagen" id="imagen" class="dropify" >
                            <span class="help-block has-error"> {{$errors->first('imagen')}}</span>
                        </div>
                    </div>    
                </div>
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('archivo','Importar Archivo',array('class' => 'form-label'))!!}
                    <div class="col-md-12">
                        <div class="form-group has-default bmd-form-group">
                            <input type="file" name="archivo" id="archivo" class="dropify" >
                            <span class="help-block has-error"> {{$errors->first('archivo')}}</span>
                        </div>
                    </div>    
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    {!!Form::label('idcategoria','Seleccione a que categorías pertenece el beneficio',array('class' => 'form-label'))!!}
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
                        {!!Form::submit('Crear un nuevo beneficio',array('class'=>'btn btn-success ml-auto'))!!}
                        <button type="button" class="btn btn-blue ml-auto"
                            onclick="document.location.href='{{ URL::to('beneficios/') }}'">Volver</button>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@stop