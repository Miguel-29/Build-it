@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Área de Profesión</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('sub-uso-ocupaciones.index') }}">Áreas de Profesiones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Área de Profesión</li>
            </ol>
		</div>
		<div class="card">
			<div class="card-header d-block">
				<h2 class="mb-2">{{ $professionArea->nombre }}</h2><br>
				<h5 class="mb-0">Id numérico: {{ $professionArea->id }}</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Basic info -->
						<div class="row">
							<div class="col-6">
								<b>Última Actualización:</b>
								{{ $professionArea->updated_at }}
							</div>
							<div class="col-6">
								<b>Fecha de Creación:</b>
								{{ $professionArea->created_at }}
							</div>
						</div>
						<hr>
						<!-- Model Info -->
						<div class="row">
							<div class="col-md-12">
								<h4>Pertenece a la Profesión:</h4>
								<p class="lead text-justify">
									{{ $profession->id }} - {{ $profession->nombre }}
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
@stop