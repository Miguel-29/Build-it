@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Crear Área de Profesión</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('areas-profesiones.index') }}">Áreas de Profesiones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Área de Profesión</li>
            </ol>
		</div>
		<form method="POST" action="{{ route('areas-profesiones.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="nombre">
								Profesión:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<select name="profesion_id" id="profesion_id" class="form-control
										@if($errors->has('profesion_id')) has-error @endif
									" required>
										<option value="" disabled 
											@if(old('profesion_id') === null || old('profesion_id') === '') selected @endif
										>-- Seleccionar Profesión --</option>
										@foreach ($professions as $profession)
											<option value="{{ $profession->id }}"
												@if(old('profesion_id') === $profession->id) selected @endif
											>{{ $profession->nombre }}</option>
										@endforeach
									</select>
									<span class="help-block has-error">{{ $errors->first('profesion_id') }}</span>
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
									<input type="text" name="nombre" id="nombre" class="form-control @if($errors->has('nombre')) has-error @endif" value="{{ old('nombre') }}" placeholder="Ingrese el Nombre del Área de Profesión" required>
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
							<a href="{{ route('areas-profesiones.index') }}" class="btn btn-link ml-auto">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
@stop