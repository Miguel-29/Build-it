@extends('admin.layouts.default-light')
@section('contenido')
<div class="row">
   <div class="col-md-3" style="margin-top: 40px">
      <h3>BUILD <b>IT</b></h3>
      <hr width="50px" color="yellow">
      <p>Crea, gerencia y ejecuta, tu proyecto de obra civil o inmoviliario, con profesionales y empresas altamente calificados.</p>
  </div>
   <div class="offset-md-5 col-md-4">
      <div class="card">
         <img class="card-img-top br-tr-7 br-tl-7" src="{{URL::to('assets/front/images/imagenes/como-deseas-registrarte-2.jpg')}}" alt="Well, I didn't vote for you.">
            <div class="card-body">
               <center><h1>Ingreso</h1></center>
               <div class="col col-login mx-auto">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                  </div>
                  @endif
                  <form method="POST" action="{{ route('password.email') }}">
                     @csrf
                     <div class="bg-blue br-tr-7 br-tl-7"></div>
                     <div class="p-6">
                        <div class="form-group">
                           <label class="form-label" for="exampleInputEmail1">{{ __('Correo Electrónico') }}</label>
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo registrado">
                           @error('email')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                        <div class="card-footer">
                           <button type="submit" class="btn btn-info  btn-block">{{ __('Enviar link de reestablecimiento') }}</button>
                           <a class="btn btn-blue btn-block" href="{{URL::to('/login')}}">Volver a inicio de sesion</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
 </div>
@endsection
