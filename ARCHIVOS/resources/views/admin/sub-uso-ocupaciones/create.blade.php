@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Crear Sub Uso de Ocupación</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('sub-uso-ocupaciones.index') }}">Sub Uso de Ocupaciones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Sub Uso de Ocupación</li>
            </ol>
		</div>
		<form method="POST" action="{{ route('sub-uso-ocupaciones.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="nombre">
								Grupo de Uso:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<select name="grupo_uso_id" id="grupo_uso_id" class="form-control
										@if($errors->has('grupo_uso_id')) has-error @endif
									" required>
										<option value="" disabled 
											@if(old('grupo_uso_id') === null || old('grupo_uso_id') === '') selected @endif
										>-- Seleccionar Grupo de Uso --</option>
										@foreach ($useGroups as $useGroup)
											<option value="{{ $useGroup->id }}"
												@if(old('grupo_uso_id') === $useGroup->id) selected @endif
											>{{ $useGroup->nombre }}</option>
										@endforeach
									</select>
									<span class="help-block has-error">{{ $errors->first('grupo_uso_id') }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="nombre">
								Nombre:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<input type="text" name="nombre" id="nombre" class="form-control @if($errors->has('nombre')) has-error @endif" value="{{ old('nombre') }}" placeholder="Ingrese el Nombre del Sub Uso de Ocupación" required>
									<span class="help-block has-error">{{ $errors->first('nombre') }}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer ">
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-success ml-auto">
								Crear Nuevo
							</button>
							<a href="{{ route('sub-uso-ocupaciones.index') }}" class="btn btn-link ml-auto">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
@stop