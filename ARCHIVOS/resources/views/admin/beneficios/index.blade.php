@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Beneficios</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Beneficios</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                @can('beneficios-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{URL::to('beneficios/crear')}}">
                    Crear Nuevo
                </a>
                @endcan
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Beneficios</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">Titulo</th>
                                            <th rowspan="1" colspan="1">Categoria</th>
                                            <th rowspan="1" colspan="1">Estado</th>
                                            <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        $j = $i%2;
                                        @endphp
                                        <!-- incluimos el ciclo con la sintaxis de blade -->
                                        @foreach($beneficio as $valor)
                                        @if( $j == 1 )
                                        <tr role="row" class="odd">
                                            @else
                                        <tr role="row" class="odd">
                                            @endif
                                            <td tabindex="0" class="sorting_1">{{$valor->idbeneficio}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->titulo}}</td>
                                            <td class="text-center">
                                                @foreach ($valor->categorias as $item)
                                                    {{$item->nombre}}
                                                @endforeach
                                            </td>
                                            <td tabindex="0" class="sorting_1">{{$valor->estado}}</td>

                                            <td class="text-center">
                                                @can('beneficios-consultar')
                                                <a href="{{URL::to('beneficios/'.$valor->idbeneficio.'')}}"><i
                                                        class="fa fa-search btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('beneficios-editar')
                                                <a href="{{URL::to('beneficios/'.$valor->idbeneficio.'/editar')}}"><i
                                                        class="fa fa-pencil btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('beneficios-eliminar')
                                                <a onclick="eliminar({id:{{$valor->idbeneficio}},url:'{{URL('beneficios')}}' })"><i
                                                        class="mdi mdi-close-circle btn-space"  style="font-size: 20px;"></i></a>
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