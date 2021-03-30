@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Posts</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Posts</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                @can('categorias-crear')
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{URL::to('posts/crear')}}">
                    Crear Nuevo
                </a>
                @endcan
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Posts</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">Titulo</th>
                                            <th rowspan="1" colspan="1">Resumen Descripcion</th>
                                            <th rowspan="1" colspan="1">Imagen Full</th>
                                            <th rowspan="1" colspan="1">Imagen Small</th>
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
                                        @foreach($post as $valor)
                                        @if( $j == 1 )
                                        <tr role="row" class="odd">
                                            @else
                                        <tr role="row" class="odd">
                                            @endif
                                            <td tabindex="0" class="sorting_1">{{$valor->idpost}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->titulo}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->resumenDescripcion}}</td>
                                            <td class="text-center">
                                                @if ($valor->imagenFull == "" )
                                                    <img src="{{ URL::asset('assets/admin/images/faces/male/2.jpg') }}" style="width: 130px !important;" />
                                                @else
                                                    <img src="{{url('uploads/posts/'.$valor->idpost.'/'.$valor->imagenFull)}}" style="width: 130px !important;" />
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($valor->imagenSmall == "" )
                                                    <img src="{{ URL::asset('assets/admin/images/faces/male/2.jpg') }}" style="width: 130px !important;" />
                                                @else
                                                    <img src="{{url('uploads/posts/'.$valor->idpost.'/'.$valor->imagenSmall)}}" style="width: 130px !important;" />
                                                @endif
                                            </td>
                                            <td tabindex="0" class="sorting_1">{{$valor->estado}}</td>

                                            <td class="text-center">
                                                @can('posts-consultar')
                                                <a href="{{URL::to('posts/'.$valor->idpost.'')}}"><i
                                                        class="fa fa-search btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('posts-editar')
                                                <a href="{{URL::to('posts/'.$valor->idpost.'/editar')}}"><i
                                                        class="fa fa-pencil btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('posts-eliminar')
                                                <a onclick="eliminar({id:{{$valor->idpost}},url:'{{URL('posts')}}' })"><i
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