@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Usuarios</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{URL::to('usuarios/crearusuario')}}">
                    Crear Nuevo
                </a>
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Usuarios</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">Nombre</th>
                                            <th rowspan="1" colspan="1">Apellidos</th>
                                            <th rowspan="1" colspan="1">Correo Electrónico</th>
                                            <th rowspan="1" colspan="1">Roles</th>
                                            <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        $j = $i%2;
                                        @endphp
                                        <!-- incluimos el ciclo con la sintaxis de blade -->
                                        @foreach($usuarios as $valor)
                                        @if( $j == 1 )
                                        <tr role="row" class="odd">
                                            @else
                                        <tr role="row" class="odd">
                                            @endif
                                            <td tabindex="0" class="sorting_1">{{$valor->name}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->lastname}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->email}}</td>
                                            <?php
                                          $rolesuser = $valor->getRoleNames();

                                          if ($rolesuser->count() > 0) {
                                              echo '<td>'.$rolesuser->implode(', ').'</td>';
                                          } else {
                                              echo '<td>No tiene Rol Asignado</td>';
                                          }
                                       ?>
                                            <td class="text-center">
                                                @can('usuarios-consultar')
                                                <a href="{{URL::to('usuarios/'.$valor->id.'')}}"><i
                                                        class="fa fa-search btn-space"  style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('usuarios-editar')
                                                <a href="{{URL::to('usuarios/'.$valor->id.'/editar')}}"><i
                                                        class="fa fa-pencil btn-space" style="font-size: 20px;"></i></a>
                                                @endcan
                                                @can('usuarios-eliminar')
                                                <a onclick="eliminar({id:{{$valor->id}},url:'{{URL('usuarios')}}' })"><i
                                                        class="mdi mdi-close-circle" style="font-size: 20px;"></i></a>
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