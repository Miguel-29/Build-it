@extends('admin.layouts.default')
@section('content')
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Disciplinas</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Disciplinas</li>
        </ol>
    </div>
    <div class="card-body">
        <p class="category">
            @can('disciplinas-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right"
                    href="{{ URL::to('disciplinas/crear') }}">
                    Crear Nuevo
                </a>
            @endcan
        </p>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-blue br-tr-7 br-tl-7">
                        <div class="card-title text-white">Disciplinas</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">Nombre</th>
                                        <th rowspan="1" colspan="1">Descripcion</th>
                                        <th rowspan="1" colspan="1">Asociada</th>
                                        <th rowspan="1" colspan="1">Servicios</th>
                                        <th rowspan="1" colspan="1">Profesiones</th>
                                        <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- incluimos el ciclo con la sintaxis de blade -->
                                    @foreach($disciplinas as $valor)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{ $valor->iddisciplina }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->nombre }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->descripcion }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->asociada_a }}</td>
                                            <td class="text-center">
                                                @if($valor->asociada_a == "profesionales")
                                                    <a title="Asociar Servicios"><i class="fa fa-thumb-tack"
                                                        style="font-size: 20px;"></i><a>
                                                @else
                                                    <a href="{{ URL::to('disciplinas/'.$valor->iddisciplina.'/servicios') }}"
                                                        title="Asociar servicios"><i class="fa fa-thumb-tack"
                                                            style="font-size: 20px;"></i></a>

                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($valor->asociada_a == "proveedores")
                                                    <a title="Asociar Profesiones"><i class="fa fa-user-md"
                                                        style="font-size: 20px;"></i><a>
                                                @else
                                                    <a href="{{ URL::to('disciplinas/'.$valor->iddisciplina.'/profesiones')}}"
                                                        title="Asociar Profesiones"><i class="fa fa-user-md"
                                                            style="font-size: 20px;"></i></a>

                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @can('disciplinas-consultar')
                                                    <a href="{{ URL::to('disciplinas/'.$valor->iddisciplina.'') }}"
                                                        title="Consultar"><i class="fa fa-search btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('disciplinas-editar')
                                                    <a href="{{ URL::to('disciplinas/'.$valor->iddisciplina.'/editar') }}"
                                                        title="Editar"><i class="fa fa-pencil btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('disciplinas-eliminar')
                                                    <a onclick="eliminar({id:{{ $valor->iddisciplina }},url:'{{ URL('disciplinas') }}' })"
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
