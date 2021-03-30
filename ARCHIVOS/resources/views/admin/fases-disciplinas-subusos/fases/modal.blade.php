<div class="modal fade" id="add-phase-modal" tabindex="-1" role="dialog" aria-labelledby="add-phase-modalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-phase-modalLabel">Agregar Fase</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Agregar una nueva fase al tipo de proyecto: <b>{{ $projectType->id }} - {{ $projectType->nombre }}<b></p>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<label class="form-label" for="nombre">
							Fase:
						</label>
						<div class="col-md-12">
							<div class="form-group has-default bmd-form-group">
								<select id="phase-selector" class="form-control">
									<option value="" disabled selected>-- Seleccione una Fase --</option>
								</select>
								<span class="help-block has-error" id="phase-selector-error"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="add-phase-button" data-dismiss="modal">Agregar</button>
			</div>
		</div>
	</div>
</div>