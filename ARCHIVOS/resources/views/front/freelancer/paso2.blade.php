@extends('front.layouts.pasos')
@section('content')
<div class="container">
    <div class="row mb-6">
        <img src="{{URL::to('assets/front/images/imagenes/freelancer/banner-tipo-cliente.jpg')}}" alt="Freelancer">
    </div>
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
                            <span class="status-active">Profesional</span>
                        </div>
                        <br>
                        <div class="circleBase actual"><p class="center">2</p></div>
                    </div>
                </div>
        </div>
        <div class="pasos" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            Específico
                        </div>
                        <br>
                        <div class="circleBase"><p class="center">3</p></div>
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
    <!--<div class="row">
        <div class="col-sm-12 col-md-6 col-lg-2"></div>
        <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="">	
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
                        <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                            <div class="chart-circle-value"> 2 </div>
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
    @php
        $profesiones2 = $freelancer->profesiones->last();
        $disciplinas2 = $freelancer->disciplinas->last();
    @endphp
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-2','method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
                <div class="card-header">
                    <h3 class="card-title">Crea tu cuenta</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            formulario profesional
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Profesión *</label>
                                <select class="form-control" data-placeholder="Seleccione" name="fp_profesion" id="fp_profesion" tabindex="-1" aria-hidden="true" required>
                                    <option label="Seleccione" selected></option>
                                    @foreach ($profesiones as $profesion)
                                        <option value="{{$profesion->id}}"@if($profesiones2 !== NULL && $profesiones2->id == $profesion->id) selected @endif>{{$profesion->nombre}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('fp_profesion')}}</p>

                            </div>
                            <div class="form-group">
                                <label class="form-label">Disciplinas *</label>
                                <select class="form-control" data-placeholder="Seleccione" name="fp_linea_enfoque_area" id="fp_linea_enfoque_area" tabindex="-1" aria-hidden="true">
                                    <option label="Seleccione" selected></option>
                                    @if($disciplinas2 !== NULL)
                                        <option value="{{$disciplinas2->iddisciplina}}" selected >{{$disciplinas2->nombre}}</option>
                                    @endif
                                </select>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('fp_linea_enfoque_area')}}</p>

                            </div>
                            <div class="form-group">
                                <label class="form-label">Competencias *</label>
                                @php
                                    $competencias = ['Ayuda a redactar normativas.' => 'Ayuda a redactar normativas.',
                                                    'Bien organizado.' => 'Bien organizado.',
                                                    'Capacidad para tratar al público en general.' => 'Capacidad para tratar al público en general.',
                                                    'Capaz de adaptarse a los cambios.' => 'Capaz de adaptarse a los cambios.',
                                                    'Capaz de analizar información.' => 'Capaz de analizar información.',
                                                    'Capaz de dirigir a personas y recursos.' => 'Capaz de dirigir a personas y recursos.',
                                                    'Capaz de entablar buenas relaciones con la gente.' => 'Capaz de entablar buenas relaciones con la gente.',
                                                    'Capaz de expresar ideas con claridad.' => 'Capaz de expresar ideas con claridad.',
                                                    'Capaz de mantener información confidencial.' => 'Capaz de mantener información confidencial.',
                                                    'Capaz de trabajar con vencimientos.' => 'Capaz de trabajar con vencimientos.',
                                                    'Destrezas en informática.' => 'Destrezas en informática.',
                                                    'Gestiona solicitudes de planificación.' => 'Gestiona solicitudes de planificación.',
                                                    'Habilidad para escribir en inglés' => 'Habilidad para escribir en inglés',
                                                    'Habilidad para hablar en público.' => 'Habilidad para hablar en público.',
                                                    'Habilidad para resolver problemas.' => 'Habilidad para resolver problemas.',
                                                    'Habilidades comunicativas.' => 'Habilidades comunicativas.',
                                                    'Planifica cómo desarrollar y conservar tierras.' => 'Planifica cómo desarrollar y conservar tierras.',
                                                    'Pone en práctica normativas.' => 'Pone en práctica normativas.',
                                                    'Se mantiene al día de la normativa nueva.' => 'Se mantiene al día de la normativa nueva.'];
                                    if($freelancer->fp_competencias !== NULL){
                                        $fp_competencias = explode(',', $freelancer->fp_competencias);
                                    }else{
                                        $fp_competencias = NULL;
                                    }
                                @endphp
                                {!!Form::select('fp_competencias[]',$competencias,
                                    $fp_competencias,
                                    array('class'=>'form-control select2','id' => 'fp_competencias','multiple'=>'true')
                                    )!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('fp_competencias')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descripción profesional *</label>
                                {!!Form::textarea('fp_descripcion_profesional',null,array('placeholder'=>'Descripción profesional','class'=>'form-control','rows'=>'4'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('fp_descripcion_profesional')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-1')}}" class="btn btn-link">Cancelar</a>
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
        $("#fp_profesion").change(function(){
            var profesion = $(this).val();
            $.ajax({
                url:"/api/profesion/"+profesion,
                type:"GET",
                success:function(data){  //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                    var codigo_select = '<option value="">Seleccione un área</option>'
                    for (var i=0; i<data.length;i++)
                        codigo_select+='<option value="'+data[i].iddisciplina+'">'+data[i].nombre+'</option>';
        
                    $("#fp_linea_enfoque_area").html(codigo_select);

                }    
            });
        });
    });

</script>
@stop