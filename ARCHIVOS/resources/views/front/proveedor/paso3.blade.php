@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'proveedores.paso3' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<div class="container">
    @if($rutaNombre == 'proveedores.paso3')

        <div class="row mb-6">
            <img src="{{URL::to('assets/front/images/imagenes/proveedores/banner-tipo-cliente-5.jpg')}}" alt="Proveedores">
        </div>
        {{--<div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3"></div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">
                    <div class="col-auto align-self-center ">
                        <div class="circleBase finished"><p class="center"><a>1</a></p></div>
                        <div class="menu-step">
                            <a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1')}}"style="color: white">General</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">
                    <div class="col-auto align-self-center ">
                        <div class="circleBase finished"><p class="center"><a>2</a></p></div>
                        <div class="menu-step">
                            <a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-2')}}"style="color: white">Gerencia</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">
                    <div class="col-auto align-self-center ">
                        <div class="circleBase actual"><p class="center">3</p></div>
                        <div class="menu-step">
                            <span class="status-active">Servicios</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">
                    <div class="col-auto align-self-center ">
                        <div class="circleBase"><p class="center">4</p></div>
                        <div class="menu-step">
                            Adjuntar
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-5"></div>
        </div>--}}
        <div class="row justify-content-center">
            <!--<div class="col-sm-12 col-md-6 col-lg-3"></div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">
                    <div class="col-auto align-self-center ">
                        <div class="circleBase actual"><p class="center">1</p></div>
                        <div class="menu-step">
                            <span class="status-active">General</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">
                    <div class="col-auto align-self-center ">
                        <div class="circleBase"><p class="center">2</p></div>
                        <div class="menu-step">
                            Gerencia
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">
                    <div class="col-auto align-self-center ">
                        <div class="circleBase"><p class="center">3</p></div>
                        <div class="menu-step">
                            Servicios
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">
                    <div class="col-auto align-self-center ">
                        <div class="circleBase"><p class="center">4</p></div>
                        <div class="menu-step">
                            Adjuntar
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-5"></div>-->
            <div class="pasosp" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            <a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1')}}" style="color: white">General</a>
                        </div>
                        <br>
                        <div class="circleBase finished"><p class="center"><a>1</a></p></div>
                    </div>
                </div>
            </div>
            <div class="pasosp" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-2')}}" style="color: white">Gerencia</a>
                            </div>
                            <br>
                            <div class="circleBase finished"><p class="center"><a>2</a></p></div>
                        </div>
                    </div>
            </div>
            <div class="pasosp" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                <span class="status-active">Servicios</span>
                            </div>
                            <br>
                            <div class="circleBase actual"><p class="center"><a>3</a></p></div>
                        </div>
                    </div>
            </div>
            <div class="pasosp" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                Adjuntar
                            </div>
                            <br>
                            <div class="circleBase"><p class="center"><a>4</a></p></div>
                        </div>
                    </div>
            </div>
    
        </div>
    @endif

    <!--<div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4"></div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        General
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B">
                        <div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1')}}"> 1 </a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Gerencia
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B">
                        <div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-2')}}"> 2 </a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Servicios
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value=1 data-thickness="6" data-color="#c21a1a">
                        <div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 3 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Adjuntar
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="0" data-thickness="6" data-color="#c21a1a">
                        <div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 4 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3"></div>
    </div>-->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            @if($rutaNombre == 'proveedores.paso3')
                {!!Form::model($proveedor,array('url'=>'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-3','method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($proveedor,array('url'=>'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-3?editar='.$idproveedor,'method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}

            @endif
                <input type="hidden" name="idproveedor" id="idproveedor" value="{{$idproveedor}}">
                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'proveedores.paso3' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            servicios
                        </div>
                    </div>
                </div>
                @php
                    $array = [];
                    $array[''] = 'Seleccione';
                    foreach ($especialidades as $especialidad) {
                        $array[$especialidad->idespecialidad*1] = $especialidad->nombre;
                    }
                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            @if($proveedor->especialidades->count() > 0)
                                <label class="form-label">Servicios Guardados</label>
                                <br>
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table card-table ">
                                            <thead>
                                                <tr>
                                                    <th>Funciones</th>
                                                    <th>Materiales - Servicios</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($proveedor->servicios as $servicios)
                                                    <tr>
                                                        <td>{{$servicios->especialidades->nombre}}</td>
                                                        <td>
                                                            {{$servicios->nombre}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>
                            @endif
                            <label class="form-label">Agregar Servicios</label>
                            <br>
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table card-table " >
                                        <thead>
                                            <tr>
                                                <th>Funciones</th>
                                                <th>Materiales - Servicios</th>
                                                <th>&nbsp;</th>																	
                                            </tr>
                                        </thead>
                                        <tbody id="crear">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="agregar" class="text-right"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{$rutaNombre == 'proveedores.paso3' ? '/clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-2' : '/clientes/perfil-proveedor/'.$proveedor->idproveedor}}" class="btn btn-link">Cancelar</a>
                        {!!Form::submit('Guardar',array('class'=>'btn btn-primary ml-auto'))!!}
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
@stop
@section('scriptsown')

<script language="javascript">
    function servicios(value){
        var especialidad = $('#idespecialidad_'+value).val();
        $.ajax({
            url:"/api/especialidad/"+especialidad,
            type:"GET",
            success:function(data){  //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                var codigo_select = '<option value="">Seleccione un servicio</option>'
                for (var i=0; i<data.length;i++)
                    codigo_select+='<option value="'+data[i].idservicio*1+'">'+data[i].nombre+'</option>';
    
                $("#idservicio_"+value).html(codigo_select);

            }    
        });
  
    }
    $(document).ready(function(){
        $("#idespecialidad").change(function(){
            var especialidad = $(this).val();
            $.ajax({
                url:"/api/especialidad/"+especialidad,
                type:"GET",
                success:function(data){  //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                    var codigo_select = '<option value="">Seleccione un servicio</option>'
                    for (var i=0; i<data.length;i++)
                        codigo_select+='<option value="'+data[i].idservicio*1+'">'+data[i].nombre+'</option>';
        
                    $("#idservicio").html(codigo_select);

                }    
            });
        });
    });

    $(document).ready(function(){

    var count = 1;
    dynamic_field(count);

        function dynamic_field(number)
        {
            html = '<tr>';

                html += `<td>
                            {!!Form::select('idespecialidad[]',$array,
                                    null,
                                    array('class'=>'form-control','id'=>'idespecialidad_${number}','onchange'=>'servicios(${number})')
                            )!!}
                            <span class="help-block has-error"> {{$errors->first('idespecialidad')}}</span>
                        </td>`;
                html += `<td>
                            <select class="form-control " data-placeholder="Seleccione" name="idservicio[]" id="idservicio_${number}" tabindex="-1" aria-hidden="true">
                                <option label="Seleccione" selected></option>
                            </select>
                            <span class="help-block has-error"> {{$errors->first('idservicio')}}</span>

                        </td>`;

                if(number > 1)
                {
                    html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">X</button></td></tr>';
                    $('#crear').append(html);
                }
                else
                {   
                    add = '<button type="button" name="add" id="add" class="btn btn-facebook btn-sm">+ Agregar</button>';
                    $('#crear').html(html);
                    $('#agregar').html(add);
                }
        }

        $(document).on('click', '#add', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
        });
    });


</script>
@stop