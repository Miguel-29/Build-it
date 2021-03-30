@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Parámetros</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Parámetros</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                @can('parametros-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{URL::to('parametros/crear')}}">
                    Crear Nuevo
                </a>
                @endcan
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Parametros</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">Nombre</th>
                                            <th rowspan="1" colspan="1">Valor</th>
                                            <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        $j = $i%2;
                                        @endphp
                                        <!-- incluimos el ciclo con la sintaxis de blade -->
                                        @foreach($parametros as $valor)
                                        @if( $j == 1 )
                                        <tr role="row" class="odd">
                                            @else
                                        <tr role="row" class="odd">
                                            @endif
                                            <td tabindex="0" class="sorting_1">{{$valor->idparametro}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->nombre}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->valor}}</td>
                                            <td class="text-center">
                                                @can('parametros-consultar')
                                                <a href="{{URL::to('parametros/'.$valor->idparametro.'')}}"><i
                                                        class="fa fa-search btn-space" style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('parametros-editar')
                                                <a href="{{URL::to('parametros/'.$valor->idparametro.'/editar')}}"><i
                                                        class="fa fa-pencil btn-space" style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('parametros-eliminar')
                                                <a onclick="eliminar({id:{{$valor->idparametro}},url:'{{URL('parametros')}}' })"><i
                                                        class="mdi mdi-close-circle btn-space" style="font-size: 20px;"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop