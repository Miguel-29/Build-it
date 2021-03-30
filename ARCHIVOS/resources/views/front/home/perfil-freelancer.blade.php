@extends('front.layouts.proyecto')
@section('content')
<style>
.foto-perfil {
    object-fit: cover;
    border-radius:50%;
    width: 150px;
    height: 150px;
}

.datosPersona{
    display: flex;
    justify-content: center;
    align-content: center;
    flex-direction: column;
}
body *::-webkit-scrollbar-thumb {
    background: #153556;
}

body *:hover::-webkit-scrollbar-thumb {
    background: #0e243b;
}

</style>
<div class="container">
    <div class="row general-view profesionales-info">
        <div class="perfil-nombre col-md-12">
            <div class="card" style="background-color: #ffffff;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3" style="text-align: center">
                            @php
                                $url = '/assets/front/images/user-2.png';
                                if($freelancer->image !== NULL){
                                    $url = '/uploads/front/freelancer/general/'.$freelancer->idfreelancer.'/'.$freelancer->image;
                                }
                                $user = auth()->user();
                                $cuentaComentarios = 0;
                                if($galeria->count() > 0){
                                    foreach ($galeria as $galerias) {
                                        $cuentaComentarios += $galerias->comentarios->count();
                                    }

                                }else{
                                    $cuentaComentarios = 0;
                                }
                
                            @endphp
                            <img class="foto-perfil" src="{{$url}}"/>
                        </div>
                        <div class="col-md-6 col-lg-6 datosPersona">
                            <h1>{{$freelancer->nombres}} {{$freelancer->apellidos}}</h1>
                            <h3>Contratista(Freelancer)</h3>
                        </div>
                        <div class="col-md-3 col-lg-3"></div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="perfil-datos col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="background-color: #ffffff;">
                        <div class="card-header">
                            <div class="card-title"><img src="{{URL::to('assets/front/images/imagenes/buildit.png')}}"/></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h6>Acerca de ti</h6>
                                    <p style="color: #FF9603; font-size: 8px">
                                        @foreach ($freelancer->disciplinas as $disciplinas)
                                            {{$disciplinas->nombre}}<br>
                                        @endforeach
                                        
                                    </p>
                                    @foreach ($formacion as $formaciones)
                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left">{{$formaciones->titulo}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card" style="background-color: #ffffff;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h6>Contacto</h6>
                                    <ul class="demo-accordion accordionjs m-0">
                                        <li>
                                            <div style="background-color: #153556"><h3 style="color: white">Contactar</h3></div>
                                            <div style="background-color: #E1E1E1; color: black; font-size: 12px">
                                                <b>Correo: </b>{{$freelancer->email}}
                                                <br>
                                                <b>Celular: </b>{{$freelancer->celular}}
                                                <br>
                                                <b>Ciudad: </b>{{$freelancer->ciudad_residencia}}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list">
                                <li>Perfil</li>
                                <li>Portafolio</li>
                            </ul>
                            <div class="content_wrapper">
                                <div class="tab_content">
                                    <div class="table-responsive">
                                        <div class="card" style="background-color: #ffffff;">
                                            <div class="card-header">
                                                <div class="card-title"><br>Información</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="panel panel-primary col-md-12">
                                                        <div class="tab_wrapper first_tab">
                                                            <ul class="tab_list">
                                                                <li>Perfil profesional</li>
                                                                <li>Perfil personal</li>
                                                            </ul>
                                                            <div class="content_wrapper">
                                                                
                                                                <div class="tab_content">
                                                                    @if($user->hasRole('Freelancer'))
                                                                        @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                            <div class="row">
                                                                                <div class="col-md-6"></div>
                                                                                <div class="col-md-6 text-right">
                                                                                    <a href="{{URL::to('clientes/agregar-disciplinas/freelancer/'.$freelancer->idfreelancer)}}" style="background-color:  #153556" class="btn btn-facebook btn-sm">+ Agregar Disciplinas</a>
                                                                                </div>
                                                                                <br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    <div class="panel panel-primary col-md-12">
                                                                        <div class="tab_wrapper first_tab">
                                                                            @php
                                                                                $espe = $freelancer->disciplinas;
                                                                                $disciplinas = $espe->unique('iddisciplina');
                                                                            @endphp
                                                                            <ul class="tab_list clase-perfil" style=" display:flex;
                                                                            white-space: nowrap;">
                                                                                @foreach ($disciplinas as $disciplina)
                                                                                    <li>{{$disciplina->nombre}}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                            <hr style="margin-top: 0.1rem;">
                                                                            <div class="content_wrapper">
                                                                                @foreach ($disciplinas as $disciplina)
                                                                                @php

                                                                                    $experiencia = \App\Models\Front\ExperienciaLaboral::where('tipo_relacion','freelancer')->where('idrelacion',$freelancer->idfreelancer)->where('iddisciplina',$disciplina->iddisciplina)->first();
                                                                                    $idioma = \App\Models\Front\Idioma::where('tipo_relacion','freelancer')->where('idrelacion',$freelancer->idfreelancer)->where('iddisciplina',$disciplina->iddisciplina)->get();
                                                                                    $modelacion = \App\Models\Front\ModelacionBim::where('tipo_relacion','freelancer')->where('idrelacion',$freelancer->idfreelancer)->where('iddisciplina',$disciplina->iddisciplina)->first();
                                                                                    $revision = \App\Models\Front\Revision::where('tipo_relacion','freelancer')->where('idrelacion',$freelancer->idfreelancer)->where('iddisciplina',$disciplina->iddisciplina)->first();
                                                                                    $supervision = \App\Models\Front\SupervisionTecnica::where('tipo_relacion','freelancer')->where('idrelacion',$freelancer->idfreelancer)->where('iddisciplina',$disciplina->iddisciplina)->first();

                                                                                    if($experiencia !== NULL && $experiencia->tipo_estructuras_disenadas !== NULL){
                                                                                        $tipo_estructuras_disenadas = explode(',', $experiencia->tipo_estructuras_disenadas);
                                                                                    }else{
                                                                                        $tipo_estructuras_disenadas = NULL;
                                                                                    }
                
                                                                                    if($experiencia !== NULL && $experiencia->actividades_desempena !== NULL){
                                                                                        $actividades_desempena = explode(',', $experiencia->actividades_desempena);
                                                                                    }else{
                                                                                        $actividades_desempena = NULL;
                                                                                    }
                
                                                                                    if($experiencia !== NULL && $experiencia->uso_software !== NULL){
                                                                                        $uso_software = explode(',', $experiencia->uso_software);
                                                                                    }else{
                                                                                        $uso_software = NULL;
                                                                                    }
                
                                                                                    if($modelacion !== NULL && $modelacion->tipo_estructuras_disenadas !== NULL){
                                                                                        $tipo_estructuras_disenadas_bim = explode(',', $modelacion->tipo_estructuras_disenadas);
                                                                                    }else{
                                                                                        $tipo_estructuras_disenadas_bim = NULL;
                                                                                    }
                                                                                    if($revision !== NULL && $revision->tipos_estructuras !== NULL){
                                                                                        $tipo_estructuras_disenadas_r = explode(',', $revision->tipos_estructuras);
                                                                                    }else{
                                                                                        $tipo_estructuras_disenadas_r = NULL;
                                                                                    }
                
                                                                                    if($supervision !== NULL && $supervision->tipo_estructura !== NULL){
                                                                                        $tipo_estructuras_disenadas_s = explode(',', $supervision->tipo_estructura);
                                                                                    }else{
                                                                                        $tipo_estructuras_disenadas_s = NULL;
                                                                                    }
                

                
                                                                                @endphp
                                                                                    <div class="tab_content">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 col-lg-12 ">
                                                                                                <div class="col-md-12">
                                                                                                    @foreach ($formacion as $formaciones)
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>{{$formaciones->titulo}}</b></p>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$formaciones->universidad}} {{$formaciones->anio_culminacion}}</p>
                                                                                                    @endforeach
                                                                                                    @if($user->hasRole('Freelancer'))
                                                                                                        @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-6"></div>
                                                                                                                <div class="col-md-6">
                                                                                                                    <a href="{{URL::to('clientes/editar-freelancer/freelancer/'.$freelancer->idfreelancer.'/formacion-academica')}}" class="btn btn-primary ml-auto">Editar Formación Académica</a>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @endif
                    
                                                                                                    <hr>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6">
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Experiencia Laboral</b></p>
                                                                                                        @if($experiencia !== NULL)
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$experiencia->anios_experiencia}}</p>
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$experiencia->m2_disenados}} m2 diseñados</p>
                                                                                                        @endif
                    
                                                                                                            <br>
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Tipos de estructuras diseñadas</b></p>
                                                                                                            @if($experiencia !== NULL)
                    
                                                                                                                @foreach ($tipo_estructuras_disenadas as $item)
                                                                                                                    <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$item}}</p>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                            <br>
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Actividades desempeñadas</b></p>
                                                                                                            @if($experiencia !== NULL)
                                                                                                                @foreach ($actividades_desempena as $item)
                                                                                                                    <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$item}}</p>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                            <br>
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Softwares</b></p>
                                                                                                            @if($experiencia !== NULL)
                                                                                                                @foreach ($uso_software as $item)
                                                                                                                    <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$item}}</p>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                            <br>
                    
                    
                                                                                                    </div>
                                                                                                    <div class="col-md-6">
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Disponibilidad de personal</b></p>
                                                                                                        @if($experiencia !== NULL)
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$experiencia->disponibilidad_personal}}</p>
                                                                                                        @endif
                                                                                                        <br>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Certificados de cursos y seminarios</b></p>
                                                                                                        @if($experiencia !== NULL)
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$experiencia->certificados_cursos_seminarios}}</p>
                                                                                                        @endif
                                                                                                        <br>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Disponibilidad para viajar</b></p>
                                                                                                        @if($experiencia !== NULL)
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$experiencia->disponibilidad_viajar}}</p>
                                                                                                        @endif
                                                                                                        <br>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Idiomas</b></p>
                                                                                                        @foreach ($idioma as $item)
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$item->nombreIdioma}} - {{$item->nivelIdioma}}</p>
                                                                                                        @endforeach
                                                                                                        <br>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Tipo de contratación</b></p>
                                                                                                        @if($experiencia !== NULL)
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$experiencia->tipo_contratacion}}</p>
                                                                                                        @endif
                                                                                                        <br>
                    
                                                                                                    </div>
                    
                                                                                                    <hr>
                                                                                                </div>
                                                                                                @if($user->hasRole('Freelancer'))
                                                                                                    @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-6"></div>
                                                                                                            <div class="col-md-6">
                                                                                                                <a href="{{URL::to('clientes/editar-freelancer/freelancer/'.$freelancer->idfreelancer.'/experiencia-laboral?disciplinas='.$disciplina->iddisciplina)}}" class="btn btn-primary ml-auto">Editar Experiencia Laboral</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @endif
                    
                                                                                                <hr>
                                                                                                <div class="col-md-12">
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Modelacion BIM</b></p>
                                                                                                        @if($modelacion == NULL  || $modelacion->ha_trabajado_bim == 0 )
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">No ha trabajado BIM</p>
                                                                                                        @else
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$modelacion->anios_experiencia}}</p>
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$modelacion->m2_disenados_bim}} m2 diseñados</p>
                                                                                                            <br>
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Tipos de estructuras diseñadas</b></p>
                                                                                                            @foreach ($tipo_estructuras_disenadas_bim as $item)
                                                                                                                <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$item}}</p>
                                                                                                            @endforeach
                                                                                                            <br>
                        
                                                                                                        @endif
                                                                                                        @if($user->hasRole('Freelancer'))
                                                                                                            @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-6"></div>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <a href="{{URL::to('clientes/editar-freelancer/freelancer/'.$freelancer->idfreelancer.'/modelacion-bim?disciplinas='.$disciplina->iddisciplina)}}" class="btn btn-primary ml-auto">Editar Modelacion BIM</a>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        @endif
                    
                                                                                                    <hr>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Revisión de diseños estructurales</b></p>
                                                                                                    @if($revision == NULL || $revision->realiza_funcion_revision_diseno == 0 )
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">No realiza funcion de revisión de diseño</p>
                                                                                                    @else
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$revision->anios_experiencia_revision}}</p>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$revision->m2_revisados}} m2 diseñados</p>
                                                                                                        <br>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Tipo de estructuras revisadas con BIM</b></p>
                                                                                                        @foreach ($tipo_estructuras_disenadas_r as $item)
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$item}}</p>
                                                                                                        @endforeach
                                                                                                        <br>
                    
                                                                                                    @endif
                                                                                                    @if($user->hasRole('Freelancer'))
                                                                                                        @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-6"></div>
                                                                                                                <div class="col-md-6">
                                                                                                                    <a href="{{URL::to('clientes/editar-freelancer/freelancer/'.$freelancer->idfreelancer.'/revision-bim?disciplinas='.$disciplina->iddisciplina)}}" class="btn btn-primary ml-auto">Editar Revisión BIM</a>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @endif
                    
                                                                                                    <hr>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Supervisión técnica estructural</b></p>
                                                                                                    @if($supervision == NULL || $supervision->realiza_supervision_tecnica == 0 )
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">No realiza supervisión técnica</p>
                                                                                                    @else
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$supervision->anios_experiencia_supervision}}</p>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$supervision->m2_supervisados}} m2 diseñados</p>
                                                                                                        <br>
                                                                                                        <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Tipo de estructuras supervisadas con BIM</b></p>
                                                                                                        @foreach ($tipo_estructuras_disenadas_s as $item)
                                                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left" style="visibility: hidden">{{$item}}</p>
                                                                                                        @endforeach
                                                                                                    <br>
                    
                                                                                                    @endif
                                                                                                    @if($user->hasRole('Freelancer'))
                                                                                                        @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-6"></div>
                                                                                                                <div class="col-md-6">
                                                                                                                    <a href="{{URL::to('clientes/editar-freelancer/freelancer/'.$freelancer->idfreelancer.'/supervision-bim?disciplinas='.$disciplina->iddisciplina)}}" class="btn btn-primary ml-auto">Editar Supervisión BIM</a>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @endif
                    
                                                                                                    <hr>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                                <div class="tab_content">
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-1 col-lg-1 "></div>
                                                                        <div class="col-md-11 col-lg-11 ">
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Nombre (s):</b> {{$freelancer->nombres}}</p>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Apellidos:</b> {{$freelancer->apellidos}}</p><h1></h1>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Ciudad de residencia:</b> {{$freelancer->ciudad_residencia}}</p>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>País:</b> {{$freelancer->pais}}</p>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Tipo de documento:</b> {{$freelancer->tipo_documento}}</p>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Documento:</b> {{$freelancer->documento}}</p>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Edad:</b> {{$freelancer->edad}}</p>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Correo:</b> {{$freelancer->email}}</p>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Celular:</b> {{$freelancer->celular}}</p>
                                                                            <p><img src="{{URL::to('assets/front/images/imagenes/check.png')}}" align="left"><b>Nacionalidad:</b> {{$freelancer->nacionalidad}}</p>

                                                                            <br>
                                                                            <br>
                                                                            @if($user->hasRole('Freelancer'))
                                                                                @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                                    <div class="row">
                                                                                        <div class="col-md-8"></div>
                                                                                        <div class="col-md-4">
                                                                                            <a href="{{URL::to('clientes/editar-freelancer/freelancer/'.$freelancer->idfreelancer)}}" class="btn btn-primary ml-auto">Editar Perfil</a>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                    
                                    </div>
                                </div>
                                <div class="tab_content">
                                    <div class="panel panel-primary col-md-12">
                                        <div class="tab_wrapper first_tab">
                                            <ul class="tab_list">
                                                <li>Fotos</li>
                                                <li>Comentarios ({{$cuentaComentarios}})</li>
                                            </ul>
                                            <div class="content_wrapper">
                                                <div class="tab_content">
                                                    @if($user->hasRole('Freelancer'))
                                                        @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                            <div class="row">
                                                                <div class="col-md-9 col-lg-9 "></div>
                                                                <div class="col-md-3 col-lg-3 ">
                                                                    <button type="button" class="btn btn-success btn-sm btn-round add" data-toggle="modal" data-target="#exampleModal">Agregar Galería</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    <div class="table-responsive">
                                                        @if($galeria->count() !== 0)
                                                            @php $cuentaFotos = 1; @endphp
                                                            @foreach ($galeria as $galerias)
                                                                <div class="card" style="background-color: #ffffff;">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            @if($user->hasRole('Freelancer'))
                                                                                @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                                    <div class="col-md-11 col-lg-11 ">
                                                                                @else
                                                                                    <div class="col-md-12 col-lg-12">
                                                                                @endif
                                                                            @else
                                                                                <div class="col-md-12 col-lg-12">
                                                                            @endif
                                                                                <div class="row">
                                                                                    @if($galerias->imagenes->count() > 0)
                                                                                        @foreach ($galerias->imagenes as $imagenes)
                                                                                            @if ($cuentaFotos <= 6)
                                                                                                <div class="col-md-4" style="border: 5px solid white;">
                                                                                                    <a href="/uploads/front/galerias/{{$galerias->idgaleria}}/{{$imagenes->image}}" data-fancybox="gallery" data-caption="{{$imagenes->descripcion}}">
                                                                                                        <img src="/uploads/front/galerias/{{$galerias->idgaleria}}/{{$imagenes->image}}" width="200" height="200" />
                                                                                                    </a>
                                                                                                </div>
                                                                                            @else
                                                                                                @if ($cuentaFotos == 7)
                                                                                                    <div class="col-md-12 col-lg-12">
                                                                                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#demo">Mostrar más ↓</button>
                                                                                                        <div id="demo" class="collapse col-md-12" >
                                                                                                            <div class="row">
                                                                                                @endif
                                                                                                                <div class="col-md-4" style="border: 5px solid white;">
                                                                                                                    <a href="/uploads/front/galerias/{{$galerias->idgaleria}}/{{$imagenes->image}}" data-fancybox="gallery" data-caption="{{$imagenes->descripcion}}">
                                                                                                                        <img src="/uploads/front/galerias/{{$galerias->idgaleria}}/{{$imagenes->image}}" width="200" height="200" />
                                                                                                                    </a>
                                                                                                                </div>
                                                                                                @if($cuentaFotos == $galerias->imagenes->count() )
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endif
                                                                                            @php $cuentaFotos = $cuentaFotos + 1; @endphp
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @if($user->hasRole('Freelancer'))
                                                                                @if($freelancer->idfreelancer == $user->iduserrelacion)
                                                                                    <div class="col-md-1 col-lg-1 ">
                                                                                        <button type="button" class="btn btn-success btn-sm btn-round" data-toggle="modal" data-target="#exampleModal_{{$galerias->idgaleria}}">+</button>
                                                                                    </div>
                                                                                @endif
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <div class="row">
                                                                            <div class="col-md-8 col-lg-8">
                                                                                <h2>{{$galerias->nombre}}</h2>
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-4">
                                                                                <button type="button" class="btn btn-link btn-sm btn-round" data-toggle="modal" data-target="#comentarios_{{$galerias->idgaleria}}">
                                                                                    <i class="fa fa-comment"></i>
                                                                                    Comentar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                                <div class="modal fade" id="exampleModal_{{$galerias->idgaleria}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModal_{{$galerias->idgaleria}}">Agregue imagenes</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            {!!Form::open(array('url'=>'clientes/editar-galeria','method'=>'post','id'=>'formFotos_'.$galerias->idgaleria,'files' =>'true'))!!}
                            
                                                                                <div class="modal-body" id="modal-data_{{$galerias->idgaleria}}">
                            
                                                                                    <div class="row">
                                                                                        <input type="hidden" name="tipo_relacion" value="freelancer">

                                                                                        <input type="hidden" name="idgaleria" value="{{$galerias->idgaleria}}">
                                                                                        <input type="hidden" name="idrelacion" value="{{$freelancer->idfreelancer}}">
                            
                                                                                        <div class="form-group col-md-12">
                                                                                            {!!Form::label('evidencias','Cargar Imagénes para Galeria '.$galerias->nombre,array('class' => 'form-label'))!!}
                                                                                            <div class="col-md-12">
                                                                                                <table class="table card-table">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th width="50%">Descripcion</th>
                                                                                                            <th width="40%">Imagen</th>

                                                                                                            <th>&nbsp;</th>																	
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <div name="add2" class="text-left add2"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                                                    <button type="button" class="btn btn-success btn-sm" onclick="imagenes({{$galerias->idgaleria}})" data-dismiss="modal" >Guardar</button>
                                                                                </div>
                                                                            {!!Form::close()!!}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal fade" id="comentarios_{{$galerias->idgaleria}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="comentarios_{{$galerias->idgaleria}}">Agregue un comentario</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            {!!Form::open(array('url'=>'clientes/crear-comentario','method'=>'post','id'=>'formComentario_'.$galerias->idgaleria))!!}
                            
                                                                                <div class="modal-body" id="modal-data_{{$galerias->idgaleria}}">
                            
                                                                                    <div class="row">
                                                                                        @if($user->hasRole('Freelancer'))
                                                                                            <input type="hidden" name="tipo_relacion" value="freelancer">
                                                                                        @elseif($user->hasRole('Cliente'))
                                                                                            <input type="hidden" name="tipo_relacion" value="cliente">
                                                                                        @elseif($user->hasRole('Empresa'))
                                                                                            <input type="hidden" name="tipo_relacion" value="empresa">
                                                                                        @elseif($user->hasRole('Proveedor'))
                                                                                            <input type="hidden" name="tipo_relacion" value="proveedor">
                                                                                        @endif
                                                                                        <input type="hidden" name="idrelacion" value="{{$user->iduserrelacion}}">
                                                                                        <input type="hidden" name="idgaleria" value="{{$galerias->idgaleria}}">
                                                                                        
                                                                                        <div class="form-group col-md-12">
                                                                                            {!!Form::label('comentarios','Escribe un comentario para la Galeria '.$galerias->nombre,array('class' => 'form-label'))!!}
                                                                                            {!!Form::textarea('descripcion_'.$galerias->idgaleria,null,array('placeholder'=>'Ingrese el comentario de la galeria','class'=>'form-control'))!!}
                                                                                            <span class="help-block has-error">{{ $errors->first('descripcion') }}</span>                
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                                                    <button type="button" class="btn btn-success btn-sm"  onclick="comentar({{$galerias->idgaleria}})" data-dismiss="modal" >Guardar</button>
                                                                                </div>
                                                                            {!!Form::close()!!}
                                                                        </div>
                                                                    </div>
                                                                </div>

                            
                                                            @endforeach
                                                        @else
                                                            <div class="card" style="background-color: #ffffff;">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-lg-12 ">
                                                                            <div class="row">
                                                                                <h1>No hay galerías creadas</h1>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>     

                                                        @endif             
                                                    </div>
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="example-Modal">Llene los siguientes campos</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                {!!Form::open(array('url'=>'clientes/crear-galeria','method'=>'post','id'=>'formGaleria'))!!}

                                                                    <div class="modal-body" id="modal-data">

                                                                        <div class="row">
                                                                            <input type="hidden" name="tipo_relacion" value="freelancer">
                                                                            <input type="hidden" name="idrelacion" value="{{$freelancer->idfreelancer}}">
                                                            
                                                                            <div class="form-group col-md-12">
                                                                                <label class="form-label">Seleccione el proyecto</label>
                                                                                <select class="form-control" name="idproyecto" id="idproyecto">
                                                                                    <option value="" selected>Seleccione</option>
                                                                                    @foreach($proyectos as $proyecto)
                                                                                        @foreach ($proyecto->proyectos as $proyectos_asociados)
                                                                                            <option value="{{$proyectos_asociados->idproyecto}}">{{$proyectos_asociados->nombre}}</option>
                                                                                        @endforeach
                                                                                    @endforeach
                                                                                </select>
                                                                                <span class="help-block has-error">{{ $errors->first('idproyecto') }}</span>

                                                                            </div>
                                                                            <div class="form-group col-md-12">
                                                                                <label class="form-label">Nombre de la Galeria</label>
                                                                                {!!Form::text('nombre',null,array('placeholder'=>'Escriba el nombre','class'=>'form-control'))!!}
                                                                                <span class="help-block has-error">{{ $errors->first('nombre') }}</span>
                                                                            </div>
                                                                            <div class="form-group col-md-12">
                                                                                <label class="form-label">Descripcion de la Galeria</label>
                                                                                {!!Form::textarea('descripcion',null,array('placeholder'=>'Escriba la descripcion','class'=>'form-control'))!!}
                                                                                <span class="help-block has-error">{{ $errors->first('descripcion') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" id="save">Guardar</button>
                                                                    </div>
                                                                {!!Form::close()!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab_content">
                                                    <div class="table-responsive">
                                                        @if($galeria->count() !== 0)
                                                            @foreach ($galeria as $galerias)
                                                                @if($galerias->comentarios->count() > 0)
                                                                    @foreach ($galerias->comentarios as $comentarios)
                                                                        @php
                                                                            $nombre = '';
                                                                            $rol = '';
                                                                            $proyecto = '';
                                                                            $url = 'assets/images/faces/female/25.jpg';

                                                                            if($comentarios->tipo_relacion == 'freelancer'){
                                                                                $freelancer = \App\Models\Front\Freelancer::find($comentarios->idrelacion);
                                                                                $nombre = $freelancer->nombres.' '.$freelancer->apellidos;
                                                                                $rol = 'Contratista (Freelancer)';
                                                                                $proyecto = $galerias->nombre;
                                                                                if($freelancer->image !== NULL){
                                                                                    $url = '/uploads/front/freelancer/general/'.$freelancer->idfreelancer.'/'.$freelancer->image;
                                                                                }

                                                                            }elseif($comentarios->tipo_relacion == 'cliente'){
                                                                                $cliente = \App\Models\Front\Cliente::find($comentarios->idrelacion);
                                                                                $nombre = $cliente->nombre_razon_social;
                                                                                $rol = 'Cliente';
                                                                                $proyecto = $galerias->nombre;

                                                                                if($cliente->image !== NULL){
                                                                                    $url = '/uploads/front/cliente/general/'.$cliente->idcliente.'/'.$cliente->image;
                                                                                }

                                                                            }elseif($comentarios->tipo_relacion == 'proveedor'){
                                                                                $proveedor = \App\Models\Front\Proveedor::find($comentarios->idrelacion);
                                                                                $nombre = $proveedor->nombre;
                                                                                $rol = 'Proveedor';
                                                                                $proyecto = $galerias->nombre;

                                                                                if($proveedor->image !== NULL){
                                                                                    $url = '/uploads/front/proveedor/general/'.$proveedor->idproveedor.'/'.$proveedor->image;
                                                                                }


                                                                            }elseif($comentarios->tipo_relacion == 'empresa'){
                                                                                $empresa = \App\Models\Front\Empresa::find($comentarios->idrelacion);
                                                                                $nombre = $empresa->razon_social;
                                                                                $rol = 'Empresa';
                                                                                $proyecto = $galerias->nombre;

                                                                                if($empresa->image !== NULL){
                                                                                    $url = '/uploads/front/empresa/general/'.$empresa->idempresa.'/'.$empresa->image;
                                                                                }


                                                                            }
                                                                            //FECHAS
                                                                            $fechacreacion = date("Y-m-d",strtotime($comentarios->created_at));
                                                                            $fechaactual = date("Y-m-d");

                                                                            $dias = (strtotime($fechacreacion)-strtotime($fechaactual))/86400;
                                                                            $dias = abs($dias); 
                                                                            $dias = floor($dias);

                                                                            //horas
                                                                            $day1 = strtotime($comentarios->created_at);
                                                                            $day2 = date("Y-m-d H:i:s");
                                                                            $day2 = strtotime($day2);

                                                                            $diffHours = round(($day2 - $day1) / 3600);

                                                                            //minutos
                                                                            $date1 = new DateTime($comentarios->created_at);
                                                                            $date2 = new DateTime(date("Y-m-d H:i:s"));
                                                                            $minutoss = $date1->diff($date2);
                                                                            $minutos = intval($minutoss->format('%i'));

                                                                        @endphp
                                                                        <br>
                                                                        <div class="card comentario-des" style="background-color: #ffffff;">
                                                                            <div class="card-header">
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-2 col-lg-2">
                                                                                        <span class="avatar avatar-md brround" style="background-image: url({{$url}})"></span>
                                                                                    </div>
                                                                                    <div class="col-md-10 col-lg-10" style="text-align: left">
                                                                                        <h6>{{$nombre}}</h6>
                                                                                        <h6>{{$rol}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="comentario-des">
                                                                                    <h6>Comentario para galeria {{$proyecto}}</h6>
                                                                                    {!!$comentarios->descripcion!!}
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <div class="row">
                                                                                    <div class="col-md-12 col-lg-12">
                                                                                        @if($dias == 0 && $diffHours == 0 && $minutos == 0)
                                                                                            <h6>Publicado hace un momento</h6>

                                                                                        @elseif($minutos !==0 && $diffHours == 0 && $dias ==0)
                                                                                            <h6>Publicado hace {{$minutos}} minuto(s)</h6>
                                                                                        @elseif($diffHours !==0 && $dias == 0)
                                                                                            <h6>Publicado hace {{$diffHours}} hora(s)</h6>
                                                                                        @else
                                                                                            <h6>Publicado hace {{$dias}} día(s) </h6>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
        
                                                                        </div>
                                                                        <br>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
     $('.dropify').dropify();
     $(function(e) {
        $(".demo-accordion").accordionjs();
        $( ".acc_section" ).removeClass( "acc_active" );
        $( ".acc_content" ).hide();
    });
    $(function(e) {
        $(".first_tab").champ();
        $(".accordion_example").champ({
            plugin_type: "accordion",
            side: "left",
            active_tab: "3",
            controllers: "true"
        });

        $(".second_tab").champ({
            plugin_type: "tab",
            side: "right",
            active_tab: "1",
            controllers: "false"
        });

    });

    $("#save").click(function() {
        $("#formGaleria").submit();
    });

    function imagenes(id){
        $("#formFotos_"+id).submit();
    }

    function comentar(id){
        $("#formComentario_"+id).submit();
    }


    $('.dropify').dropify();


        var count = 1;
        $('.dropify').dropify();

        dynamic_field(count);

        function dynamic_field(number)
        {
            $('.dropify').dropify();

            html = '<tr>';

                html += '<td><textarea name="descripcionImagen[]" class="form-control" placeholder="Escriba" rows="4"></textarea></td>';
                html += '<td><input type="file"  name="imagen[]" class="new"/></td>';

                if(number > 1)
                {
                    html += '<td style="vertical-align: center;"><button type="button" name="remove" id="" class="btn btn-danger remove">X</button></td></tr>';

                    $('tbody').append(html);
                }
                else
                {   
                    add = '<td><button type="button" name="add"  class="btn btn-primary btn-sm addi">+ Agregar</button></td></tr>';

                    $('tbody').html(html);
                    $('.add2').html(add);
                }
                $('.new').addClass("dropify");
                $('.new').attr('data-height', '100');
                $('.dropify').dropify();

        }

        $(document).on('click', '.addi', function(){
            count++;

            dynamic_field(count);
        });
        $('.dropify').dropify();

        $(document).on('click', '.remove', function(){
            count--;

            $(this).closest("tr").remove();
        });

        function charge(){
            $('.dropify').dropify();
        }



</script>
@endsection
