@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Consultar Post </a></li>
                <li class="breadcrumb-item active" aria-current="page">Consultar Post</li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header bg-blue br-tr-7 br-tl-7">
                <h3 class="card-title text-white">Consultar Post: <strong>{{$post->titulo}}</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Titulo del Post: </strong>{{$post->titulo}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Resumen de descripción del Post: </strong>{{$post->resumenDescripcion}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Descripción del Post: </strong>
                                    {!!$post->descripcion!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Imagen Full: </strong>
                                    @if( $post->imagenFull == "" )
                                        <input type="file" name="image" id="image" class="dropify" disabled
                                            data-default-file="{{ URL::asset('assets/admin/images/19.jpg') }}">
                                    @else
                                        <input type="file" name="image" id="image" class="dropify" disabled
                                            data-default-file="/uploads/posts/{{ $post->idpost }}/{{ $post->imagenFull }}">
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                                <p><strong style="color: #1C4E8B">Imagen Small: </strong>
                                    @if( $post->imagenSmall == "" )
                                        <input type="file" name="image" id="image" class="dropify" disabled
                                            data-default-file="{{ URL::asset('assets/admin/images/19.jpg') }}">
                                    @else
                                        <input type="file" name="image" id="image" class="dropify" disabled
                                            data-default-file="/uploads/posts/{{ $post->idpost }}/{{ $post->imagenSmall }}">
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
                                <p><strong style="color: #1C4E8B">Categorias asociadas del Post: </strong>
                                    <ol>
                                        <?php
                                            $list1= $post->categorias;
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
                                <p><strong style="color: #1C4E8B">Estado del Post: </strong>{{$post->estado}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-success ml-auto"
                            onclick="document.location.href='{{ URL::to('posts/') }}'">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop