@extends('admin.layouts.default')
@section('content')
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Páginas</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Páginas</li>
        </ol>
    </div>
    <div class="card-body">
        <p class="category">
            @can('paginas-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right"
                    href="{{ URL::to('paginas/crear') }}">
                    Crear Nuevo
                </a>
            @endcan
        </p>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-blue br-tr-7 br-tl-7">
                        <div class="card-title text-white">Páginas</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">Titulo</th>
                                        <th rowspan="1" colspan="1">Ruta</th>
                                        <th rowspan="1" colspan="1">Asociada a</th>
                                        <th rowspan="1" colspan="1">Estado</th>

                                        <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- incluimos el ciclo con la sintaxis de blade -->
                                    @foreach($paginas as $valor)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{ $valor->idpagina }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->titulo }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->ruta_pagina }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->asociada_a }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->estado }}</td>

                                            <td class="text-center">
                                                @can('paginas-consultar')
                                                    <a href="{{ URL::to('paginas/'.$valor->idpagina.'') }}"
                                                        title="Consultar"><i class="fa fa-search btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('paginas-editar')
                                                    <a href="{{ URL::to('paginas/'.$valor->idpagina.'/editar') }}"
                                                        title="Editar"><i class="fa fa-pencil btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('paginas-eliminar')
                                                    <a onclick="eliminar({id:{{ $valor->idpaginas }},url:'{{ URL('paginas') }}' })"
                                                        title="Eliminar"><i class="mdi mdi-close-circle btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end card-body -->
</div>
<!-- end side-app-->
<!-- end app-content-->
@stop
