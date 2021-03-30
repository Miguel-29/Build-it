@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Editar Tag de Documento</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tag-documentos.index') }}">Tag de Documentos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Tag de Documento</li>
            </ol>
		</div>
		
		<form method="POST" action="{{ route('tag-documentos.update', $documentTag->id) }}" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header d-block">
					<h5 class="mb-2">Editando Tag de Documento:</h5>
					<h2 class="mb-0">{{ $documentTag->id }} - {{ $documentTag->tag }}</h2>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="tipo">
								Tipo:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<select name="tipo" id="tipo" class="form-control
										@if($errors->has('tipo')) has-error @endif
									" required>
										<option value="" disabled>-- Seleccionar Tipo --</option>
										@foreach ($documentTypes as $documentType)
											<option value="{{ $documentType }}"
												@if($documentTag->tipo === $documentType ) selected @endif
											>{{ $documentType }}</option>
										@endforeach
									</select>
									<span class="help-block has-error">{{ $errors->first('tipo') }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="tag">
								Tag:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<input type="text" name="tag" id="tag" class="form-control @if($errors->has('tag')) has-error @endif" value="{{ $documentTag->tag }}" placeholder="Ingrese el Tag del Documento" required>
									<span class="help-block has-error">{{ $errors->first('tag') }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label class="form-label" for="obligatorio">
								Obligatoriedad:
							</label>
							<div class="col-md-12">
								<div class="form-group has-default bmd-form-group">
									<div class="custom-controls-stacked">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="obligatorio" id="obligatorio" value="1" @if($documentTag->obligatorio)checked @endif>
											<span class="custom-control-label">Marcar Documento como Obligatorio.</span>
										</label>
									 </div>
									<span class="help-block has-error">{{ $errors->first('obligatorio') }}</span>
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
							<a href="{{ route('tag-documentos.index') }}" class="btn btn-link ml-auto">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	
	
@stop