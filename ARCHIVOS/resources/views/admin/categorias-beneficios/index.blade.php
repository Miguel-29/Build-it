@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Categorias de Beneficios</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Categorias</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                @can('categorias-beneficios-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{URL::to('categorias-beneficios/crear')}}">
                    Crear Nueva
                </a>
                @endcan
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Categorias de Beneficios</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">Nombre</th>
                                            <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        $j = $i%2;
                                        @endphp
                                        <!-- incluimos el ciclo con la sintaxis de blade -->
                                        @foreach($categorias as $valor)
                                        @if( $j == 1 )
                                        <tr role="row" class="odd">
                                            @else
                                        <tr role="row" class="odd">
                                            @endif
                                            <td tabindex="0" class="sorting_1">{{$valor->idcategoria}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->nombre}}</td>
                                            <td class="text-center">
                                                @can('categorias-beneficios-consultar')
                                                <a href="{{URL::to('categorias-beneficios/'.$valor->idcategoria.'')}}"><i
                                                        class="fa fa-search btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('categorias-beneficios-editar')
                                                <a href="{{URL::to('categorias-beneficios/'.$valor->idcategoria.'/editar')}}"><i
                                                        class="fa fa-pencil btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('categorias-beneficios-eliminar')
                                                <a onclick="eliminar({id:{{$valor->idcategoria}},url:'{{URL('categorias-beneficios')}}' })"><i
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