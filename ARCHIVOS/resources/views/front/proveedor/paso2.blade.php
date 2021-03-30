@extends('front.layouts.pasos')
@section('content')
<div class="container">
    <div class="row mb-6">
        <img src="{{URL::to('assets/front/images/imagenes/proveedores/banner-tipo-cliente-5.jpg')}}" alt="Proveedores">
    </div>
    {{--<div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3"></div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase finished"><p class="center"><a>1</a></p></div>
                    <div class="menu-step">
                        <a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1')}}" style="color: white">General</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase actual"><p class="center">2</p></div>
                    <div class="menu-step">
                        <span class="status-active">Gerencia</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase"><p class="center">3</p></div>
                    <div class="menu-step">
                        Servicios
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase"><p class="center">4</p></div>
                    <div class="menu-step">
                        Adjuntar
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-5"></div>
    </div>--}}
    <div class="row justify-content-center">
        <!--<div class="col-sm-12 col-md-6 col-lg-3"></div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase actual"><p class="center">1</p></div>
                    <div class="menu-step">
                        <span class="status-active">General</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase"><p class="center">2</p></div>
                    <div class="menu-step">
                        Gerencia
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase"><p class="center">3</p></div>
                    <div class="menu-step">
                        Servicios
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase"><p class="center">4</p></div>
                    <div class="menu-step">
                        Adjuntar
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-5"></div>-->
        <div class="pasosp" style="width: 12.5%">
            <div class="">	
                <div class=" ">
                    <div class="menu-step">
                        <a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1')}}" style="color: white">General</a>
                    </div>
                    <br>
                    <div class="circleBase finished"><p class="center"><a>1</a></p></div>
                </div>
            </div>
        </div>
        <div class="pasosp" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            <span class="status-active">Gerencia</span>
                        </div>
                        <br>
                        <div class="circleBase actual"><p class="center"><a>2</a></p></div>
                    </div>
                </div>
        </div>
        <div class="pasosp" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            Servicios
                        </div>
                        <br>
                        <div class="circleBase"><p class="center"><a>3</a></p></div>
                    </div>
                </div>
        </div>
        <div class="pasosp" style="width: 12.5%">
                <div class="">	
                    <div class=" ">
                        <div class="menu-step">
                            Adjuntar
                        </div>
                        <br>
                        <div class="circleBase"><p class="center"><a>4</a></p></div>
                    </div>
                </div>
        </div>

    </div>
    <!--<div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4"></div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        General
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#53CD3B">
                        <div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"><a href="{{URL::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1')}}"> 1 </a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Gerencia
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="1" data-thickness="6" data-color="#c21a1a">
                        <div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 2 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="menu-step">
                        Servicios
                    </div>
                    <div class="chart-circle chart-circle-sm" data-value="0" data-thickness="6" data-color="#c21a1a">
                        <div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 3 </div>
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
                    <div class="chart-circle chart-circle-sm" data-value="0" data-thickness="6" data-color="#c21a1a">
                        <div width="128" height="128" style="height: 64px; width: 64px;"></div>
                        <div class="chart-circle-value"> 4 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3"></div>
    </div>-->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            {!!Form::model($proveedor,array('url'=>'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-2','method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
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
                            {!!Form::text('gerente_nombre',null,array('placeholder'=>'Nombre del Gerente','class'=>'form-control'))!!}
                            <span class="help-block has-error">{{ $errors->first('gerente_nombre') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tipo de documento del gerente *</label>
                            {!!Form::select('gerente_tipodocumento', [
                            '' => 'Selecciona el documento',
                            'cc'=>'Cédula de Ciudadanía',
                            'ce'=>'Cédula de Extranjería',
                            'ti'=>'Tarjeta de Identidad',
                            'nit'=>'NIT'],
                            null,
                            array('class'=>'form-control','id' => 'gerente_tipodocumento')
                            )!!}
                            <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('gerente_tipodocumento')}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Documento del gerente *</label>
                            {!!Form::text('gerente_documento',null,array('placeholder'=>'Documento del Gerente','class'=>'form-control'))!!}
                            <span class="help-block has-error">{{ $errors->first('gerente_documento') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Celular del gerente *</label>
                            {!!Form::text('gerente_celular',null,array('placeholder'=>'Celular del Gerente','class'=>'form-control'))!!}
                            <span class="help-block has-error">{{ $errors->first('gerente_celular') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex">
                    <a href="{{URL::to('/clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1')}}" class="btn btn-link">Cancelar</a>
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
    // Funciones para carga de departamentos y municipios
    $('.dropify').dropify();


</script>

@stop
