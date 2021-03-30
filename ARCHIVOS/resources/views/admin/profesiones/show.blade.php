@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Profesión</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('profesiones.index') }}">Profesiones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profesión</li>
            </ol>
		</div>
		<div class="card">
			<div class="card-header d-block">
				<h2 class="mb-2">{{ $profession->nombre }}</h2><br>
				<h5 class="mb-0">Id numérico: {{ $profession->id }}</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Basic info -->
						<div class="row">
							<div class="col-6">
								<b>Última Actualización:</b>
								{{ $profession->updated_at }}
							</div>
							<div class="col-6">
								<b>Fecha de Creación:</b>
								{{ $profession->created_at }}
							</div>
						</div>
						<hr>
						<!-- Model Info -->
						<div class="row">
							<div class="col-md-12">
								<h4>Estado:</h4>
								<p class="lead text-justify">
									@if($profession->isActive())
										Esta profesión se encuentra <strong>activada</strong> en estos momentos.
									@else
										<strong>No está activada</strong> esta profesión en estos momentos.
									@endif
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
@stop