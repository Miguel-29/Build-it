@extends('front.layouts.default')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6"><img src="{{URL::to('assets/front/images/imagenes/como-deseas-registrarte-1.jpg')}}" alt="Empresas"></div>
                <div class="col-sm-6">
                    <div class="card">
                        <img class="card-img-top br-tr-7 br-tl-7" src="{{URL::to('assets/front/images/imagenes/como-deseas-registrarte-2.jpg')}}" alt="Well, I didn't vote for you.">
                        <div class="card-body d-flex flex-column">
                            <center><h1>Ingresa tus datos</h1></center>
                                <div class="align-items-center pt-5 mt-auto">
                                    <form class="card" method="post" action="{{ route('login-front') }}">
                                        @csrf
                                            <div class="form-group">
                                                <label class="form-label">Correo Electrónico</label>
                                                <input type="email"
                                                    class="form-control{{ $errors->has('email') ? ' error' : '' }} input-no-border"
                                                    name="email" value="{{ old('email') }}"
                                                    placeholder="Escribe tu correo electrónico" required>
                                                @if($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Contraseña</label>
                                                <div class="row gutters-xs">
                                                    <div class="col">
                                                    <input type="password"
                                                        class="form-control{{ $errors->has('password') ? ' error' : '' }} input-no-border"
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
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
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
