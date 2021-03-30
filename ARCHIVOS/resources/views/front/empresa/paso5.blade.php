@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'empresas.paso5' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<style>
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
<div class="container">
    @if($rutaNombre == 'empresas.paso5')

        <div class="row mb-6">
            <img src="{{URL::to('assets/front/images/imagenes/empresas/banner-crear-cuenta.jpg')}}" alt="Empresas">
        </div>
        {{--<div class="row">
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
            <!--<div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase finished" ><p class="center"><a>4</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-4')}}" style="color: white">Específico</a>
                            </div>

                        </div>
                    </div>
            </div>-->
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase actual" ><p class="center">4</p></div>
                            <div class="menu-step">
                                <span class="status-active">Experiencia</span>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase" ><p class="center">5</p></div>
                            <div class="menu-step">
                                Modelación
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">6</p></div>
                        <div class="menu-step">
                            Revisión
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">7</p></div>
                        <div class="menu-step">
                            Supervisión
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">8</p></div>
                        <div class="menu-step">
                            Adjuntar
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2"></div>
        </div>--}}
        <div class="row">
            <!--<div class="col-sm-12 col-md-6 col-lg-1"></div>-->
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-1')}}" style="color: white">General</a>
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
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-2')}}" style="color: white">Especialidad</a>
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
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-3')}}" style="color: white">Gerencial</a>
                            </div>
                            <br>
                            <div class="circleBase finished"><p class="center"><a>3</a></p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                <span class="status-active">Experiencia</span>
                            </div>
                            <br>
                            <div class="circleBase actual"><p class="center"><a>4</a></p></div>
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
    
                            <div class="circleBase"><p class="center"><a>5</a></p></div>
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
                        <div class="circleBase"><p class="center"><a>6</a></p></div>
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
                        <div class="circleBase"><p class="center"><a>7</a></p></div>
    
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
                        <div class="circleBase"><p class="center"><a>8</a></p></div>
    
                    </div>
                </div>
            </div>
            <!--<div class="col-sm-12 col-md-6 col-lg-2"></div>-->
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
                        <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-3')}}"> 3 </a></div>
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
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-4')}}"> 4 </a></div>
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
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
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
            @if($rutaNombre == 'empresas.paso5')
                {!!Form::model($empresa,array('url'=>'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-5','method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($empresa,array('url'=>'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-5?editar='.$idempresa,'method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}

            @endif    
                <input type="hidden" name="tipo_relacion" value="empresa">
                <input type="hidden" name="idrelacion" value="{{$empresa->idempresa}}">
                <input type="hidden" name="iddisciplina" value="{{$iddisciplina}}">

                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'empresas.paso5' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            Experiencia laboral
                        </div>
                    </div>

                </div>
                @php
                    $arrayNivel = [];

                    $arrayNivel[''] = 'Seleccione';
                    foreach ($nivelIdioma as $key ) {
                        $arrayNivel[$key->nombre] = $key->nombre;
                    }

                    $arrayIdioma = [];

                    $arrayIdioma[''] = 'Seleccione';
                    foreach ($nombreIdioma as $key ) {
                        $arrayIdioma[$key->nombre] = $key->nombre;
                    }
                    $array = [];
                    foreach ($subUso as $key ) {
                        $array[$key->nombre] = $key->nombre;
                    }

                    if($experiencia !== NULL && $experiencia->tipo_estructuras_disenadas !== NULL){
                        $tipo_estructuras_disenadas = explode(',', $experiencia->tipo_estructuras_disenadas);
                    }else{
                        $tipo_estructuras_disenadas = NULL;
                    }

                    $arrayActividad = [];
                    foreach ($actividad as $key ) {
                        $arrayActividad[$key->nombre] = $key->nombre;
                    }

                    if($experiencia !== NULL && $experiencia->actividades_desempena !== NULL){
                        $actividades_desempena = explode(',', $experiencia->actividades_desempena);
                    }else{
                        $actividades_desempena = NULL;
                    }

                    $arraySoftware = [];
                    foreach ($software as $key ) {
                        $arraySoftware[$key->nombre] = $key->nombre;
                    }

                    if($experiencia !== NULL && $experiencia->uso_software !== NULL){
                        $uso_software = explode(',', $experiencia->uso_software);
                    }else{
                        $uso_software = NULL;
                    }
                    if($experiencia !== NULL){
                        $anios_experiencia = $experiencia->anios_experiencia;
                        $m2_disenados = $experiencia->m2_disenados;
                        $disponibilidad_personal = $experiencia->disponibilidad_personal;
                        $certificados_cursos = $experiencia->certificados_cursos_seminarios;
                        $disponibilidad_viajar = $experiencia->disponibilidad_viajar;
                        $tipo_contratacion = $experiencia->tipo_contratacion;
                    }else{
                        $anios_experiencia = NULL;
                        $m2_disenados = NULL;
                        $disponibilidad_personal = NULL;
                        $certificados_cursos = NULL;
                        $disponibilidad_viajar = NULL;
                        $tipo_contratacion = NULL;

                    }
                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Años de Experiencia *</label>
                                {!!Form::text('anios_experiencia',$anios_experiencia,array('placeholder'=>'Años de Experiencia','class'=>'form-control'))!!}
                                <span class="help-block has-error"> {{$errors->first('anios_experiencia')}}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">M2 Diseñados *</label>
                                {!!Form::text('m2_disenados',$m2_disenados,array('placeholder'=>'M2 diseñados','class'=>'form-control'))!!}
                                <span class="help-block has-error"> {{$errors->first('m2_disenados')}}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tipos de estructuras diseñadas *</label>
                                {!!Form::select('tipo_estructuras_disenadas[]',$array,
                                        $tipo_estructuras_disenadas,
                                        array('class'=>'form-control select2','id' => 'tipo_estructuras_disenadas','multiple'=>'true')
                                )!!}
                                <span class="help-block has-error"> {{$errors->first('tipo_estructuras_disenadas')}}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Actividades que desempeña *</label>
                                {!!Form::select('actividades_desempena[]',$arrayActividad,
                                        $actividades_desempena,
                                        array('class'=>'form-control select2','id' => 'actividades_desempena','multiple'=>'true')
                                )!!}
                                <span class="help-block has-error"> {{$errors->first('actividades_desempena')}}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Uso de Software *</label>
                                {!!Form::select('uso_software[]',$arraySoftware,
                                        $uso_software,
                                        array('class'=>'form-control select2','id' => 'uso_software','multiple'=>'true')
                                )!!}
                                <span class="help-block has-error"> {{$errors->first('uso_software')}}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Disponibilidad de Personal *</label>
                                {!!Form::select('disponibilidad_personal', [
                                    '' => 'Selecciona una opción',
                                    'Hasta 10 empleados.'=>'Hasta 10 empleados.',
                                    'De 11 a 20 empleados.'=>'De 11 a 20 empleados.',
                                    'De 21 empleados en adelante.'=>'De 21 empleados en adelante.'],
                                    $disponibilidad_personal,
                                    array('class'=>'form-control','id' => 'disponibilidad_personal')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('disponibilidad_personal')}}</span>
                            </div>
                            <!--<div class="form-group">
                                <label class="form-label">Certificados de cursos/seminarios</label>
                                {!!Form::select('certificados_cursos_seminarios', [
                                    '' => 'Selecciona una opción',
                                    'De 1 a 3 certificados'=>'De 1 a 3 certificados',
                                    'De 4 a 8 certificados'=>'De 4 a 8 certificados',
                                    'De 9 certificados en adelante'=>'De 9 certificados en adelante'],
                                    $certificados_cursos,
                                    array('class'=>'form-control','id' => 'certificados_cursos_seminarios')
                                    )!!}
                                <span class="help-block has-error"> {{$errors->first('certificados_cursos_seminarios')}}</span>
                            </div>-->
                            <div class="form-group">
                                <label class="form-label">Disponibilidad de Viajar *</label>
                                {!!Form::select('disponibilidad_viajar', [
                                    '' => 'Selecciona una opción',
                                    'si'=>'Si',
                                    'si_condiciones'=>'Si, con condiciones',
                                    'no'=>'No'],
                                    $disponibilidad_viajar,
                                    array('class'=>'form-control','id' => 'disponibilidad_viajar')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('disponibilidad_viajar')}}</span>
                            </div>
                            <div class="form-group">

                                @if($idioma->count() > 0)
                                <label class="form-label"><b>Idiomas Guardados</b></label>
                                <br>
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table card-table ">
                                                <thead>
                                                    <tr>
                                                        <th>Idioma</th>
                                                        <th>Nivel</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($idioma as $idiomas)
                                                        <tr>
                                                            <td>{{$idiomas->nombreIdioma}}</td>
                                                            <td>{{$idiomas->nivelIdioma}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                <label class="form-label"><b>Idiomas</b></label>
                                <br>
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table card-table " >
                                            <thead>
                                                <tr>
                                                    <th>Idioma</th>
                                                    <th>Nivel</th>
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
                            <div class="form-group">
                                <label class="form-label">Tipo de Contratacion *</label>
                                {!!Form::select('tipo_contratacion', [
                                    '' => 'Selecciona una opción',
                                    'Por hora'=>'Por hora',
                                    'Por actividad'=>'Por actividad',
                                    'Por proyecto'=>'Por proyecto',],
                                    $tipo_contratacion,
                                    array('class'=>'form-control','id' => 'tipo_contratacion')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('tipo_contratacion')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{$rutaNombre == 'empresas.paso5' ? '/clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-3' : '/clientes/perfil-empresa/'.$empresa->idempresa}}" class="btn btn-link">Cancelar</a>
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
$(document).ready(function(){

    var count = 1;
   
    dynamic_field(count);
   
        function dynamic_field(number)
        {
            html = '<tr>';

                html += `<td>
                            {!!Form::select('nombreIdioma[]',$arrayIdioma,
                                    null,
                                    array('class'=>'form-control select2')
                            )!!}
                        </td>`;
                html += `<td>
                            {!!Form::select('nivelIdioma[]',$arrayNivel,
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