@extends('front.layouts.default')
@section('content')
@php
        $categoria = \App\Models\Admin\Categoria::where('nombre','Terminos y condiciones')->first();
        $posts = $categoria->post()->where('estado','publicado')->first();

@endphp
<div class="container">
    <div class="row mb-6">
        @if($tipo == "empresas")
            <img src="{{URL::to('assets/front/images/imagenes/empresas/banner-crear-cuenta.jpg')}}" alt="Empresas">
        @elseif($tipo == "freelancer")
            <img src="{{URL::to('assets/front/images/imagenes/freelancer/banner-tipo-cliente.jpg')}}" alt="Freelancer">
        @elseif($tipo == "proveedores")
            <img src="{{URL::to('assets/front/images/imagenes/proveedores/banner-tipo-cliente-5.jpg')}}" alt="Proveedores">
        @elseif($tipo == "clientes")
            <img src="{{URL::to('assets/front/images/imagenes/clientes/banner-tipo-cliente-4.jpg')}}" alt="Clientes">
        @else
            <img src="https://via.placeholder.com/1500x400" alt="img">
        @endif
    </div>
    <div class="row">
        <div class="col col-md-7 mx-auto">
            @if($tipo == "freelancer")
                {!!Form::open(array('url'=>'clientes/crear-f/'.$tipo.'','method'=>'post','class'=>'card'))!!}
            @elseif($tipo == "clientes")
                {!!Form::open(array('url'=>'clientes/crear-c/'.$tipo.'','method'=>'post','class'=>'card'))!!}
            @elseif($tipo == "empresas")
                {!!Form::open(array('url'=>'clientes/crear-e/'.$tipo.'','method'=>'post','class'=>'card'))!!}
            @elseif($tipo == "proveedores")
                {!!Form::open(array('url'=>'clientes/crear-p/'.$tipo.'','method'=>'post','class'=>'card'))!!}
            @endif
                <div class="card-body p-6">
                <div class="card-title text-center">Crea tu cuenta - {{ucwords($tipo)}}</div>
                    <div class="mb-6" style="text-align: center; display: none;">
                        <button type="button" class="btn btn-facebook"><i class="fa fa-facebook mr-2"></i>Facebook</button>
                        <button type="button" class="btn btn-red"><i class="fa fa-google mr-2"></i>Google</button> 
                    </div>
                    <div class="mb-6"><hr/></div>
                    <div class="form-group" style="text-align: left">
                        {!!Form::label('email','Email',array('class' => 'control-label','style' => 'color: black'))!!}
                        {!!Form::text('email',old('email'),array('placeholder'=>'Ingrese una dirección de correo electrónico','class'=>'form-control'))!!}
                        <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('email')}}</p>

                    </div>
                    <div class="form-group" style="text-align: left">
                        {!!Form::label('password','Password',array('class' => 'control-label','style' => 'color: black'))!!}
                        <div class="row gutters-xs">
                            <div class="col">
                                {!!Form::password('password',array('placeholder'=>'Ingrese una contraseña','class'=>'form-control','id' => 'password'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('password')}}</p>
                            </div>
                            <span class="col-auto">
                                <button type="button" class="btn btn-icon btn-blue" id="boton"><i class="fa fa-eye" id="mostrar"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group" style="text-align: left">
                        {!!Form::label('password_repite','Confirmar Password',array('class' => 'control-label','style' => 'color: black'))!!}
                        <div class="row gutters-xs">
                            <div class="col">
                                {!!Form::password('password_repite',array('placeholder'=>'Repita la contraseña','class'=>'form-control','id' => 'password_repite'))!!}
                                <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('password_repite')}}</p>
                            </div>
                            <span class="col-auto">
                                <button type="button" class="btn btn-icon btn-blue" id="boton2"><i class="fa fa-eye" id="mostrar2"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="terminos" id="terminos" class="custom-control-input" required/>
                            <span class="custom-control-label">Al crear tu cuenta estás aceptando los <a data-toggle="modal" data-target="#exampleModalLong" style="color: #fc7303" >términos y condiciones</a> de la política de privacidad de Build It.</span>
                            <p class="help-block has-error"  style="color:#f4981a"> {{$errors->first('terminos')}}</p>

                        </label>
                    </div>
                    <div class="form-footer">
                        {!!Form::submit('Crea tu cuenta',array('class'=>'btn btn-primary btn-block'))!!}
                    </div>
                    <div class="text-center text-muted mt-4">
                        ¿Ya estás registrado en Built It? <a href="{{'/clientes/login'}}" style="color: #fc7303">Iniciar sesión</a>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
        <!--Scrolling Modal-->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Términos y Condiciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!!$posts->descripcion!!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop
@section('scriptsown')

<script language="javascript">
    $(document).ready(function () {
        $('#boton').click(function () {
            if ($('#mostrar').hasClass('fa-eye')) {
                $('#password').removeAttr('type');
                $('#mostrar').addClass('fa-eye-slash').removeClass('fa-eye');
            } else {
                //Establecemos el atributo y valor
                $('#password').attr('type', 'password');
                $('#mostrar').addClass('fa-eye').removeClass('fa-eye-slash');
            }
        });

        $('#boton2').click(function () {
            if ($('#mostrar2').hasClass('fa-eye')) {
                $('#password_repite').removeAttr('type');
                $('#mostrar2').addClass('fa-eye-slash').removeClass('fa-eye');
            } else {
                //Establecemos el atributo y valor
                $('#password_repite').attr('type', 'password');
                $('#mostrar2').addClass('fa-eye').removeClass('fa-eye-slash');
            }
        });
    });
</script>

@endsection
