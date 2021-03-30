@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Crear Grupo de Uso</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('grupos-uso.index') }}">Grupo de Usos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Grupo de Uso</li>
            </ol>
		</div>
		<form method="POST" action="{{ route('grupos-uso.store') }}" enctype="multipart/form-data">
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
									<input type="text" name="nombre" id="nombre" class="form-control @if($errors->has('nombre')) has-error @endif" value="{{ old('nombre') }}" placeholder="Ingrese el Nombre del Grupo de Uso" required>
									<span class="help-block has-error">{{ $errors->first('nombre') }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="descripcion">
								Descripción:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<textarea name="descripcion" id="descripcion" class="form-control @if($errors->has('descripcion')) has-error @endif" placeholder="Ingrese la Descripción del Grupo de Uso">{{ old('descripcion') }}</textarea>
									<span class="help-block has-error">{{ $errors->first('descripcion') }}</span>
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
							<a href="{{ route('grupos-uso.index') }}" class="btn btn-link ml-auto">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
@stop