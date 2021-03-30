@extends('admin.layouts.default')
@section('content')
<div class="side-app" style="height:670px">
    <div class="page-header">
        <h4 class="page-title">Crear Disciplina</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Crear Disciplina</li>
        </ol>
    </div>
    {!!Form::open(array('url'=>'disciplinas/crear','method'=>'post','class'=>'card','files'=>'true'))!!}
    <div class="card-body ">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                {!!Form::label('nombre','Nombre de la disciplina',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::text('nombre',old('nombre'),array('placeholder'=>'Ingrese el nombre de la disciplina','class'=>'form-control'))!!}
                        <span class="help-block has-error"> {{ $errors->first('nombre') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                {!!Form::label('descripcion','Descripción de la disciplina',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        {!!Form::textarea('descripcion', old('descripcion'),array('placeholder'=>'Ingrese la descripción de la disciplina','class'=>'form-control', 'rows' => '3'))!!}
                        <span class="help-block has-error">
                            {{ $errors->first('descripcion') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                {!!Form::label('image','Imagen',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                    <div class="form-group has-default bmd-form-group">
                        <input type="file" name="image" id="image" class="dropify" data-default-file="{{ URL::asset('assets/admin/images/19.jpg') }}">
                        <span class="help-block has-error"> {{$errors->first('image')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                {!!Form::label('asociada_a','Asociada a:',array('class' => 'form-label'))!!}
                <div class="col-md-12">
                   <div class="form-group has-default bmd-form-group">
                      {!!Form::select('asociada_a', [
                      'profesionales' => 'Profesionales',
                      'proveedores' => 'Proveedores'],
                      old('asociada_a'),
                      array('class'=>'form-control')
                      )!!}
                      <span class="help-block has-error"> {{ $errors->first('asociada_a') }}</span>
                   </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::submit('Crear',array('class'=>'btn btn-success ml-auto'))!!}
                    <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('disciplinas/') }}'">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@stop
