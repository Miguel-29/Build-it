@extends('admin.layouts.default')
@section('content')
   <div class="side-app">
      <div class="page-header">
         <h4 class="page-title">Profesiones asociadas a la Disciplina : {{ $disciplina->nombre }}</h4>
         <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Servicios Rol</li>
         </ol>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-12 col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <div class="card-title">Seleccione las profesiones que considere convenientes para la Disciplina.</div>
                  </div>
                  <div class="card-body">
                     {!!Form::open(array('url'=>'disciplinas/'.$disciplina->iddisciplina.'/profesiones/guardar','method'=>'post','class'=>'form-horizontal'))!!}
                     <div class="table-responsive">
                        <table id="example" class="table card-table table-vcenter text-nowrap" style="width:100%">
                           <tbody>
                              @foreach($profesiones as $valor)
                                 <tr>
                                    <td>
                                       <div class="custom-controls-stacked">
                                          <label class="custom-control custom-checkbox">
                                            @php
                                                $list1= $disciplina->profesiones;
                                                $bande = false;
                                                if(!empty($list1)){
                                                    foreach($list1 as $value)
                                                    {
                                                        if($value->id==$valor->id)
                                                        {
                                                            $bande = true; 
                                                            break;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <input type="checkbox" class="custom-control-input" name="items[]"
                                            id="item_{{ $valor->id }}" value="{{ $valor->id }}" @if($bande) checked="checked" @endif>
                                            <span class="custom-control-label"></span>
                                          </label>
                                       </div>
                                    </td>
                                    <td>{{ $valor->nombre }}</td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
                        <div class="hr-line-dashed"></div>
                        <center>{!!Form::submit('Asignar profesiones',array('class'=>'btn btn-success ml-auto'))!!}
                           <button type="button" class="btn btn-blue ml-auto"
                              onclick="document.location.href='{{ URL::to('disciplinas/') }}'">Volver</button>
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