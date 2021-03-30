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
                    <div class="circleBase actual" ><p class="center">3</p></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase" ><p class="center">4</p></div>

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
        <div class="" style="width: 100%">
            <div class="card" style="background-color: #e4e4e4;
            box-shadow: 0 0 0; border-radius: 0;">
                <div class="card-header">
                    <div class="card-title">Disciplinas que te recomendamos para tu proyecto</div>
                </div>

                <div class="card-body p-6">
                    @if(count($fases) > 0)
                        <div class="wizard-container">
                            <div class="wizard-card m-0 tab-crear" data-color="blue" id="wizardProfile">
                                {!!Form::model($proyecto,array('url'=>'clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-3','method'=>'post','class'=>'form-horizontal','files'=>'true','name'=>'formProyecto','id'=>'formProyecto'))!!}
                                    @php
                                        $demolicion = false;
                                        $revision = false;
                                        $licencia = false;
                                        $estudios = false;
                                        $administracion = false;
                                        $disciplinasObligatorias = [];
                                        $disciplinasPropuestas = [];
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
                                                                                    <center><table class="table card-table" style="width:500px;" id="fase_disciplina_{{$fase->idfase}}_{{$especialidad->idespecialidad}}">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th style="border-bottom: 1px solid #153556 !important;">Disciplinas Recomendadas</th>
                                                                                                <th style="border-bottom: 1px solid #153556 !important; border-right: 1px solid #153556;">&nbsp;</th>
                                                                                                <th style="text-align: center; border-bottom: 1px solid #153556 !important; border-right: 1px solid #153556;">Contratistas</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody id="add_{{$fase->idfase}}_{{$especialidad->idespecialidad}}">
                                                                                            @foreach ($fases_disciplinas as $fase_disciplina)
                                                                                                @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                                    @foreach ($especialidad->servicios as $servicios)
                                                                                                        
                                                                                                        @foreach ($servicios->disciplinas as $disciplinas)
                                                                                                            @if($fase_disciplina->disciplina_id == $disciplinas->iddisciplina)
                                                                                                                @if($fase_disciplina->es_obligatorio == 1)
                                                                                                                @php
                                                                                                                    $disciplinasObligatorias[] = $fase_disciplina->disciplina_id;
                                                                                                                @endphp

                                                                                                                    <tr>
                                                                                                                        <td>
                                                                                                                            <label class="custom-control custom-checkbox">
                                                                                                                                <input type="checkbox" class="custom-control-input info-{{$fase_disciplina->disciplina_id}}" name="informaciones[]" checked="checked" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                                                <span class="custom-control-label" name="nombres">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                                            </label>
                                                                                                                        </td>
                                                                                                                        <td style="border-right: 1px solid #153556;"><input type="button" class="btn btn-icon btn-danger btn-sm btn-round" onclick="deleteRowC({datos:this,nombre:'{{$fase_disciplina->disciplina->nombre}}',id:{{$fase_disciplina->disciplina_id}},fase:{{$fase->idfase}},especialidad:{{$especialidad->idespecialidad}} })" value="-"></td>
                                                                                                                        <td style="text-align: center; border-right: 1px solid #153556;"><span class="avatar avatar-md brround" style="background-image: url(/assets/front/images/user-2.png);"></span></td>
                                                                                                                    </tr>
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table></center>
                                                                                    <button type="button" class="btn btn-success btn-sm btn-round add" data-toggle="modal" data-target="#exampleModal_{{$fase->idfase}}_{{$especialidad->idespecialidad}}">+</button>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Message Modal -->
                                                                            <div class="modal fade" id="exampleModal_{{$fase->idfase}}_{{$especialidad->idespecialidad}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="example-Modal_{{$fase->idfase}}_{{$especialidad->idespecialidad}}">Seleccione un área</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body" id="modal-data_{{$fase->idfase}}_{{$especialidad->idespecialidad}}">
                                                                                            @foreach ($fases_disciplinas as $fase_disciplina)
                                                                                                @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                                    @foreach ($especialidad->servicios as $servicios)
                                                                                                        @foreach ($servicios->disciplinas as $disciplinas)
                                                                                                            @if($fase_disciplina->disciplina_id == $disciplinas->iddisciplina)
                                                                                                                @if($fase_disciplina->es_obligatorio == 0)
                                                                                                                @php
                                                                                                                    $disciplinasPropuestas[] = $fase_disciplina->disciplina_id;
                                                                                                                @endphp
            
            
                                                                                                                    <div id="option_{{$fase_disciplina->disciplina_id}}_{{$especialidad->idespecialidad}}">
                                                                                                                        <label class="custom-control custom-checkbox">
                                                                                                                            <input type="checkbox" class="custom-control-input info" name="informacion2" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                                            <input type="hidden" name="valor2" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                                            <input type="hidden" name="fase2" value="{{$fase->idfase}}">
                                                                                                                            <input type="hidden" name="especialidad" value="{{$especialidad->idespecialidad}}">
                                                                                                                            <span class="custom-control-label" name="nombre2">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            @endforeach

                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                                                            <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="save2();"id="save_{{$fase->idfase}}_{{$especialidad->idespecialidad}}">Guardar</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        @endforeach
                                                                        <div class="tab_content">
                                                                            <div class="input-group">
                                                                                <center><table class="table card-table" style="width:500px;" id="fase_disciplina_{{$fase->idfase}}">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="border-bottom: 1px solid #153556 !important;">Disciplinas Recomendadas</th>
                                                                                            <th style="border-bottom: 1px solid #153556 !important; border-right: 1px solid #153556;">&nbsp;</th>
                                                                                            <th style="text-align: center; border-bottom: 1px solid #153556 !important; border-right: 1px solid #153556;">Contratistas</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <?php ?>

                                                                                    <tbody id="add_{{$fase->idfase}}">
                                                                                        @foreach ($fases_disciplinas as $fase_disciplina)
                                                                                            @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                                @if($fase_disciplina->es_obligatorio == 1)

                                                                                                    @if(!in_array($fase_disciplina->disciplina_id*1, $disciplinasObligatorias))
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <label class="custom-control custom-checkbox">
                                                                                                                    <input type="checkbox" class="custom-control-input info-{{$fase_disciplina->disciplina_id}}" name="informaciones[]" checked="checked" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                                    <span class="custom-control-label" name="nombres">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                                </label>
                                                                                                            </td>
                                                                                                            <td style="border-right: 1px solid #153556;"><input type="button" class="btn btn-icon btn-danger btn-sm btn-round" onclick="deleteRowC({datos:this,nombre:'{{$fase_disciplina->disciplina->nombre}}',id:{{$fase_disciplina->disciplina_id}},fase:{{$fase->idfase}}})" value="-"></td>
                                                                                                            <td style="text-align: center; border-right: 1px solid #153556;"><span class="avatar avatar-md brround" style="background-image: url(/assets/front/images/user-2.png);"></span></td>
                                                                                                        </tr>
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table></center>
                                                                                <button type="button" class="btn btn-success btn-sm btn-round add" data-toggle="modal" data-target="#exampleModal_{{$fase->idfase}}">+</button>
                                                                            </div>
                                                                            <div class="modal fade" id="exampleModal_{{$fase->idfase}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="example-Modal_{{$fase->idfase}}">Seleccione un área</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body" id="modal-data_{{$fase->idfase}}">
                                                                                            @foreach ($fases_disciplinas as $fase_disciplina)
                                                                                                @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                                    @if($fase_disciplina->es_obligatorio == 0)
                                                                                                        @if(!in_array($fase_disciplina->disciplina_id*1, $disciplinasPropuestas))
                                                                                                            <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                                                <label class="custom-control custom-checkbox">
                                                                                                                    <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                                    <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                                    <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                                    <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                                </label>
                                                                                                            </div>  
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endforeach
        
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                                                            <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="save();"id="save_{{$fase->idfase}}">Guardar</button>
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
                                                    <!-- Message Modal 
                                                    -->
                                                </div>

                                            @else
                                                <div class="tab-pane" id="fase_{{$fase->idfase}}">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <center><table class="table card-table" style="width:500px;" id="fase_disciplina_{{$fase->idfase}}">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="border-bottom: 1px solid #153556 !important;">Disciplinas Recomendadas</th>
                                                                            <th style="border-bottom: 1px solid #153556 !important; border-right: 1px solid #153556;">&nbsp;</th>
                                                                            <th style="text-align: center; border-bottom: 1px solid #153556 !important; border-right: 1px solid #153556;">Contratista</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="add_{{$fase->idfase}}">
                                                                        @foreach ($fases_disciplinas as $fase_disciplina)
                                                                            @if($fase_disciplina->fase_id == $fase->idfase)
                                                                                @if($fase_disciplina->es_obligatorio == 0)
                                                                                    @if($fase_disciplina->fase_id == 7 || $fase_disciplina->fase->nombre == 'Administración')
                                                                                        @if($proyecto->ad_administracion == 'delegada')
                                                                                            <?php
                                                                                                $administracion = true;
                                                                                            ?>
                                                                                            @if($fase_disciplina->disciplina_id == 112 || $fase_disciplina->disciplina->nombre == 'Gerencia')
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" class="custom-control-input info-{{$fase_disciplina->disciplina_id}}" name="informaciones[]" checked="checked" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                            <span class="custom-control-label" name="nombres">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                        </label>
                                                                                                    </td>
                                                                                                    <td style="border-right: 1px solid #153556;"><input type="button" class="btn btn-icon btn-danger btn-sm btn-round" onclick="deleteRow({datos:this,nombre:'{{$fase_disciplina->disciplina->nombre}}',id:{{$fase_disciplina->disciplina_id}},fase:{{$fase->idfase}} })" value="-"></td>
                                                                                                    <td style="text-align: center; border-right: 1px solid #153556;"><span class="avatar avatar-md brround" style="background-image: url(/assets/front/images/user-2.png);"></span></td>
                                                                                                </tr>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                    @if($fase_disciplina->fase_id == 4 || $fase_disciplina->fase->nombre == 'Construcción')
                                                                                        @if($proyecto->ie_predio_demolicion == 'si')
                                                                                            <?php
                                                                                                $demolicion = true;
                                                                                            ?>
                                                                                            @if($fase_disciplina->disciplina_id == 137 || $fase_disciplina->disciplina->nombre == 'Demolición')
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" class="custom-control-input info-{{$fase_disciplina->disciplina_id}}" name="informaciones[]" checked="checked" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                            <span class="custom-control-label" name="nombres">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                        </label>
                                                                                                    </td>
                                                                                                    <td style="border-right: 1px solid #153556;"><input type="button" class="btn btn-icon btn-danger btn-sm btn-round" onclick="deleteRow({datos:this,nombre:'{{$fase_disciplina->disciplina->nombre}}',id:{{$fase_disciplina->disciplina_id}},fase:{{$fase->idfase}} })" value="-"></td>
                                                                                                    <td style="text-align: center; border-right: 1px solid #153556;"><span class="avatar avatar-md brround" style="background-image: url(/assets/front/images/user-2.png);"></span></td>
                                                                                                </tr>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                    @if($fase_disciplina->fase_id == 5 || $fase_disciplina->fase->nombre == 'Revisión, Supervisión y/o Interventoría')
                                                                                        @if($proyecto->area > 2000 || $proyecto->ie_grupousolistado == 'IV - Edificaciones indispensables' || $proyecto->ie_grupousolistado == 'III - Edicaciones para la atención a la comunidad' || $proyecto->ie_grupousolistado == 'II - Estructuras de ocupación especial')
                                                                                            <?php
                                                                                                $revision = true;
                                                                                            ?>
                                                                                            @if($fase_disciplina->disciplina_id == 140 || $fase_disciplina->disciplina->nombre == 'Revisión Estructural' || $fase_disciplina->disciplina_id == 141 || $fase_disciplina->disciplina->nombre == 'Supervisión Técnica' || $fase_disciplina->disciplina_id == 142 || $fase_disciplina->disciplina->nombre == 'Interventoría')
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" class="custom-control-input info-{{$fase_disciplina->disciplina_id}}" name="informaciones[]" checked="checked" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                            <span class="custom-control-label" name="nombres">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                        </label>
                                                                                                    </td>
                                                                                                    <td><input type="button" class="btn btn-icon btn-danger btn-sm btn-round" onclick="deleteRow({datos:this,nombre:'{{$fase_disciplina->disciplina->nombre}}',id:{{$fase_disciplina->disciplina_id}},fase:{{$fase->idfase}} })" value="-"></td>
                                                                                                    <td style="text-align: center;"><span class="avatar avatar-md brround" style="background-image: url(/assets/front/images/user-2.png);"></span></td>
                                                                                                </tr>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif  
                                                                                    @if($fase_disciplina->fase_id == 2 || $fase_disciplina->fase->nombre == 'Licencia de construcción')
                                                                                        @if($proyecto->ie_proyecto_colinda_bic_100 == 'si' )
                                                                                            <?php
                                                                                                $licencia = true;
                                                                                            ?>
                                                                                            @if($fase_disciplina->disciplina_id == 123 || $fase_disciplina->disciplina->nombre == 'Patrimonio' )
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" class="custom-control-input info-{{$fase_disciplina->disciplina_id}}" name="informaciones[]" checked="checked" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                            <span class="custom-control-label" name="nombres">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                        </label>
                                                                                                    </td>
                                                                                                    <td><input type="button" class="btn btn-icon btn-danger btn-sm btn-round" onclick="deleteRow({datos:this,nombre:'{{$fase_disciplina->disciplina->nombre}}',id:{{$fase_disciplina->disciplina_id}},fase:{{$fase->idfase}} })" value="-"></td>
                                                                                                    <td style="text-align: center;"><span class="avatar avatar-md brround" style="background-image: url(/assets/front/images/user-2.png);"></span></td>
                                                                                                </tr>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif  

                                                                                    @if($fase_disciplina->fase_id == 3 || $fase_disciplina->fase->nombre == 'Estudios técnicos')
                                                                                        @if($proyecto->ie_proyecto_colinda_bic_100 == 'si' )
                                                                                            <?php
                                                                                                $estudios = true;
                                                                                            ?>
                                                                                            @if($fase_disciplina->disciplina_id == 123 || $fase_disciplina->disciplina->nombre == 'Patrimonio' || $fase_disciplina->disciplina_id == 116 || $fase_disciplina->disciplina->nombre == 'Arqueología' )
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" class="custom-control-input info-{{$fase_disciplina->disciplina_id}}" name="informaciones[]" checked="checked" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                            <span class="custom-control-label" name="nombres">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                        </label>
                                                                                                    </td>
                                                                                                    <td><input type="button" class="btn btn-icon btn-danger btn-sm btn-round" onclick="deleteRow({datos:this,nombre:'{{$fase_disciplina->disciplina->nombre}}',id:{{$fase_disciplina->disciplina_id}},fase:{{$fase->idfase}} })" value="-"></td>
                                                                                                    <td style="text-align: center;"><span class="avatar avatar-md brround" style="background-image: url(/assets/front/images/user-2.png);"></span></td>
                                                                                                </tr>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif  
                                                                                @endif
                                                                                @if($fase_disciplina->es_obligatorio == 1)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <label class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input info-{{$fase_disciplina->disciplina_id}}" name="informaciones[]" checked="checked" value="{{$fase_disciplina->disciplina_id}}_{{$fase_disciplina->fase_id}}">
                                                                                                <span class="custom-control-label" name="nombres">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                            </label>
                                                                                        </td>
                                                                                        <td><input type="button" class="btn btn-icon btn-danger btn-sm btn-round" onclick="deleteRow({datos:this,nombre:'{{$fase_disciplina->disciplina->nombre}}',id:{{$fase_disciplina->disciplina_id}},fase:{{$fase->idfase}} })" value="-"></td>
                                                                                        <td style="text-align: center;"><span class="avatar avatar-md brround" style="background-image: url(/assets/front/images/user-2.png);"></span></td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table></center>
                                                                <button type="button" class="btn btn-success btn-sm btn-round add" data-toggle="modal" data-target="#exampleModal_{{$fase->idfase}}">+</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Message Modal -->
                                                    <div class="modal fade" id="exampleModal_{{$fase->idfase}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="example-Modal_{{$fase->idfase}}">Seleccione un área</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" id="modal-data_{{$fase->idfase}}">
                                                                    @foreach ($fases_disciplinas as $fase_disciplina)
                                                                        @if($fase_disciplina->fase_id == $fase->idfase)
                                                                            @if($fase_disciplina->es_obligatorio == 0)
                                                                                @if ($fase_disciplina->fase_id == 5 || $fase_disciplina->fase->nombre == 'Revisión, Supervisión y/o Interventoría')
                                                                                    @if($revision)
                                                                                        
                                                                                        @if($fase_disciplina->disciplina_id !== 140  && $fase_disciplina->disciplina_id !== 141  && $fase_disciplina->disciplina_id !== 142 || $fase_disciplina->disciplina->nombre !== 'Revisión Estructural' && $fase_disciplina->disciplina->nombre !== 'Supervisión Técnica' && $fase_disciplina->disciplina->nombre !== 'Interventoría' )
                                                                                            <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                                <label class="custom-control custom-checkbox">
                                                                                                    <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                    <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                    <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                    <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                </label>
                                                                                            </div>

                                                                                        @endif
                                                                                    @else
                                                                                        <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                            <label class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    @endif
                                                                                @elseif($fase_disciplina->fase_id == 4 || $fase_disciplina->fase->nombre == 'Construcción')

                                                                                    @if($demolicion)
                                                                                        @if($fase_disciplina->disciplina_id !== 137 || $fase_disciplina->disciplina->nombre !== 'Demolición')
                                                                                            <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                                <label class="custom-control custom-checkbox">
                                                                                                    <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                    <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                    <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                    <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                </label>
                                                                                            </div>
        
                                                                                        @endif
                                                                                    @else
                                                                                        <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                            <label class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                            </label>
                                                                                        </div>

                                                                                    @endif
                                                                                @elseif($fase_disciplina->fase_id == 7 || $fase_disciplina->fase->nombre == 'Administración')
                                                                                        
                                                                                    @if($administracion)
                                                                                        @if($fase_disciplina->disciplina_id !== 112 || $fase_disciplina->disciplina->nombre !== 'Gerencia')
                                                                                            <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                                <label class="custom-control custom-checkbox">
                                                                                                    <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                    <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                    <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                    <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                </label>
                                                                                            </div>
        
                                                                                        @endif
                                                                                    @else
                                                                                        <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                            <label class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                            </label>
                                                                                        </div>

                                                                                    @endif
                                                                                @elseif($fase_disciplina->fase_id == 2 || $fase_disciplina->fase->nombre == 'Licencia de construcción')
                                                                                    @if($licencia)
                                                                                        @if($fase_disciplina->disciplina_id !== 123 || $fase_disciplina->disciplina->nombre !== 'Patrimonio')
                                                                                            <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                                <label class="custom-control custom-checkbox">
                                                                                                    <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                    <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                    <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                    <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                </label>
                                                                                            </div>

                                                                                        @endif
                                                                                    @else
                                                                                        <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                            <label class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                            </label>
                                                                                        </div>

                                                                                    @endif
                                                                                @elseif($fase_disciplina->fase_id == 3 || $fase_disciplina->fase->nombre == 'Estudios técnicos')
                                                                                    @if($estudios)
                                                                                        @if($fase_disciplina->disciplina_id !== 123 && $fase_disciplina->disciplina_id !== 116  || $fase_disciplina->disciplina->nombre !== 'Patrimonio' && $fase_disciplina->disciplina->nombre !== 'Arqueología')
                                                                                            <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                                <label class="custom-control custom-checkbox">
                                                                                                    <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                    <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                    <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                    <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                                </label>
                                                                                            </div>

                                                                                        @endif
                                                                                    @else
                                                                                        <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                            <label class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                                <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                                <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                                <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                            </label>
                                                                                        </div>

                                                                                    @endif   

                                                                                @else
                                                                                    <div id="option_{{$fase_disciplina->disciplina_id}}">
                                                                                        <label class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input info" name="informacion" onclick="count(this);" value="{{$fase_disciplina->disciplina_id}}" >
                                                                                            <input type="hidden" name="valor" value="{{$fase_disciplina->disciplina_id}}">
                                                                                            <input type="hidden" name="fase" value="{{$fase->idfase}}">
                                                                                            <span class="custom-control-label" name="nombre">{{$fase_disciplina->disciplina->nombre}}</span>
                                                                                        </label>
                                                                                    </div>  
                                                                                @endif


                                                                            @endif
                                                                        @endif
                                                                    @endforeach

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="save();"id="save_{{$fase->idfase}}">Guardar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                    @else
                        No hay fases ni disciplinas asociadas para este tipo de proyecto.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
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

    function deleteRowC(data) {
        btn = data.datos;
        nombre = data.nombre;
        id = data.id;
        fases = data.fase;
        especialidades = data.especialidad;
        var html = '<div id="option_'+id+'_'+especialidades+'">'+
                        '<label class="custom-control custom-checkbox">'+
                            '<input type="checkbox" class="custom-control-input info" onclick="count(this);" name="informacion2" value="'+id+'">'+
                            '<input type="hidden" name="valor2" value="'+id+'">'+
                            '<input type="hidden" name="fase2" value="'+fases+'">'+
                            '<input type="hidden" name="especialidad" value="'+especialidades+'">'+
                            '<span class="custom-control-label" name="nombre2">'+nombre+'</span>'+
                        '</label>'+
                    '</div>';
        $('#modal-data_'+fases+'_'+especialidades).append(html);
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }


    var cuenta = 0;
    function count(check) {
        cuenta = 0;
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
                                "<td style='border-right: 1px solid #153556;'><input type='button' class='btn btn-icon btn-danger btn-sm btn-round' onclick='deleteRow({datos:this,nombre:&quot;"+nombres+"&quot;,id:"+valor[i].value+",fase:"+fase[i].value+" })' value='-'></td>"+
                                "<td style='text-align: center; text-align: center; border-right: 1px solid #153556;'><span class='avatar avatar-md brround' style='background-image: url(/assets/front/images/user-2.png);'></span></td>"+
                            "</tr>";
                    $('#add_'+fase[i].value).append(html);
                    $("#option_"+valor[i].value).remove();

                }
            }
        }
    }

    function save2(){
        if(cuenta < 1){
            $(this).removeAttr("data-dismiss");
            alert("Debes seleccionar al menos un área");
        }else{
            $(this).attr("data-dismiss", "modal"); 
            var html = "";
            var elementos = document.getElementsByName("informacion2");
            var valor = document.getElementsByName("valor2");
            var fase = document.getElementsByName("fase2");
            var especialidad = document.getElementsByName("especialidad");
            var nombre = document.getElementsByName("nombre2");
            console.log(elementos.length)
            for(var i=0; i < elementos.length; i++){
                if(elementos[i].checked == true){
                    nombres = `${nombre[i].innerHTML}`;
                    console.log(especialidad[i].value);
                    html = "<tr>"+
                                "<td>"+
                                    "<label class='custom-control custom-checkbox'>"+
                                        "<input type='checkbox' class='custom-control-input info' name='informaciones[]' checked='checked' value='"+valor[i].value+"_"+fase[i].value+"'>"+
                                        "<span class='custom-control-label' name='nombres'>"+nombre[i].innerHTML+"</span>"+
                                    "</label>"+
                                "</td>"+
                                "<td style='border-right: 1px solid #153556;'><input type='button' class='btn btn-icon btn-danger btn-sm btn-round' onclick='deleteRowC({datos:this,nombre:&quot;"+nombres+"&quot;,id:"+valor[i].value+",fase:"+fase[i].value+",especialidad:"+especialidad[i].value+" })' value='-'></td>"+
                                "<td style='text-align: center; text-align: center; border-right: 1px solid #153556;'><span class='avatar avatar-md brround' style='background-image: url(/assets/front/images/user-2.png);'></span></td>"+
                            "</tr>";
                    $('#add_'+fase[i].value+"_"+especialidad[i].value).append(html);
                    $("#option_"+valor[i].value+"_"+especialidad[i].value).remove();

                }
            }
        }
    }

    $("#finish").click(function() {
        $("#formProyecto").submit();
    });
</script>
@stop