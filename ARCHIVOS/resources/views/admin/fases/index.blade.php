@extends('admin.layouts.default')
@section('content')
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Fases</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Fases</li>
        </ol>
    </div>
    <div class="card-body">
        <p class="category">
            @can('fases-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right"
                    href="{{ URL::to('fases/crear') }}">
                    Crear Nuevo
                </a>
            @endcan
        </p>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-blue br-tr-7 br-tl-7">
                        <div class="card-title text-white">Fases</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">Nombre</th>
                                        <th rowspan="1" colspan="1">Descripcion</th>
                                        <th rowspan="1" colspan="1">Imagen</th>
                                        <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- incluimos el ciclo con la sintaxis de blade -->
                                    @foreach($fases as $valor)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{ $valor->idfase }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->nombre }}</td>
                                            <td tabindex="0" class="sorting_1">{{ $valor->descripcion }}</td>
                                            <td class="text-center">
                                                @if ($valor->image == "" )
                                                    <img src="{{ URL::asset('assets/admin/images/faces/male/2.jpg') }}" style="width: 130px !important;" />
                                                @else
                                                    <img src="{{url('uploads/fases/'.$valor->image)}}" style="width: 130px !important;" />
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @can('fases-consultar')
                                                    <a href="{{ URL::to('fases/'.$valor->idfase.'') }}"
                                                        title="Consultar"><i class="fa fa-search btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('fases-editar')
                                                    <a href="{{ URL::to('fases/'.$valor->idfase.'/editar') }}"
                                                        title="Editar"><i class="fa fa-pencil btn-space"
                                                            style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('fases-eliminar')
                                                    <a onclick="eliminar({id:{{ $valor->idfase }},url:'{{ URL('fases') }}' })"
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
