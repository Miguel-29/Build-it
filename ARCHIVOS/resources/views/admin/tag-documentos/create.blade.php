@extends('admin.layouts.default')
@section('content')
    <div class="side-app" style="height:670px">
        <div class="page-header">
            <h4 class="page-title">Crear Tag de Documento</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tag-documentos.index') }}">Tags de Documentos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Tag de Documento</li>
            </ol>
		</div>
		<form method="POST" action="{{ route('tag-documentos.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="card">
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
										<option value="" disabled 
											@if(old('tipo') === null || old('tipo') === '') selected @endif
										>-- Seleccionar Tipo --</option>
										@foreach ($documentTypes as $documentType)
											<option value="{{ $documentType }}"
												@if(old('tipo') === $documentType) selected @endif
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
									<input type="text" name="tag" id="tag" class="form-control @if($errors->has('tag')) has-error @endif" value="{{ old('tag') }}" placeholder="Ingrese el Tag de Documento" required>
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
											<input type="checkbox" class="custom-control-input" name="obligatorio" id="obligatorio" value="1" @if(old('obligatorio') == '1')checked @endif>
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
								Crear Nuevo
							</button>
							<a href="{{ route('tag-documentos.index') }}" class="btn btn-link ml-auto">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
@stop