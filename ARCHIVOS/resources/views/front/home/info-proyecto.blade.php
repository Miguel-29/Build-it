@extends('front.layouts.proyecto')
@section('content')
<style>
    .main_content {
        height: auto;
        position: relative;
    }

.content {
    margin: 0 auto;
    padding: 10px;
    position: relative;
}
body *::-webkit-scrollbar-thumb {
    background: #153556;
}

body *:hover::-webkit-scrollbar-thumb {
    background: #0e243b;
}

</style>
<div class="container">
    <img src="{{URL::to('assets/front/images/imagenes/mis-proyectos/b-tus-proyectos.png')}}" alt="Contratistas">
    <div class="row general-view profesionales-info" style="padding-top: 0">
        <div class="col-sm-12">
            @php
                $user = auth()->user();
            @endphp
            <div class="table-responsive">
                <div class="card info-proyecto" style="border-radius: 0;" >
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="1" colspan="1">Código</th>
                                    <th rowspan="1" colspan="1">Proyecto</th>
                                    <th rowspan="1" colspan="1">Propietario</th>
                                    <th rowspan="1" colspan="1">Ciudad</th>
                                    <th rowspan="1" colspan="1">Dirección</th>
                                    <th rowspan="1" colspan="1">Tipo</th>
                                    <th rowspan="1" colspan="1">Inicio</th>
                                    <th rowspan="1" colspan="1">Proceso</th>
                                    <th rowspan="1" colspan="1">Administracion</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td tabindex="0"  class="sorting_1 width">{{$proyecto->idproyecto}}</td>
                                    <td tabindex="0"  class="sorting_1 width">{{$proyecto->nombre}}</td>
                                    <td tabindex="0"  class="sorting_1 width">{{$proyecto->propietario}}</td>
                                    <td tabindex="0"  class="sorting_1 width">{{$proyecto->ciudad}}</td>
                                    <td tabindex="0"  class="sorting_1 width">{{$proyecto->direccion}}</td>

                                    <td tabindex="0"  class="sorting_1 width">{{$proyecto->tipos->nombre}}</td>
                                    <td tabindex="0"  class="sorting_1 width">{{date("d-m-Y",strtotime($proyecto->created_at))}}</td>
                                    <td>
                                        {{$proyecto->proceso}} %
                                    </td>
                                    <td tabindex="0"  class="sorting_1 width">{{$proyecto->ad_administracion}}</td>

                                </tr>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                        <hr>
                        <div class="panel panel-primary">
                            <div class="tab_wrapper first_tab">
                                <ul class="tab_list tab-tipo-info">
                                    <li>Proyecto</li>
                                    <li>Equipo de trabajo</li>
                                </ul>
                                <div class="content_wrapper">
                                    <div class="tab_content">
                                        <div class="table-responsive">
                                            <br>
                                            <div class="row col-md-12" style="padding-top: 1.0rem">
                                                <div class="col-md-5">
                                                    <p><b>Codigo:</b> {{$proyecto->idproyecto}}</p>
                                                    <p><b>Proyecto:</b> {{$proyecto->nombre}}</p>
                                                    <p><b>Propietario:</b> {{$proyecto->propietario}}</p>
                                                    <p><b>Ciudad:</b> {{$proyecto->ciudad}}</p>
                                                    <p><b>Dirección:</b> {{$proyecto->direccion}}</p>
                                                    <p><b>Tipo:</b> {{$proyecto->tipos->nombre}}</p>
                                                    <p><b>Inicio:</b> {{date("d-m-Y",strtotime($proyecto->created_at))}}</p>
                                                    <p><b>Administracion:</b> {{$proyecto->ad_administracion}}</p>
                                                    <br>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="row">
                                                        <div class="col-md-6" style="text-align: center;padding-left: 2.4rem;padding-bottom: 2.0rem">
                                                            @php
                                                                $imagenTipo = '/assets/front/images/obra-nueva.jpeg';
                                                                if($proyecto->tipos->imagen !== NULL){
                                                                    if(file_exists('storage/'.$proyecto->tipos->imagen)){
                                                                        $imagenTipo = '/storage/'.$proyecto->tipos->imagen;

                                                                    }
                                                                }
                                                            @endphp
                                                            
                                                            <img src="{{$imagenTipo}}" width="200" height="160" style="border-radius: 10px">
                                                            <br>
                                                            <b style="color: #153556">{{$proyecto->tipos->nombre}}</b>
                                                        </div>
                                                        <br>
                                                        <div class="col-md-6" style="text-align: center">
                                                            <div class="chart-circle chart-circle-lg" @if($proyecto->proceso == 100) data-value="1" @else data-value="0.{{$proyecto->proceso}}" @endif data-thickness="6" data-color="#153556"><div class="chart-circle-value">{{$proyecto->proceso}} %</div></div>
                                                            <b style="color: #153556">Proceso</b>
                                                        </div>
                                                        <br>
                                                        <div class="col-md-12 main_content">
                                                            <div id="mapa" class="content" style="border-radius: 10px; width: 450px; height: 200px;"></div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_content">
                                        <div class="tab_wrapper first_tab">
                                            <ul class="tab_list tab-fases-proyecto" style="  display:flex;
                                            white-space: nowrap;" >
                                                @foreach ($fases as $fase)
                                                    <li>{{$fase->nombre}}</li>
                                                @endforeach
                                            </ul>
                                            <div class="content_wrapper">
                                                @php
                                                    $arrayMapa = $proyecto->disciplinas->count();
                                                    $cuenta = 0;
                                                @endphp
                                                @foreach ($fases as $fase)
                                                    @if($fase->idfase == 6 || $fase->nombre == 'Complementarios')
                                                        <div class="tab_content" id="fase_{{$fase->idfase}}">
                                                            <div class="panel panel-primary">
                                                                <div class="tab_wrapper first_tab">
                                                                    <ul class="tab_list tab-disciplinas-proyecto" style="  display:flex;
                                                                    white-space: nowrap;">
                                                                        @foreach ($especialidades as $especialidad)
                                                                            <li>{{$especialidad->nombre}}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <div class="content_wrapper">
                                                                        @foreach ($especialidades as $especialidad)
                                                                            <div class="tab_content">
                                                                                <div class="panel panel-primary">
                                                                                    <div class="tab_wrapper first_tab">
                                                                                        <ul class="tab_list tab-disciplinas-proyecto" style="  display:flex;
                                                                                        white-space: nowrap;">
                                                                                            @foreach ($fases_disciplinas as $fase_disciplina)
                                                                                                @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                                    @foreach ($proyecto->disciplinas as $disciplinas)
                                                                                                        @if($disciplinas->pivot->idfase == $fase_disciplina->fase_id )
                                                                                                            @if ($disciplinas->iddisciplina == $fase_disciplina->disciplina_id)
                                                                                                                @foreach ($especialidad->servicios as $servicios)
                                                                                                                    @foreach ($servicios->disciplinas as $disciplinas)
                                                                                                                        @if($fase_disciplina->disciplina_id == $disciplinas->iddisciplina)
                                                                                                                            <li>
                                                                                                                                @php
                                                                                                                                    $explo = explode(' - ',$fase_disciplina->disciplina->nombre);
                                                                                                                                    $nombreDisci = $fase_disciplina->disciplina->nombre;
                                                                                                                                    if(count($explo) > 1){
                                                                                                                                        $nombreDisci = $explo[1];
                                                                                                                                    }
                                                                                                                                @endphp
                                                                                                                                {{$nombreDisci}}
                                                                                                                            </li>
                                                                                                                        @endif
                                                                                                                    @endforeach
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </ul>
                                                                                        <div class="content_wrapper">
                                                                                            @foreach ($fases_disciplinas as $fase_disciplina)
                                                                                                @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                                    @foreach ($proyecto->disciplinas as $disciplinas)
                                                                                                        @if($disciplinas->pivot->idfase == $fase_disciplina->fase_id )
                                                                                                            @if ($disciplinas->iddisciplina == $fase_disciplina->disciplina_id)
                                                                                                                @foreach ($especialidad->servicios as $servicios)
                                                                                                                    @foreach ($servicios->disciplinas as $disciplinas2)
                                                                                                                        @if($fase_disciplina->disciplina_id == $disciplinas2->iddisciplina)
                                                                                                                            <div class="tab_content">
                                                                                                                                <br>
                                                                                                                                <div class="row col-md-12" style="padding-top: 1.0rem">
                                                                                                                                    <div class="col-md-5">
                                                                                                                                        @if($disciplinas->pivot->tipo_contratista == NULL && $disciplinas->pivot->idcontratista == NULL )
                                                                                                                                            @if($user->hasRole('Cliente'))
                                                                                                                                                @if($cliente->idcliente == $user->iduserrelacion)

                                                                                                                                                    {!!Form::model($proyecto,array('url'=>'clientes/agregar-contratistas/'.$proyecto->idproyecto.'/'.$fase_disciplina->fase_id.'/'.$fase_disciplina->disciplina_id.'/'.$cliente->idcliente.'/agregar','method'=>'post','name'=>'formProyecto','id'=>'formProyecto_'.$fase_disciplina->fase_id.'_'.$fase_disciplina->disciplina_id))!!}
                                                            
                                                                                                                                                        <a data-toggle="modal" class="btn btn-facebook btn-sm" style="background-color: #153556; color: white" data-target="#exampleModal_{{$fase->idfase}}" onclick="showModal({id: {{$fase->idfase}}, disciplina: {{$disciplinas->iddisciplina}}})">+ Agregar Contratista</a>
                                                                                                                                                        <hr>
                                                                                                                                                        <div id="nuevos_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" style="display: none;">
                                                                                                                                                            <center><span class="avatar avatar-xxl brround" id="imagen_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"style="background-image: url(/assets/front/images/user-2.png);"></span>
                                                                                                                                                            <div id="nombre_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"></div></center>
                                                                                                                                                        </div>
                                                                                                                                                        <input type="hidden" name="cuenta" value="0"/>
                                                            
                                                                                                                                                        <input type="hidden" name="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0"/>
                                                                                                                                                        <input type="hidden" name="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                                                        <input type="hidden" name="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                                                        <input type="hidden" name="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                                                        <br>
                                                                                                                                                        <center>{!!Form::submit('Guardar contratista',array('class'=>'btn btn-facebook btn-sm','id'=>'submit_'.$fase_disciplina->fase_id.'_'.$fase_disciplina->disciplina_id,'style'=>'display: none; background-color: #153556'))!!}</center>
                                                                                                                                                    {!!Form::close()!!}
                                                                                                                                                @endif
                                                                                                                                            @endif
                                                                                                                                        @else
                                                                                                                                        @php
                                                                                                                                            $nombre = '';
                                                                                                                                            $rol = '';
                                                                                                                                            $correo = '';
                                                                                                                                            $url = '/assets/front/images/user-2.png';
                                                                                                                                            $ciudad = '';
                                                                                                                                            $celular = '';
                                                                                                                                            $perfil = '';
                                                
                                                
                                                                                                                                            if($disciplinas->pivot->tipo_contratista == 'freelancer'){
                                                                                                                                                $freelancer = \App\Models\Front\Freelancer::find($disciplinas->pivot->idcontratista);
                                                                                                                                                $nombre = $freelancer->nombres.' '.$freelancer->apellidos;
                                                                                                                                                $rol = 'Contratista (Freelancer)';
                                                                                                                                                $correo = $freelancer->email;
                                                                                                                                                $ciudad = $freelancer->ciudad_residencia;
                                                                                                                                                $celular = $freelancer->celular;
                                                                                                                                                $perfil = '/clientes/perfil-freelancer/'.$freelancer->idfreelancer;
                                                                                                                                                if($freelancer->image !== NULL){
                                                                                                                                                    $url = '/uploads/front/freelancer/general/'.$freelancer->idfreelancer.'/'.$freelancer->image;
                                                                                                                                                }
                                                                
                                                
                                                                                                                                            }elseif($disciplinas->pivot->tipo_contratista == 'proveedor'){
                                                                                                                                                $proveedor = \App\Models\Front\Proveedor::find($disciplinas->pivot->idcontratista);
                                                                                                                                                $nombre = $proveedor->nombre;
                                                                                                                                                $rol = 'Proveedor';
                                                                                                                                                $correo = $proveedor->email;
                                                                                                                                                $ciudad = $proveedor->ciudad_residencia;
                                                                                                                                                $celular = $proveedor->celular;
                                                                                                                                                $perfil = '/clientes/perfil-proveedor/'.$proveedor->idproveedor;
                                                
                                                                                                                                                if($proveedor->image !== NULL){
                                                                                                                                                    $url = '/uploads/front/proveedor/general/'.$proveedor->idproveedor.'/'.$proveedor->image;
                                                                                                                                                }
                                                                
                                                                
                                                                                                                                            }elseif($disciplinas->pivot->tipo_contratista == 'empresa'){
                                                                                                                                                $empresa = \App\Models\Front\Empresa::find($disciplinas->pivot->idcontratista);
                                                                                                                                                $nombre = $empresa->razon_social;
                                                                                                                                                $rol = 'Empresa';
                                                                                                                                                $correo = $empresa->email;
                                                                                                                                                $ciudad = $empresa->ciudad_residencia;
                                                                                                                                                $celular = $empresa->celular;
                                                                                                                                                $perfil = '/clientes/perfil-empresa/'.$empresa->idempresa;
                                                
                                                                                                                                                if($empresa->image !== NULL){
                                                                                                                                                    $url = '/uploads/front/empresa/general/'.$empresa->idempresa.'/'.$empresa->image;
                                                                                                                                                }
                                                                
                                                                
                                                                                                                                            }
                                                                                                                                        @endphp
                                                                                                                                        <div class="row" id="datos_{{$fase_disciplina->fase_id}}_{{$fase_disciplina->disciplina_id}}">
                                                                                                                                            <div class="col-md-12">
                                                                                                                                                <center><a href="{{$perfil}}" target="_blank" title="Ver Perfil"><span class="avatar avatar-xxl brround" style="background-image: url({{$url}})"></span></a></center>
                                                                                                                                                <br>
                                                                                                                                            </div>
                                                                                                                                            <br>
                                                
                                                                                                                                            <div class="col-md-12">
                                                                                                                                                <p><b>Nombre:</b> {{$nombre}}</p>
                                                                                                                                                <p><b>Rol:</b> {{$rol}}</p>
                                                                                                                                                <p><b>Correo:</b> {{$correo}}</p>
                                                                                                                                                <p><b>Ciudad:</b> {{$ciudad}}</p>
                                                                                                                                                <p><b>Celular:</b> {{$celular}}</p>                                                                                                                                                                        
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                            @if($user->hasRole('Cliente'))
                                                                                                                                                @if($cliente->idcliente == $user->iduserrelacion)
                                                                        
                                                                                                                                                    {!!Form::model($proyecto,array('url'=>'clientes/agregar-contratistas/'.$proyecto->idproyecto.'/'.$fase_disciplina->fase_id.'/'.$fase_disciplina->disciplina_id.'/'.$cliente->idcliente.'/agregar','method'=>'post','name'=>'formProyecto','id'=>'formProyecto_'.$fase_disciplina->fase_id.'_'.$fase_disciplina->disciplina_id))!!}
                                                            
                                                                                                                                                        <hr style="margin-top: 0.5rem;
                                                                                                                                                        margin-bottom: 0.5rem;">
                                                                                                                                                            <center><a data-toggle="modal" class="btn btn-facebook btn-sm" style="background-color: #153556; color: white" data-target="#exampleModal_{{$fase->idfase}}" onclick="showModal({id: {{$fase->idfase}}, disciplina: {{$disciplinas->iddisciplina}}})">Seleccionar Nuevo Contratista</a></center>
                                                                                                                                                        <hr style="margin-top: 0.5rem;
                                                                                                                                                        margin-bottom: 0.5rem;">
                            
                                                                                                                                                        <div id="nuevos_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" style="display: none;">
                                                                                                                                                            <center><span class="avatar avatar-xxl brround" id="imagen_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"style="background-image: url(/assets/front/images/avatar.png);"></span>
                                                                                                                                                            <div id="nombre_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"></div></center>
                                                                                                                                                        </div>
                                                                                                                                                        <input type="hidden" name="cuenta" value="0"/>
                                                            
                                                                                                                                                        <input type="hidden" name="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0"/>
                                                                                                                                                        <input type="hidden" name="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                                                        <input type="hidden" name="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                                                        <input type="hidden" name="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                                                        <br>
                                                                                                                                                        <center>{!!Form::submit('Guardar contratista',array('class'=>'btn btn-facebook btn-sm','id'=>'submit_'.$fase_disciplina->fase_id.'_'.$fase_disciplina->disciplina_id,'style'=>'display: none; background-color: #153556'))!!}</center>
                                                                                                                                                    {!!Form::close()!!}
                                                                                                                                                @endif
                                                                                                                                            @endif
                                                                                                                                        @endif
                                                                                                                                    </div>
                                                
                                                                                                                                    <div class="col-md-7">
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="col-md-6" style="text-align: center;padding-left: 2.4rem; padding-bottom: 2.0rem">
                                                                                                                                                @php
                                                                                                                                                    $imagenTipo = '/assets/front/images/obra-nueva.jpeg';
                                                                                                                                                    if($proyecto->tipos->imagen !== NULL){
                                                                                                                                                        if(file_exists('storage/'.$proyecto->tipos->imagen)){
                                                                                                                                                            $imagenTipo = '/storage/'.$proyecto->tipos->imagen;
                                                                                    
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                @endphp
                                                                                
                                                                                                                                                <img src="{{$imagenTipo}}" style="border-radius: 10px" width="200" height="160">
                                                                                                                                                <br>
                                                                                                                                                <b style="color: #153556">{{$proyecto->tipos->nombre}}</b>
                                                                                                                                            </div>
                                                                                                                                            <br>
                                                                                                                                            <div class="col-md-6" style="text-align: center">
                                                                                                                                                    <div class="chart-circle chart-circle-lg" @if($proyecto->proceso == 100) data-value="1" @else data-value="0.{{$proyecto->proceso}}" @endif data-thickness="6" data-color="#153556"><div class="chart-circle-value">{{$proyecto->proceso}} %</div></div>
                                                                                                                                                <b style="color: #153556">{{$disciplinas->nombre}}</b>
                                                                                                                                            </div>
                                                                                                                                            <br>
                                                                                                                                            <div class="col-md-12 main_content" style="text-align: center">
                                                                                                                                                <div id="mapa_{{$cuenta}}" class="content" style="border-radius: 10px;width: 450px; height: 200px;"></div>
                                                                                                                                            </div>
                                                                                                                                            
                                                                                                                                        </div>
                                                                                                                                        <br>
                                                                                                                                        <br>
                                                                                                                                        <br>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            @php
                                                                                                                                $cuenta = $cuenta+1;
                                                                                                                            @endphp
                                                                                                                        @endif
                                                                                                                    @endforeach
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <div id="exampleModal_{{$fase->idfase}}" class="multi-step"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="tab_content">
                                                            <div class="panel panel-primary">
                                                                <div class="tab_wrapper first_tab">
                                                                    <ul class="tab_list tab-disciplinas-proyecto" style="  display:flex;
                                                                    white-space: nowrap;">
                                                                        @foreach ($fases_disciplinas as $fase_disciplina)
                                                                            @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                @foreach ($proyecto->disciplinas as $disciplinas)
                                                                                    @if($disciplinas->pivot->idfase == $fase_disciplina->fase_id )
                                                                                        @if ($disciplinas->iddisciplina == $fase_disciplina->disciplina_id)
                                                                                            <li>{{$fase_disciplina->disciplina->nombre}}</li>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                    <div class="content_wrapper">
                                                                        @foreach ($fases_disciplinas as $fase_disciplina)
                                                                            @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                @foreach ($proyecto->disciplinas as $disciplinas)
                                                                                    @if($disciplinas->pivot->idfase == $fase_disciplina->fase_id )
                                                                                        @if ($disciplinas->iddisciplina == $fase_disciplina->disciplina_id)
                                                                                            <div class="tab_content">
                                                                                                <br>
                                                                                                <div class="row col-md-12" style="padding-top: 1.0rem">
                                                                                                    <div class="col-md-5">
                                                                                                        @if($disciplinas->pivot->tipo_contratista == NULL && $disciplinas->pivot->idcontratista == NULL )
                                                                                                            @if($user->hasRole('Cliente'))
                                                                                                                @if($cliente->idcliente == $user->iduserrelacion)

                                                                                                                    {!!Form::model($proyecto,array('url'=>'clientes/agregar-contratistas/'.$proyecto->idproyecto.'/'.$fase_disciplina->fase_id.'/'.$fase_disciplina->disciplina_id.'/'.$cliente->idcliente.'/agregar','method'=>'post','name'=>'formProyecto','id'=>'formProyecto_'.$fase_disciplina->fase_id.'_'.$fase_disciplina->disciplina_id))!!}
                            
                                                                                                                        <a data-toggle="modal" class="btn btn-facebook btn-sm" style="background-color: #153556; color: white" data-target="#exampleModal_{{$fase->idfase}}" onclick="showModal({id: {{$fase->idfase}}, disciplina: {{$disciplinas->iddisciplina}}})"> + Agregar Contratista</a>
                                                                                                                        <hr>
                                                                                                                        <div id="nuevos_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" style="display: none;">
                                                                                                                            <center><span class="avatar avatar-xxl brround" id="imagen_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"style="background-image: url(/assets/front/images/user-2.png);"></span>
                                                                                                                            <div id="nombre_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"></div></center>
                                                                                                                        </div>
                                                                                                                        <input type="hidden" name="cuenta" value="0"/>
                            
                                                                                                                        <input type="hidden" name="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0"/>
                                                                                                                        <input type="hidden" name="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                        <input type="hidden" name="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                        <input type="hidden" name="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                        <br>
                                                                                                                        <center>{!!Form::submit('Guardar contratista',array('class'=>'btn btn-facebook btn-sm','id'=>'submit_'.$fase_disciplina->fase_id.'_'.$fase_disciplina->disciplina_id,'style'=>'display: none; background-color: #153556'))!!}</center>
                                                                                                                    {!!Form::close()!!}
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @else
                                                                                                        @php
                                                                                                            $nombre = '';
                                                                                                            $rol = '';
                                                                                                            $correo = '';
                                                                                                            $url = '/assets/front/images/user-2.png';
                                                                                                            $ciudad = '';
                                                                                                            $celular = '';
                                                                                                            $perfil = '';
                
                
                                                                                                            if($disciplinas->pivot->tipo_contratista == 'freelancer'){
                                                                                                                $freelancer = \App\Models\Front\Freelancer::find($disciplinas->pivot->idcontratista);
                                                                                                                $nombre = $freelancer->nombres.' '.$freelancer->apellidos;
                                                                                                                $rol = 'Contratista (Freelancer)';
                                                                                                                $correo = $freelancer->email;
                                                                                                                $ciudad = $freelancer->ciudad_residencia;
                                                                                                                $celular = $freelancer->celular;
                                                                                                                $perfil = '/clientes/perfil-freelancer/'.$freelancer->idfreelancer;
                                                                                                                if($freelancer->image !== NULL){
                                                                                                                    $url = '/uploads/front/freelancer/general/'.$freelancer->idfreelancer.'/'.$freelancer->image;
                                                                                                                }
                                
                
                                                                                                            }elseif($disciplinas->pivot->tipo_contratista == 'proveedor'){
                                                                                                                $proveedor = \App\Models\Front\Proveedor::find($disciplinas->pivot->idcontratista);
                                                                                                                $nombre = $proveedor->nombre;
                                                                                                                $rol = 'Proveedor';
                                                                                                                $correo = $proveedor->email;
                                                                                                                $ciudad = $proveedor->ciudad_residencia;
                                                                                                                $celular = $proveedor->celular;
                                                                                                                $perfil = '/clientes/perfil-proveedor/'.$proveedor->idproveedor;
                
                                                                                                                if($proveedor->image !== NULL){
                                                                                                                    $url = '/uploads/front/proveedor/general/'.$proveedor->idproveedor.'/'.$proveedor->image;
                                                                                                                }
                                
                                
                                                                                                            }elseif($disciplinas->pivot->tipo_contratista == 'empresa'){
                                                                                                                $empresa = \App\Models\Front\Empresa::find($disciplinas->pivot->idcontratista);
                                                                                                                $nombre = $empresa->razon_social;
                                                                                                                $rol = 'Empresa';
                                                                                                                $correo = $empresa->email;
                                                                                                                $ciudad = $empresa->ciudad_residencia;
                                                                                                                $celular = $empresa->celular;
                                                                                                                $perfil = '/clientes/perfil-empresa/'.$empresa->idempresa;
                
                                                                                                                if($empresa->image !== NULL){
                                                                                                                    $url = '/uploads/front/empresa/general/'.$empresa->idempresa.'/'.$empresa->image;
                                                                                                                }
                                
                                
                                                                                                            }
                                                                                                        @endphp
                                                                                                        <div class="row" id="datos_{{$fase_disciplina->fase_id}}_{{$fase_disciplina->disciplina_id}}">
                                                                                                            <div class="col-md-12">
                                                                                                                <center><a href="{{$perfil}}" target="_blank" title="Ver Perfil"><span class="avatar avatar-xxl brround" style="background-image: url({{$url}})"></span></a></center>
                                                                                                                <br>
                                                                                                            </div>
                                                                                                            <br>
                
                                                                                                            <div class="col-md-12">
                                                                                                                <p><b>Nombre:</b> {{$nombre}}</p>
                                                                                                                <p><b>Rol:</b> {{$rol}}</p>
                                                                                                                <p><b>Correo:</b> {{$correo}}</p>
                                                                                                                <p><b>Ciudad:</b> {{$ciudad}}</p>
                                                                                                                <p><b>Celular:</b> {{$celular}}</p>                                                                                                                                                                        
                                                                                                            </div>
                                                                                                        </div>
                                                                                                            @if($user->hasRole('Cliente'))
                                                                                                                @if($cliente->idcliente == $user->iduserrelacion)
                                        
                                                                                                                    {!!Form::model($proyecto,array('url'=>'clientes/agregar-contratistas/'.$proyecto->idproyecto.'/'.$fase_disciplina->fase_id.'/'.$fase_disciplina->disciplina_id.'/'.$cliente->idcliente.'/agregar','method'=>'post','name'=>'formProyecto','id'=>'formProyecto_'.$fase_disciplina->fase_id.'_'.$fase_disciplina->disciplina_id))!!}
                            
                                                                                                                        <hr style="margin-top: 0.5rem;
                                                                                                                        margin-bottom: 0.5rem;">
                                                                                                                            <center><a data-toggle="modal" class="btn btn-facebook btn-sm" style="background-color: #153556; color: white" data-target="#exampleModal_{{$fase->idfase}}" onclick="showModal({id: {{$fase->idfase}}, disciplina: {{$disciplinas->iddisciplina}}})">Seleccionar Nuevo Contratista</a></center>
                                                                                                                        <hr style="margin-top: 0.5rem;
                                                                                                                        margin-bottom: 0.5rem;">
                                                                                                                        <div id="nuevos_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" style="display: none;">
                                                                                                                            <center><span class="avatar avatar-xxl brround" id="imagen_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"style="background-image: url(/assets/front/images/avatar.png);"></span>
                                                                                                                            <div id="nombre_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"></div></center>
                                                                                                                        </div>
                                                                                                                        <input type="hidden" name="cuenta" value="0"/>
                            
                                                                                                                        <input type="hidden" name="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0"/>
                                                                                                                        <input type="hidden" name="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                        <input type="hidden" name="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                        <input type="hidden" name="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                        <br>
                                                                                                                        <center>{!!Form::submit('Guardar contratista',array('class'=>'btn btn-facebook btn-sm','id'=>'submit_'.$fase_disciplina->fase_id.'_'.$fase_disciplina->disciplina_id,'style'=>'display: none; background-color: #153556'))!!}</center>
                                                                                                                    {!!Form::close()!!}
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    </div>
                
                                                                                                    <div class="col-md-7">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-6" style="text-align: center;padding-left: 2.4rem; padding-bottom: 2.0rem">
                                                                                                                @php
                                                                                                                    $imagenTipo = '/assets/front/images/obra-nueva.jpeg';
                                                                                                                    if($proyecto->tipos->imagen !== NULL){
                                                                                                                        if(file_exists('storage/'.$proyecto->tipos->imagen)){
                                                                                                                            $imagenTipo = '/storage/'.$proyecto->tipos->imagen;
                                                    
                                                                                                                        }
                                                                                                                    }
                                                                                                                @endphp
                                                
                                                                                                                <img src="{{$imagenTipo}}" style="border-radius: 10px" width="200" height="160">
                                                                                                                <br>
                                                                                                                <b style="color: #153556">{{$proyecto->tipos->nombre}}</b>
                                                                                                            </div>
                                                                                                            <br>
                                                                                                            <div class="col-md-6" style="text-align: center">
                                                                                                                    <div class="chart-circle chart-circle-lg" @if($proyecto->proceso == 100) data-value="1" @else data-value="0.{{$proyecto->proceso}}" @endif data-thickness="6" data-color="#153556"><div class="chart-circle-value">{{$proyecto->proceso}} %</div></div>
                                                                                                                <b style="color: #153556">{{$disciplinas->nombre}}</b>
                                                                                                            </div>
                                                                                                            <br>
                                                                                                            <div class="col-md-12 main_content"  style="text-align: center">
                                                                                                                <div id="mapa_{{$cuenta}}" class="content" style="border-radius: 10px;width: 450px; height: 200px;"></div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @php
                                                                                                $cuenta = $cuenta+1;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                    <div id="exampleModal_{{$fase->idfase}}" class="multi-step"></div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-blue ml-auto"
                        onclick="document.location.href='{{ URL::to('clientes/'.$user->iduserrelacion.'/'.$relacion.'/mis-proyectos') }}'">Volver</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
    //FUNCION CONTRATISTAS

    var fase = 0;
    var disciplina = 0;
    var faseSeleccion = 0;
    var disciplinaSeleccion = 0;
    var paso2 = '';
    var count = 0;

    function showModal(values){

        fase = values.id;
        disciplina = values.disciplina;
        $('#exampleModal_'+fase).modal('show');
        $('#results_'+fase).empty();

        $('#exampleModal_'+fase).MultiStep({
            title: 'Selección de contratista',
            data: [{
                content: `  <div class="form-group">
                                <label>Tipo de contratista</label>
                                <select class="form-control " name="tipo_contratista_${fase}" onchange="tipoContratista({fase: ${fase},disciplina: ${disciplina}});"id="tipo_contratista_${fase}" tabindex="-1" aria-hidden="true">
                                    <option label="Seleccione" selected></option>
                                    <option value="freelancer">Freelancer</option>
                                    <option value="empresa">Empresa</option>
                                    <option value="proveedor">Proveedor</option>
                                </select>
                            </div>
            `,
                label: '1'
            }, {
                content: step2(fase),
                label: '2'
            }],
            final: `<div id="final_${fase}"></div>`,
            finalLabel:'3',
            modalSize: 'lg',
            prevText: 'Volver',
            skipText: 'Saltar',
            nextText: 'Siguiente',
            finishText: 'Agregar a mi equipo',

        });
        $('.btn-next').click(function(){
            if($(this).html() == 'Agregar a mi equipo'){
                $(this).css('display','none');

            }
        });
        $('.btn-prev').click(function(){
            console.log('check');
            if($('.btn-next').html() == 'Siguiente'){
                $('.btn-next').css('display','block');

            }
        });

    }
    $(document).ready(function() {
        
    });

    function step2(fase){
        $('#contratista_'+fase).empty();

        return `<div id="results_${fase}">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th style="width:10%">Seleccionar</th>
                                <th style="text-align: center;">Contratista</th>
                                <th style="text-align: center;">Carrera / Enfoque</th>
                                <th style="text-align: center;">Ciudad</th>
                                <th style="text-align: center;">Imagen</th>
                            </tr>
                        </thead>
                        <tbody id="contratista_${fase}">
                        </tbody>
                    </table>
                </div>`;


    }
    function tipoContratista(values){
        faseSeleccion = values.fase;
        console.log(faseSeleccion);
        $('#contratista_'+faseSeleccion).empty();
        disciplinaSeleccion = values.disciplina;
        console.log(disciplinaSeleccion);

        var seleccion = $('#tipo_contratista_'+faseSeleccion).val();
        console.log(seleccion);
        $.ajax({
            url:`/api/tipo/${disciplinaSeleccion}/${seleccion}`,
            type:"GET",
            success:function(data){
                paso2 = '';
                if(seleccion == "freelancer"){
                    for (var i=0; i < data.length;i++){
                        if(data[i].image !== null){
                            url = `/uploads/front/freelancer/general/${data[i].idfreelancer}/${data[i].image}`;
                        }else{
                            url = `/assets/front/images/user-2.png`;
                        }
                        paso2 += `  <tr>
                                        <td style="text-align: center;">
                                            <label class="custom-control custom-radio" style="display:inline">
                                                <input type="radio" class="custom-control-input" name="idcontratista_${disciplinaSeleccion}_${faseSeleccion}" value="${data[i].idfreelancer}" onclick="finalStep({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data[i].idfreelancer}})">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].nombres} ${data[i].apellidos}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].fp_profesion} - ${data[i].fp_linea_enfoque_area}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].ciudad_residencia}
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="avatar avatar-md brround" style="background-image: url(${url});"></span>
                                        </td>

                                    </tr>`;
                    }

                }else if(seleccion == "empresa"){
                    for (var i=0; i < data.length;i++){
                        if(data[i].image !== null){
                            url = `/uploads/front/empresa/general/${data[i].idempresa}/${data[i].image}`;
                        }else{
                            url = `/assets/front/images/user-3.png`;
                        }

                        paso2 += `  <tr>
                                        <td style="text-align: center;">
                                            <label class="custom-control custom-radio" style="display:inline">
                                                <input type="radio" class="custom-control-input" name="idcontratista_${disciplinaSeleccion}_${faseSeleccion}" value="${data[i].idempresa}" onclick="finalStep({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data[i].idempresa}})">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].razon_social}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].fp_linea_enfoque_area}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].ciudad_residencia}
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="avatar avatar-md brround" style="background-image: url(${url});"></span>
                                        </td>

                                    </tr>`;
                    }
                }else{
                    for (var i=0; i < data.length;i++){
                        if(data[i].image !== null){
                            url = `/uploads/front/proveedor/general/${data[i].idproveedor}/${data[i].image}`;
                        }else{
                            url = `/assets/front/images/user-3.png`;
                        }

                        paso2 += `  <tr>
                                        <td style="text-align: center;">
                                            <label class="custom-control custom-radio" style="display:inline">
                                                <input type="radio" class="custom-control-input" name="idcontratista_${disciplinaSeleccion}_${faseSeleccion}" value="${data[i].idproveedor}" onclick="finalStep({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data[i].idproveedor}})">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].nombre}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].descripcion}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].ciudad_residencia}
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="avatar avatar-md brround" style="background-image: url(${url});"></span>
                                        </td>

                                    </tr>`;
                    }

                }
                $('#contratista_'+faseSeleccion).append(paso2);
            }    
        });

    }
    function finalStep(values){
        faseSeleccion = values.fase;
        disciplinaSeleccion = values.disciplina;
        var idfinal = values.id;
        seleccion = values.seleccion;
        $('#final_'+faseSeleccion).empty();

        $.ajax({
            url:`/api/idfinal/${idfinal}/${seleccion}/${disciplinaSeleccion}`,
            type:"GET",
            success:function(data){
                $('#final_'+faseSeleccion).empty();
                $('#nombre_'+disciplinaSeleccion+'_'+faseSeleccion).empty();

                $('#seleccion_del_catalogo_'+disciplinaSeleccion+'_'+faseSeleccion).empty();
                $('#tipo_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).empty();
                $('#idcontratista_'+disciplinaSeleccion+'_'+faseSeleccion).empty();
                $('#estado_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).empty();

                var final = '';
                if (seleccion == "freelancer"){
                    if(data.image !== null){
                        url = `/uploads/front/freelancer/general/${data.idfreelancer}/${data.image}`;
                    }else{
                        url = `/assets/front/images/user-2.png`;
                    }

                    final = `   <center><span class="avatar avatar-xxl brround" style="background-image: url(${url})"></span>
                                <p><b>${data.nombres} ${data.apellidos}</b></p>
                                <p>${data.fp_linea_enfoque_area}</p>
                                <a href="/clientes/perfil-freelancer/${data.idfreelancer}" target="_blank" class="btn btn-danger btn-sm">Ver Perfil</a>
                                <a class="btn btn-facebook" style="color: white" onclick="finalStep2({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data.idfreelancer}})">Agregar a mi equipo</a></center>`;
                }else if(seleccion == "empresa"){
                    if(data.image !== null){
                        url = `/uploads/front/empresa/general/${data.idempresa}/${data.image}`;
                    }else{
                        url = `/assets/front/images/user-3.png`;
                    }

                    final = `<center><span class="avatar avatar-xxl brround" style="background-image: url(${url})"></span>
                                <p><b>${data.razon_social}</b></p>
                                <p>${data.fp_linea_enfoque_area}</p>
                                <a href="/clientes/perfil-empresa/${data.idempresa}" target="_blank" class="btn btn-danger btn-sm">Ver Perfil</a>
                                <a class="btn btn-facebook" style="color: white" onclick="finalStep2({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data.idempresa}})">Agregar a mi equipo</a></center>`;

                }else{
                    if(data.image !== null){
                        url = `/uploads/front/proveedor/general/${data.idproveedor}/${data.image}`;
                    }else{
                        url = `/assets/front/images/user-3.png`;
                    }

                    final = `<center><span class="avatar avatar-xxl brround" style="background-image: url(${url})"></span>
                                <p><b>${data.nombre}</b></p>
                                <a href="/clientes/perfil-proveedor/${data.idproveedor}" target="_blank" class="btn btn-danger btn-sm">Ver Perfil</a>
                                <a class="btn btn-facebook" style="color: white" onclick="finalStep2({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data.idproveedor}})">Agregar a mi equipo</a></center>`;

                }

                $('#final_'+faseSeleccion).append(final);

            }
        });
    }

    function finalStep2(values){
        faseSeleccion = values.fase;
        disciplinaSeleccion = values.disciplina;
        var idfinal = values.id;
        seleccion = values.seleccion;


        $.ajax({
            url:`/api/idfinal/${idfinal}/${seleccion}/${disciplinaSeleccion}`,
            type:"GET",
            success:function(data){

                $('#nombre_'+disciplinaSeleccion+'_'+faseSeleccion).empty();

                $('#seleccion_del_catalogo_'+disciplinaSeleccion+'_'+faseSeleccion).empty();
                $('#tipo_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).empty();
                $('#idcontratista_'+disciplinaSeleccion+'_'+faseSeleccion).empty();
                $('#estado_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).empty();

                var final = '';
                if (seleccion == "freelancer"){
                    if(data.image !== null){
                        url = `/uploads/front/freelancer/general/${data.idfreelancer}/${data.image}`;
                    }else{
                        url = `/assets/front/images/user-2.png`;
                    }

                    $('#nombre_'+disciplinaSeleccion+'_'+faseSeleccion).append(`<p>${data.nombres} ${data.apellidos}</p>`); 
                    $('#imagen_'+disciplinaSeleccion+'_'+faseSeleccion).css("background-image", `url(${url})`); 

                    $('#seleccion_del_catalogo_'+disciplinaSeleccion+'_'+faseSeleccion).val(1);
                    $('#tipo_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).val(seleccion);
                    $('#idcontratista_'+disciplinaSeleccion+'_'+faseSeleccion).val(data.idfreelancer);
                    $('#estado_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).val("activo");

                }else if(seleccion == "empresa"){
                    if(data.image !== null){
                        url = `/uploads/front/empresa/general/${data.idempresa}/${data.image}`;
                    }else{
                        url = `/assets/front/images/user-3.png`;
                    }

                    $('#nombre_'+disciplinaSeleccion+'_'+faseSeleccion).append(`<p>${data.razon_social}</p>`); 
                    $('#imagen_'+disciplinaSeleccion+'_'+faseSeleccion).css("background-image", `url(${url})`); 

                    $('#seleccion_del_catalogo_'+disciplinaSeleccion+'_'+faseSeleccion).val(1);
                    $('#tipo_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).val(seleccion);
                    $('#idcontratista_'+disciplinaSeleccion+'_'+faseSeleccion).val(data.idempresa);
                    $('#estado_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).val("activo");

                }else{
                    if(data.image !== null){
                        url = `/uploads/front/proveedor/general/${data.idproveedor}/${data.image}`;
                    }else{
                        url = `/assets/front/images/user-3.png`;
                    }

                    $('#nombre_'+disciplinaSeleccion+'_'+faseSeleccion).append(`<p>${data.nombre}</p>`); 
                    $('#imagen_'+disciplinaSeleccion+'_'+faseSeleccion).css("background-image", `url(${url})`); 

                    $('#seleccion_del_catalogo_'+disciplinaSeleccion+'_'+faseSeleccion).val(1);
                    $('#tipo_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).val(seleccion);
                    $('#idcontratista_'+disciplinaSeleccion+'_'+faseSeleccion).val(data.idproveedor);
                    $('#estado_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).val("activo");

                }
                $('#nuevos_'+disciplinaSeleccion+'_'+faseSeleccion).show();
                $('#datos_'+faseSeleccion+'_'+disciplinaSeleccion).hide();

                $('#submit_'+faseSeleccion+'_'+disciplinaSeleccion).show();
                $('#exampleModal_'+faseSeleccion).modal('hide');

            }
        });
    }

    ///////////////////////////////////////////////////////////////
    var array = {{$arrayMapa}};
    console.log(array);

    for(var ma = 0; ma < array; ma++){
        showGoogleMaps2(ma);
    }

    function showGoogleMaps()
    {
        //Creamos el punto a partir de la latitud y longitud de una dirección:
        var point = {lng: {{$proyecto->ubicacion_longitud}}, lat: {{$proyecto->ubicacion_latitud}}};

        //Configuramos las opciones indicando zoom, punto y tipo de mapa
        var myOptions = {
            zoom: 15, 
            center: point, 
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        //Creamos el mapa y lo asociamos a nuestro contenedor
        var map = new google.maps.Map(document.getElementById("mapa"),  myOptions);

        //Mostramos el marcador en el punto que hemos creado
        var marker = new google.maps.Marker({
            position:point,
            map: map,
            title: "{{$proyecto->direccion}}"
        });
    }
    showGoogleMaps();

    function showGoogleMaps2(id)
    {
        //Creamos el punto a partir de la latitud y longitud de una dirección:
        var point = {lng: {{$proyecto->ubicacion_longitud}}, lat: {{$proyecto->ubicacion_latitud}}};

        //Configuramos las opciones indicando zoom, punto y tipo de mapa
        var myOptions = {
            zoom: 15, 
            center: point, 
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        //Creamos el mapa y lo asociamos a nuestro contenedor
        var map = new google.maps.Map(document.getElementById("mapa_"+id),  myOptions);

        //Mostramos el marcador en el punto que hemos creado
        var marker = new google.maps.Marker({
            position:point,
            map: map,
            title: "{{$proyecto->direccion}}"
        });
    }

    $(function(e) {
        $(".first_tab").champ({
            
        });

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



</script>
@stop