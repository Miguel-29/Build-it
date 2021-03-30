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
                    <div class="card-title">Suministra información necesaria para el proyecto</div>
                </div>
                <div class="card-body p-6">
                    <div class="wizard-container">
                        <div class="wizard-card m-0" data-color="blue" id="wizardProfile">
                            {!!Form::model($proyecto,array('url'=>'clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/inmobiliaria/paso-2','method'=>'post','class'=>'form-horizontal','files'=>'true','name'=>'formProyecto','id'=>'formProyecto'))!!}
                                <div class="wizard-navigation">
                                    <ul class="nav nav-pills">
                                        <li><a href="#about" data-toggle="tab">General</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
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
                                                            old('departamento'),
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
                                                            old('ciudad'),
                                                            array('class'=>'form-control','id' => 'ciudad','required' => 'required')
                                                            )!!}
                                                            <span class="help-block has-error"> {{$errors->first('ciudad')}}</span>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                      <label class="control-label">Área (m2) *</label>
                                                      {!!Form::number('area',null,array('placeholder'=>'Área','class'=>'form-control','required' => 'required'))!!}
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-group label-floating">
                                                      <label class="control-label">Cantidad de pisos *</label>
                                                      {!!Form::number('cantidad_pisos',null,array('placeholder'=>'Cantidad de Pisos','class'=>'form-control','required' => 'required'))!!}
                                                    </div>
                                                </div>
                                                @php
                                                    $adicional = array(
                                                    "Tomar en Arriendo",
                                                    "Vender",
                                                    "Poner en Arriendo",
                                                    "Comprar",
                                                    "Aváluos");

                                                @endphp
                                                <div class="input-group radio-inf-adc">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">¿Cuál función buscas de una inmobiliria?</label>
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
                                                            {!!Form::text('direccion',null,array('placeholder'=>'Escribe una dirección','class'=>'form-control','id'=>'geocomplete'))!!}
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
    $(document).ready(function() {
        var $validator = $(".wizard-card form").validate({
            rules: {
                
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
                
            // Código para cargar departamentos
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

            // Código para cargar departamentos
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
            $("#ie_grupouso").change(function(){
                var grupouso = $(this).val();
                $.ajax({
                    url:"/api/grupouso/"+grupouso,
                    type:"GET",
                    success:function(data){  //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                        var codigo_select = '<option value="" selected>Seleccione un subuso</option>'
                        for (var i=0; i<data.length;i++)
                            codigo_select+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
            
                        $("#ie_subuso").html(codigo_select);

                    }    
                });
            });
        });

        $("#ad_administracion").change(function () {
        
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
        });

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