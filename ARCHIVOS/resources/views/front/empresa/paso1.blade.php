@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'empresas.paso1' ? 'front.layouts.pasos' : 'front.layouts.proyecto')
@section('content')
<div class="container">
    @if($rutaNombre == 'empresas.paso1')

        <div class="row mb-6">
            <img src="{{URL::to('assets/front/images/imagenes/empresas/banner-crear-cuenta.jpg')}}" alt="Empresas">
        </div>
        {{--<div class="row">
            <div class="col-sm-12 col-md-6 col-lg-1"></div>
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
                            <div class="circleBase" ><p class="center">2</p></div>
                            <div class="menu-step">
                                Especialidad
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">3</p></div>
                        <div class="menu-step">
                            Gerencial
                        </div>

                    </div>
                </div>
            </div>
            <!--<div class="col-sm-12 col-md-6 col-lg-1">
                    <div class="card-body sales-relative">	
                        <div class="col-auto align-self-center ">
                            <div class="circleBase" ><p class="center">4</p></div>
                            <div class="menu-step">
                                Espec??fico
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
                                Modelaci??n
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">6</p></div>
                        <div class="menu-step">
                            Revisi??n
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-1">
                <div class="card-body sales-relative">	
                    <div class="col-auto align-self-center ">
                        <div class="circleBase" ><p class="center">7</p></div>
                        <div class="menu-step">
                            Supervisi??n
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
                                <span class="status-active">General</span>
                            </div>
                            <br>
                            <div class="circleBase actual"><p class="center"><a>1</a></p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                Especialidad
                            </div>
                            <br>
                            <div class="circleBase"><p class="center">2</p></div>
                        </div>
                    </div>
            </div>
            <div class="pasos" style="width: 12.5%">
                    <div class="">	
                        <div class=" ">
                            <div class="menu-step">
                                Gerencial
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
                                Modelaci??n
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
                            Revisi??n
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
                            Supervisi??n
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
    @endif
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            @if($rutaNombre == 'empresas.paso1')
                {!!Form::model($empresa,array('url'=>'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-1','method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($empresa,array('url'=>'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-1?editar='.$idempresa,'method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
            @endif    
  
                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'empresas.paso1' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            formulario general
                        </div>
                    </div>


                </div>
                @php

                    $year = date("Y");
                    $array = ['' => 'Seleccione'];
                    for ($i= 1960; $i <= $year ; $i++) { //quitarle el +1 Aver ?

                        $array[$i] = $i;

                    }

                    $paises = array("Afganist??n","Albania","Alemania","Andorra","Angola","Antigua y Barbuda","Arabia Saudita","Argelia","Argentina","Armenia","Australia","Austria","Azerbaiy??n","Bahamas","Banglad??s","Barbados","Bar??in","B??lgica","Belice","Ben??n","Bielorrusia","Birmania","Bolivia","Bosnia y Herzegovina","Botsuana","Brasil","Brun??i","Bulgaria","Burkina Faso","Burundi","But??n","Cabo Verde","Camboya","Camer??n","Canad??","Catar","Chad","Chile","China","Chipre","Ciudad del Vaticano","Colombia","Comoras","Corea del Norte","Corea del Sur","Costa de Marfil","Costa Rica","Croacia","Cuba","Dinamarca","Dominica","Ecuador","Egipto","El Salvador","Emiratos ??rabes Unidos","Eritrea","Eslovaquia","Eslovenia","Espa??a","Estados Unidos","Estonia","Etiop??a","Filipinas","Finlandia","Fiyi","Francia","Gab??n","Gambia","Georgia","Ghana","Granada","Grecia","Guatemala","Guyana","Guinea","Guinea ecuatorial","Guinea-Bis??u","Hait??","Honduras","Hungr??a","India","Indonesia","Irak","Ir??n","Irlanda","Islandia","Islas Marshall","Islas Salom??n","Israel","Italia","Jamaica","Jap??n","Jordania","Kazajist??n","Kenia","Kirguist??n","Kiribati","Kuwait","Laos","Lesoto","Letonia","L??bano","Liberia","Libia","Liechtenstein","Lituania","Luxemburgo","Madagascar","Malasia","Malaui","Maldivas","Mal??","Malta","Marruecos","Mauricio","Mauritania","M??xico","Micronesia","Moldavia","M??naco","Mongolia","Montenegro","Mozambique","Namibia","Nauru","Nepal","Nicaragua","N??ger","Nigeria","Noruega","Nueva Zelanda","Om??n","Pa??ses Bajos","Pakist??n","Palaos","Panam??","Pap??a Nueva Guinea","Paraguay","Per??","Polonia","Portugal","Reino Unido","Rep??blica Centroafricana","Rep??blica Checa","Rep??blica de Macedonia","Rep??blica del Congo","Rep??blica Democr??tica del Congo","Rep??blica Dominicana","Rep??blica Sudafricana","Ruanda","Ruman??a","Rusia","Samoa","San Crist??bal y Nieves","San Marino","San Vicente y las Granadinas","Santa Luc??a","Santo Tom?? y Pr??ncipe","Senegal","Serbia","Seychelles","Sierra Leona","Singapur","Siria","Somalia","Sri Lanka","Suazilandia","Sud??n","Sud??n del Sur","Suecia","Suiza","Surinam","Tailandia","Tanzania","Tayikist??n","Timor Oriental","Togo","Tonga","Trinidad y Tobago","T??nez","Turkmenist??n","Turqu??a","Tuvalu","Ucrania","Uganda","Uruguay","Uzbekist??n","Vanuatu","Venezuela","Vietnam","Yemen","Yibuti","Zambia","Zimbabue");
                    $arrayPaises = ["" => "Seleccione"];
                    foreach ($paises as $pais) {
                        $arrayPaises[$pais] = $pais;
                    }


                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                @if ( $empresa->image == NULL )
                                    <input type="file" name="image" id="image" class="dropify" data-height="180" >
                                @else
                                    <input type="file" name="image" id="image" class="dropify" data-height="180" data-default-file="/uploads/front/empresa/general/{{ $empresa->idempresa }}/{{ $empresa->image }}" >
                                @endif
                                <label class="form-label">Selecciona foto de perfil</label>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('image')}}</p>

                            </div>
                            <div class="form-group">
                                <label class="form-label">Nombre de la empresa *</label>
                                {!!Form::text('razon_social',null,array('placeholder'=>'Razon Social','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('razon_social')}}</p>

                            </div>
                            <div class="form-group">
                                <label class="form-label">Pa??s *</label>
                                <select class="form-control " id="pais" name="pais" data-placeholder="Seleccione" tabindex="-1" aria-hidden="true">
                                    <option value="Colombia" selected>Colombia</option>
                                </select>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('pais')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ciudad de residencia *</label>
                                {!!Form::select('ciudad_residencia', [
                                '' => 'Selecciona la ciudad'],
                                null,
                                array('class'=>'form-control','id' => 'ciudad_residencia')
                                )!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('ciudad_residencia')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Direcci??n *</label>
                                {!!Form::textarea('direccion',null,array('placeholder'=>'Direccion','class'=>'form-control','rows'=>'2'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('direccion')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">NIT/RUT *</label>
                                {!!Form::text('nit',null,array('placeholder'=>'NIT/RUT','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('nit')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">RUP <small>(Opcional)</small></label>
                                {!!Form::text('rup',null,array('placeholder'=>'Opcional','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('rup')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">A??o de fundaci??n *</label>
                                {!!Form::select('anio_fundacion',$array,
                                null,
                                array('class'=>'form-control','id' => 'anio_fundacion')
                                )!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('anio_fundacion')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Celular *</label>
                                {!!Form::text('celular',null,array('placeholder'=>'Celular','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('celular')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nacionalidad *</label>
                                {!!Form::select('nacionalidad', $arrayPaises,
                                    null,
                                    array('class'=>'form-control','id' => 'nacionalidad')
                                )!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('nacionalidad')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">P??gina Web <small>(Opcional)</small></label>
                                {!!Form::text('pagina_web',null,array('placeholder'=>'Opcional','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('pagina_web')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Redes Sociales <small>(Opcional)</small></label>
                                {!!Form::text('redes_sociales',null,array('placeholder'=>'Opcional','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('redes_sociales')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descripci??n de la empresa *</label>
                                {!!Form::textarea('descripcion_empresa',null,array('placeholder'=>'Descripcion Empresa','class'=>'form-control','rows'=>'4'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('descripcion_empresa')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">??Presta servicios en otras ciudades? *</label>
                                {!!Form::select('presta_servicios_otras_ciudades', [
                                '' => 'Seleccione una opci??n',
                                1=>'S??',
                                0=>'No'],
                                null,
                                array('class'=>'form-control','id' => 'presta_servicios_otras_ciudades')
                                )!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('presta_servicios_otras_ciudades')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{$rutaNombre == 'empresas.paso1' ? 'javascript:void(0)' : '/clientes/perfil-empresa/'.$empresa->idempresa}}" class="btn btn-link">Cancelar</a>
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
            xobj.open('GET', "{{ URL::asset('assets/front/js/colombia.json') }}", true); // Reemplaza colombia-json.json con el nombre que le hayas puesto
            xobj.onreadystatechange = function () {
            if (xobj.readyState == 4 && xobj.status == "200") {
                callback(xobj.responseText);
            }
        };
        xobj.send(null);  
    }
    $(document).ready(function() {
        $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        // C??digo para cargar departamentos
        loadJSON(function(response) {
        // Parse JSON string into object
            var JSONFinal = JSON.parse(response);
            $.each(JSONFinal, function(i,item) {
                var lista=document.getElementById("ciudad_residencia");
                @if(Session::has('ciudad'))  
                var deptAsisTemp = "{{Session::get('ciudad')}}";
                if(deptAsisTemp == item.departamento) {
                    lista.options.add(new Option(item.departamento, item.departamento, false, true));
                } else {
                    lista.options.add(new Option(item.departamento, item.departamento));
                }
                @elseif($empresa->ciudad_residencia !== NULL)
                    deptAsisTemp = "{{$empresa->ciudad_residencia}}";
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
