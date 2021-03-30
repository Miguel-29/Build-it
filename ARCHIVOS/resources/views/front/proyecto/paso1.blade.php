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
                    <div class="circleBase actual"><p class="center">1</p></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase" ><p class="center">2</p></div>
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
    <div class="row ">
        <div style="width: 100%">
            <div class="card" style="background-color: #e4e4e4;
            box-shadow: 0 0 0; border-radius: 0;" >
                <div class="card-header">
                    <h3 class="card-title">¿Qué tipo de proyecto quieres realizar con Build It?</h3>
                </div>
                {!!Form::open(array('url'=>'clientes/crear-proyecto/'.$idcliente.'/paso-1','method'=>'post'))!!}
                    <div class="card-body d-flex flex-column">
                        <div class="row">
                            <div class="form-group">
                                <label class="form-label">Selecciona el tipo de proyecto</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <select class="form-control "
                                    data-placeholder="Choose one" tabindex="-1" aria-hidden="true" multiple size="8" id="idtipo" name="idtipo">
                                    <option label="Seleccione" selected></option>
                                    @foreach ($tipoproyecto as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-8" id="descripcion">
                            </div>
                        </div>
                    </div>
                
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{URL::to('clientes/ultimas-noticias')}}" class="btn btn-link">Cancelar</a>
                            {!!Form::submit('Guardar',array('class'=>'btn btn-primary ml-auto'))!!}
                        </div>
                    </div>
                {!!Form::close()!!}

            </div>
        </div>
    </div>
</div>
@stop
@section('scriptsown')

<script>
    $('.dropify').dropify();

    $("#idtipo").change(function () {
        
        var selected_option = $('#idtipo').val();
        console.log(selected_option);

        let proyecto= `/api/proyectos/get-proyectos/${selected_option}`;
        $.get(proyecto,(proyectos)=>{
            $("#descripcion").empty();
            if(proyectos.imagen !== null){
                html =  '<div class="card card-blog-overlay" style="height: 200px; background: url(/storage/'+proyectos.imagen+'); background-size: cover">';
            }else{
                html =  '<div class="card card-blog-overlay" style="height: 200px;">';
            }
                html +=        '<div class="card-body blog-content-wrapper">'+
                            '<div class="blog-content">'+
                                '<h4 class="blog-title text-white">'+proyectos.nombre+':</h4>'+
                                '<p class="blog-category text-white col-md-8">'+proyectos.descripcion+'</p>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
            $("#descripcion").append(html); 
        });
    });
</script>
    
@stop
