@extends('front.layouts.proyecto')
@section('content')
<style>
.cn {
  display: flex;
  justify-content: center;
  align-items: center; 
}
</style>

<div class="container">
    <img src="{{URL::to('assets/front/images/imagenes/home/b-beneficios.jpg')}}" alt="Contratistas">
    <div class="row general-view profesionales-info" style="padding-top: 0">
        <div class="col-sm-12">
            <div class="card" style="border-radius: 0;">
                <div class="card-body">

                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list tab-tipos-clientes">
                                <li>Clientes</li>
                                <li>Contratistas</li>
                                <li>Universidades</li>
                                <li>Pasantes</li>
                            </ul>
                            <div class="content_wrapper">
                                <div class="tab_content">
                                    <div class="card" style="background-color: #ffffff;">
                                        <div class="card-body">
                                            <div class="panel panel-primary">
                                                <div class="tab_wrapper first_tab">
                                                    <ul class="tab_list tab-beneficios">
                                                        <li>Beneficios</li>
                                                        @if($descuentosClientes->count() > 0)
                                                            <li>Descuentos</li>
                                                        @endif
                                                    </ul>
                                                    <div class="content_wrapper">
                                                        <div class="tab_content">
                                                            @foreach ($beneficiosClientes as $item)
                                                                <br>
                                                                <h5 style="color: #153556"><b>{{$item->titulo}}</b></h5>
                                                                <hr>
                                                                <p>{!!$item->descripcion!!}</p>
                                                                <hr>
                                                            @endforeach
                                                        </div>
                                                        @if($descuentosClientes->count() > 0)
                                                            @php
                                                                $cuentaDesc = 0;
                                                            @endphp
                                                            <div class="tab_content">
                                                                @foreach ($descuentosClientes as $item)
                                                                    @if($cuentaDesc == 0)
                                                                        <br>
                                                                        <h5 style="color: #153556"><b>{{$item->titulo}}</b></h5>
                                                                        <hr>
                                                                    @endif
                                                                    <div class="row col-md-12">
                                                                        <div class="col-md-3 ">
                                                                            <center><img src="/uploads/beneficios/{{$item->idbeneficio}}/{{$item->imagen}}" width="100" height="100"/></center>
                                                                        </div>
                                                                        <div class="col-md-5 ">
                                                                            <center>
                                                                            {!!$item->descripcion!!}
                                                                            </center>

                                                                        </div>
                                                                        <div class="col-md-4 ">
                                                                            <center>
                                                                                <a href="{{URL::to('/uploads/beneficios/'.$item->idbeneficio.'/'.$item->archivo)}}" download="terminos-condiciones-{{date("Y-m-d H:i:s")}}.pdf" target="_blank" aria-disabled="true">Obtén tu descuento aquí > </a>
                                                                            </center>

                                                                        </div>

                                                                    </div>
                                                                    <hr>
                                                                @endforeach

                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_content">
                                    <div class="card" style="background-color: #ffffff;">
                                        <div class="card-body">
                                            <div class="panel panel-primary">
                                                <div class="tab_wrapper first_tab">
                                                    <ul class="tab_list tab-beneficios">
                                                        <li>Beneficios</li>
                                                        @if($descuentosContratistas->count() > 0)
                                                            <li>Descuentos</li>
                                                        @endif
                                                    </ul>
                                                    <div class="content_wrapper">
                                                        <div class="tab_content">
                                                            @foreach ($beneficiosContratistas as $item)
                                                                <br>
                                                                <h5 style="color: #153556"><b>{{$item->titulo}}</b></h5>
                                                                <hr>
                                                                <p>{!!$item->descripcion!!}</p>
                                                                <hr>
                                                            @endforeach

                                                        </div>
                                                        @if($descuentosContratistas->count() > 0)
                                                            @php
                                                                $cuentaDesc = 0;
                                                            @endphp
                                                            <div class="tab_content">
                                                                @foreach ($descuentosContratistas as $item)
                                                                    @if($cuentaDesc == 0)
                                                                        <br>
                                                                        <h5 style="color: #153556"><b>{{$item->titulo}}</b></h5>
                                                                        <hr>
                                                                    @endif
                                                                    <div class="row col-md-12 cn ">
                                                                        <div class="col-md-3 ">
                                                                            <center><img src="/uploads/beneficios/{{$item->idbeneficio}}/{{$item->imagen}}" width="100" height="100"/></center>
                                                                        </div>
                                                                        <div class="col-md-5 ">
                                                                            <center>
                                                                            {!!$item->descripcion!!}
                                                                            </center>

                                                                        </div>
                                                                        <div class="col-md-4 ">
                                                                            <center>
                                                                                @if(Auth::user()->hasRole('Cliente'))
                                                                                    <b>No puedes descargar los descuentos debido a tu rol</b>
                                                                                @else
                                                                                    <a href="{{URL::to('/uploads/beneficios/'.$item->idbeneficio.'/'.$item->archivo)}}"   download="terminos-condiciones-{{date("Y-m-d H:i:s")}}.pdf" target="_blank">Obtén tu descuento aquí > </a>
                                                                                @endif
                                                                            </center>

                                                                        </div>

                                                                    </div>
                                                                    <hr>
                                                                    @php
                                                                        $cuentaDesc = $cuentaDesc+1;
                                                                    @endphp
                                                                @endforeach

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_content">
                                    <div class="card" style="background-color: #ffffff;">
                                        <div class="card-body">
                                            <div class="panel panel-primary">
                                                <div class="tab_wrapper first_tab">
                                                    <ul class="tab_list tab-beneficios">
                                                        <li>Beneficios</li>
                                                        @if($descuentosUniversidades->count() > 0)
                                                            <li>Descuentos</li>
                                                        @endif
                                                    </ul>
                                                    <div class="content_wrapper">
                                                        <div class="tab_content">
                                                            @foreach ($beneficiosUniversidades as $item)
                                                                <br>
                                                                <h5 style="color: #153556"><b>{{$item->titulo}}</b></h5>
                                                                <hr>
                                                                <p>{!!$item->descripcion!!}</p>
                                                                <hr>
                                                            @endforeach


                                                        </div>
                                                        @if($descuentosUniversidades->count() > 0)
                                                            <div class="tab_content">
                                                                @foreach ($descuentosUniversidades as $item)
                                                                    <br>
                                                                    <h5 style="color: #153556"><b>{{$item->titulo}}</b></h5>
                                                                    <hr>
                                                                    <div class="row col-md-12 ">
                                                                        <div class="col-md-3 ">
                                                                            <center><img src="/uploads/beneficios/{{$item->idbeneficio}}/{{$item->imagen}}" width="100" height="100"/></center>
                                                                        </div>
                                                                        <div class="col-md-5 ">
                                                                            <center>
                                                                            {!!$item->descripcion!!}
                                                                            </center>

                                                                        </div>
                                                                        <div class="col-md-4 ">
                                                                            <center>
                                                                                <a href="{{URL::to('/uploads/beneficios/'.$item->idbeneficio.'/'.$item->archivo)}}" download="terminos-condiciones-{{date("Y-m-d H:i:s")}}.pdf" target="_blank">Obtén tu descuento aquí > </a>
                                                                            </center>

                                                                        </div>

                                                                    </div>
                                                                    <hr>
                                                                @endforeach


                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_content">
                                    <div class="card" style="background-color: #ffffff;">
                                        <div class="card-body">
                                            <div class="panel panel-primary">
                                                <div class="tab_wrapper first_tab">
                                                    <ul class="tab_list tab-beneficios">
                                                        <li>Beneficios</li>
                                                        @if($descuentosPasantes->count() > 0)
                                                            <li>Descuentos</li>
                                                        @endif
                                                    </ul>
                                                    <div class="content_wrapper">
                                                        <div class="tab_content">
                                                            @foreach ($beneficiosPasantes as $item)
                                                                <br>
                                                                <h5 style="color: #153556"><b>{{$item->titulo}}</b></h5>
                                                                <hr>
                                                                <p>{!!$item->descripcion!!}</p>
                                                                <hr>
                                                            @endforeach


                                                        </div>
                                                        @if($descuentosPasantes->count() > 0)
                                                            <div class="tab_content">
                                                                @foreach ($descuentosPasantes as $item)
                                                                    <br>
                                                                    <h5 style="color: #153556"><b>{{$item->titulo}}</b></h5>
                                                                    <hr>
                                                                    <div class="row col-md-12 ">
                                                                        <div class="col-md-3 ">
                                                                            <center><img src="/uploads/beneficios/{{$item->idbeneficio}}/{{$item->imagen}}" width="100" height="100"/></center>
                                                                        </div>
                                                                        <div class="col-md-5 ">
                                                                            <center>
                                                                            {!!$item->descripcion!!}
                                                                            </center>

                                                                        </div>
                                                                        <div class="col-md-4 ">
                                                                            <center>
                                                                                <a href="{{URL::to('/uploads/beneficios/'.$item->idbeneficio.'/'.$item->archivo)}}" download="terminos-condiciones-{{date("Y-m-d H:i:s")}}.pdf" target="_blank">Obtén tu descuento aquí > </a>
                                                                            </center>

                                                                        </div>

                                                                    </div>
                                                                    <hr>
                                                                @endforeach

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<script>
    $(function(e) {
        $(".first_tab").champ();
        $(".accordion_example").champ({
            plugin_type: "accordion",
            side: "left",
            active_tab: "3",
            controllers: "true"
        });

        $(".second_tab").champ({
            plugin_type: "tab",
            side: "right",
            active_tab: "1",
            controllers: "false"
        });

        $(".table-1").css("width", "100%");
        $('.table-1').prev().addClass('cn');
        $('div[style="text-align: center;"]').addClass('cn');


    });
</script>
@stop