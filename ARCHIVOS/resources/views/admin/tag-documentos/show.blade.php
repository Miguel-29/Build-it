@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Tag de Documento</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tag-documentos.index') }}">Tags de Documentos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tag de Documento</li>
            </ol>
		</div>
		<div class="card">
			<div class="card-header d-block">
				<h2 class="mb-2">{{ $documentTag->tago }}</h2><br>
				<h5 class="mb-0">Id numérico: {{ $documentTag->id }}</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Basic info -->
						<div class="row">
							<div class="col-6">
								<b>Última Actualización:</b>
								{{ $documentTag->updated_at }}
							</div>
							<div class="col-6">
								<b>Fecha de Creación:</b>
								{{ $documentTag->created_at }}
							</div>
						</div>
						<hr>
						<!-- Model Info -->
						<div class="row">
							<div class="col-md-12">
								<h4>Tipo de Documento:</h4>
								<p class="lead text-justify text-capitalize">
									{{ $documentTag->tipo }}
								</p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<h4>Obligatoriedad:</h4>
								<p class="lead text-justify text-capitalize">
									@if($documentTag->obligatorio)
										Este documento es de carácter <strong>obligatorio</strong>.
									@else
										<strong>No es obligatorio</strong> cargar este documento.
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