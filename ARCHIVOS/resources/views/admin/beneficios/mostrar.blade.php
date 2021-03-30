@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Consultar Beneficio </a></li>
                <li class="breadcrumb-item active" aria-current="page">Consultar Beneficio</li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header bg-blue br-tr-7 br-tl-7">
                <h3 class="card-title text-white">Consultar Beneficio: <strong>{{$beneficio->titulo}}</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Titulo del Beneficio: </strong>{{$beneficio->titulo}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Descripción del Beneficio: </strong>
                                    {!!$beneficio->descripcion!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Imagen: </strong>
                                    @if( $beneficio->imagen == "" )
                                        <input type="file" name="image" id="image" class="dropify" disabled
                                            data-default-file="{{ URL::asset('assets/admin/images/19.jpg') }}">
                                    @else
                                        <input type="file" name="image" id="image" class="dropify" disabled
                                            data-default-file="/uploads/beneficios/{{ $beneficio->idbeneficio }}/{{ $beneficio->imagen }}">
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Categorias asociadas del Beneficio: </strong>
                                    <ol>
                                        <?php
                                            $list1= $beneficio->categorias;
                                            if(!empty($list1))
                                            foreach($list1 as $value)
                                            {
                                                echo '<strong><li>'.$value->nombre.'</li></strong>';
                                            }
                                        ?>
                                    </ol>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Estado del Beneficio: </strong>{{$beneficio->estado}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-success ml-auto"
                            onclick="document.location.href='{{ URL::to('beneficios/') }}'">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop