@extends('front.layouts.proyecto')
@section('content')
<div class="container">
    <img src="{{URL::to('assets/front/images/imagenes/mis-proyectos/b-tus-proyectos.png')}}" alt="Contratistas">
    <div class="row general-view profesionales-info">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="tab_wrapper first_tab">
                    <ul class="tab_list tab-proceso-proyecto">
                        <li>En proceso</li>
                        <li>Finalizado</li>
                    </ul>
                    @php
                        $cuenta = [];
                        $cuenta = [0,10,20,30,40,50,60,70,80,90,100];
                        $user = auth()->user();
                    @endphp
                    <div class="content_wrapper">
                        <div class="tab_content">
                            <div class="table-responsive">
                                <div class="card" style="background-color: #ffffff;">
                                    <div class="card-body">
                                        <table id="misproyectos" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Código</th>
                                                    <th rowspan="1" colspan="1">Proyecto</th>
                                                    <th rowspan="1" colspan="1">Propietario</th>
                                                    <th rowspan="1" colspan="1">Ciudad</th>
                                                    <th rowspan="1" colspan="1">Dirección</th>
                                                    <th rowspan="1" colspan="1">Tipo</th>
                                                    <th rowspan="1" colspan="1">Inicio</th>
                                                    <th rowspan="1" colspan="1">Proceso</th>
                                                    <th rowspan="1" colspan="1">Ver Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($proyectos as $proyecto)
                                                    @if($proyecto->estado == 'en_proceso' && $proyecto->nombre !== NULL)

                                                        <tr>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->idproyecto}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->nombre}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->propietario}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->ciudad}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->direccion}}</td>

                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->tipos->nombre}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{date("d-m-Y",strtotime($proyecto->created_at))}}</td>
                                                            <td>
                                                                <input type="hidden" id="cliente_{{$proyecto->idproyecto}}" value="{{$proyecto->idcliente}}">
                                                                <select name="proceso" id="proceso_{{$proyecto->idproyecto}}" onclick="inputs({{$proyecto->idproyecto}})" class="form-control" @if(!$user->hasRole('Cliente')) disabled @endif  >
                                                                    @foreach ($cuenta as $numeros)
                                                                        <option value="{{$numeros}}" @if($numeros == $proyecto->proceso) selected @endif>{{$numeros}} %</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td tabindex="0"  class="sorting_1 width"><a class="btn btn-primary" href="{{URL::to('clientes/'.$relacion.'/'.$user->iduserrelacion.'/mis-proyectos/'.$proyecto->idproyecto)}}">Ver</a></td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab_content">
                            <div class="table-responsive">
                                <div class="card" style="background-color: #ffffff;">
                                    <div class="card-body">
                                        <table id="finalizados" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Código</th>
                                                    <th rowspan="1" colspan="1">Proyecto</th>
                                                    <th rowspan="1" colspan="1">Propietario</th>
                                                    <th rowspan="1" colspan="1">Ciudad</th>
                                                    <th rowspan="1" colspan="1">Dirección</th>
                                                    <th rowspan="1" colspan="1">Tipo</th>
                                                    <th rowspan="1" colspan="1">Inicio</th>
                                                    <th rowspan="1" colspan="1">Ver Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($proyectos as $proyecto)
                                                    @if($proyecto->estado == 'finalizado' && $proyecto->nombre !== NULL)
                                                        <tr>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->idproyecto}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->nombre}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->propietario}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->ciudad}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->direccion}}</td>

                                                            <td tabindex="0"  class="sorting_1 width">{{$proyecto->tipos->nombre}}</td>
                                                            <td tabindex="0"  class="sorting_1 width">{{date("d-m-Y",strtotime($proyecto->created_at))}}</td>
                                                            <td tabindex="0"  class="sorting_1 width"><a class="btn btn-primary" href="{{URL::to('clientes/'.$proyecto->idcliente.'/mis-proyectos/'.$proyecto->idproyecto)}}">Ver</a></td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
    $(function(e) {
        $(".first_tab").champ();
        $(".accordion_example").champ({
            plugin_type: "accordion",
            side: "left",
            active_tab: "3",
            controllers: "true"
        });

        $(".second_tab").champ({
            plugin_type: "tab",
            side: "right",
            active_tab: "1",
            controllers: "false"
        });

    });
    function inputs(proyecto){
        var proyectos = proyecto;
        document.getElementById("proceso_"+proyecto).onchange = function(e){
            var idp = document.getElementById('proceso_'+proyecto).value;
            var idc = document.getElementById('cliente_'+proyecto).value;

            window.location.href =  "{{url('clientes/proyecto-actualizar-estado')}}/" + idp +"/"+ idc+"/"+proyectos;
        };
    }


        $('#misproyectos').DataTable( {
            bProcessing: true,
            "dom": 'T<"clear">lfrtip',
            "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
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

        $('#finalizados').DataTable( {
            bProcessing: true,
            "dom": 'T<"clear">lfrtip',
            "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
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





</script>
@stop