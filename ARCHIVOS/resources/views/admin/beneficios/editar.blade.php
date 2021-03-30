@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Editar Beneficio {{ $beneficio->titulo }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Editar Beneficio </a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Beneficio</li>
            </ol>
        </div>
        {!!Form::model($beneficio,array('action'=>array('Admin\BeneficiosController@actualizar',$beneficio->idbeneficio),'method'=>'post','class'=>'card','files' => 'true'))!!}
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        {!!Form::label('titulo','Titulo del beneficio',array('class' => 'form-label'))!!}
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                {!!Form::text('titulo',null,array('placeholder'=>'Ingrese el titulo del beneficio','class'=>'form-control'))!!}
                                <span class="help-block has-error"> {{ $errors->first('titulo') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        {!!Form::label('descripcion','Descripcion del post',array('class' => 'form-label'))!!}
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                {!!Form::textarea('descripcion',null,array('placeholder'=>'Ingrese la descripcion del post','class'=>'form-control description'))!!}
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
                                @if ( $beneficio->imagen !== "" )

                                    <input type="file" name="imagen" id="imagen" class="dropify"  data-default-file="/uploads/beneficios/{{$beneficio->idbeneficio}}/{{$beneficio->imagen}}" >

                                @else

                                    <input type="file" name="imagen" id="imagen" class="dropify" >

                                @endif
                                <span class="help-block has-error"> {{$errors->first('imagen')}}</span>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-6 col-lg-6">
                        {!!Form::label('archivo','Importar archivo',array('class' => 'form-label'))!!}
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                @if ( $beneficio->archivo !== "" )

                                    <input type="file" name="archivo" id="archivo" class="dropify"  data-default-file="/uploads/beneficios/{{$beneficio->idbeneficio}}/{{$beneficio->archivo}}" >

                                @else

                                    <input type="file" name="archivo" id="archivo" class="dropify" >

                                @endif
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
                            @php
                                $list1= $beneficio->categorias;
                                $bande = false;
                                if(!empty($list1)){
                                    foreach($list1 as $value)
                                    {
                                        if($value->idcategoria==$valor->idcategoria )
                                        {
                                            $bande = true; 
                                            break;
                                        }
                                    }

                                }
                            @endphp
                                <tr>
                                    <td>
                                        <div class="custom-controls-stacked">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="items[]"
                                            id="item_{{ $valor->idcategoria }}" value="{{ $valor->idcategoria }}" @if($bande) checked="checked" @endif >
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
                        {!!Form::label('estado','Estado del beneficio',array('class' => 'form-label'))!!}
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                {!!Form::select('estado', [
                                'publicado' => 'Publicado',
                                'no_publicado' => 'No publicado'],
                                null,
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
                            {!!Form::submit('Editar beneficio',array('class'=>'btn btn-success ml-auto'))!!}
                            <button type="button" class="btn btn-blue ml-auto"
                                onclick="document.location.href='{{ URL::to('beneficios/') }}'">Volver</button>
                        </div>
                    </div>
                </div>
            </div>
        {!!Form::close()!!}
    </div>
@stop