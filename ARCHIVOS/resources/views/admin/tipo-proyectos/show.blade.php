@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Tipo de Proyecto</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tipo-proyectos.index') }}">Tipo de Proyectos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tipo de Proyecto</li>
            </ol>
		</div>
		<div class="card">
			<div class="card-header d-block">
				<h2 class="mb-2">{{ $projectType->nombre }}</h2><br>
				<h5 class="mb-0">Id numérico: {{ $projectType->id }}</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Basic info -->
						<div class="row">
							<div class="col-6">
								<b>Última Actualización:</b>
								{{ $projectType->updated_at }}
							</div>
							<div class="col-6">
								<b>Fecha de Creación:</b>
								{{ $projectType->created_at }}
							</div>
						</div>
						<hr>
						<!-- Model Info -->
						<div class="row">
							<div class="col-md-12">
								<h4>Imagen:</h4>
								@if($projectType->imagen !== null) 
									<img src="{{ $projectType->getImageUrl() }}" alt="{{ $projectType->nombre }}" class="img-fluid">
								@else
									Este tipo de proyecto no cuenta con una imagen asociada.
								@endif
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<h4>Descripción:</h4>
								<p class="lead text-justify">
									{{ $projectType->descripcion != '' ? $projectType->descripcion : 'Este tipo de proyecto no cuenta con una descripción.' }}
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
@stop