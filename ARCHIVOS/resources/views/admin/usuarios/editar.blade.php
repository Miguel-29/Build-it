@extends('admin.layouts.default')
@section('content')
<div class="side-app">
   <div class="page-header">
      <h4 class="page-title">Editar Usuario</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Inicio</a></li>
         <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
      </ol>
   </div>
   {!!Form::model($usuario,array('action'=>array('Admin\UsersController@actualizar',$usuario->id),'method'=>'post','class'=>'card'))!!}
   <div class="card-body ">
      <div class="row">
         <div class="col-sm-6 col-md-6">
            {!!Form::label('name','Nombres del Usuario',array('class' => 'form-label'))!!}
            <div class="col-md-12">
               <div class="form-group has-default bmd-form-group">
                  {!!Form::text('name',null,array('placeholder'=>'Ingrese los nombres del usuario','class'=>'form-control'))!!}
                  <span class="help-block has-error"> {{$errors->first('name')}}</span>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6">
            {!!Form::label('lastname','Apellidos del Usuario',array('class' => 'form-label'))!!}
            <div class="col-md-12">
               <div class="form-group has-default bmd-form-group">
                  {!!Form::text('lastname', null,array('placeholder'=>'Ingrese los apellidos del usuario','class'=>'form-control'))!!}
                  <span class="help-block has-error"> {{$errors->first('lastname')}}</span>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6 col-lg-6">
            {!!Form::label('email','Email del Usuario',array('class' => 'form-label'))!!}
            <div class="col-md-12">
               <div class="form-group has-default bmd-form-group">
                  {!!Form::text('email', null,array('placeholder'=>'Ingrese el email del usuario','class'=>'form-control'))!!}
                  <span class="help-block has-error"> {{$errors->first('email')}}</span>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6">
            {!!Form::label('password','Contrase??a',array('class' => 'form-label'))!!}
            <div class="col-md-12">
               <div class="form-group has-default bmd-form-group">
                  {!!Form::password('password',array('placeholder'=>'Ingrese la contrase??a del usuario','class'=>'form-control'))!!}
                  <span class="help-block has-error"> {{$errors->first('password')}}</span>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6">
            {!!Form::label('password_repite','Repite contrase??a',array('class' => 'form-label'))!!}
            <div class="col-md-12">
               <div class="form-group has-default bmd-form-group">
                  {!!Form::password('password_repite',array('placeholder'=>'Repita la contrase??a','class'=>'form-control'))!!}
                  <span class="help-block has-error"> {{$errors->first('password_repite')}}</span>
               </div>
            </div>
         </div>
      </div>
      <div class="card-footer ">
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <h4 class="card-title">Roles asociados al usuario:</h4>
               </div>
               <table class="table">
                  <tbody>
                     @foreach($listroles as $valor)
                     <tr>
                        <td>
                           <div class="custom-controls-stacked">
                              <label class="custom-control custom-checkbox">
                              <?php
                                 if($usuario->hasRole($valor->name)) {
                                 ?>
                              <input type="checkbox" class="form-check-input custom-control-input items" name="items[]" id="item_{{$valor->id}}" value="{{$valor->name}}" checked>
                              <?php
                                 } else { 
                                 ?>
                              <input type="checkbox" class="form-check-input custom-control-input items" name="items[]" id="item_{{$valor->id}}" value="{{$valor->name}}">
                              <?php
                                 }
                                 ?>
                              <span class="custom-control-label">{{$valor->name}}</span>
                              </label>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               <div class="hr-line-dashed"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               {!!Form::submit('Editar Usuario',array('class'=>'btn btn-success ml-auto'))!!}
               <button type="button" class="btn btn-blue ml-auto" onclick="document.location.href='{{ URL::to('usuarios/') }}'">Volver</button>
            </div>
         </div>
      </div>
   </div>
   {!!Form::close()!!}
</div>
@stop