@extends('admin.layouts.default')
@section('content')
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Contenido de Páginas</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Contenido de Páginas</li>
        </ol>
    </div>
    <div class="card-body">
        <p class="category">
            @can('contenidos-paginas-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right"
                    href="{{ URL::to('contenidos-paginas/crear') }}">
                    Crear Nuevo
                </a>
            @endcan
        </p>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-blue br-tr-7 br-tl-7">
                        <div class="card-title text-white">Contenidos de Páginas</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">Nombre</th>
                                        <th rowspan="1" colspan="1">Página</th>
                                        <th rowspan="1" colspan="1">Estado</th>

                                        <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- incluimos el ciclo con la sintaxis de blade -->
                                    @foreach($contenidospaginas as $valor)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{ $valor->idcontenido }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->nombre }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->paginas->titulo }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->estado }}</td>

                                            <td class="text-center">
                                                @can('contenidos-paginas-consultar')
                                                    <a href="{{ URL::to('contenidos-paginas/'.$valor->idcontenido.'') }}"
                                                        title="Consultar"><i class="fa fa-search btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('contenidos-paginas-editar')
                                                    <a href="{{ URL::to('contenidos-paginas/'.$valor->idcontenido.'/editar') }}"
                                                        title="Editar"><i class="fa fa-pencil btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('contenidos-paginas-eliminar')
                                                    <a onclick="eliminar({id:{{ $valor->idcontenido }},url:'{{ URL('contenidos-paginas') }}' })"
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
