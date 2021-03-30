@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Grupo de Uso</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('grupos-uso.index') }}">Grupo de Usos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grupo de Uso</li>
            </ol>
		</div>
		<div class="card">
			<div class="card-header d-block">
				<h2 class="mb-2">{{ $useGroup->nombre }}</h2><br>
				<h5 class="mb-0">Id numérico: {{ $useGroup->id }}</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Basic info -->
						<div class="row">
							<div class="col-6">
								<b>Última Actualización:</b>
								{{ $useGroup->updated_at }}
							</div>
							<div class="col-6">
								<b>Fecha de Creación:</b>
								{{ $useGroup->created_at }}
							</div>
						</div>
						<hr>
						<!-- Model Info -->
						<div class="row">
							<div class="col-md-12">
								<h4>Descripción:</h4>
								<p class="lead text-justify">
									{{ $useGroup->descripcion != '' ? $useGroup->descripcion : 'Este grupo de uso no cuenta con una descripción.' }}
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<p class="category">
					<a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{ route('sub-uso-ocupaciones.index-by-use-group', $useGroup->id) }}">
						Ver Sub Usos de Ocupaciones
					</a>
				</p>
			</div>
		</div>
    </div>
@stop