@extends('admin.layouts.default')
@section('content')
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Servicios Especialidad</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Servicios Especialidad</li>
        </ol>
    </div>
    @php 
        $rutaNombre = \Request::route()->getName();
    @endphp
    <div class="card-body">
        @if($rutaNombre == "servicios-especialidad-index")
            <p class="category">
                @can('servicios-especialidad-crear')
                    <a class="btn btn-success btn-fill btn-wd btn-move-right"
                        href="{{ URL::to('servicios-especialidad/crear') }}">
                        Crear Nuevo
                    </a>
                @endcan
            </p>
        @else
            <p class="category">
                <a class="btn btn-success btn-fill btn-wd btn-move-right"
                    href="{{ URL::to('especialidades-proveedor/'.$especialidad->idespecialidad.'/servicios-especialidad/crear') }}">
                    Crear Nuevo
                </a>
                <a class="btn btn-blue btn-fill btn-wd btn-move-right"
                    href="{{ URL::to('especialidades-proveedor/') }}">
                    Volver
                </a>
            </p>
        @endif
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-blue br-tr-7 br-tl-7">
                        <div class="card-title text-white">Servicios Especialidad</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">Especialidad</th>
                                        <th rowspan="1" colspan="1">Nombre</th>
                                        <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- incluimos el ciclo con la sintaxis de blade -->
                                    @foreach($servicios as $valor)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{ $valor->idservicio }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->especialidades->nombre }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->nombre }}</td>
                                            <td class="text-center">
                                                @can('servicios-especialidad-consultar')
                                                    <a href="{{ URL::to('servicios-especialidad/'.$valor->idservicio.'') }}"
                                                        title="Consultar"><i class="fa fa-search btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('servicios-especialidad-editar')
                                                    @if($rutaNombre == "servicios-especialidad-index")
                                                        <a href="{{ URL::to('servicios-especialidad/'.$valor->idservicio.'/editar') }}"
                                                            title="Editar"><i class="fa fa-pencil btn-space"
                                                                style="font-size: 20px;"></i></a>
                                                    @else
                                                        <a href="{{ URL::to('especialidades-proveedor/'.$especialidad->idespecialidad.'/servicios-especialidad/'.$valor->idservicio.'/editar') }}"
                                                            title="Editar"><i class="fa fa-pencil btn-space"
                                                                style="font-size: 20px;"></i></a>    
                                                    @endif
                                                @endcan
                                                @can('servicios-especialidad-eliminar')
                                                    <a onclick="eliminar({id:{{ $valor->idservicio }},url:'{{ URL('servicios-especialidad') }}' })"
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
