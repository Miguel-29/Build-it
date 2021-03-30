<div class="modal fade" id="add-discipline-subuse-modal" tabindex="-1" role="dialog" aria-labelledby="add-discipline-subuse-modalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-discipline-subuse-modalLabel">Agregar Disciplina/Subuso</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Agregar una nueva fase al tipo de proyecto: <b>{{ $projectType->id }} - {{ $projectType->nombre }}<b></p>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<label class="form-label" for="nombre">
							Subuso de Ocupación:
						</label>
						<div class="col-md-12">
							<div class="form-group has-default bmd-form-group">
								<select id="subuse-selector" class="form-control">
									<option value="" disabled selected>-- Seleccione un Subuso de Ocupación --</option>
								</select>
								<span class="help-block has-error" id="ocupation-subuse-selector-error"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<label class="form-label" for="nombre">
							Disciplina:
						</label>
						<div class="col-md-12">
							<div class="form-group has-default bmd-form-group">
								<select id="discipline-selector" class="form-control">
									<option value="" disabled selected>-- Seleccione una Disciplina --</option>
								</select>
								<span class="help-block has-error" id="discipline-selector-error"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<label class="form-label" for="nombre">
							Es Obligatorio para esta Fase del Tipo de Proyecto:
						</label>
						<div class="col-md-12">
							<div class="custom-controls-stacked">
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="is-required-checkbox">
									<span class="custom-control-label">Es Obligatorio</span>
								</label>
							 </div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="add-discipline-subuse-button" data-dismiss="modal">Agregar</button>
			</div>
		</div>
	</div>
</div>