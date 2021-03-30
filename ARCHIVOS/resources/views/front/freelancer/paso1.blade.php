@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'freelancer.paso1' ? 'front.layouts.pasos' : 'front.layouts.proyecto')

@section('content')
<div class="container">
    @if($rutaNombre == 'freelancer.paso1')
        <div class="row mb-6">
            <img src="{{URL::to('assets/front/images/imagenes/freelancer/banner-tipo-cliente.jpg')}}" alt="Freelancer">
        </div>
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
                                Profesional
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
    @endif
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            @if($rutaNombre == 'freelancer.paso1')
                {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-1','method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
            @else
                {!!Form::model($freelancer,array('url'=>'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-1?editar='.$idfreelancer,'method'=>'post','class'=>'card','files'=>'true', 'style' => 'margin-bottom: 70px'))!!}
            @endif    
                <div class="card-header">
                    <h3 class="card-title">{{$rutaNombre == 'freelancer.paso1' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6" style="text-align: left; color: #153556; ">
                            formulario general
                        </div>
                    </div>

                </div>
                <?php

                    $paises = array("Afganistán","Albania","Alemania","Andorra","Angola","Antigua y Barbuda","Arabia Saudita","Argelia","Argentina","Armenia","Australia","Austria","Azerbaiyán","Bahamas","Bangladés","Barbados","Baréin","Bélgica","Belice","Benín","Bielorrusia","Birmania","Bolivia","Bosnia y Herzegovina","Botsuana","Brasil","Brunéi","Bulgaria","Burkina Faso","Burundi","Bután","Cabo Verde","Camboya","Camerún","Canadá","Catar","Chad","Chile","China","Chipre","Ciudad del Vaticano","Colombia","Comoras","Corea del Norte","Corea del Sur","Costa de Marfil","Costa Rica","Croacia","Cuba","Dinamarca","Dominica","Ecuador","Egipto","El Salvador","Emiratos Árabes Unidos","Eritrea","Eslovaquia","Eslovenia","España","Estados Unidos","Estonia","Etiopía","Filipinas","Finlandia","Fiyi","Francia","Gabón","Gambia","Georgia","Ghana","Granada","Grecia","Guatemala","Guyana","Guinea","Guinea ecuatorial","Guinea-Bisáu","Haití","Honduras","Hungría","India","Indonesia","Irak","Irán","Irlanda","Islandia","Islas Marshall","Islas Salomón","Israel","Italia","Jamaica","Japón","Jordania","Kazajistán","Kenia","Kirguistán","Kiribati","Kuwait","Laos","Lesoto","Letonia","Líbano","Liberia","Libia","Liechtenstein","Lituania","Luxemburgo","Madagascar","Malasia","Malaui","Maldivas","Malí","Malta","Marruecos","Mauricio","Mauritania","México","Micronesia","Moldavia","Mónaco","Mongolia","Montenegro","Mozambique","Namibia","Nauru","Nepal","Nicaragua","Níger","Nigeria","Noruega","Nueva Zelanda","Omán","Países Bajos","Pakistán","Palaos","Panamá","Papúa Nueva Guinea","Paraguay","Perú","Polonia","Portugal","Reino Unido","República Centroafricana","República Checa","República de Macedonia","República del Congo","República Democrática del Congo","República Dominicana","República Sudafricana","Ruanda","Rumanía","Rusia","Samoa","San Cristóbal y Nieves","San Marino","San Vicente y las Granadinas","Santa Lucía","Santo Tomé y Príncipe","Senegal","Serbia","Seychelles","Sierra Leona","Singapur","Siria","Somalia","Sri Lanka","Suazilandia","Sudán","Sudán del Sur","Suecia","Suiza","Surinam","Tailandia","Tanzania","Tayikistán","Timor Oriental","Togo","Tonga","Trinidad y Tobago","Túnez","Turkmenistán","Turquía","Tuvalu","Ucrania","Uganda","Uruguay","Uzbekistán","Vanuatu","Venezuela","Vietnam","Yemen","Yibuti","Zambia","Zimbabue");
                    $arrayPaises = ["" => "Seleccione"];
                    foreach ($paises as $pais) {
                        $arrayPaises[$pais] = $pais;
                    }
                ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                @if ( $freelancer->image == NULL )
                                    <input type="file" name="image" id="image" class="dropify" data-height="180" >
                                @else
                                    <input type="file" name="image" id="image" class="dropify" data-height="180" data-default-file="/uploads/front/freelancer/general/{{ $freelancer->idfreelancer }}/{{ $freelancer->image }}" >
                                @endif
                                <label class="form-label">Selecciona foto de perfil</label>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('image')}}</p>


                            </div>
                            <div class="form-group">
                                <label class="form-label">Nombres *</label>
                                {!!Form::text('nombres',null,array('placeholder'=>'Nombres','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('nombres')}}</p>

                            </div>
                            <div class="form-group">
                                <label class="form-label">Apellidos *</label>
                                {!!Form::text('apellidos',null,array('placeholder'=>'Apellidos','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('apellidos')}}</p>

                            </div>
                            <div class="form-group">
                                <label class="form-label">País *</label>
                                <select class="form-control " id="pais" name="pais" data-placeholder="Seleccione" tabindex="-1" aria-hidden="true">
                                    <option value="Colombia" selected>Colombia</option>
                                </select>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('pais')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ciudad de residencia *</label>
                                {!!Form::select('ciudad_residencia', [
                                '' => 'Selecciona el departamento'],
                                null,
                                array('class'=>'form-control','id' => 'ciudad_residencia')
                                )!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('ciudad_residencia')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Fecha de Nacimiento *</label>
                                {!!Form::text('fecha_nacimiento', null,array('placeholder'=>'YYYY-MM-DD','class'=>'form-control', 'id' => 'fecha_nacimiento'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('fecha_nacimiento')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Género *</label>
                                {!!Form::select('genero', [
                                    '' => 'Selecciona',
                                    'F'=>'Femenino',
                                    'M'=>'Masculino'],
                                    null,
                                    array('class'=>'form-control','id' => 'genero')
                                    )!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('genero')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Dirección *</label>
                                {!!Form::textarea('direccion',null,array('placeholder'=>'Direccion','class'=>'form-control','rows'=>'2'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('genero')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tipo de documento *</label>
                                {!!Form::select('tipo_documento', [
                                '' => 'Selecciona el documento',
                                'cc'=>'Cédula de Ciudadanía',
                                'ce'=>'Cédula de Extranjería',
                                'ti'=>'Tarjeta de Identidad',
                                'nit'=>'NIT'],
                                null,
                                array('class'=>'form-control','id' => 'tipo_documento')
                                )!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('tipo_documento')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Documento *</label>
                                {!!Form::text('documento',null,array('placeholder'=>'Documento','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('documento')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Edad *</label>
                                {!!Form::number('edad',null,array('placeholder'=>'Edad','class'=>'form-control'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('edad')}}</p>
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
                                <label class="form-label">Disponibilidad *</label>
                                <label class="custom-control custom-radio">
                                      <input type="radio" class="custom-control-input" name="disponibilidad_tiempo" value="completo" checked="">
                                      <span class="custom-control-label">Completa</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="disponibilidad_tiempo" value="medio_tiempo" checked="">
                                    <span class="custom-control-label">Medio tiempo</span>
                                </label>
                                  <label class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" name="disponibilidad_tiempo" value="fin_de_semana" checked="">
                                  <span class="custom-control-label">Fines de semana</span>
                                  </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        @if($rutaNombre !== 'freelancer.paso1')
                            <a href="{{$rutaNombre == 'freelancer.paso1' ? 'javascript:void(0)' : '/clientes/perfil-freelancer/'.$freelancer->idfreelancer}}" class="btn btn-link">Cancelar</a>
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

    flatpickr('#fecha_nacimiento',{
        dateFormat: 'Y-m-d',
        locale: {
            firstDayOfWeek: 1,
            weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
            }, 
            months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            },
        },
    });


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

        // Código para cargar departamentos
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
                @elseif($freelancer->ciudad_residencia !== NULL)
                    deptAsisTemp = "{{$freelancer->ciudad_residencia}}";
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
