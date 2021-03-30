@extends('admin.layouts.default')
@section('content')
   <div class="side-app">
      <div class="page-header">
         <h4 class="page-title">Permisos asociados al Rol : {{ $objrol->name }}</h4>
         <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Permisos Rol</li>
         </ol>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-12 col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <div class="card-title">Seleccione los permisos que considere convenientes para el Rol.</div>
                  </div>
                  <div class="card-body">
                     {!!Form::open(array('url'=>'roles/'.$objrol->id.'/permisos/guardar','method'=>'post','class'=>'form-horizontal'))!!}
                     <div class="table-responsive">
                        <table id="example" class="table card-table table-vcenter text-nowrap" style="width:100%">
                           <tbody>
                              @foreach($listadopermisos as $valor)
                                 <tr>
                                    <td>
                                       <div class="custom-controls-stacked">
                                          <label class="custom-control custom-checkbox">
                                             <?php
                                                      if($objrol->hasPermissionTo($valor->name))
                                                      {
                                                      ?>
                                             <input type="checkbox" class="custom-control-input" name="items[]"
                                                id="item_{{ $valor->id }}" value="{{ $valor->name }}" checked>
                                             <?php
                                                      } else{
                                                      ?>
                                             <input type="checkbox" class="custom-control-input" name="items[]"
                                                id="item_{{ $valor->id }}" value="{{ $valor->name }}">
                                             <?php
                                                      }
                                                      ?>
                                             <span class="custom-control-label"></span>
                                          </label>
                                       </div>
                                    </td>
                                    <td>{{ $valor->name }}</td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
                        <div class="hr-line-dashed"></div>
                        <center>{!!Form::submit('Asignar permisos',array('class'=>'btn btn-success ml-auto'))!!}
                           <button type="button" class="btn btn-blue ml-auto"
                              onclick="document.location.href='{{ URL::to('roles/') }}'">Volver</button>
                        </center>
                        {!!Form::close()!!}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@stop