@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Consultar Usuario </a></li>
                <li class="breadcrumb-item active" aria-current="page">Consultar Usuario</li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header bg-blue br-tr-7 br-tl-7">
                <h3 class="card-title text-white">Consultar Usuario: <strong>{{$usuario->name}} {{$usuario->lastname}}</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-default bmd-form-group">
                            <p><strong style="color: #1C4E8B">Nombres del Usuario </strong><br>{{$usuario->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-default bmd-form-group">
                            <p><strong style="color: #1C4E8B">Apellidos del Usuario </strong><br>{{$usuario->lastname}}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-default bmd-form-group">
                            <p><strong style="color: #1C4E8B">Email </strong><br>{{$usuario->email}}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-default bmd-form-group">
                            <p><strong style="color: #1C4E8B">Roles asociados al usuario </strong><br>
                            <?php
                                $rolesuser = $usuario->getRoleNames();
                                //print_r($rolesuser);
                                foreach($rolesuser as $valor)
                                {
                                    echo $valor;
                                }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer ">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-success ml-auto"
                            onclick="document.location.href='{{ URL::to('usuarios/') }}'">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop