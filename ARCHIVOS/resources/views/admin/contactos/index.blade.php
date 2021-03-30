@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Contactos</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Contactos</li>
            </ol>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Contactos</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">Tipo contratista</th>
                                            <th rowspan="1" colspan="1">Nombres</th>
                                            <th rowspan="1" colspan="1">Correo</th>
                                            <th rowspan="1" colspan="1">Celular</th>
                                            <th rowspan="1" colspan="1">Proyecto</th>
                                            <th rowspan="1" colspan="1">Cliente</th>
                                            <th rowspan="1" colspan="1">Disciplina</th>
                                            <th rowspan="1" colspan="1">Fase</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        $j = $i%2;
                                        @endphp
                                        <!-- incluimos el ciclo con la sintaxis de blade -->
                                        @foreach($contactos as $valor)
                                        @if( $j == 1 )
                                        <tr role="row" class="odd">
                                            @else
                                        <tr role="row" class="odd">
                                            @endif
                                            <td tabindex="0" class="sorting_1">{{$valor->tipo_contratista}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->nombres}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->correo}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->celular}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->proyectos->nombre}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->clientes->nombre_razon_social}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->disciplinas->nombre}}</td>
                                            <td tabindex="0" class="sorting_1">{{$valor->fases->nombre}}</td>

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