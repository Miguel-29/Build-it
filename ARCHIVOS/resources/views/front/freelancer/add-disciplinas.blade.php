@extends('front.layouts.proyecto')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            {!!Form::model($freelancer,array('url'=>'clientes/add-disciplinas/'.$tipo.'/'.$idfreelancer.'/save','method'=>'post','class'=>'card','files'=>'true'))!!}
                <div class="card-header">
                    <h3 class="card-title">Añadir disciplinas</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Profesión *</label>
                                <select class="form-control" data-placeholder="Seleccione" name="fp_profesion" id="fp_profesion" tabindex="-1" aria-hidden="true" required>
                                    <option label="Seleccione" selected></option>
                                    @foreach ($profesiones as $profesion)
                                        <option value="{{$profesion->id}}">{{$profesion->nombre}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('fp_profesion')}}</p>

                            </div>
                            <div class="form-group">
                                <label class="form-label">Disciplinas *</label>
                                <select class="form-control" data-placeholder="Seleccione" name="fp_linea_enfoque_area" id="fp_linea_enfoque_area" tabindex="-1" aria-hidden="true">
                                    <option label="Seleccione" selected></option>
                                </select>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('fp_linea_enfoque_area')}}</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{URL::to('clientes/perfil-freelancer/'.$idfreelancer)}}" class="btn btn-link">Cancelar</a>
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

    $(document).ready(function(){
        $("#fp_profesion").change(function(){
            var profesion = $(this).val();
            $.ajax({
                url:"/api/profesion/"+profesion,
                type:"GET",
                success:function(data){  //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                    var codigo_select = '<option value="">Seleccione un área</option>'
                    for (var i=0; i<data.length;i++)
                        codigo_select+='<option value="'+data[i].iddisciplina+'">'+data[i].nombre+'</option>';
        
                    $("#fp_linea_enfoque_area").html(codigo_select);

                }    
            });
        });
    });

</script>
@stop