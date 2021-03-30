@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Editar Grupo de Uso</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('grupos-uso.index') }}">Grupo de Usos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Grupo de Uso</li>
            </ol>
		</div>
		
		<form method="POST" action="{{ route('grupos-uso.update', $useGroup->id) }}" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header d-block">
					<h5 class="mb-2">Editando Post:</h5>
					<h2 class="mb-0">{{ $useGroup->id }} - {{ $useGroup->nombre }}</h2>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="nombre">
								Nombre:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<input type="text" name="nombre" id="nombre" class="form-control @if($errors->has('nombre')) has-error @endif" value="{{ $useGroup->nombre }}" placeholder="Ingrese el Nombre del Grupo de Uso" required>
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
									<textarea name="descripcion" id="descripcion" class="form-control @if($errors->has('descripcion')) has-error @endif" placeholder="Ingrese la Descripción del Grupo de Uso">{{ $useGroup->descripcion }}</textarea>
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
								Guardar Cambios
							</button>
							<a href="{{ route('grupos-uso.index') }}" class="btn btn-link ml-auto">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	
	
@stop