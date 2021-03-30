@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Crear Profesión</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('profesiones.index') }}">Profesiones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Profesión</li>
            </ol>
		</div>
		<form method="POST" action="{{ route('profesiones.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="nombre">
								Nombre:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<input type="text" name="nombre" id="nombre" class="form-control @if($errors->has('nombre')) has-error @endif" value="{{ old('nombre') }}" placeholder="Ingrese el Nombre del Profesión" required>
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
							<a href="{{ route('profesiones.index') }}" class="btn btn-link ml-auto">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
@stop