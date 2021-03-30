@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'empresas.paso4' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<div class="container">
    @if($rutaNombre == 'empresas.paso4')

        <div class="row mb-6">
            <img src="{{URL::to('assets/front/images/imagenes/empresas/banner-crear-cuenta.jpg')}}" alt="Empresas">
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-1"></div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase finished"><p class="center"><a>1</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-1')}}" style="color: white">General</a>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase finished" ><p class="center"><a>2</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-2')}}" style="color: white">Especialidad</a>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase finished" ><p class="center"><a>3</a></p></div>
                        <div class="menu-step">
                            <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-3')}}" style="color: white">Gerencial</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase actual" ><p class="center">4</p></div>
                            <div class="menu-step">
                                Específico
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase" ><p class="center">5</p></div>
                            <div class="menu-step">
                                Experiencia
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase" ><p class="center">6</p></div>
                            <div class="menu-step">
                                Modelación
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">7</p></div>
                        <div class="menu-step">
                            Revisión
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">8</p></div>
                        <div class="menu-step">
                            Supervisión
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">9</p></div>
                        <div class="menu-step">
                            Adjuntar
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1"></div>
        </div>
    @endif
    <!--<div class="row">
        <div class="col-sm-12 col-md-6 col-lg-1"></div>
        <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="menu-step">
                            General
                        </div>
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-1')}}"> 1 </a></div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="menu-step">
                            Profesional
                        </div>
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-2')}}"> 2 </a></div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">	
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Gerencial
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="menu-step">
                            Específico
                        </div>
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"> 4 </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="menu-step">
                            Experiencia
                        </div>
                        <div class="chart-circle chart-circle-sm" data-value="0" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"> 5 </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="menu-step">
                            Modelación
                        </div>
                        <div class="chart-circle chart-circle-sm" data-value="0" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"> 6 </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">	
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Revisión
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="0" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 7 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">	
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Supervisión
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="0" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 8 </div>
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
                    <div class="chart-circle chart-circle-sm" data-value="0" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 9 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1"></div>
    </div>-->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            {!!Form::model($empresa,array('url'=>'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-4','method'=>'post','class'=>'card'))!!}
                <input type="hidden" name="tipo_relacion" value="empresa">
                <input type="hidden" name="idrelacion" value="{{$empresa->idempresa}}">
                <input type="hidden" name="tipoFormacion" value="formal">
                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'empresas.paso4' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                </div>
                @php
                    $year = date("Y");
                    $array = ['' => 'Seleccione'];
                    for ($i= 1970; $i <= $year ; $i++) { //quitarle el +1 Aver ?

                        $array[$i] = $i;

                    }

                    $universidades = [
                        '' => 'Seleccione',
                        'Militar' => 'Militar',
                        'Gran Colombia' => 'Gran Colombia',
                        'Javeriana' => 'Javeriana',
                        'Los Andes' => 'Los Andes',
                        'Nacional' => 'Nacional',
                        'Santo tomas' => 'Santo tomas ',
                        'Escuela de ingenieros' => 'Escuela de ingenieros'
                    ]
                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Profesión</label>
                                <select class="form-control " data-placeholder="Seleccione" name="fp_profesion" id="fp_profesion" tabindex="-1" aria-hidden="true" disabled>
                                    <option value="{{$empresa->gerente_idprofesion}}" selected >{{$empresa->profesionesGerente->nombre}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Área</label>
                                <select class="form-control " data-placeholder="Seleccione" tabindex="-1" aria-hidden="true" disabled>
                                    <option value="{{$empresa->gerente_iddisciplina}}" selected >{{$empresa->disciplinasGerente->nombre}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                    @if($formacion->count() > 0)
                                    <label class="form-label"><b>Formación académica</b></label>
                                        <br>
                                        <div class="card">
                                            <div class="table-responsive">
                                                <table class="table card-table " style="width:700px;">
                                                    <thead>
                                                        <tr>
                                                            <th>Tipo</th>
                                                            <th>Título</th>
                                                            <th>Universidad</th>
                                                            <th>Año Culminacion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($formacion as $formaciones)
                                                            <tr>
                                                                <td>{{$formaciones->nivelFormacion}}</td>
                                                                <td>{{$formaciones->titulo}}</td>
                                                                <td>{{$formaciones->universidad}}</td>
                                                                <td>{{$formaciones->anio_culminacion}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    <label class="form-label"><b>Agregar Formación</b></label>
                                    <br>
                                    <div class="card">

                                        <div class="table-responsive">
                                            <table class="table card-table " style="width:700px;">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Título</th>
                                                        <th>Universidad</th>
                                                        <th>Año Culminacion</th>
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
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{$rutaNombre == 'empresas.paso4' ? 'javascript:void(0)' : '/clientes/perfil-empresa/'.$empresa->idempresa}}" class="btn btn-link">Cancelar</a>
                        <button type="submit" class="btn btn-primary ml-auto">Guardar</button>
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
$(document).ready(function(){

    var count = 1;
   
    dynamic_field(count);
   
        function dynamic_field(number)
        {
            html = '<tr>';
                html += '<td><select class="form-control " id="" name="nivelFormacion[]" data-placeholder="Seleccione" tabindex="-1" aria-hidden="true">'+
                                '<option label="Seleccione" selected disabled></option>'+
                                '<option value="pregrado">Pregrado</option>'+
                                '<option value="posgrado">Posgrado</option>'+
                            '</select>'+
                        '</td>';
                html += '<td><input type="text" name="titulo[]" class="form-control" placeholder="Titulo obtenido" /></td>';
                html += `<td>
                            {!!Form::select('universidad[]',$universidades,
                                    null,
                                    array('class'=>'form-control select2')
                            )!!}

                        </td>`;
                html += `<td>
                                    {!!Form::select('anio_culminacion[]',$array,
                                            null,
                                            array('class'=>'form-control select2')
                                    )!!}
                        </td>`;
                if(number > 1)
                {
                    html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">X</button></td></tr>';
                    $('#crear').append(html);
                }
                else
                {   
                    add = '<td><button type="button" name="add" id="add" class="btn btn-facebook btn-sm">+ Agregar</button></td></tr>';
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