@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'freelancer.paso6' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<style>
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
<div class="container">
    @if($rutaNombre == 'freelancer.paso6')
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
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3')}}" style="color: white">Espec??fico</a>
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
                            <div class="circleBase finished"><p class="center"><a>5</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5')}}" style="color: white">Modelaci??n</a>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase actual"><p class="center">6</p></div>
                        <div class="menu-step">
                            <span class="status-active">Revisi??n</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase"><p class="center">7</p></div>
                        <div class="menu-step">
                            Supervisi??n
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
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3')}}" style="color: white">Espec??fico</a>
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
                                <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5')}}" style="color: white">Modelaci??n</a>
                            </div>
                            <br>
    
                            <div class="circleBase finished"><p class="center"><a>5</a></p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            <span class="status-active">Revisi??n</span>
                        </div>
                        <br>
                        <div class="circleBase actual"><p class="center">6</p></div>
                    </div>
                </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            Supervisi??n
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
                            Espec??fico
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
                            Modelaci??n
                        </div>
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5')}}"> 5 </a></div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">	
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Revisi??n
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 6 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">	
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Supervisi??n
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
            @if($rutaNombre == 'freelancer.paso6')
                {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-6','method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-6?editar='.$idfreelancer,'method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @endif    
   
                <input type="hidden" name="tipo_relacion" value="freelancer">
                <input type="hidden" name="idrelacion" value="{{$freelancer->idfreelancer}}">
                <input type="hidden" name="iddisciplina" value="{{$iddisciplina}}">
                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'freelancer.paso6' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            Revisi??n de dise??o
                        </div>
                    </div>

                </div>
                @php
                    $array = [];
                    foreach ($subUso as $key ) {
                        $array[$key->nombre] = $key->nombre;
                    }

                    if($revision !== NULL && $revision->tipos_estructuras !== NULL){
                        $tipo_estructuras_disenadas = explode(',', $revision->tipos_estructuras);
                    }else{
                        $tipo_estructuras_disenadas = NULL;
                    }

                    $realiza_funcion_revision_diseno = NULL;
                    $anios_experiencia_revision = NULL;
                    $m2_revisados = NULL;
                    
                    if($revision !== NULL){
                        $realiza_funcion_revision_diseno =  $revision->realiza_funcion_revision_diseno;
                        $anios_experiencia_revision = $revision->anios_experiencia_revision;
                        $m2_revisados = $revision->m2_revisados;
                    }

                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">??Realiza la funci??n de revision de dise??o? *</label>
                                {!!Form::select('realiza_funcion_revision_diseno', [
                                    '' => 'Selecciona una opci??n',
                                    1=>'Si',
                                    0=>'No'],
                                    $realiza_funcion_revision_diseno,
                                    array('class'=>'form-control','id' => 'realiza_funcion_revision_diseno')
                                    )!!}
                                    <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('realiza_funcion_revision_diseno')}}</p>
                            </div>
                            <div style="display: none;" id="revision">
                                <div class="form-group">
                                    <label class="form-label">A??os de Experiencia *</label>
                                    {!!Form::text('anios_experiencia_revision',$anios_experiencia_revision,array('placeholder'=>'A??os de Experiencia','class'=>'form-control'))!!}
                                    <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('anios_experiencia_revision')}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">M2 revisados *</label>
                                    {!!Form::text('m2_revisados',$m2_revisados,array('placeholder'=>'M2 revisados','class'=>'form-control'))!!}
                                    <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('m2_revisados')}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tipos de estructuras *</label>
                                    {!!Form::select('tipos_estructuras[]',$array,
                                            $tipo_estructuras_disenadas,
                                            array('class'=>'form-control select2','id' => 'tipos_estructuras','multiple'=>'true')
                                    )!!}
                                    <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('tipos_estructuras')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{$rutaNombre == 'freelancer.paso6' ? '/clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5' : '/clientes/perfil-freelancer/'.$freelancer->idfreelancer}}" class="btn btn-link">Cancelar</a>
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

    var selected = $('#realiza_funcion_revision_diseno').val();
    console.log(selected);

    if (selected == "1") {
        document.getElementById("revision").style.display = "block";
    }
    if (selected == "0") {
        document.getElementById("revision").style.display = "none";
    }
    
    $("#realiza_funcion_revision_diseno").change(function () {
        
        var selected_option = $('#realiza_funcion_revision_diseno').val();
        console.log(selected_option);

        if (selected_option == "1") {
            document.getElementById("revision").style.display = "block";
        }
        if (selected_option == "0") {
            document.getElementById("revision").style.display = "none";
        }
    });

</script>
    
@stop
