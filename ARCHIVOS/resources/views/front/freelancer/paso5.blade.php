@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'freelancer.paso5' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<div class="container">
    @if($rutaNombre == 'freelancer.paso5')
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
                            <div class="circleBase finished"><p class="center"><a>3</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3')}}" style="color: white">Específico</a>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase finished"><p class="center"><a>4</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-4')}}" style="color: white">Experiencia</a>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase actual"><p class="center">5</p></div>
                            <div class="menu-step">
                                <span class="status-active">Modelación</span>
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
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3')}}" style="color: white">Específico</a>
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
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-4')}}" style="color: white">Experiencia</a>
                            </div>
                            <br>
                            <div class="circleBase finished"><p class="center"><a>4</a></p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                <span class="status-active">Modelación</span>
                            </div>
                            <br>
    
                            <div class="circleBase actual"><p class="center">5</p></div>
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
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3')}}"> 3 </a></div>
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
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-4')}}"> 4 </a></div>
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
            @if($rutaNombre == 'freelancer.paso5')
                {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5','method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5?editar='.$idfreelancer,'method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @endif    
    
                <input type="hidden" name="tipo_relacion" value="freelancer">
                <input type="hidden" name="idrelacion" value="{{$freelancer->idfreelancer}}">
                <input type="hidden" name="iddisciplina" value="{{$iddisciplina}}">
                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'freelancer.paso5' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            Modelación BIM
                        </div>
                    </div>

                </div>
                @php
                    $array = [];
                    foreach ($subUso as $key ) {
                        $array[$key->nombre] = $key->nombre;
                    }

                    if($modelacion !== NULL && $modelacion->tipo_estructuras_disenadas !== NULL){
                        $tipo_estructuras_disenadas = explode(',', $modelacion->tipo_estructuras_disenadas);
                    }else{
                        $tipo_estructuras_disenadas = NULL;
                    }

                    $arraySoftware = [];
                    foreach ($software as $key ) {
                        $arraySoftware[$key->nombre] = $key->nombre;
                    }

                    if($modelacion !== NULL && $modelacion->uso_software_bim !== NULL){
                        $uso_software = explode(',', $modelacion->uso_software_bim);
                    }else{
                        $uso_software = NULL;
                    }

                    if($modelacion !== NULL){
                        $ha_trabajado_bim = $modelacion->ha_trabajado_bim;
                        $desea_aprender_bim = $modelacion->desea_aprender_bim;
                        $anios_experiencia = $modelacion->anios_experiencia;
                        $m2_disenados_bim = $modelacion->m2_disenados_bim;
                        $tiene_certificados_bim = $modelacion->tiene_certificados_bim;
                    }else{
                        $ha_trabajado_bim = NULL;
                        $desea_aprender_bim = NULL;
                        $anios_experiencia = NULL;
                        $m2_disenados_bim = NULL;
                        $tiene_certificados_bim = NULL;

                    }


                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">¿Ha trabajado con BIM? *</label>
                                {!!Form::select('ha_trabajado_bim', [
                                    '' => 'Selecciona una opción',
                                    1=>'Si',
                                    0=>'No'],
                                    $ha_trabajado_bim,
                                    array('class'=>'form-control','id' => 'ha_trabajado_bim')
                                    )!!}
                                     <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('ha_trabajado_bim')}}</p>
                            </div>
                            <div style="display: none;" id="opcion">
                                <div class="form-group">
                                    <label class="form-label">¿Desea aprender BIM? *</label>
                                    {!!Form::select('desea_aprender_bim', [
                                        '' => 'Selecciona una opción',
                                        1=>'Si',
                                        0=>'No'],
                                        $desea_aprender_bim,
                                        array('class'=>'form-control','id' => 'desea_aprender_bim')
                                        )!!}
                                         <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('desea_aprender_bim')}}</p>
                                </div>    
                            </div>
                            <div style="display: none;" id="modelacion">
                                <div class="form-group">
                                    <label class="form-label">Años de Experiencia *</label>
                                    {!!Form::text('anios_experiencia',$anios_experiencia,array('placeholder'=>'Años de Experiencia','class'=>'form-control'))!!}
                                     <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('anios_experiencia')}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">M2 Diseñados con BIM *</label>
                                    {!!Form::text('m2_disenados_bim',$m2_disenados_bim,array('placeholder'=>'M2 diseñados con BIM','class'=>'form-control'))!!}
                                     <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('m2_disenados_bim')}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tipos de estructuras diseñadas *</label>
                                    {!!Form::select('tipo_estructuras_disenadas[]',$array,
                                            $tipo_estructuras_disenadas,
                                            array('class'=>'form-control select2','id' => 'tipo_estructuras_disenadas','multiple'=>'true')
                                    )!!}
                                     <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('tipo_estructuras_disenadas')}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Uso de Software *</label>
                                    {!!Form::select('uso_software_bim[]',$arraySoftware,
                                            $uso_software,
                                            array('class'=>'form-control select2','id' => 'uso_software_bim','multiple'=>'true')
                                    )!!}
                                     <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('uso_software_bim')}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">¿Cuenta con certificados? *</label>
                                    {!!Form::select('tiene_certificados_bim', [
                                        '' => 'Selecciona una opción',
                                        1=>'Si',
                                        0=>'No'],
                                        $tiene_certificados_bim,
                                        array('class'=>'form-control','id' => 'tiene_certificados_bim')
                                        )!!}
                                         <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('tiene_certificados_bim')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{$rutaNombre == 'freelancer.paso5' ? '/clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-4' : '/clientes/perfil-freelancer/'.$freelancer->idfreelancer}}" class="btn btn-link">Cancelar</a>
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

<script>
    $('.dropify').dropify();

    var selected = $('#ha_trabajado_bim').val();
    console.log(selected);

    if (selected == "1") {
        document.getElementById("modelacion").style.display = "block";
        document.getElementById("opcion").style.display = "none";
    }
    if (selected == "0") {
        document.getElementById("modelacion").style.display = "none";
        document.getElementById("opcion").style.display = "block";
    }

    $("#ha_trabajado_bim").change(function () {
        
        var selected_option = $('#ha_trabajado_bim').val();
        console.log(selected_option);

        if (selected_option == "1") {
            document.getElementById("modelacion").style.display = "block";
            document.getElementById("opcion").style.display = "none";
        }
        if (selected_option == "0") {
            document.getElementById("modelacion").style.display = "none";
            document.getElementById("opcion").style.display = "block";
        }
    });
</script>
    
@stop
