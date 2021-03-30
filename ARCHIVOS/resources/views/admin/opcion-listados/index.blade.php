@extends('admin.layouts.default')
@section('content')
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Opcion Listados</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Opcion Listados</li>
        </ol>
    </div>
    @php 
        $rutaNombre = \Request::route()->getName();
    @endphp
    <div class="card-body">
        @if($rutaNombre == "opcionlistados-index")
            <p class="category">
                @can('opcionlistados-crear')
                    <a class="btn btn-success btn-fill btn-wd btn-move-right"
                        href="{{ URL::to('opcionlistados/crear') }}">
                        Crear Nuevo
                    </a>
                @endcan
            </p>
        @else
            <p class="category">
                <a class="btn btn-success btn-fill btn-wd btn-move-right"
                    href="{{ URL::to('listados/'.$listado->idlistado.'/opcionlistados/crear') }}">
                    Crear Nuevo
                </a>
                <a class="btn btn-blue btn-fill btn-wd btn-move-right"
                    href="{{ URL::to('listados/') }}">
                    Volver
                </a>
            </p>
        @endif
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <input type="hidden" name="valor" id="valor" value="@if(isset($listado)){{$listado->idlistado}}@endif" >

                <div class="card">
                    <div class="card-header bg-blue br-tr-7 br-tl-7">
                        <div class="card-title text-white">Opcion Listados</div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="opcion" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">Listado</th>
                                        <th rowspan="1" colspan="1">Nombre</th>
                                        <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Variables AJAX -->
                                   
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

@section('scriptsown')
    <script language="javascript">
        var valor = $('#valor').val();
        console.log(valor);
        var datatable = undefined;
        var columnas =[
            {
                "data": "idopcion"
            },
            {
                "data":"nombrelistado"
            },
            {
                "data":"nombre"
            },
            {
                "data":"idopcion",
                fnCreatedCell: function (td, sData, oData, iRow, iCol) {
                    if(valor == ''){
                        let id = oData.idopcion;
                        let blankUrl = `/opcionlistados/${id}/`;
                        let helperUrl = `${blankUrl}editar`;
                        let html = `<center><a href="${blankUrl}" title="Consultar"><i class="fa fa-search btn-space"
                        style="font-size: 20px;"></i></a>`;
                        html += `<a href="${helperUrl}" title="Editar"><i class="fa fa-pencil btn-space"
                            style="font-size: 20px;"></i></a>`;
                        html += `<a onclick="eliminar({id:${id},url:'/opcionlistados' })"
                                title="Eliminar"><i class="mdi mdi-close-circle btn-space" style="font-size: 20px;"></i></a></center>`; 
                        $(td).html(html);
                    }else{
                        let id = oData.idopcion;
                        let blankUrl = `/opcionlistados/${id}/`;
                        let helperUrl = `${blankUrl}editar`;
                        let html = `<center><a href="${blankUrl}" title="Consultar"><i class="fa fa-search btn-space"
                        style="font-size: 20px;"></i></a>`;
                        html += `<a href="/listados/${valor*1}${helperUrl}" title="Editar"><i class="fa fa-pencil btn-space"
                            style="font-size: 20px;"></i></a>`;
                        html += `<a onclick="eliminar({id:${id},url:'/opcionlistados' })"
                                title="Eliminar"><i class="mdi mdi-close-circle btn-space" style="font-size: 20px;"></i></a></center>`; 
                        $(td).html(html);
                    }
                    
                }
            }
            
        ];
        if(valor == ""){
            datatable = $('#opcion').DataTable( {
                "ajax": "{{ route('api-opcionlistados-index') }}",
                "deferRender": true,
                "columns": columnas,

                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });

        }else{
            datatable = $('#opcion').DataTable( {
                "ajax": "/api-opc/"+valor,
                "deferRender": true,
                "columns": columnas,

                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        }

    </script>
@stop