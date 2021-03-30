@extends('admin.layouts.default-light')
@section('contenido')
<div class="row">
    <div class="col col-login mx-auto">
       <div class="text-center mb-6">
          <img src="{{ URL::asset('assets/admin/images/bg-logins.png') }}" class="h-6" alt="">
       </div>
       <form class="card" method="post" action="{{ route('login') }}">
          @csrf
          <div class="card-status card-status-left bg-blue br-tr-7 br-tl-7"></div>
          <div class="card-header text-center">
             <h3 class="card-title">Sistema de administración</h3>
          </div>
          <div class="text-justify text-muted " style="padding-left: 35px; padding-right: 35px; padding-top: 20px;">
             Bienvenido al sistema de administración de Build IT. <br>
             A continuación, ingrese con su usuario y clave.
             Si no tiene estos datos por favor contáctese con el administrador del sistema.
          </div>
          <div class="card-body p-6">
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
                <a class="btn btn-link" href="{{ route('password.request') }}">
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
@stop