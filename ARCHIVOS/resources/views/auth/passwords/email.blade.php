@extends('admin.layouts.default-light')
@section('contenido')

<div class="row">
    <div class="col col-login mx-auto">
       <div class="text-center mb-6">
          <img src="{{ URL::asset('assets/images/renoboyl.png') }}" class="h-6" alt="">
       </div>
       @if (session('status'))
       <div class="alert alert-success" role="alert">
          {{ session('status') }}
       </div>
       @endif
       <form method="POST" class= "card"action="{{ route('password.email') }}">
          @csrf
          <div class="card-status card-status-left bg-blue br-tr-7 br-tl-7"></div>
          <div class="card-header text-center">
             <h3 class="card-title">Olvide mi contraseña</h3>
          </div>
          <div class="card-body p-6">
             <div class="form-group">
                <label class="form-label" for="exampleInputEmail1">{{ __('Correo Electrónico') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingrese su direccion de e-mail">
                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
             </div>
             <div class="card-footer">
                <button type="submit" class="btn btn-success btn-block">{{ __('Enviar link de reestablecimiento') }}</button>
                <a class="btn btn-blue btn-block" href="{{URL::to('/login')}}">Ir al login</a>
             </div>
          </div>
       </form>
    </div>
 </div>
@endsection
