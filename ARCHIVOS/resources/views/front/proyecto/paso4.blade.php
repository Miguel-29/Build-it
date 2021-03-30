@extends('front.layouts.proyecto')
@section('content')
<div class="container">
    <div class="row">
        <img src="{{URL::to('assets/front/images/imagenes/b-crea-tu-proyecto.jpg')}}" alt="Crea tu proyecto">
    </div>
    <div class="row" style="background-color: white;">
        <div class="col-sm-12 col-md-6 col-lg-1"></div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase finished"><p class="center"><a>1</a></p></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase finished" ><p class="center"><a>2</a></p></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase finished" ><p class="center"><a>3</a></p></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase actual" ><p class="center">4</p></div>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="circleBase" ><p class="center">5</p></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1"></div>
    </div>

    <div class="row">
        <div class=""  style="width: 100%">
            <div class="card " style="background-color: #e4e4e4;
            box-shadow: 0 0 0; border-radius: 0;">
                <div class="card-header">
                    <div class="card-title">Escoge el equipo de trabajo que realizara tu proyecto</div>
                </div>
                <div class="card-body p-6">
                    <div class="wizard-container">
                        <div class="wizard-card m-0 tab-crear" data-color="blue" id="wizardProfile">
                            {!!Form::model($proyecto,array('url'=>'clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-4','method'=>'post','class'=>'form-horizontal','files'=>'true','name'=>'formProyecto','id'=>'formProyecto4'))!!}
                                <!-- Button to launch modal popover -->

                                @php
                                    $disciplinasEsp = [];
                                @endphp
                                <div class="wizard-navigation">
                                    <ul class="nav nav-pills">
                                        @foreach ($fases as $fase)
                                            @if($fase->idfase == 7 || $fase->nombre == 'Administración')
                                                <li><a href="#fase_{{$fase->idfase}}" data-toggle="tab">{{$fase->nombre}}</a></li>
                                            @endif
                                        @endforeach
                                        @foreach ($fases as $fase)
                                            @if($fase->idfase !== 7 || $fase->nombre !== 'Administración')
                                                <li><a href="#fase_{{$fase->idfase}}" data-toggle="tab">{{$fase->nombre}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    @foreach ($fases as $fase)
                                        @if($fase->idfase == 6)
                                            <div class="tab-pane" id="fase_{{$fase->idfase}}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-primary">
                                                            <div class="tab_wrapper first_tab">
                                                                <ul class="tab_list">
                                                                    @foreach ($especialidades as $especialidad)
                                                                        <li>{{$especialidad->nombre}}</li>
                                                                    @endforeach
                                                                        <li>Disciplinas</li>
                                                                </ul>
                                                                <div class="content_wrapper">
                                                                    @foreach ($especialidades as $especialidad)
                                                                        <div class="tab_content">
                                                                            <div class="input-group">
                                                                                <center><table class="table card-table" style="width:500px;" id="fase_disciplina_{{$fase->idfase}}">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Disciplinas Seleccionadas</th>
                                                                                            <th style="text-align: center;">¿Cuenta con Contratista?</th>
                                                                                            <th style="text-align: center;">Condicion</th>
                                                                                            <th style="text-align: center;">Selección de Contratista</th>
                    
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="add_{{$fase->idfase}}">
                                                                                        @foreach ($fases_disciplinas as $fase_disciplina)
                                                                                            @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                                @foreach ($proyecto->disciplinas as $disciplinas)
                                                                                                    @if($disciplinas->pivot->idfase == $fase_disciplina->fase_id )
                                                                                                        @if ($disciplinas->iddisciplina == $fase_disciplina->disciplina_id)
                                                                                                            @foreach ($especialidad->servicios as $servicios)
                                                                                                                @foreach ($servicios->disciplinas as $disciplinas)
                                                                                                                    @if($fase_disciplina->disciplina_id == $disciplinas->iddisciplina)
                                                                                                                    @php
                                                                                                                        $disciplinasEsp[] = $fase_disciplina->disciplina_id;
                                                                                                                    @endphp
                                                                                                                        <tr>
                                                                                                                            <td>
                                                                                                                                <label>
                                                                                                                                    <input type="hidden" name="informaciones[]" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                                                    <span name="nombres" id="disciplina_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                                                </label>
                                                                                                                            </td>
                                                                                                                            <td style="text-align: center;">
                                                                                                                                <label class="custom-control custom-radio" style="display:inline">
                                                                                                                                    <input type="radio" class="custom-control-input" name="cuenta_con_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="1" onclick="showOptions({fase: {{$fase_disciplina->fase_id}},disciplina: {{$fase_disciplina->disciplina_id}}})">
                                                                                                                                    <span class="custom-control-label">Si</span>
                                                                                                                                </label>
                                                                                                                                <label class="custom-control custom-radio" style="display:inline">
                                                                                                                                    <input type="radio" class="custom-control-input" name="cuenta_con_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0">
                                                                                                                                    <span class="custom-control-label">No</span>
                                                                                                                                </label>
                                                                                                                            </td>
                                                                                                                            <td style="text-align: center;">
                                                                                                                                <select style="background-color: transparent" name="tipo_contratista_{{$fase->idfase}}" id="tipo_contratista_{{$fase->idfase}}_{{$fase_disciplina->disciplina_id}}" onchange="tipoContratista({fase: {{$fase->idfase}},disciplina: {{$fase_disciplina->disciplina_id}}});" tabindex="-1" aria-hidden="true">
                                                                                                                                    <option label="Seleccione" selected></option>
                                                                                                                                    <option value="freelancer">Freelancer</option>
                                                                                                                                    <option value="empresa">Empresa</option>
                                                                                                                                    <option value="proveedor">Proveedor</option>
                                                                                                                                </select>
                                                                                                                            </td>
                                
                                                                                                                            <td style="text-align: center;">
                                                                                                                                <a data-toggle="modal" data-target="#exampleModal_{{$fase->idfase}}" onclick="showModal({id: {{$fase->idfase}}, disciplina: {{$fase_disciplina->disciplina_id}}})">
                                                                                                                                    <span class="avatar avatar-md brround" id="imagen_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"style="background-image: url(/assets/front/images/user-2.png);"></span>
                                                                                                                                    <div id="nombre_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"></div>
                                                                                                                                </a>
                                                                                                                                <input type="hidden" name="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0"/>
                                                                                                                                <input type="hidden" name="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                                <input type="hidden" name="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                                <input type="hidden" name="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            @endif
                                                                                        @endforeach
                    
                                                                                    </tbody>
                                                                                </table></center>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="tab_content">
                                                                        <div class="input-group">
                                                                            <center><table class="table card-table" style="width:500px;" id="fase_disciplina_{{$fase->idfase}}">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Disciplinas Seleccionadas</th>
                                                                                        <th style="text-align: center;">¿Cuenta con Contratista?</th>
                                                                                        <th style="text-align: center;">Condicion</th>
                                                                                        <th style="text-align: center;">Selección de Contratista</th>
                
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="add_{{$fase->idfase}}">
                                                                                    @foreach ($fases_disciplinas as $fase_disciplina)
                                                                                        @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                            @foreach ($proyecto->disciplinas as $disciplinas)
                                                                                                @if($disciplinas->pivot->idfase == $fase_disciplina->fase_id )
                                                                                                    @if ($disciplinas->iddisciplina == $fase_disciplina->disciplina_id)
                                                                                                        @if(!in_array($fase_disciplina->disciplina_id*1, $disciplinasEsp))
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <label>
                                                                                                                        <input type="hidden" name="informaciones[]" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                                        <span name="nombres" id="disciplina_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                                    </label>
                                                                                                                </td>
                                                                                                                <td style="text-align: center;">
                                                                                                                    <label class="custom-control custom-radio" style="display:inline">
                                                                                                                        <input type="radio" class="custom-control-input" name="cuenta_con_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="1" onclick="showOptions({fase: {{$fase_disciplina->fase_id}},disciplina: {{$fase_disciplina->disciplina_id}}})">
                                                                                                                        <span class="custom-control-label">Si</span>
                                                                                                                    </label>
                                                                                                                    <label class="custom-control custom-radio" style="display:inline">
                                                                                                                        <input type="radio" class="custom-control-input" name="cuenta_con_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0">
                                                                                                                        <span class="custom-control-label">No</span>
                                                                                                                    </label>
                                                                                                                </td>
                                                                                                                <td style="text-align: center;">
                                                                                                                    <select style="background-color: transparent" name="tipo_contratista_{{$fase->idfase}}" id="tipo_contratista_{{$fase->idfase}}_{{$fase_disciplina->disciplina_id}}" onchange="tipoContratista({fase: {{$fase->idfase}},disciplina: {{$fase_disciplina->disciplina_id}}});" tabindex="-1" aria-hidden="true">
                                                                                                                        <option label="Seleccione" selected></option>
                                                                                                                        <option value="freelancer">Freelancer</option>
                                                                                                                        <option value="empresa">Empresa</option>
                                                                                                                        <option value="proveedor">Proveedor</option>
                                                                                                                    </select>
                                                                                                                </td>
                    
                                                                                                                <td style="text-align: center;">
                                                                                                                    <a data-toggle="modal" data-target="#exampleModal_{{$fase->idfase}}" onclick="showModal({id: {{$fase->idfase}}, disciplina: {{$fase_disciplina->disciplina_id}}})">
                                                                                                                        <span class="avatar avatar-md brround" id="imagen_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"style="background-image: url(/assets/front/images/user-2.png);"></span>
                                                                                                                        <div id="nombre_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"></div>
                                                                                                                    </a>
                                                                                                                    <input type="hidden" name="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0"/>
                                                                                                                    <input type="hidden" name="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                    <input type="hidden" name="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                                    <input type="hidden" name="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                    
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @endif
                                                                                    @endforeach
                
                                                                                </tbody>
                                                                            </table></center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="exampleModal_{{$fase->idfase}}" class="modal fade color" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style=" right: 250px !important">
                                                            <div class="modal-dialog " role="document" style="width:370px;">
                                                                <div class="modal-content" style="background-color: #E1E1E1;">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Seleccion de contratista</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body_{{$fase->idfase}}">
                                                                        <div id="results_{{$fase->idfase}}">
                                                                            <table class="table card-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="width:10% ;border-bottom: 1px solid #153556 !important;border-right: 1px solid #153556 !important;">&nbsp;</th>
                                                                                        <th style="text-align: center; border-bottom: 1px solid #153556 !important;">Contratista</th>
                                                                                        <th style="text-align: center; border-bottom: 1px solid #153556 !important;">&nbsp;</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="contratista_{{$fase->idfase}}">
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="show_{{$fase->idfase}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="example-Modal3">Datos de contratista</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <label class="form-control-label" id="description_{{$fase->idfase}}"></label>
                                                                        <div class="form-group">
                                                                            <label class="form-control-label" >Tipo de Contratista</label>
                                                                            <select class="form-control " name="check_contratista_{{$fase->idfase}}" onchange="checkContratista({{$fase->idfase}});"id="check_contratista_{{$fase->idfase}}" tabindex="-1" aria-hidden="true">
                                                                                <option label="Seleccione" selected></option>
                                                                                <option value="freelancer">Freelancer</option>
                                                                                <option value="empresa">Empresa</option>
                                                                                <option value="proveedor">Proveedor</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Email:</label>
                                                                            <input type="email" class="form-control" id="check_email_{{$fase->idfase}}" name="check_email_{{$fase->idfase}}"readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Nombres y Apellidos / Razón Social:</label>
                                                                            <input type="text" class="form-control" id="check_nombres_{{$fase->idfase}}" name="check_nombres_{{$fase->idfase}}" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Teléfono o celular de contacto:</label>
                                                                            <input type="text" class="form-control" id="check_telefono_{{$fase->idfase}}" name="check_telefono_{{$fase->idfase}}" readonly>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" value="cerrar">Cerrar</button>
                                                                        <button type="button" class="btn btn-primary" value="guardar" id="check_status_{{$fase->idfase}}" >Guardar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                                    </div>
                                                </div>
                                            </div>

                                        @else
                                            <div class="tab-pane" id="fase_{{$fase->idfase}}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <center><table class="table card-table" style="width:500px;" id="fase_disciplina_{{$fase->idfase}}">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Disciplinas Seleccionadas</th>
                                                                        <th style="text-align: center;">¿Cuenta con Contratista?</th>
                                                                        <th style="text-align: center;">Condicion</th>
                                                                        <th style="text-align: center;">Selección de Contratista</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="add_{{$fase->idfase}}">
                                                                    @foreach ($fases_disciplinas as $fase_disciplina)
                                                                        @if($fase_disciplina->fase_id == $fase->idfase)
                                                                            @foreach ($proyecto->disciplinas as $disciplinas)
                                                                                @if($disciplinas->pivot->idfase == $fase_disciplina->fase_id )
                                                                                    @if ($disciplinas->iddisciplina == $fase_disciplina->disciplina_id)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <label>
                                                                                                    <input type="hidden" name="informaciones[]" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                    <span name="nombres" id="disciplina_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                </label>
                                                                                            </td>
                                                                                            <td style="text-align: center;">
                                                                                                <label class="custom-control custom-radio" style="display:inline">
                                                                                                    <input type="radio" class="custom-control-input" name="cuenta_con_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="1" onclick="showOptions({fase: {{$fase_disciplina->fase_id}},disciplina: {{$fase_disciplina->disciplina_id}}})">
                                                                                                    <span class="custom-control-label">Si</span>
                                                                                                </label>
                                                                                                <label class="custom-control custom-radio" style="display:inline">
                                                                                                    <input type="radio" class="custom-control-input" name="cuenta_con_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0">
                                                                                                    <span class="custom-control-label">No</span>
                                                                                                </label>
                                                                                            </td>
                                                                                            <td style="text-align: center;">
                                                                                                <select style="background-color: transparent" name="tipo_contratista_{{$fase->idfase}}" @if($fase->idfase !== 5 ) onchange="tipoContratista({fase: {{$fase->idfase}},disciplina: {{$fase_disciplina->disciplina_id}}});"  @else onchange="revision({fase: {{$fase->idfase}},disciplina: {{$fase_disciplina->disciplina_id}}});" @endif id="tipo_contratista_{{$fase->idfase}}_{{$fase_disciplina->disciplina_id}}"  tabindex="-1" aria-hidden="true">
                                                                                                    <option label="Seleccione" selected></option>
                                                                                                    <option value="freelancer">Freelancer</option>
                                                                                                    <option value="empresa">Empresa</option>
                                                                                                    @if($fase->idfase !== 5)
                                                                                                        <option value="proveedor">Proveedor</option>
                                                                                                    @endif
                                                                                                </select>
                                                                                            </td>
                                                                                            <td style="text-align: center;">
                                                                                                <a data-toggle="modal" data-target="#exampleModal_{{$fase->idfase}}" onclick="showModal({id: {{$fase->idfase}}, disciplina: {{$fase_disciplina->disciplina_id}}})">
                                                                                                    <span class="avatar avatar-md brround" id="imagen_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"style="background-image: url(/assets/front/images/user-2.png);"></span>
                                                                                                    <div id="nombre_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}"></div>
                                                                                                </a>
                                                                                                <input type="hidden" name="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="seleccion_del_catalogo_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value="0"/>
                                                                                                <input type="hidden" name="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="tipo_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                <input type="hidden" name="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="idcontratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>
                                                                                                <input type="hidden" name="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" id="estado_contratista_{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}" value=""/>

                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table></center>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="exampleModal_{{$fase->idfase}}" class="modal fade color" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style=" right: 250px !important">
                                                    <div class="modal-dialog " role="document" style="width:370px;">
                                                        <div class="modal-content" style="background-color: #E1E1E1;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Seleccion de contratista</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body_{{$fase->idfase}}">
                                                                <div id="results_{{$fase->idfase}}">
                                                                    <table class="table card-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width:10% ;border-bottom: 1px solid #153556 !important;border-right: 1px solid #153556 !important;">&nbsp;</th>
                                                                                <th style="text-align: center; border-bottom: 1px solid #153556 !important;">Contratista</th>
                                                                                <th style="text-align: center; border-bottom: 1px solid #153556 !important;">&nbsp;</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="contratista_{{$fase->idfase}}">
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="show_{{$fase->idfase}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="example-Modal3">Datos de contratista</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label class="form-control-label" id="description_{{$fase->idfase}}"></label>
                                                                <div class="form-group">
                                                                    <label class="form-control-label" >Tipo de Contratista</label>
                                                                    <select class="form-control " name="check_contratista_{{$fase->idfase}}" onchange="checkContratista({{$fase->idfase}});"id="check_contratista_{{$fase->idfase}}" tabindex="-1" aria-hidden="true">
                                                                        <option label="Seleccione" selected></option>
                                                                        <option value="freelancer">Freelancer</option>
                                                                        <option value="empresa">Empresa</option>
                                                                        <option value="proveedor">Proveedor</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Email:</label>
                                                                    <input type="email" class="form-control" id="check_email_{{$fase->idfase}}" name="check_email_{{$fase->idfase}}"readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Nombres y Apellidos / Razón Social:</label>
                                                                    <input type="text" class="form-control" id="check_nombres_{{$fase->idfase}}" name="check_nombres_{{$fase->idfase}}" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Teléfono o celular de contacto:</label>
                                                                    <input type="text" class="form-control" id="check_telefono_{{$fase->idfase}}" name="check_telefono_{{$fase->idfase}}" readonly>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" value="cerrar">Cerrar</button>
                                                                <button type="button" class="btn btn-primary" id="check_status_{{$fase->idfase}}" value="guardar" >Guardar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <br>
                                                <p><b>Nota:</b> Si tienes contratista haznolo saber queremos poder contar con el en nuestra plataforma, de lo contrario entra a nuestro directorio, contamos con los mejores profesionales en cada campo.</p>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-primary btn-wd m-0' name='next' value='SIGUIENTE' />
                                        <input type='button' class='btn btn-finish btn-fill btn-success btn-wd m-0' name="finish" id="finish" value='GUARDAR' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd m-0' name='previous' value='ANTERIOR' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            {!!Form::close()!!}
                        </div>
                    </div> <!-- wizard container -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
    var disciplinas = 0;
    var fases = 0;
    function showOptions(val){
        fases = val.fase;
        disciplinas = val.disciplina;
        nombre = $('#disciplina_'+disciplinas+'_'+fases).text();
        $('#description_'+fases).text(`Si ya cuentas con un contratista para "${nombre}", por favor, bríndanos su información de contacto para verificar si hace parte de Build it:`);
        $("#check_nombres_"+fases).val(null);
        $("#check_email_"+fases).val(null);
        $("#check_contratista_"+fases).val(null);
        $("#check_telefono_"+fases).val(null);
        $("#check_status_"+fases).text('Guardar');
        $("#check_status_"+fases).val('guardar');

        $('#show_'+fases).modal('show');

    }
    function checkContratista(value){
        var id = 0;
        var imagen = '';

        $("#check_email_"+value).removeAttr("readonly");
        contratistaSeleccion = $("#check_contratista_"+value).val();
        $('#check_email_'+value).on('change',function(e){
        email = $(this).val();
            $.ajax({
                url:`/api/check-email/${disciplinas}/${email}/${contratistaSeleccion}`,
                type:"GET",
                success:function(data){
                    if(data.status == "exist")
                    {
                        if(contratistaSeleccion == "empresa"){
                            id = data.contratista.idempresa;
                            if(data.contratista.image !== null){
                                imagen = `/uploads/front/empresa/general/${id}/${data.contratista.image}`;
                            }else{
                                imagen = `/assets/front/images/user-3.png`;
                            }
                            $("#check_nombres_"+value).val(`${data.contratista.razon_social}`);
                            $("#check_telefono_"+value).val(`${data.contratista.celular}`);
                        }else if(contratistaSeleccion == "freelancer"){
                            id = data.contratista.idfreelancer;
                            if(data.contratista.image !== null){
                                imagen = `/uploads/front/freelancer/general/${id}/${data.contratista.image}`;
                            }else{
                                imagen = `/assets/front/images/user-2.png`;
                            }
                            $("#check_nombres_"+value).val(`${data.contratista.nombres} ${data.contratista.apellidos}`);
                            $("#check_telefono_"+value).val(`${data.contratista.celular}`);
                        }else{
                            id = data.contratista.idproveedor;
                            if(data.contratista.image !== null){
                                imagen = `/uploads/front/proveedor/general/${id}/${data.contratista.image}`;
                            }else{
                                imagen = `/assets/front/images/user-3.png`;
                            }
                            $("#check_nombres_"+value).val(`${data.contratista.nombre}`);
                            $("#check_telefono_"+value).val(`${data.contratista.celular}`);

                        }
                        $("#check_status_"+value).text('Agregar a mi equipo');
                        $("#check_status_"+value).val('agregar');

                    }else{
                        $("#check_status_"+value).text('Guardar');
                        $("#check_status_"+value).val('guardar');
                        $("#check_nombres_"+value).val(null);
                        $("#check_telefono_"+value).val(null);
                        $("#check_nombres_"+value).removeAttr("readonly");
                        $("#check_telefono_"+value).removeAttr("readonly");


                    }

                }
            });

        });

        $("#check_status_"+value).click(function(event) {
            if(!event.detail || event.detail == 1){
                if($(this).val() == "guardar"){
                    console.log("Submit Detected");
                    nombres = $("#check_nombres_"+value).val();
                    celular = $("#check_telefono_"+value).val();
                    correo = $("#check_email_"+value).val();
                    contratista = $("#check_contratista_"+value).val();

                    var save = {
                        "_token": "{{ csrf_token() }}",
                        "idproyecto": "{{ $idproyecto }}",
                        "idcliente": "{{ $idcliente }}",
                        "iddisciplina": disciplinas,
                        "idfase" : value,
                        "tipo_contratista": contratista,
                        "nombres": nombres,
                        "correo": correo,
                        "celular": celular,
                    };
                    $.ajax({
                        data:  save, 
                        url:   '/clientes/contacto/save', //
                        type:  'post', 
                        success:  function (data) { 
                            swal({
                                title: "Contacto guardado!",
                                html: "Pronto nos comunicaremos para explicarte el paso a seguir",
                                type: "success"
                            });
                            $('#nombre_'+disciplinas+'_'+value).append(`<p>Contratista Guardado</p>`); 
                        },
                        error: function(error) {
                            swal({
                                title: "Error!",
                                html: "Error guardando el contacto",
                                type: "error",
                            });

                        }
                    });

                }else{
                    nombres = $("#check_nombres_"+value).val();
                    contratista = $("#check_contratista_"+value).val();
                    //LIMPIAR DATOS ANTERIORES
                    $('#nombre_'+disciplinas+'_'+value).empty();
                    $('#seleccion_del_catalogo_'+disciplinas+'_'+value).empty();
                    $('#tipo_contratista_'+disciplinas+'_'+value).empty();
                    $('#idcontratista_'+disciplinas+'_'+value).empty();
                    $('#estado_contratista_'+disciplinas+'_'+value).empty();
                    //AGREGAR DATOS
                    $('#nombre_'+disciplinas+'_'+value).append(nombres); 
                    $('#imagen_'+disciplinas+'_'+value).css("background-image", `url(${imagen})`); 
                    $('#seleccion_del_catalogo_'+disciplinas+'_'+value).val(1);
                    $('#tipo_contratista_'+disciplinas+'_'+value).val(contratista);
                    $('#idcontratista_'+disciplinas+'_'+value).val(id);
                    $('#estado_contratista_'+disciplinas+'_'+value).val("activo");

                    swal({
                        title: "Agregado a tu equipo!",
                        type: "success"
                    });

                }
            }
            $('#show_'+value).modal('hide');
        });


    }

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

    var fase = 0;
    var disciplina = 0;
    var faseSeleccion = 0;
    var disciplinaSeleccion = 0;
    var paso2 = '';
    function showModal(values){

        fase = values.id;
        disciplina = values.disciplina;
        console.log(disciplina);
        $('#exampleModal_'+fase).modal('show');
        /*$('#exampleModal_'+fase).MultiStep({
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
        });*/
    }

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
        disciplinaSeleccion = values.disciplina;
        console.log(disciplinaSeleccion);
        $('#contratista_'+faseSeleccion).empty();
        console.log('#contratista_'+faseSeleccion);
        var seleccion = $('#tipo_contratista_'+faseSeleccion+'_'+disciplinaSeleccion).val();
        console.log(seleccion);
        $.ajax({
            url:`/api/tipo/${disciplinaSeleccion}/${seleccion}`,
            type:"GET",
            success:function(data){
                console.log(data);
                paso2 = '';
                if(seleccion == "freelancer"){
                    for (var i=0; i < data.length;i++){
                        if(data[i].image !== null){
                            url = `/uploads/front/freelancer/general/${data[i].idfreelancer}/${data[i].image}`;
                        }else{
                            url = `/assets/front/images/user-2.png`;
                        }
                        var newHtml = `<div class='row justify-content-md-center'  style='width: 340px;'>
                                            <span class='avatar avatar-md brround' style='background-image: url(${url});width: 6rem;height: 6rem;'></span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p><b style='font-size: 18px;color: #153556'>${data[i].nombres} ${data[i].apellidos}</b></p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].fp_linea_enfoque_area}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].email}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='font-size: 10px; color: black'>${data[i].celular}</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='color: #153556'>____________________________</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <a  href='/clientes/perfil-freelancer/${data[i].idfreelancer}' target='_blank' style='color: white' class='btn btn-facebook btn-pill btn-sm'>Ver Perfil</button>
                                            <a onclick='saveAllSteps({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: &quot;${seleccion}&quot;,id: ${data[i].idfreelancer}})'  style='color: white' class='btn btn-facebook btn-pill btn-sm'>Añadir a mi equipo</button>

                                        </div>`;
                        paso2 += `  <tr>
                                        <td style="text-align: center; border-right: 1px solid #153556 !important;">
                                            <label class="custom-control custom-radio" style="display:inline">
                                                <input type="radio" class="custom-control-input" name="idcontratista_${disciplinaSeleccion}_${faseSeleccion}" value="${data[i].idfreelancer}" onclick="finalStep({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data[i].idfreelancer}})">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: right; color: #153556">
                                            <b style="font-size: 18px";>${data[i].nombres} ${data[i].apellidos}</b>
                                            <p style="font-size: 10px; color: black">${data[i].fp_profesion} - ${data[i].fp_linea_enfoque_area}</p>
                                        </td>
                                        <!--<td style="text-align: center;">
                                            ${data[i].fp_profesion} - ${data[i].fp_linea_enfoque_area}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].ciudad_residencia}
                                        </td>-->
                                        <td style="text-align: center;">
                                            <span class="avatar avatar-md brround" style="background-image: url(${url});"></span>
                                            <span  data-html="true" id="notice_${disciplinaSeleccion}_${data[i].idfreelancer}"  data-toggle="popover" title="Freelancer" data-trigger="focus" data-content="${newHtml}"></span>

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
                        var newHtml = `<div class='row justify-content-md-center'  style='width: 340px;'>
                                            <span class='avatar avatar-md brround' style='background-image: url(${url});width: 6rem;height: 6rem;'></span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p><b style='font-size: 18px;color: #153556'>${data[i].razon_social}</b></p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].fp_linea_enfoque_area}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].email}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='font-size: 10px; color: black'>${data[i].celular}</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='color: #153556'>____________________________</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <a  href='/clientes/perfil-empresa/${data[i].idempresa}' target='_blank' style='color: white' class='btn btn-facebook btn-pill btn-sm'>Ver Perfil</button>
                                            <a onclick='saveAllSteps({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: &quot;${seleccion}&quot;,id: ${data[i].idempresa}})' style='color: white' class='btn btn-facebook btn-pill btn-sm'>Añadir a mi equipo</button>

                                        </div>`;
                        paso2 += `  <tr>
                                        <td style="text-align: center; border-right: 1px solid #153556 !important;">
                                            <label class="custom-control custom-radio" style="display:inline">
                                                <input type="radio" class="custom-control-input" name="idcontratista_${disciplinaSeleccion}_${faseSeleccion}" value="${data[i].idempresa}" onclick="finalStep({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data[i].idempresa}})">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: right; color: #153556">
                                            <b style="font-size: 18px";>${data[i].razon_social}</b>
                                            <p style="font-size: 10px; color: black"> ${data[i].fp_linea_enfoque_area}</p>
                                        </td>
                                        <!--<td style="text-align: center;">
                                            ${data[i].fp_linea_enfoque_area}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].ciudad_residencia}
                                        </td>-->
                                        <td style="text-align: center;">
                                            <span class="avatar avatar-md brround" style="background-image: url(${url});"></span>
                                            <span  data-html="true" id="notice_${disciplinaSeleccion}_${data[i].idempresa}"  data-toggle="popover" title="Empresa" data-trigger="focus" data-content="${newHtml}"></span>

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

                        var newHtml = `<div class='row justify-content-md-center'  style='width: 340px;'>
                                            <span class='avatar avatar-md brround' style='background-image: url(${url});width: 6rem;height: 6rem;'></span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p><b style='font-size: 18px;color: #153556'>${data[i].nombre}</b></p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].descripcion}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].email}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='font-size: 10px; color: black'>${data[i].celular}</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='color: #153556'>____________________________</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <a  href='/clientes/perfil-proveedor/${data[i].idproveedor}' target='_blank' style='color: white' class='btn btn-facebook btn-pill btn-sm'>Ver Perfil</button>
                                            <a  onclick='saveAllSteps({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: &quot;${seleccion}&quot;,id: ${data[i].idproveedor}})' style='color: white' class='btn btn-facebook btn-pill btn-sm'>Añadir a mi equipo</button>

                                        </div>`;
                        paso2 += `  <tr>
                                        <td style="text-align: center; border-right: 1px solid #153556 !important;">
                                            <label class="custom-control custom-radio" style="display:inline">
                                                <input type="radio" class="custom-control-input" name="idcontratista_${disciplinaSeleccion}_${faseSeleccion}" value="${data[i].idproveedor}" onclick="finalStep({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data[i].idproveedor}})">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: right; color: #153556">
                                            <b style="font-size: 18px";>${data[i].nombre}</b>
                                            <p style="font-size: 10px; color: black"> ${data[i].descripcion}</p>

                                        </td>
                                        <!--<td style="text-align: center;">
                                            ${data[i].descripcion}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].ciudad_residencia}
                                        </td>-->
                                        <td style="text-align: center;">
                                            <span class="avatar avatar-md brround" style="background-image: url(${url});"></span>
                                            <span  data-html="true" id="notice_${disciplinaSeleccion}_${data[i].idproveedor}"  data-toggle="popover" title="Proveedor" data-trigger="focus" data-content="${newHtml}"></span>

                                        </td>

                                    </tr>`;
                    }

                }
                $('#contratista_'+faseSeleccion).append(paso2);

                //$('#contratista_'+faseSeleccion).append(paso2);
            }    
        });

    }

    function revision(values){
        faseSeleccion = values.fase;
        console.log(faseSeleccion);
        disciplinaSeleccion = values.disciplina;
        console.log(disciplinaSeleccion);
        $('#contratista_'+faseSeleccion).empty();
        console.log('#contratista_'+faseSeleccion);
        var seleccion = $('#tipo_contratista_'+faseSeleccion+'_'+disciplinaSeleccion).val();
        console.log(seleccion);
        $.ajax({
            url:`/api/fase-revision/${disciplinaSeleccion}/${seleccion}`,
            type:"GET",
            success:function(data){
                console.log(data);
                paso2 = '';
                if(seleccion == "freelancer"){
                    for (var i=0; i < data.length;i++){
                        if(data[i].image !== null){
                            url = `/uploads/front/freelancer/general/${data[i].idfreelancer}/${data[i].image}`;
                        }else{
                            url = `/assets/front/images/user-2.png`;
                        }
                        var newHtml = `<div class='row justify-content-md-center'  style='width: 340px;'>
                                            <span class='avatar avatar-md brround' style='background-image: url(${url});width: 6rem;height: 6rem;'></span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p><b style='font-size: 18px;color: #153556'>${data[i].nombres} ${data[i].apellidos}</b></p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].fp_linea_enfoque_area}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].email}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='font-size: 10px; color: black'>${data[i].celular}</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='color: #153556'>____________________________</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <a  href='/clientes/perfil-freelancer/${data[i].idfreelancer}' target='_blank' style='color: white' class='btn btn-facebook btn-pill btn-sm'>Ver Perfil</button>
                                            <a onclick='saveAllSteps({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: &quot;${seleccion}&quot;,id: ${data[i].idfreelancer}})'  style='color: white' class='btn btn-facebook btn-pill btn-sm'>Añadir a mi equipo</button>

                                        </div>`;
                        paso2 += `  <tr>
                                        <td style="text-align: center; border-right: 1px solid #153556 !important;">
                                            <label class="custom-control custom-radio" style="display:inline">
                                                <input type="radio" class="custom-control-input" name="idcontratista_${disciplinaSeleccion}_${faseSeleccion}" value="${data[i].idfreelancer}" onclick="finalStep2({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data[i].idfreelancer},seleccionDisciplina: ${data[i].disc}})">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: right; color: #153556">
                                            <b style="font-size: 18px";>${data[i].nombres} ${data[i].apellidos}</b>
                                            <p style="font-size: 10px; color: black">${data[i].fp_profesion} - ${data[i].fp_linea_enfoque_area}</p>
                                        </td>
                                        <!--<td style="text-align: center;">
                                            ${data[i].fp_profesion} - ${data[i].fp_linea_enfoque_area}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].ciudad_residencia}
                                        </td>-->
                                        <td style="text-align: center;">
                                            <span class="avatar avatar-md brround" style="background-image: url(${url});"></span>
                                            <span  data-html="true" id="notice_${disciplinaSeleccion}_${data[i].idfreelancer}_${data[i].disc}"  data-toggle="popover" title="Freelancer" data-trigger="focus" data-content="${newHtml}"></span>

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
                        var newHtml = `<div class='row justify-content-md-center'  style='width: 340px;'>
                                            <span class='avatar avatar-md brround' style='background-image: url(${url});width: 6rem;height: 6rem;'></span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p><b style='font-size: 18px;color: #153556'>${data[i].razon_social}</b></p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].fp_linea_enfoque_area}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <p style='font-size: 10px; color: black'>${data[i].email}</p>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='font-size: 10px; color: black'>${data[i].celular}</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <span style='color: #153556'>____________________________</span>
                                        </div>
                                        <div class='row justify-content-md-center' >
                                            <a  href='/clientes/perfil-empresa/${data[i].idempresa}' target='_blank' style='color: white' class='btn btn-facebook btn-pill btn-sm'>Ver Perfil</button>
                                            <a onclick='saveAllSteps({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: &quot;${seleccion}&quot;,id: ${data[i].idempresa}})' style='color: white' class='btn btn-facebook btn-pill btn-sm'>Añadir a mi equipo</button>

                                        </div>`;
                        paso2 += `  <tr>
                                        <td style="text-align: center; border-right: 1px solid #153556 !important;">
                                            <label class="custom-control custom-radio" style="display:inline">
                                                <input type="radio" class="custom-control-input" name="idcontratista_${disciplinaSeleccion}_${faseSeleccion}" value="${data[i].idempresa}" onclick="finalStep2({fase: ${faseSeleccion},disciplina: ${disciplinaSeleccion},seleccion: '${seleccion}',id: ${data[i].idempresa},seleccionDisciplina: ${data[i].disc}})">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: right; color: #153556">
                                            <b style="font-size: 18px";>${data[i].razon_social}</b>
                                            <p style="font-size: 10px; color: black"> ${data[i].fp_linea_enfoque_area}</p>
                                        </td>
                                        <!--<td style="text-align: center;">
                                            ${data[i].fp_linea_enfoque_area}
                                        </td>
                                        <td style="text-align: center;">
                                            ${data[i].ciudad_residencia}
                                        </td>-->
                                        <td style="text-align: center;">
                                            <span class="avatar avatar-md brround" style="background-image: url(${url});"></span>
                                            <span  data-html="true" id="notice_${disciplinaSeleccion}_${data[i].idempresa}_${data[i].disc}"  data-toggle="popover" title="Empresa" data-trigger="focus" data-content="${newHtml}"></span>

                                        </td>

                                    </tr>`;
                    }
                }
                $('#contratista_'+faseSeleccion).append(paso2);

                //$('#contratista_'+faseSeleccion).append(paso2);
            }    
        });

    }

    var idpop = 0;
    function finalStep(values){
        faseSeleccion = values.fase;
        disciplinaSeleccion = values.disciplina;
        var idfinal = values.id;
        seleccion = values.seleccion;
        if(idpop !== 0){
            $('#notice_'+disciplinaSeleccion+'_'+idpop).popover('hide');

        }
        $('#notice_'+disciplinaSeleccion+'_'+idfinal).popover('show');
        idpop = idfinal;

        $('#final_'+faseSeleccion).empty();
    }
    var idco = 0;
    var iddis = 0;
    function finalStep2(values){
        faseSeleccion = values.fase;
        disciplinaSeleccion = values.disciplina;
        console.log(values.seleccionDisciplina);
        var idfinal = values.id;
        var iddiscseleccion = values.seleccionDisciplina;
        seleccion = values.seleccion;
        if(idco !== 0 && iddis !== 0){
            $('#notice_'+disciplinaSeleccion+'_'+idco+'_'+iddis).popover('hide');

        }
        $('#notice_'+disciplinaSeleccion+'_'+idfinal+'_'+iddiscseleccion).popover('show');
        idco = idfinal;
        iddis = iddiscseleccion;

        $('#final_'+faseSeleccion).empty();
    }

    function saveAllSteps(values){
        faseSeleccion = values.fase;
        disciplinaSeleccion = values.disciplina;
        var idfinal = values.id;
        seleccion = values.seleccion;

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
                console.log(seleccion);
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
                                <a href="/clientes/perfil-freelancer/${data.idfreelancer}" target="_blank" class="btn btn-danger btn-sm">Ver Perfil</a></center>`
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

                    final = `<center><span class="avatar avatar-xxl brround" style="background-image: url(${url})"></span>
                                <p><b>${data.razon_social}</b></p>
                                <p>${data.fp_linea_enfoque_area}</p>
                                <a href="/clientes/perfil-empresa/${data.idempresa}" target="_blank" class="btn btn-danger btn-sm">Ver Perfil</a></center>`
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

                    final = `<center><span class="avatar avatar-xxl brround" style="background-image: url(${url})"></span>
                                <p><b>${data.nombre}</b></p>
                                <a href="/clientes/perfil-proveedor/${data.idproveedor}" target="_blank" class="btn btn-danger btn-sm">Ver Perfil</a></center>`
                    $('#nombre_'+disciplinaSeleccion+'_'+faseSeleccion).append(`<p>${data.nombre}</p>`); 
                    $('#imagen_'+disciplinaSeleccion+'_'+faseSeleccion).css("background-image", `url(${url})`); 

                    $('#seleccion_del_catalogo_'+disciplinaSeleccion+'_'+faseSeleccion).val(1);
                    $('#tipo_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).val(seleccion);
                    $('#idcontratista_'+disciplinaSeleccion+'_'+faseSeleccion).val(data.idproveedor);
                    $('#estado_contratista_'+disciplinaSeleccion+'_'+faseSeleccion).val("activo");

                }
                
                $('#exampleModal_'+fase).modal('hide');
                $('#notice_'+disciplinaSeleccion+'_'+idfinal).popover('hide');

            }
        });

    }

    $(document).ready(function() {
        var $validator = $(".wizard-card form").validate({
            rules: {
                nombre: {
                    required: true
                },
                propietario:{
                    required: true
                },
                departamento:{
                    required: true
                }, 
                ciudad:{
                    required: true
                },     
                direccion:{
                    required: true
                },
                area:{
                    required: true
                },  
                cantidad_pisos:{
                    required: true
                },  
                ubicacion_latitud:{
                    required: true
                }, 
                ubicacion_longitud:{
                    required: true
                },
            },
        


            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                $(element).closest('.form-check-label').removeClass('has-success').addClass('has-danger');

            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                $(element).closest('.form-check-label').removeClass('has-danger').addClass('has-success');

            },
            errorPlacement : function(error, element) {
                $(element).append(error);
            }

        });

        $('.wizard-card').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function(tab, navigation, index) {
                var $valid = $(".wizard-card form").valid();
                if(!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            },
            onInit: function(tab, navigation, index) {
                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('.wizard-card');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                $('.wizard-card .wizard-navigation').append($moving_div);


                $('.moving-tab').css('transition', 'transform 0s');

                
            },

            onTabClick: function(tab, navigation, index) {
                var $valid = $('.wizard-card form').valid();

                if (!$valid) {
                    return false;
                } else {
                    return true;
                }
            },

            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('.wizard-card');

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $($wizard).find('.btn-next').hide();
                    $($wizard).find('.btn-finish').show();
                } else {
                    $($wizard).find('.btn-next').show();
                    $($wizard).find('.btn-finish').hide();
                }

                button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                setTimeout(function() {
                    $('.moving-tab').text(button_text);
                }, 150);

                var checkbox = $('.footer-checkbox');

                if (!index == 0) {
                    $(checkbox).css({
                        'opacity': '0',
                        'visibility': 'hidden',
                        'position': 'absolute'
                    });
                } else {
                    $(checkbox).css({
                        'opacity': '1',
                        'visibility': 'visible'
                    });
                }

            }

        });	
    });

    function deleteRow(data) {
        btn = data.datos;
        nombre = data.nombre;
        id = data.id;
        fases = data.fase;
        var html = '<div id="option_'+id+'">'+
                        '<label class="custom-control custom-checkbox">'+
                            '<input type="checkbox" class="custom-control-input info" onclick="count(this);" name="informacion" value="'+id+'">'+
                            '<input type="hidden" name="valor" value="'+id+'">'+
                            '<input type="hidden" name="fase" value="'+fases+'">'+
                            '<span class="custom-control-label" name="nombre">'+nombre+'</span>'+
                        '</label>'+
                    '</div>';
        $('#modal-data_'+fases).append(html);
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }


    var cuenta = 0;
    function count(check) {
        if($(check).is(':checked')){
            cuenta++;
            console.log(cuenta);
        }else{
            cuenta--;
            console.log(cuenta);
        }
    }

    function save(){
        if(cuenta < 1){
            $(this).removeAttr("data-dismiss");
            alert("Debes seleccionar al menos un área");
        }else{
            $(this).attr("data-dismiss", "modal"); 
            var html = "";
            var elementos = document.getElementsByName("informacion");
            var valor = document.getElementsByName("valor");
            var fase = document.getElementsByName("fase");
            var nombre = document.getElementsByName("nombre");
            for(var i=0; i < elementos.length; i++){
                console.log(fase[i].value);
                if(elementos[i].checked == true){
                    nombres = `${nombre[i].innerHTML}`;
                    console.log(fase[i].value);
                    html = "<tr>"+
                                "<td>"+
                                    "<label class='custom-control custom-checkbox'>"+
                                        "<input type='checkbox' class='custom-control-input info' name='informaciones[]' checked='checked' value='"+valor[i].value+"_"+fase[i].value+"'>"+
                                        "<span class='custom-control-label' name='nombres'>"+nombre[i].innerHTML+"</span>"+
                                    "</label>"+
                                "</td>"+
                                "<td><input type='button' class='btn btn-icon btn-danger btn-sm btn-round' onclick='deleteRow({datos:this,nombre:&quot;"+nombres+"&quot;,id:"+valor[i].value+",fase:"+fase[i].value+" })' value='-'></td>"+
                                "<td style='text-align: center;'><span class='avatar avatar-md brround' style='background-image: url(/assets/front/images/avatar.png);'></span></td>"+
                            "</tr>";
                    $('#add_'+fase[i].value).append(html);
                    $("#option_"+valor[i].value).remove();

                }
            }
        }
    }

    $("#finish").click(function() {
        $("#formProyecto4").submit();
    });
</script>
@stop