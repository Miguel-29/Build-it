@extends('front.layouts.login')
@section('content')
<div class="container-fluid" style="height: 100%; background-image: url({{url('images/MicrosoftTeams-image.png')}})">
    <div class="row">
        <div class="col-sm-12">
            <div class="row" style="margin: 95px 30px 0 30px">
                <div class="col-md-3 text-dark" style="margin-top: 40px">
                    <h1>BUILD <b>IT</b></h1>
                    <hr width="50px" color="yellow">
                    <p>Crea, gerencia y ejecuta, tu proyecto de obra civil o inmoviliario, con profesionales y empresas altamente calificados.</p>
                </div>
                {{-- <div class="col-sm-6"><img src="{{URL::to('assets/front/images/imagenes/como-deseas-registrarte-1.jpg')}}" alt="Empresas"></div> --}}
                <div class="offset-md-5 col-md-4">
                    <div class="card">
                        <img class="card-img-top br-tr-7 br-tl-7" src="{{URL::to('assets/front/images/imagenes/como-deseas-registrarte-2.jpg')}}" alt="Well, I didn't vote for you.">
                        <div class="card-body d-flex flex-column">
                            <h1 class="text-center">Ingreso</h1>
                                <div class="align-items-center pt-5 mt-auto">
                                    <form class="card" method="post" action="{{ route('login-front') }}">
                                        @csrf
                                            <div class="form-group">
                                                {{-- <label class="form-label">Correo Electrónico</label> --}}
                                                <input type="email" style="border: 0; border-bottom: 1px solid; width: 100%; height: 37px"
                                                    class="{{ $errors->has('email') ? ' error' : '' }} input-no-border"
                                                    name="email" value="{{ old('email') }}" placeholder="Correo electronico" required>
                                                @if($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                                {{-- <input type="text" placeholder="Correo electronico"> --}}
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="row gutters-xs">
                                                    <div class="col">
                                                    <input type="password" style="border: 0; border-bottom: 1px solid; width: 100%; height: 37px;"
                                                        class="{{ $errors->has('password') ? ' error' : '' }} input-no-border"
                                                        name="password" placeholder="Escribe tu contraseña" id="password" required>
                                                    @if($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                    </div>
                                                    <span class="col-auto">
                                                        <button type="button" class="btn btn-icon btn-blue" id="boton"><i class="fa fa-eye" id="mostrar"></i></button>
                                                    </span>
                                                </div>
                                                @if(Route::has('password.request'))
                                                <a class="btn btn-link" style="border: 0px" href="{{ route('password.request') }}">
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                                </a>
                                                @endif
                                            </div>
                                            <div class="card-footer mx-auto">
                                                <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                                                <a type="button" href="#" class="btn ">Registrarse</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <label>Todos los derechos reservados</label>
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
    });
</script>

@endsection
