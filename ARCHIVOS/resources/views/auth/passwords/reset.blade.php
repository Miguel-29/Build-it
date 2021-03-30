@extends('admin.layouts.default-light')

@section('contenido')
<div class="row justify-content-center">
    <div class="col col-login mx-auto">
       <div class="card">
          <div class="card-header"><strong>{{ __('Cambiar Contraseña') }}</strong></div>
          <div class="card-body">
             <form method="POST" class="card" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="card-body p-6">
                   <div class="form-group">
                      <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                   </div>
                   <div class="form-group">
                      <label for="password" class="form-label">{{ __('Nueva contraseña') }}</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                   </div>
                   <div class="form-group">
                      <label for="password-confirm" class="form-label">{{ __('Confirmar contraseña') }}</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                   </div>
                   <div class="form-footer">
                      <button type="submit" class="btn btn-primary">
                      {{ __('Cambiar contraseña') }}
                      </button>
                   </div>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>
@endsection
