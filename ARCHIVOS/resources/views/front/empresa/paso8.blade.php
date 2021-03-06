@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'empresas.paso8' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<div class="container">
    @if($rutaNombre == 'empresas.paso8')

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
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-4')}}" style="color: white">Espec??fico</a>
                            </div>

                        </div>
                    </div>
            </div>-->
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase finished" ><p class="center"><a>4</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-5')}}" style="color: white">Experiencia</a>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase finished" ><p class="center"><a>5</a></p></div>
                            <div class="menu-step">
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-6')}}" style="color: white">Modelaci??n</a>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase finished" ><p class="center"><a>6</a></p></div>
                        <div class="menu-step">
                            <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-7')}}" style="color: white">Revisi??n</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase actual" ><p class="center">7</p></div>
                        <div class="menu-step">
                            <span class="status-active">Supervisi??n</span>
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
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-5')}}" style="color: white">Experiencia</a>
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
                                <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-6')}}" style="color: white">Modelaci??n</a>
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
                            <a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-7')}}" style="color: white">Revisi??n</a>
                        </div>
                        <br>
                        <div class="circleBase finished"><p class="center"><a>6</a></p></div>
                    </div>
                </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            <span class="status-active">Supervisi??n</span>
                        </div>
                        <br>
                        <div class="circleBase actual"><p class="center"><a>7</a></p></div>
    
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
                            Espec??fico
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
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-5')}}"> 5 </a></div>
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
                            <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-6')}}"> 6 </a></div>
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
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-7')}}"> 7 </a></div>
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
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
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
            @if($rutaNombre == 'empresas.paso8')
                {!!Form::model($empresa,array('url'=>'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-8','method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($empresa,array('url'=>'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-8?editar='.$idempresa,'method'=>'post','class'=>'card', 'style' => 'margin-bottom: 70px'))!!}
            @endif

            <input type="hidden" name="tipo_relacion" value="empresa">
            <input type="hidden" name="idrelacion" value="{{$empresa->idempresa}}">
            <input type="hidden" name="iddisciplina" value="{{$iddisciplina}}">
                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'empresas.paso8' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            Supervisi??n t??cnica
                        </div>
                    </div>

                </div>
                @php
                    $array = [];
                    foreach ($subUso as $key ) {
                        $array[$key->nombre] = $key->nombre;
                    }

                    if($supervision !== NULL && $supervision->tipo_estructura !== NULL){
                        $tipo_estructuras_disenadas = explode(',', $supervision->tipo_estructura);
                    }else{
                        $tipo_estructuras_disenadas = NULL;
                    }
                    
                    $realiza_supervision_tecnica = NULL;
                    $anios_experiencia_supervision = NULL;
                    $m2_supervisados = NULL;

                    if($supervision !== NULL){
                        $realiza_supervision_tecnica = $supervision->realiza_supervision_tecnica;
                        $anios_experiencia_supervision = $supervision->anios_experiencia_supervision;
                        $m2_supervisados = $supervision->m2_supervisados;
                    }

                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">??Realiza la funci??n de supervisor t??cnico? *</label>
                                {!!Form::select('realiza_supervision_tecnica', [
                                    '' => 'Selecciona una opci??n',
                                    1=>'Si',
                                    0=>'No'],
                                    $realiza_supervision_tecnica,
                                    array('class'=>'form-control','id' => 'realiza_supervision_tecnica')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('realiza_supervision_tecnica')}}</span>
                            </div>
                            <div style="display: none;" id="supervision">
                                <div class="form-group">
                                    <label class="form-label">A??os de Experiencia *</label>
                                    {!!Form::text('anios_experiencia_supervision',$anios_experiencia_supervision,array('placeholder'=>'A??os de Experiencia','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('anios_experiencia_supervision')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">M2 supervisados *</label>
                                    {!!Form::text('m2_supervisados',$m2_supervisados,array('placeholder'=>'M2 supervisados','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('m2_supervisados')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tipos de estructuras *</label>
                                    {!!Form::select('tipo_estructura[]',$array,
                                            $tipo_estructuras_disenadas,
                                            array('class'=>'form-control select2','id' => 'tipo_estructura','multiple'=>'true')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('tipo_estructura')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{$rutaNombre == 'empresas.paso8' ? '/clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-7' : '/clientes/perfil-empresa/'.$empresa->idempresa}}" class="btn btn-link">Cancelar</a>
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

    var selected = $('#realiza_supervision_tecnica').val();
    console.log(selected);

    if (selected == "1") {
        document.getElementById("supervision").style.display = "block";
    }
    if (selected == "0") {
        document.getElementById("supervision").style.display = "none";
    }

    $("#realiza_supervision_tecnica").change(function () {
        
        var selected_option = $('#realiza_supervision_tecnica').val();
        console.log(selected_option);

        if (selected_option == "1") {
            document.getElementById("supervision").style.display = "block";
        }
        if (selected_option == "0") {
            document.getElementById("supervision").style.display = "none";
        }
    });

</script>
    
@stop
