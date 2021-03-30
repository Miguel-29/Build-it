@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'freelancer.paso3' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<style>
    .select2-container .select2-selection--single{
        width: 100% !important
    }
</style>
<div class="container">
    @if($rutaNombre == 'freelancer.paso3')
        <div class="row mb-6">
            <img src="{{URL::to('assets/front/images/imagenes/freelancer/banner-tipo-cliente.jpg')}}" alt="Freelancer">
        </div>
        <!--<div class="row">
            <div class="col-sm-12 col-md-6 col-lg-1"></div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase finished"><p class="center"><a>1</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-1')}}" style="color: white">General</a>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase finished"><p class="center"><a>2</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-2')}}" style="color: white">Profesional</a>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase actual"><p class="center">3</p></div>
                            <div class="menu-step">
                                <span class="status-active">Específico</span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase"><p class="center">4</p></div>
                            <div class="menu-step">
                                Experiencia
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase"><p class="center">5</p></div>
                            <div class="menu-step">
                                Modelación
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase"><p class="center">6</p></div>
                        <div class="menu-step">
                            Revisión
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase"><p class="center">7</p></div>
                        <div class="menu-step">
                            Supervisión
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase"><p class="center">8</p></div>
                        <div class="menu-step">
                            Adjuntar
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2"></div>
        </div>-->
        <div class="row">
            <!--<div class="col-sm-12 col-md-6 col-lg-1"></div>-->
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-1')}}" style="color: white">General</a>
                            </div>
                            <br>
                            <div class="circleBase finished"><p class="center"><a>1</a></p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-2')}}" style="color: white">Profesional</a>
                            </div>
                            <br>
                            <div class="circleBase finished"><p class="center"><a>2</a></p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                <span class="status-active">Específico</span>
                            </div>
                            <br>
                            <div class="circleBase actual"><p class="center">3</p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                Experiencia
                            </div>
                            <br>
                            <div class="circleBase"><p class="center">4</p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                Modelación
                            </div>
                            <br>
    
                            <div class="circleBase"><p class="center">5</p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            Revisión
                        </div>
                        <br>
                        <div class="circleBase"><p class="center">6</p></div>
                    </div>
                </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            Supervisión
                        </div>
                        <br>
                        <div class="circleBase"><p class="center">7</p></div>
    
                    </div>
                </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            Adjuntar
                        </div>
                        <br>
                        <div class="circleBase"><p class="center">8</p></div>
    
                    </div>
                </div>
            </div>
            <!--<div class="col-sm-12 col-md-6 col-lg-2"></div>-->
        </div>
    @endif
    <!--<div class="row">
        <div class="col-sm-12 col-md-6 col-lg-2"></div>
        <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="menu-step">
                            General
                        </div>
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-1')}}"> 1 </a></div>
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
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-2')}}"> 2 </a></div>
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
                            <div class="chart-circle-value"> 3 </div>
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
                            <div class="chart-circle-value"> 4 </div>
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
                            <div class="chart-circle-value"> 5 </div>
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
                        <div class="chart-circle-value"> 6 </div>
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
                        <div class="chart-circle-value"> 7 </div>
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
                        <div class="chart-circle-value"> 8 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2"></div>
    </div>-->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            @if($rutaNombre == 'freelancer.paso3')
                {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3','method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3?editar='.$idfreelancer,'method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @endif    

                <input type="hidden" name="tipo_relacion" value="freelancer">
                <input type="hidden" name="idrelacion" value="{{$freelancer->idfreelancer}}">
                <input type="hidden" name="tipoFormacion" value="formal">
                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'freelancer.paso3' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            formulario específico en área
                        </div>
                    </div>

                </div>
                @php
                    $year = date("Y");
                    $array = ['' => 'Seleccione'];
                    for ($i= 1970; $i <= $year ; $i++) { //quitarle el +1 Aver ?

                        $array[$i] = $i;

                    }

                    $universidades[''] = 'Seleccione';
                    foreach ($universidad as $arrayuniversidades ) {
                        $universidades[$arrayuniversidades->nombre] = $arrayuniversidades->nombre;

                    }
                    $profesiones = $freelancer->profesiones->last();
                    $disciplinas = $freelancer->disciplinas->last();

                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            @if($rutaNombre == 'freelancer.paso3')
                                <div class="form-group">
                                    <label class="form-label">Profesión</label>
                                    <select class="form-control " data-placeholder="Seleccione" name="fp_profesion" id="fp_profesion" tabindex="-1" aria-hidden="true" disabled>
                                        <option value="{{$profesiones->id}}" selected >{{$profesiones->nombre}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Área</label>
                                    <select class="form-control " data-placeholder="Seleccione" tabindex="-1" aria-hidden="true" disabled>
                                        <option value="{{$disciplinas->iddisciplina}}" selected >{{$disciplinas->nombre}}</option>
                                    </select>
                                </div>
                            @endif
                            <div class="form-group">
                                @if($formacion->count() > 0)
                                    <label class="form-label"><b>Formación académica guardada</b></label><br>
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table card-table " style="width:1100px;">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Título</th>
                                                        <th>Universidad</th>
                                                        <th>Año C.</th>
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
                                <br>
                                <label class="form-label"><b>Agregar Formación</b></label>
                                <br>
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table card-table " style="width:1100px;">
                                            <thead>
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>Título</th>
                                                    <th>Universidad</th>
                                                    <th>Año C.</th>
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
                        <a href="{{$rutaNombre == 'freelancer.paso3' ? '/clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-2' : '/clientes/perfil-freelancer/'.$freelancer->idfreelancer}}" class="btn btn-link">Cancelar</a>
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
   
        $('.select2').select2();
        function dynamic_field(number)
        {
            $('.select2').select2({
                width: '100%'
            });

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