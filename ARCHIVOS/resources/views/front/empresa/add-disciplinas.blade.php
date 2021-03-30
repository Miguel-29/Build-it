@extends('front.layouts.proyecto')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-8">
            {!!Form::model($empresa,array('url'=>'clientes/add-disciplinas-emp/'.$tipo.'/'.$idempresa.'/save','method'=>'post','class'=>'card','files'=>'true'))!!}
                <div class="card-header">
                    <h3 class="card-title">Añadir disciplinas</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Disciplinas *</label>
                                <select class="form-control" data-placeholder="Seleccione" name="fp_linea_enfoque_area" id="fp_linea_enfoque_area" tabindex="-1" aria-hidden="true">
                                    @foreach ($disciplinas as $disciplina)
                                        <option value="{{$disciplina->iddisciplina}}">{{$disciplina->nombre}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('fp_linea_enfoque_area')}}</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{URL::to('clientes/perfil-empresa/'.$idempresa)}}" class="btn btn-link">Cancelar</a>
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


</script>
@stop