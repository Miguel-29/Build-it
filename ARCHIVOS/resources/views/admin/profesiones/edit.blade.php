@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Editar Profesión</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('profesiones.index') }}">Profesiones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Profesión</li>
            </ol>
		</div>
		
		<form method="POST" action="{{ route('profesiones.update', $profession->id) }}" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header d-block">
					<h5 class="mb-2">Editando Post:</h5>
					<h2 class="mb-0">{{ $profession->id }} - {{ $profession->nombre }}</h2>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="nombre">
								Nombre:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<input type="text" name="nombre" id="nombre" class="form-control @if($errors->has('nombre')) has-error @endif" value="{{ $profession->nombre }}" placeholder="Ingrese el Nombre del Profesión" required>
									<span class="help-block has-error">{{ $errors->first('nombre') }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="estado">
								Estado:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<div class="custom-controls-stacked">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="estado" id="estado" value="1" @if($profession->estado)checked @endif>
											<span class="custom-control-label">Mostrar Profesión como Activa.</span>
										</label>
									 </div>
									<span class="help-block has-error">{{ $errors->first('estado') }}</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer ">
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-success ml-auto">
								Guardar Cambios
							</button>
							<a href="{{ route('profesiones.index') }}" class="btn btn-link ml-auto">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	
	
@stop