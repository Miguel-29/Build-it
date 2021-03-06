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
                    <div class="circleBase actual" ><p class="center">2</p></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase" ><p class="center">3</p></div>
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
                    <div class="card-title">Suministra informaci??n necesaria para el proyecto</div>
                </div>
                <div class="card-body p-6">
                    <div class="wizard-container">
                        <div class="wizard-card m-0 tab-crear" data-color="blue" id="wizardProfile">
                            {!!Form::model($proyecto,array('url'=>'clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-2','method'=>'post','class'=>'form-horizontal','files'=>'true','name'=>'formProyecto','id'=>'formProyecto'))!!}
                                <div class="wizard-navigation">
                                    <ul class="nav nav-pills">
                                        <li><a href="#admin" data-toggle="tab">Administraci??n</a></li>
                                        <li><a href="#about" data-toggle="tab">General</a></li>
                                        <li><a href="#account" data-toggle="tab">Espec??fica</a></li>
                                        <!--<li><a href="#address" data-toggle="tab">Adjuntar</a></li>-->
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="admin">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Administraci??n *</label>
                                                        {!!Form::select('ad_administracion', [
                                                            '' => 'Selecciona',
                                                            'propia' => 'Propia',
                                                            'delegada' => 'Delegada'],
                                                            null,
                                                            array('class'=>'form-control','id' => 'ad_administracion','required' => 'required')
                                                            )!!}
                                                            <span class="help-block has-error"> {{$errors->first('ad_administracion')}}</span>

                                                        <!--<select class="form-control " data-placeholder="Choose one" name="ad_administracion" id="ad_administracion" tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            <option value="propia">Propia</option>
                                                            <option value="delegada">Delegada</option>
                                                        </select>-->
                                                    </div>
                                                </div>
                                                <!--<div class="input-group" id="delegada" style="display: none">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">??Posee Contratista?<small></small></label>
                                                        <select class="form-control " data-placeholder="Choose one" name="ad_yatiene_contratista" id="ad_yatiene_contratista" tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            <option value="si">Si</option>
                                                            <option value="no">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group" id="condicion" style="display: none">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Condicion<small></small></label>
                                                        <select class="form-control " data-placeholder="Choose one" name="ad_condicion_contratista" id="ad_condicion_contratista" tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            <option value="empresa">Empresa</option>
                                                            <option value="freelancer">Freelancer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group" id="freelancer" style="display: none">
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nombre<small></small></label>
                                                            {!!Form::text('ad_nombre_contratista',null,array('placeholder'=>'Nombre','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Profesion<small></small></label>
                                                            {!!Form::text('ad_profesion_contratista_free',null,array('placeholder'=>'Profesion','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Tarjeta Profesional<small></small></label>
                                                            {!!Form::text('ad_tarjeta_profesional_free',null,array('placeholder'=>'Tarjeta Profesional','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Ciudad<small></small></label>
                                                            {!!Form::text('ad_ciudad_contratista',null,array('placeholder'=>'Ciudad','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Correo<small></small></label>
                                                            {!!Form::text('ad_correo_contratista',null,array('placeholder'=>'Correo','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Telefono<small></small></label>
                                                            {!!Form::text('ad_telefono_contratista',null,array('placeholder'=>'Telefono','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group" id="empresa" style="display: none">
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nombre<small></small></label>
                                                            {!!Form::text('ad_nombres_contratista',null,array('placeholder'=>'Nombre','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">??rea<small></small></label>
                                                            {!!Form::text('ad_area_contratista_emp',null,array('placeholder'=>'??rea','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">RUT / NIT<small></small></label>
                                                            {!!Form::text('ad_rutnit_contratista_emp',null,array('placeholder'=>'RUT / NIT','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Ciudad<small></small></label>
                                                            {!!Form::text('ad_ciudades_contratista',null,array('placeholder'=>'Ciudad','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Correo<small></small></label>
                                                            {!!Form::text('ad_correos_contratista',null,array('placeholder'=>'Correo','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Telefono<small></small></label>
                                                            {!!Form::text('ad_telefonos_contratista',null,array('placeholder'=>'Telefono','class'=>'form-control'))!!}
                                                        </div>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="about">
                                      <div class="row">
                                            <div class="col-sm-4">
                                                <input type="file" class="dropify" data-height="180" name="image" id="image" />
                                                <label class="control-label" style="margin: 0">Seleccione imagen para su proyecto</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">	
                                                    <div class="form-group label-floating">
                                                      <label class="control-label">Nombre del proyecto *</label>
                                                      {!!Form::text('nombre',null,array('placeholder'=>'Nombre','class'=>'form-control','required' => 'required'))!!}
                                                      <span class="help-block has-error"> {{$errors->first('nombre')}}</span>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                      <label class="control-label">Propietario del proyecto *</label>
                                                      {!!Form::text('propietario',null,array('placeholder'=>'Propietario','class'=>'form-control','required' => 'required'))!!}
                                                      <span class="help-block has-error"> {{$errors->first('propietario')}}</span>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Departamento *</label>
                                                            {!!Form::select('departamento', [
                                                            '' => 'Selecciona el departamento'],
                                                            null,
                                                            array('class'=>'form-control','id' => 'departamento','required' => 'required')
                                                            )!!}
                                                            <span class="help-block has-error"> {{$errors->first('departamento')}}</span>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Ciudad *</label>
                                                        
                                                            {!!Form::select('ciudad', [
                                                            '' => 'Selecciona la ciudad'],
                                                            null,
                                                            array('class'=>'form-control','id' => 'ciudad','required' => 'required')
                                                            )!!}
                                                            <span class="help-block has-error"> {{$errors->first('ciudad')}}</span>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                      <label class="control-label">??rea (m2) *</label>
                                                      {!!Form::number('area',null,array('placeholder'=>'??rea','class'=>'form-control','required' => 'required'))!!}
                                                      <span class="help-block has-error"> {{$errors->first('area')}}</span>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                      <label class="control-label">Cantidad de pisos *</label>
                                                      {!!Form::number('cantidad_pisos',null,array('placeholder'=>'Cantidad de Pisos','class'=>'form-control','required' => 'required'))!!}
                                                      <span class="help-block has-error"> {{$errors->first('cantidad_pisos')}}</span>
                                                    </div>
                                                </div>
                                                @php
                                                    $adicional = array(
                                                    );
                                                    foreach ($informacion as $key ) {
                                                        $adicional[] = $key->nombre;
                                                    }
                                                @endphp
                                                <div class="input-group radio-inf-adc">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Informaci??n adicional <small>(opcional)</small></label>
                                                        <div class="col-md-12">
                                                            @foreach ($adicional as $item)
                                                                @php
                                                                    $list1= $proyecto->informacion_adicional;
                                                                    $tipos = explode(",",$list1);
                                                                    $bande = false;
                                                                    if(!empty($tipos)){
                                                                        foreach($tipos as $value)
                                                                        {
                                                                            if($value == $item)
                                                                            {
                                                                                $bande = true; 
                                                                                break;
                                                                            }

                                                                        }
                                                                    }
                                                                @endphp
                                                                <div class="col-md-8">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="informacion[]" @if($bande) checked="checked" @endif value="{{$item}}">
                                                                        <span class="custom-control-label">{{$item}}</span>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Direccion *</label>
                                                        <form>
                                                            {!!Form::text('direccion',null,array('placeholder'=>'Escribe una direcci??n','class'=>'form-control','id'=>'geocomplete'))!!}
                                                            <span class="input-group-append">
                                                                <button class="btn btn-primary"  id="find" type="button">BUSCAR</button>
                                                            </span>
                                                            <input type="hidden" class="form-control" name="lat" id="lat">
                                                            <input type="hidden" class="form-control" name="lng" id="lng">
                                                        </form>
                                                        <span class="help-block has-error"> {{$errors->first('direccion')}}</span>

                                                        <div class="map-header">
                                                            <div class="map-header-layer" id="map"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                      </div>
                                    </div>
                                    <div class="tab-pane" id="account">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Subusos o subocupaciones *<small></small></label>
                                                        <select class="form-control " data-placeholder="Seleccione" name="ie_subuso" id="ie_subuso" tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            @foreach ($grupouso as $grupousos)
                                                                <option value="{{$grupousos->id}}" @if($proyecto->ie_subuso !== NULL && $proyecto->ie_subuso == $grupousos->id) selected @endif>{{$grupousos->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="help-block has-error"> {{$errors->first('ie_subuso')}}</span>

                                                    </div>
                                                </div>

                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Uso u ocupaci??n *<small></small></label>
                                                        <select class="form-control " data-placeholder="Seleccione" name="ie_grupouso" id="ie_grupouso" tabindex="-1" aria-hidden="true" aria-readonly="true">
                                                            <option label="Seleccione" selected></option>
                                                            @if($proyecto->ie_grupouso !== NULL)
                                                                <option value="{{$proyecto->ie_grupouso}}" selected >{{$proyecto->grupoUso->nombre}}</option>
                                                            @endif
                                                        </select>
                                                        <span class="help-block has-error"> {{$errors->first('ie_grupouso')}}</span>

                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Grupo de uso *<small></small></label>
                                                        <select class="form-control " data-placeholder="Choose one" name="ie_grupousolistado" id="ie_grupousolistado" tabindex="-1" aria-hidden="true" aria-readonly="true">
                                                            <option label="Seleccione" selected></option>
                                                            @if($proyecto->ie_grupousolistado !== NULL)
                                                                <option value="{{$proyecto->ie_grupousolistado}}" selected >{{$proyecto->ie_grupousolistado}}</option>
                                                            @endif
                                                        </select>
                                                        <span class="help-block has-error"> {{$errors->first('ie_grupousolistado')}}</span>

                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Disponibilidad de licencia de construcci??n/Urbanizaci??n/Parcelaci??n/Subdivisi??n *<small></small></label>
                                                        {!!Form::select('ie_disponibilidad_licenciacons', [
                                                            '' => 'Seleccione',
                                                            'si' => 'Si',
                                                            'no' => 'No',
                                                            'en proceso' => 'En Proceso'],
                                                            null,
                                                            array('class'=>'form-control','id' => 'ie_disponibilidad_licenciacons','required' => 'required')
                                                        )!!}

                                                        <!--<select class="form-control " data-placeholder="Choose one" name="ie_disponibilidad_licenciacons" id="ie_disponibilidad_licenciacons"tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            <option value="si">Si</option>
                                                            <option value="no">No</option>
                                                            <option value="en proceso">En Proceso</option>
                                                        </select>-->
                                                        <span class="help-block has-error"> {{$errors->first('ie_disponibilidad_licenciacons')}}</span>

                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">El proyecto se encuentra colindando con un BIC o en un rango de 100m *<small></small></label>
                                                        {!!Form::select('ie_proyecto_colinda_bic_100', [
                                                            '' => 'Seleccione',
                                                            'si' => 'Si',
                                                            'no' => 'No',
                                                            'no tengo conocimiento' => 'No tengo conocimiento'],
                                                            null,
                                                            array('class'=>'form-control','id' => 'ie_proyecto_colinda_bic_100','required' => 'required')
                                                        )!!}
                                                        <!--<select class="form-control " data-placeholder="Choose one" name="ie_proyecto_colinda_bic_100" id="ie_proyecto_colinda_bic_100" tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            <option value="si">Si</option>
                                                            <option value="no">No</option>
                                                            <option value="no tengo conocimiento">No tengo conocimiento</option>
                                                        </select>-->
                                                        <span class="help-block has-error"> {{$errors->first('ie_proyecto_colinda_bic_100')}}</span>

                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">En el predio se encuentra alguna edi???cacion o estructura para demoler *<small></small></label>
                                                        {!!Form::select('ie_predio_demolicion', [
                                                            '' => 'Seleccione',
                                                            'si' => 'Si',
                                                            'no' => 'No',
                                                            'no tengo conocimiento' => 'No tengo conocimiento'],
                                                            null,
                                                            array('class'=>'form-control','id' => 'ie_predio_demolicion','required' => 'required')
                                                        )!!}
                                                        <!--<select class="form-control " data-placeholder="Choose one" name="ie_predio_demolicion" id="ie_predio_demolicion" tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            <option value="si">Si</option>
                                                            <option value="no">No</option>
                                                            <option value="no tengo conocimiento">No tengo conocimiento</option>
                                                        </select>-->
                                                        <span class="help-block has-error"> {{$errors->first('ie_predio_demolicion')}}</span>

                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Tiempo para la ejecuci??n del proyecto *<small></small></label>
                                                        {!!Form::text('ie_tiempo_ejecucion',null,array('placeholder'=>'Tiempo Ejecucion','class'=>'form-control'))!!}
                                                        <span class="help-block has-error"> {{$errors->first('ie_predio_demolicion')}}</span>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">M??todo de pago de la ejecuci??n del proyecto *<small></small></label>
                                                        {!!Form::select('ie_metodo_pago_ejecucion', [
                                                            '' => 'Seleccione',
                                                            'dinero propio' => 'Dinero Propio',
                                                            'accionistas' => 'Accionistas',
                                                            'financiamiento por credito constructor' => 'Financiamiento por cr??dito constructor',
                                                            'banco'=> 'Banco',
                                                            'fiduciaria' => 'Fiduciaria'],
                                                            null,
                                                            array('class'=>'form-control','id' => 'ie_metodo_pago_ejecucion','required' => 'required')
                                                        )!!}
                                                        <!--<select class="form-control " data-placeholder="Choose one"  name="ie_metodo_pago_ejecucion" id="ie_metodo_pago_ejecucion" tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            <option value="dinero propio">Dinero propio</option>
                                                            <option value="accionistas">Accionistas</option>
                                                            <option value="financiamiento por credito constructor">Financiamiento por cr??dito constructor</option>
                                                            <option value="banco">Banco</option>
                                                            <option value="fiduciaria">Fiduciaria</option>

                                                        </select>-->
                                                        <span class="help-block has-error"> {{$errors->first('ie_predio_demolicion')}}</span>

                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Conocimiento previo sobre el proyecto civil *<small></small></label>
                                                        {!!Form::select('ie_conocimiento_previo', [
                                                            '' => 'Seleccione',
                                                            'si' => 'Si',
                                                            'no' => 'No'],
                                                            null,
                                                            array('class'=>'form-control','id' => 'ie_conocimiento_previo','required' => 'required')
                                                        )!!}
                                                        <!--<select class="form-control " data-placeholder="Choose one" name="ie_conocimiento_previo" id="ie_conocimiento_previo" tabindex="-1" aria-hidden="true">
                                                            <option label="Seleccione" selected></option>
                                                            <option value="si">Si</option>
                                                            <option value="no">No</option>
                                                        </select>-->
                                                        <span class="help-block has-error"> {{$errors->first('ie_conocimiento_previo')}}</span>

                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                    </div>
                                    <!--<div class="tab-pane" id="address">
                                        <div class="row">
                                            <div class="col-sm-12">
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
                                    </div>-->
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
    $(document).ready(function() {

        $(function() {
            $("#geocomplete").geocomplete({
                map: ".map-header-layer",
                details: "form",
                types: ["geocode", "establishment"],
            });

            $("#find").click(function() {
                $("#geocomplete").trigger("geocode");
            });
        });



        $('.wizard-card').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function(tab, navigation, index) {
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

    $("#finish").click(function() {
        $("#formProyecto").submit();
    });


    $('.dropify').dropify();
        // Funciones para carga de departamentos y municipios
        function loadJSON(callback) {   
            var xobj = new XMLHttpRequest();
                xobj.overrideMimeType("application/json");
                xobj.open('GET', "{{ URL::asset('assets/front/js/colombia.json') }}", true); // Reemplaza colombia-json.json con el nombre que le hayas puesto
                xobj.onreadystatechange = function () {
                if (xobj.readyState == 4 && xobj.status == "200") {
                callback(xobj.responseText);
                }
            };
            xobj.send(null);  
        }

        function cargarCiudad(depto, bandera)
        {
            if (bandera == 0) {
                $("#ciudad").empty().append('<option value="">Selecciona la ciudad o municipio</option>');
            }
                
            // C??digo para cargar departamentos
            loadJSON(function(response) {
            // Parse JSON string into object
                var JSONFinal = JSON.parse(response);
                $.each(JSONFinal, function(i,item) {
                if(item.departamento==depto){
                    $.each(item.ciudades, function(ic,itemc) {
                        var lista=document.getElementById("ciudad");
                        lista.options.add(new Option(itemc, itemc));  
                    });     
                }
                });                
            });
        }

        $(document).ready(function() {

            // C??digo para cargar departamentos
            loadJSON(function(response) {
                // Parse JSON string into object
                var JSONFinal = JSON.parse(response);
                $.each(JSONFinal, function(i,item) {
                var lista=document.getElementById("departamento");
                lista.options.add(new Option(item.departamento, item.departamento));
                
                });       
            });

            $( "#departamento" ).change(function() {
                $("#ciudad").empty().append('<option value="">Selecciona la ciudad o municipio</option>');
                var nameDepto = $("#departamento").val();

                cargarCiudad(nameDepto, 1);
            });
            
        });

        $(document).ready(function(){
            $("#ie_subuso").change(function(){
                var grupouso = $(this).val();
                var nombre = $('#ie_subuso option:selected').text();
                $.ajax({
                    url:"/api/grupouso/"+grupouso,
                    type:"GET",
                    success:function(data){  //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                        var codigo_select = '<option value="">Seleccione un grupo de uso</option>'
                        codigo_select+='<option value="'+data.id+'" selected>'+data.nombre+'</option>';
            
                        $("#ie_grupouso").html(codigo_select);
                        console.log(nombre);
                        checkGrupo(nombre);
                    }    
                });
            });
            function checkGrupo(nombre){
                var opciones = '';
                if (nombre == "Vivienda Bifamiliar" || 
                    nombre == "Vivienda Multifamiliar" ||
                    nombre == "Edificios" ||
                    nombre == "Hoteles" ||
                    nombre == "Vivienda VIS" ||
                    nombre == "Vivienda VIP" ||
                    nombre == "Gimnasios" ||
                    nombre == "Laboratorios" ||
                    nombre == "Comercio" ||
                    nombre == "Parqueaderos"){

                        opciones ='<option value="I - Estructuras de ocupaci??n normal" selected>I - Estructuras de ocupaci??n normal</option>';
            
                        $("#ie_grupousolistado").html(opciones);

                }else if(nombre == "Centros comerciales" ||
                        nombre == "Estadios" ||
                        nombre == "Coliseos" ||
                        nombre == "Bodegas" ||
                        nombre == "Iglesias" ||
                        nombre == "Oficinas" ||
                        nombre == "Biblioteca" ||
                        nombre == "Grader??as" ||
                        nombre == "Edificios gubernamentales" ||
                        nombre == "Edificios de administraci??n gubernamental"){

                            opciones ='<option value="II - Estructuras de ocupaci??n especial" selected>II - Estructuras de ocupaci??n especial</option>';
            
                            $("#ie_grupousolistado").html(opciones);

                }else if (nombre == "Colegios" ||
                        nombre == "Universidades" ||
                        nombre == "Estaciones de bomberos" ||
                        nombre == "Edificios de polic??as" ||
                        nombre == "Edificios fuerzas armadas" ||
                        nombre == "Sedes de oficinas de prevenci??n y atenci??n de desastres" ||
                        nombre == "Garajes de veh??culos de emergencia" ||
                        nombre == "Edificios de centros de atenci??n de emergencias" ||
                        nombre == "Guarder??as" ||
                        nombre == "Centros de ense??anza"){

                            opciones ='<option value="III - Edicaciones para la atenci??n a la comunidad" selected>III - Edicaciones para la atenci??n a la comunidad</option>';
            
                            $("#ie_grupousolistado").html(opciones);

                }else{
                    opciones ='<option value="IV - Edificaciones indispensables" selected>IV - Edificaciones indispensables</option>';
            
                    $("#ie_grupousolistado").html(opciones);

                }
            }
        });

        /*$("#ad_administracion").change(function () {
        
            var selected_option = $('#ad_administracion').val();
            console.log(selected_option);

            if (selected_option == "delegada") {
                document.getElementById("delegada").style.display = "block";
            }
            if (selected_option == "propia") {
                document.getElementById("delegada").style.display = "none";
                document.getElementById("condicion").style.display = "none";
                document.getElementById("freelancer").style.display = "none";
                document.getElementById("empresa").style.display = "none";

            }
        });

        $("#ad_yatiene_contratista").change(function () {
        
            var selected_option = $('#ad_yatiene_contratista').val();
            console.log(selected_option);

            if (selected_option == "si") {
                document.getElementById("condicion").style.display = "block";
            }
            if (selected_option == "no") {
                document.getElementById("condicion").style.display = "none";
                document.getElementById("freelancer").style.display = "none";
                document.getElementById("empresa").style.display = "none";

            }
        });

        $("#ad_condicion_contratista").change(function () {
        
            var selected_option = $('#ad_condicion_contratista').val();
            console.log(selected_option);

            if (selected_option == "freelancer") {
                document.getElementById("freelancer").style.display = "block";
                document.getElementById("empresa").style.display = "none";

            }
            if (selected_option == "empresa") {
                document.getElementById("freelancer").style.display = "none";
                document.getElementById("empresa").style.display = "block";

            }
        });*/

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