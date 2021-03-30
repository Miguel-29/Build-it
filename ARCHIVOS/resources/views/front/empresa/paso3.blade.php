@extends('front.layouts.pasos')
@section('content')
<div class="container">
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
                    <div class="circleBase actual" ><p class="center">3</p></div>
                    <div class="menu-step">
                        <span class="status-active">Gerencial</span>
                    </div>

                </div>
            </div>
        </div>
        <!--<div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">4</p></div>
                        <div class="menu-step">
                            Específico
                        </div>

                    </div>
                </div>
        </div>-->
        <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">4</p></div>
                        <div class="menu-step">
                            Experiencia
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
                            <span class="status-active">Gerencial</span>
                        </div>
                        <br>
                        <div class="circleBase actual"><p class="center"><a>3</a></p></div>
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
                        <div class="circleBase"><p class="center"><a>4</a></p></div>
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
                            Específico
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
            {!!Form::model($empresa,array('url'=>'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-3','method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
                <div class="card-header">
                    <h3 class="card-title">Crea tu cuenta</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            formulario de gerencia
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Nombre del gerente *</label>
                                {!!Form::text('gerente_nombres',null,array('placeholder'=>'Nombres del Gerente','class'=>'form-control'))!!}
                                <span class="help-block has-error"> {{$errors->first('gerente_nombres')}}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Apellidos del gerente *</label>
                                {!!Form::text('gerente_apellidos',null,array('placeholder'=>'Apellidos del Gerente','class'=>'form-control'))!!}
                                <span class="help-block has-error"> {{$errors->first('gerente_apellidos')}}</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Celular del gerente *</label>
                                {!!Form::text('gerente_celular',null,array('placeholder'=>'Celular del Gerente','class'=>'form-control'))!!}
                                <span class="help-block has-error"> {{$errors->first('gerente_celular')}}</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Profesión del Gerente *</label>
                                <select class="form-control " data-placeholder="Seleccione" name="gerente_idprofesion" id="gerente_idprofesion" tabindex="-1" aria-hidden="true">
                                    <option label="Seleccione" selected></option>
                                    @foreach ($profesiones as $profesion)
                                        <option value="{{$profesion->id}}"@if($empresa->gerente_idprofesion == $profesion->id) selected @endif>{{$profesion->nombre}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block has-error"> {{$errors->first('gerente_idprofesion')}}</span>

                            </div>
                            <div class="form-group">
                                <label class="form-label">Disciplina del Gerente *</label>
                                <select class="form-control " data-placeholder="Seleccione" name="gerente_iddisciplina" id="gerente_iddisciplina" tabindex="-1" aria-hidden="true">
                                    <option label="Seleccione" selected></option>
                                    @if($empresa->gerente_iddisciplina !== NULL)
                                        <option value="{{$empresa->gerente_iddisciplina}}" selected >{{$empresa->disciplinasGerente->nombre}}</option>
                                    @endif
                                </select>
                                <span class="help-block has-error"> {{$errors->first('gerente_iddisciplina')}}</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="javascript:void(0)" class="btn btn-link">Cancelar</a>
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
        $("#gerente_idprofesion").change(function(){
            var profesion = $(this).val();
            $.ajax({
                url:"/api/profesion/empresa/"+profesion,
                type:"GET",
                success:function(data){  //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                    var codigo_select = '<option value="">Seleccione una disciplina</option>'
                    for (var i=0; i<data.length;i++)
                        codigo_select+='<option value="'+data[i].iddisciplina+'">'+data[i].nombre+'</option>';
        
                    $("#gerente_iddisciplina").html(codigo_select);

                }    
            });
        });
    });

</script>
@stop