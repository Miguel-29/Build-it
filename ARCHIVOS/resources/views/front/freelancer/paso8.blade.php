@extends('front.layouts.pasos')
@section('content')
<div class="container">
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
                        <div class="circleBase finished"><p class="center"><a>5</a></p></div>
                        <div class="menu-step">
                            <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5')}}" style="color: white">Modelación</a>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">	
                <div class="col-auto align-self-center ">
                    <div class="circleBase finished"><p class="center"><a>6</a></p></div>
                    <div class="menu-step">
                        <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-6')}}" style="color: white">Revisión</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">	
                <div class="col-auto align-self-center ">
                    <div class="circleBase finished"><p class="center"><a>7</a></p></div>
                    <div class="menu-step">
                        <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-7')}}" style="color: white">Supervisión</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">	
                <div class="col-auto align-self-center ">
                    <div class="circleBase actual"><p class="center">8</p></div>
                    <div class="menu-step">
                        <span class="status-active">Adjuntar</span>
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
                            <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5')}}" style="color: white">Modelación</a>
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
                        <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-6')}}" style="color: white">Revisión</a>
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
                        <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-7')}}" style="color: white">Supervisión</a>
                    </div>
                    <br>
                    <div class="circleBase finished"><p class="center"><a>7</a></p></div>

                </div>
            </div>
        </div>
        <div class="pasos" style="width: 12.5%">
            <div class="">	
                <div class=" ">
                    <div class="menu-step">
                        <span class="status-active">Adjuntar</span>
                    </div>
                    <br>
                    <div class="circleBase actual"><p class="center">8</p></div>

                </div>
            </div>
        </div>
        <!--<div class="col-sm-12 col-md-6 col-lg-2"></div>-->
    </div>

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
                        Revisión
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-6')}}"> 6 </a></div>
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
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-7')}}"> 7 </a></div>
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
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#c21a1a"><div width="128" height="128" style="height: 64px; width: 64px;"></div>
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
            {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-8','method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
                <input type="hidden" name="tipoDocumento" value="freelancer">
                <input type="hidden" name="idrelacion" value="{{$freelancer->idfreelancer}}">
    
                <div class="card-header">
                    <h3 class="card-title">Crea tu cuenta</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            Adjuntar documentación
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            @foreach ($tag as $tags)
                            <div class="form-group">
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input items" name="items[]" id="item_{{$tags->tag}}" value="{{$tags->tag}}_{{$tags->id}}"  @if($tags->obligatorio == 1) required @endif>
                                        <span class="custom-control-label">{{$tags->tag}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 text-center" id="imagen_{{$tags->tag}}_{{$tags->id}}" style="display: none;" >
                                <input type="file" name="tag_{{$tags->id}}" id="tag_{{$tags->id}}" class="dropify" data-height="110"  />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{URL::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-7')}}" class="btn btn-link">Cancelar</a>
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

    $(".items").click(function(e){
        var current = $(this).val();
        console.log("current: "+current);
        if($(this).is(':checked')) {  
            console.log("disabled");
            
            document.getElementById("imagen_"+current).style.display = "block";
        } else {  
            console.log("enabled");
            document.getElementById("imagen_"+current).style.display = "none";
        }  
        
    });


</script>
    
@stop
