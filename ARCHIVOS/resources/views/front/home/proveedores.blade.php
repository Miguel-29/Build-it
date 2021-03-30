@extends('front.layouts.proyecto')
@section('content')
<div class="container">
    <img src="{{URL::to('assets/front/images/imagenes/proveedores/b-proveedores.jpg')}}" alt="Proveedores">
    <div class="row general-view proveedor-info">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"> Búsqueda Rápida </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table card-table" style="width:100%" >
                            <thead>
                                <tr>
                                    <th style="text-align: center; width: 30%; border-right: 2px solid #153556;">Función</th>
                                    <th style="text-align: center; width: 30%; border-right: 2px solid #153556;">Producto</th>
                                    <th style="text-align: center; width: 25%; border-right: 2px solid #153556;">Ciudad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td style=" border-right: 2px solid #153556;">
                                        <select id="choose-especialidad" class="form-control">
                                            <option value="" selected>Todas</option>
                                            @foreach ($especialidades as $especialidad)
                                                <option value="{{$especialidad->idespecialidad}}">{{$especialidad->nombre}}</option>
                                            @endforeach
                                        </select>
            
                                    </td>
                                    <td style=" border-right: 2px solid #153556;">
                                        <select id="choose-material" class="form-control">
                                            <option value=""  selected>Todas</option>
                                        </select>
            
                                    </td>
                                    <td style=" border-right: 2px solid #153556;">
                                        <select id="choose-ciudad" class="form-control">
                                            <option value="" selected>Todas</option>
                                        </select>
            
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!--<div class="col-sm-3 col-md-4">
                            <select id="choose-ciudad" class="form-control">
                                <option value="" selected>Todas las Ciudades</option>
                            </select>
                        </div>-->
                        <div class="col-sm-12 col-md-4">
                            <button type="button" id="filter-button" class="btn btn-primary">Filtrar</button>
                            <button type="button" id="remove-button" class="btn btn-primary">Reestablecer</button>

                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list">
                                <li>Proveedores</li>
                            </ul>
                            <div class="content_wrapper">
                                <div class="tab_content">
                                    <div class="table-responsive">
                                        <table id="proveedores" class="table table-striped table-bordered table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Usuario</th>
                                                    <th rowspan="1" colspan="1">Nombre</th>
                                                    <th rowspan="1" colspan="1">Función</th>
                                                    <th rowspan="1" colspan="1">Producto</th>
                                                    <th rowspan="1" colspan="1">Ciudad</th>
                                                    <th rowspan="1" colspan="1">Perfil</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
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
    $(document).ready(function() {
        datatableActualizar();	
        $('#remove-button').click( function() {
            $('#choose-especialidad').val('');
            $('#choose-material').val('');
            $('#choose-ciudad').val('');
            datatableActualizar();
        });
        $('#filter-button').click(datatableActualizar);
    });
    var __PROVEEDORES = undefined;
    $("#choose-especialidad").change(function(){
        var especialidad = $(this).val();
        $.ajax({
            url:"/api/especialidad/"+especialidad,
            type:"GET",
            success:function(data){  //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                var codigo_select = '<option value="">Todos</option>'
                for (var i=0; i<data.length;i++)
                    codigo_select+='<option value="'+data[i].idservicio*1+'">'+data[i].nombre+'</option>';
    
                $("#choose-material").html(codigo_select);

            }    
        });
    });

    var __COLUMNPR = [
        // valor
        {
            "data":"estado"
        },
        // Documento
        { 
            "data":"nombre"
            
        },
        // Nombres
        {
            "data": "idespecialidad"
        },
        {
            "data": "idservicio"
        },
        // Nivel 
        {
            "data": "ciudad_residencia"
        },
        {
            "data": "image",
            fnCreatedCell: function (td, sData, oData, iRow, iCol) {
                let url = '';
                if(oData.image !== null){
                    url = `/uploads/front/proveedor/general/${oData.idproveedor}/${oData.image}`;
                }else{
                    url = `/assets/front/images/user-3.png`;
                }
                let html = `<center><a href="/clientes/perfil-proveedor/${oData.idproveedor}" target="_blank" title="Ver Perfil"><span class="avatar avatar-md brround" style="background-image: url(${url})"></span></a>`;

                $(td).html(html);
            }

        },

    ];

    function datatableActualizar() {

        var datos = {
            "_token": "{{ csrf_token() }}",
            "especialidad": $('#choose-especialidad').val(),
            "material": $('#choose-material').val(),
            "ciudad": $('#choose-ciudad').val(),
        };

        if(__PROVEEDORES !== undefined) 
            __PROVEEDORES.destroy();

        __PROVEEDORES = $('#proveedores').DataTable( {
            "ajax": {
                url: "{{ route('get-proveedor-filter') }}",
                method: "GET",
                data: datos,
                xhrFields: {
                    withCredentials: true
                }
            },
            "deferRender": true,
            "columns": __COLUMNPR,
            
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

    function loadJSON(callback) {
        var xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
        xobj.open('GET', "{{ URL::asset('assets/front/js/colombia.json') }}",
        true); // Reemplaza colombia-json.json con el nombre que le hayas puesto
        xobj.onreadystatechange = function () {
            if (xobj.readyState == 4 && xobj.status == "200") {
                callback(xobj.responseText);
            }
        };
        xobj.send(null);
    }

    $(document).ready(function () {

        // Código para cargar departamentos
        loadJSON(function (response) {
            // Parse JSON string into object
            var JSONFinal = JSON.parse(response);
            $.each(JSONFinal, function (i, item) {
                var lista = document.getElementById("choose-ciudad");
                lista.options.add(new Option(item.departamento, item.departamento));
            });
        });

    });

</script>
@stop