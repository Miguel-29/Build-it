@extends('front.layouts.pasos')
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
                    <div class="circleBase finished" ><p class="center"><a>2</a></p></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase finished" ><p class="center"><a>3</a></p></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="col-auto align-self-center ">
                    <div class="circleBase finished" ><p class="center"><a>4</a></p></div>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
            <div class="card-body sales-relative">
                <div class="circleBase actual" ><p class="center">5</p></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-1"></div>
    </div>
    <div class="row">
        <div class=""  style="width: 100%">
            <div class="card " style="background-color: #e4e4e4;
            box-shadow: 0 0 0; border-radius: 0;">
                {!!Form::model($proyecto,array('url'=>'clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-5','method'=>'post','class'=>'form-horizontal','files'=>'true','name'=>'formProyecto','id'=>'formProyecto4'))!!}
                    <div class="card-header">
                        <h3 class="card-title">¡Felicitaciones!</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <p>Has finalizado todos los pasos para iniciar con tu proyecto, da clic en el botón Guardar y comienza a administrarlo.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="javascript:void(0)" class="btn btn-link">Cancelar</a>
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

<script language="javascript">

</script>
@stop