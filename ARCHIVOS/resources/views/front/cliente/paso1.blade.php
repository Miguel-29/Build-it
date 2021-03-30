@php
    $rutaNombre = \Request::route()->getName();    
@endphp


@extends($rutaNombre == 'clientes.paso1' ? 'front.layouts.pasos' : 'front.layouts.proyecto')


@section('content')
<div class="container">
    @if($rutaNombre === "clientes.paso1")
        <div class="row mb-6">
            <img src="{{URL::to('assets/front/images/imagenes/clientes/banner-tipo-cliente-4.jpg')}}" alt="Clientes">
        </div>
    @endif

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-6">
            @if($rutaNombre === "clientes.paso1")

                {!!Form::model($cliente,array('url'=>'clientes/crear-c/'.$tipo.'/'.$idcliente.'/paso-1','method'=>'post','class'=>'card','files'=>'true'))!!}
            @else
                {!!Form::model($cliente,array('url'=>'clientes/crear-c/'.$tipo.'/'.$idcliente.'/paso-1?editar='.$idcliente,'method'=>'post','class'=>'card','files'=>'true'))!!}
            @endif
                <div class="card-header">
                    <h3 class="card-title"><br>{{$rutaNombre == 'clientes.paso1' ? 'Crea tu cuenta' : 'Editar Perfil'}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Tipo de Régimen</label>
                                {!!Form::select('tipo_persona', [
                                    '' => 'Selecciona una opción',
                                    'natural'=>'Natural',
                                    'juridica'=>'Juridica'],
                                    null,
                                    array('class'=>'form-control','id' => 'tipo_persona')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('tipo_persona')}}</span>
                            </div>
                            <div style="display: none;" id="natural">
                                <div class="form-group">
                                    @if ( $cliente->image == NULL )
                                        <input type="file" name="image" id="image" class="dropify" data-height="180" >
                                    @else
                                        <input type="file" name="image" id="image" class="dropify" data-height="180" data-default-file="/uploads/front/cliente/general/{{ $cliente->idcliente }}/{{ $cliente->image }}" >
                                    @endif
                                    <label class="form-label">Selecciona foto de perfil</label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nombres</label>
                                    {!!Form::text('nombre_razon_social',null,array('placeholder'=>'Nombres','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('nombre_razon_social')}}</span>

                                </div>
                                <div class="form-group">
                                    <label class="form-label">Apellidos</label>
                                    {!!Form::text('apellidos',null,array('placeholder'=>'Apellidos','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('apellidos')}}</span>

                                </div>
                                <div class="form-group">
                                    <label class="form-label">País</label>
                                    <select class="form-control " id="pais" name="pais" data-placeholder="Seleccione" tabindex="-1" aria-hidden="true">
                                        <option value="Colombia" selected>Colombia</option>
                                    </select>
                                    <span class="help-block has-error"> {{$errors->first('pais')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Departamento de residencia</label>
                                    {!!Form::select('ciudad', [
                                    '' => 'Selecciona el departamento'],
                                    null,
                                    array('class'=>'form-control','id' => 'ciudad')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('ciudad')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    {!!Form::text('fecha_nacimiento_creacion', null,array('placeholder'=>'YYYY-MM-DD','class'=>'form-control ','id' => 'fecha_nacimiento_creacion'))!!}
                                    <span class="help-block has-error"> {{$errors->first('fecha_nacimiento_creacion')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Dirección </label>
                                    {!!Form::textarea('direccion',null,array('placeholder'=>'Direccion','class'=>'form-control','rows'=>'6'))!!}
                                    <span class="help-block has-error"> {{$errors->first('direccion')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tipo de documento</label>
                                    {!!Form::select('tipo_documento', [
                                    '' => 'Selecciona el departamento',
                                    'cc'=>'Cédula de Ciudadanía',
                                    'ce'=>'Cédula de Extranjería',
                                    'ti'=>'Tarjeta de Identidad',
                                    'nit'=>'NIT'],
                                    null,
                                    array('class'=>'form-control','id' => 'tipo_documento')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('tipo_documento')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Documento</label>
                                    {!!Form::text('documento',null,array('placeholder'=>'Documento','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('documento')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Edad</label>
                                    {!!Form::number('edad',null,array('placeholder'=>'Edad','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('edad')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Celular</label>
                                    {!!Form::text('celular',null,array('placeholder'=>'Celular','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('celular')}}</span>
                                </div>
                            </div>
                            <div style="display: none;" id="juridica">
                                <div class="form-group">
                                    @if ( $cliente->image == NULL )
                                        <input type="file" name="imagen" id="imagen" class="dropify" data-height="180" >
                                    @else
                                        <input type="file" name="imagen" id="imagen" class="dropify" data-height="180" data-default-file="/uploads/front/cliente/general/{{ $cliente->idcliente }}/{{ $cliente->image }}" >
                                    @endif
                                    <label class="form-label">Selecciona foto de perfil</label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nombre de la empresa</label>
                                    {!!Form::text('nombres_razon_social',null,array('placeholder'=>'Nombre de la empresa','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('nombre_razon_social')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">País</label>
                                    <select class="form-control " id="paises" name="paises" data-placeholder="Seleccione" tabindex="-1" aria-hidden="true">
                                        <option value="Colombia" selected>Colombia</option>
                                    </select>
                                    <span class="help-block has-error"> {{$errors->first('paises')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Ciudad de residencia</label>
                                    {!!Form::select('ciudades', [
                                    '' => 'Selecciona el departamento'],
                                    null,
                                    array('class'=>'form-control','id' => 'ciudades')
                                    )!!}
                                    <span class="help-block has-error"> {{$errors->first('ciudades')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Dirección</label>
                                    {!!Form::textarea('direcciones',null,array('placeholder'=>'Direccion','class'=>'form-control','rows'=>'6'))!!}
                                    <span class="help-block has-error"> {{$errors->first('direcciones')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">NIT / RUT</label>
                                    {!!Form::text('nit_rut',null,array('placeholder'=>'NIT / RUT','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('nit_rut')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Celular</label>
                                    {!!Form::text('celulares',null,array('placeholder'=>'Celular','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('celulares')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Página Web</label>
                                    {!!Form::text('pagina_web',null,array('placeholder'=>'Opcional','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('pagina_web')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Redes Sociales</label>
                                    {!!Form::text('redes_sociales',null,array('placeholder'=>'Opcional','class'=>'form-control'))!!}
                                    <span class="help-block has-error"> {{$errors->first('redes_sociales')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Descripción de la empresa</label>
                                    {!!Form::textarea('descripcion_empresa',null,array('placeholder'=>'Descripcion Empresa','class'=>'form-control','rows'=>'6'))!!}
                                    <span class="help-block has-error"> {{$errors->first('descripcion_empresa')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{$rutaNombre == 'clientes.paso1' ? 'javascript:void(0)' : '/clientes/perfil-cliente/'.$cliente->idcliente}}" class="btn btn-link">Cancelar</a>
                        {!!Form::submit('Guardar',array('class'=>'btn btn-primary ml-auto'))!!}
                    </div>
                </div>
            {!!Form::close()!!}
            </div>
        <div class="col-sm-3"></div>
      </div>
</div>
@stop
@section('scriptsown')

<script language="javascript">
    // Funciones para carga de departamentos y municipios
    flatpickr('#fecha_nacimiento_creacion',{
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

    function loadJSON2(callback) {   
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
                var lista=document.getElementById("ciudad");
                @if(Session::has('ciudad'))  
                    var deptAsisTemp = "{{Session::get('ciudad')}}";
                    if(deptAsisTemp == item.departamento) {
                        lista.options.add(new Option(item.departamento, item.departamento, false, true));
                    } else {
                        lista.options.add(new Option(item.departamento, item.departamento));
                    }
                @elseif($cliente->ciudad !== NULL)
                    deptAsisTemp = "{{$cliente->ciudad}}";
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


        // Código para cargar departamentos
        loadJSON2(function(response) {
                // Parse JSON string into object
            var JSONFinal = JSON.parse(response);
            $.each(JSONFinal, function(i,item) {
                var lista2=document.getElementById("ciudades");
                @if(Session::has('ciudad'))  
                    var deptAsisTemp = "{{Session::get('ciudad')}}";
                    if(deptAsisTemp == item.departamento) {
                        lista2.options.add(new Option(item.departamento, item.departamento, false, true));
                    } else {
                        lista2.options.add(new Option(item.departamento, item.departamento));
                    }
                @elseif($cliente->ciudad !== NULL)
                    deptAsisTemp = "{{$cliente->ciudad}}";
                    if(deptAsisTemp == item.departamento) {
                        lista2.options.add(new Option(item.departamento, item.departamento, false, true));
                    } else {
                        lista2.options.add(new Option(item.departamento, item.departamento));
                    }
                @else
                    lista2.options.add(new Option(item.departamento, item.departamento));
                @endif
            });  
        });



        var opcion = $('#tipo_persona').val();

        if (opcion == "natural") {
            document.getElementById("natural").style.display = "block";
            document.getElementById("juridica").style.display = "none";
        }
        if (opcion == "juridica") {
            document.getElementById("juridica").style.display = "block";
            document.getElementById("natural").style.display = "none";

        }

    });

    $("#tipo_persona").change(function () {
        
        var selected_option = $('#tipo_persona').val();
        console.log(selected_option);

        if (selected_option == "natural") {
            document.getElementById("natural").style.display = "block";
            document.getElementById("juridica").style.display = "none";
        }
        if (selected_option == "juridica") {
            document.getElementById("juridica").style.display = "block";
            document.getElementById("natural").style.display = "none";

        }
    });


</script>
    
@stop
