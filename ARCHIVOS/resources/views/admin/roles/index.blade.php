@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Roles</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                @can('roles-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{URL::to('roles/crear')}}">
                    Crear Nuevo
                </a>
                @endcan
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Roles</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">Nombre</th>
                                            <th class="text-center" rowspan="1" colspan="1">Permisos</th>
                                            <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        $j = $i%2;
                                        @endphp
                                        <!-- incluimos el ciclo con la sintaxis de blade -->
                                        @foreach($roles as $valor)
                                        @if( $j == 1 )
                                        <tr role="row" class="odd">
                                            @else
                                        <tr role="row" class="odd">
                                            @endif
                                            <td tabindex="0" class="sorting_1">{{$valor->id}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->name}}</td>
                                            <td class="text-center">
                                                @can('rolespermisos-index')
                                                <a href="{{URL::to('roles/'.$valor->id.'/permisos')}}"><i
                                                        class="fa fa-key"  style="font-size: 20px;"></i></a>
                                                @endcan
                                            </td>
                                            <td class="text-center">
                                                @can('roles-consultar')
                                                <a href="{{URL::to('roles/'.$valor->id.'')}}"><i
                                                        class="fa fa-search btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('roles-editar')
                                                <a href="{{URL::to('roles/'.$valor->id.'/editar')}}"><i
                                                        class="fa fa-pencil btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('roles-eliminar')
                                                <a onclick="eliminar({id:{{$valor->id}},url:'{{URL('roles')}}' })"><i
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