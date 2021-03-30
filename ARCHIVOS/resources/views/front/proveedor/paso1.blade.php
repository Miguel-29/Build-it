@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'proveedores.paso1' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<div class="container">
    @if($rutaNombre == 'proveedores.paso1')

        <div class="row mb-6">
            <img src="{{URL::to('assets/front/images/imagenes/proveedores/banner-tipo-cliente-5.jpg')}}" alt="Proveedores">
        </div>
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
                            <span class="status-active">General</span>
                        </div>
                        <br>
                        <div class="circleBase actual"><p class="center"><a>1</a></p></div>
                    </div>
                </div>
            </div>
            <div class="pasosp" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                Gerencia
                            </div>
                            <br>
                            <div class="circleBase"><p class="center"><a>2</a></p></div>
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
    @endif
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            @if($rutaNombre == 'proveedores.paso1')
                {!!Form::model($proveedor,array('url'=>'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1','method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($proveedor,array('url'=>'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1?editar='.$idproveedor,'method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
            @endif
            <div class="card-header">
                <h3 class="card-title">{{$rutaNombre == 'proveedores.paso1' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                <div class="row">
                    <div class="col-lg-6 col-md-6"></div>
                    <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                        formulario general
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $year = date("Y");
                        $array = ['' => 'Seleccione'];
                        for ($year; $year >= $i = 1900 ; $year--) { //quitarle el +1  ?

                            $array[$year] = $year;

                        }
                    @endphp
                    <div class="col-md-6 col-lg-12">
                        <div class="form-group">
                            @if( $proveedor->image == NULL )
                                <input type="file" name="image" id="image" class="dropify" data-height="180">
                            @else
                                <input type="file" name="image" id="image" class="dropify" data-height="180"
                                    data-default-file="/uploads/front/proveedor/general/{{ $proveedor->idproveedor }}/{{ $proveedor->image }}">
                            @endif
                            <label class="form-label">Selecciona foto de perfil</label>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nombre de la empresa *</label>
                            {!!Form::text('nombre',null,array('placeholder'=>'Nombres','class'=>'form-control'))!!}
                            <span class="help-block has-error">{{ $errors->first('nombre') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">País *</label>
                            <select class="form-control " id="pais_residencia"
                                name="pais_residencia" data-placeholder="Seleccione" tabindex="-1" aria-hidden="true">
                                <option value="Colombia" selected>Colombia</option>
                            </select>
                            <span class="help-block has-error">
                                {{ $errors->first('pais_residencia') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Departamento de residencia *</label>
                            {!!Form::select('ciudad_residencia', [
                            '' => 'Selecciona el departamento'],
                            null,
                            array('class'=>'form-control','id' => 'ciudad_residencia')
                            )!!}
                            <span class="help-block has-error">
                                {{ $errors->first('ciudad_residencia') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Dirección *</label>
                            {!!Form::textarea('direccion',null,array('placeholder'=>'Direccion','class'=>'form-control','rows'=>'3'))!!}
                            <span class="help-block has-error">{{ $errors->first('direccion') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">NIT / RUT *</label>
                            {!!Form::text('nit_rut',null,array('placeholder'=>'NIT / RUT','class'=>'form-control'))!!}
                            <span class="help-block has-error">{{ $errors->first('nit_rut') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">RUP</label>
                            {!!Form::text('rup',null,array('placeholder'=>'Opcional','class'=>'form-control'))!!}
                            <span class="help-block has-error">{{ $errors->first('rup') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Año de fundación</label>
                            {!!Form::select('anio_fundacion', $array,
                                null,
                                array('class'=>'form-control','id' => 'anio_fundacion')
                                )!!}
                            <span class="help-block has-error">{{ $errors->first('anio_fundacion') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Celular *</label>
                            {!!Form::text('celular',null,array('placeholder'=>'Celular','class'=>'form-control'))!!}
                            <span class="help-block has-error">
                                {{ $errors->first('celular') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Página Web</label>
                            {!!Form::text('pagina_web',null,array('placeholder'=>'Opcional','class'=>'form-control'))!!}
                            <span class="help-block has-error">
                                {{ $errors->first('pagina_web') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Redes Sociales</label>
                            {!!Form::text('redes_sociales',null,array('placeholder'=>'Opcional','class'=>'form-control'))!!}
                            <span class="help-block has-error">
                                {{ $errors->first('redes_sociales') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Descripción de la empresa *</label>
                            {!!Form::textarea('descripcion',null,array('placeholder'=>'Descripcion Empresa','class'=>'form-control','rows'=>'6'))!!}
                            <span class="help-block has-error">
                                {{ $errors->first('descripcion') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">¿Presta servicios en otras ciudades? *</label>
                            {!!Form::select('presta_servicios_otras_ciudades', [
                            '' => 'Seleccione una opción',
                            1=>'Sí',
                            0=>'No'],
                            null,
                            array('class'=>'form-control','id' => 'presta_servicios_otras_ciudades')
                            )!!}
                            <span class="help-block has-error"> {{$errors->first('presta_servicios_otras_ciudades')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex">
                    @if($rutaNombre !== 'proveedores.paso1')
                        <a href="{{$rutaNombre == 'proveedores.paso1' ? 'javascript:void(0)' : '/clientes/perfil-proveedor/'.$proveedor->idproveedor}}" class="btn btn-link">Cancelar</a>
                    @endif
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

        function loadJSON(callback) {
            var xobj = new XMLHttpRequest();
            xobj.overrideMimeType("application/json");
            xobj.open('GET', "{{ URL::asset('assets/front/js/colombia.json') }}",
            true); // Reemplaza colombia-json.json con el nombre que le hayas puesto
            xobj.onreadystatechange = function () {
                if (xobj.readyState == 4 && xobj.status == "200") {
                    callback(xobj.responseText);
                }
            };
            xobj.send(null);
        }

        $(document).ready(function () {
            $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });

            // Código para cargar departamentos
            loadJSON(function (response) {
                // Parse JSON string into object
                var JSONFinal = JSON.parse(response);
                $.each(JSONFinal, function (i, item) {
                    var lista = document.getElementById("ciudad_residencia");
                    @if($proveedor->ciudad_residencia !== NULL)  
                    var deptAsisTemp = "{{$proveedor->ciudad_residencia}}";
                    if(deptAsisTemp == item.departamento) {
                        lista.options.add(new Option(item.departamento, item.departamento, false, true));
                    } else {
                        lista.options.add(new Option(item.departamento, item.departamento));
                    }
                    @else
                        lista.options.add(new Option(item.departamento, item.departamento));
                    @endif
                });
            });

        });

    </script>

    @stop
