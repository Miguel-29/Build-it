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
                            <center><h1>¿Cómo deseas registrarte?</h1></center>
                            <form action="{{URL::to('clientes/crear')}}" method="get">
                                <div class="align-items-center pt-5 mt-auto">
                                    <div class="form-group"><input type="submit" class="btn btn-grey" value="Clientes" name="tipo" id="tipo"></div>
                                    <div class="form-group"><input type="submit" class="btn btn-grey" value="Empresas" name="tipo" id="tipo"></div>
                                    <div class="form-group"><input type="submit" class="btn btn-grey" value="Freelancer" name="tipo" id="tipo"></div>
                                    <div class="form-group"><button type="button" class="btn btn-grey">Pasantes</button></div>
                                    <div class="form-group"><input type="submit" class="btn btn-grey" value="Proveedores" name="tipo" id="tipo"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
