<script>
	var __NEW_PHASE_TEMPLATE = `
	<div class="col-sm-12" id="container_[phase_id]">
		<div class="expanel expanel-secondary">
			<div class="expanel-heading">
				<div class="row">
					<div class="col-sm-6 d-flex align-items-center">
						<h3 class="expanel-title">[phase_name]</h3>
					</div>
					<div class="col-md-4 text-right">
						<a href="#" class="btn btn-green" data-toggle="modal" data-target="#add-discipline-subuse-modal" data-target-table="#phase_table_[phase_id]" data-phase="[phase_id]" onclick="setPhaseForModal(this)">Agregar Subuso/Disciplina</a>
					</div>
                    <div class="col-md-2 text-left">
                        <a href="/api/fases-disciplinas-subusos/tipo/{{$projectType->id}}/fase/[phase_id]/deletefase" id="phase_{{$projectType->id}}_[phase_id]" class="btn btn-danger" onclick="check(event, {{$projectType->id}}, [phase_id])">Eliminar</a>
                    </div>
				</div>
			</div>
			<div class="expanel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dataFaseN" style="width:100%">
						<thead>
							<tr>
								<th rowspan="1" colspan="1">Subuso Ocupación</th>
								<th rowspan="1" colspan="1">Disciplina</th>
								<th rowspan="1" colspan="1">Es Obligatorio</th>
								<th class="text-center" rowspan="1" colspan="1">Acciones</th>
							</tr>
						</thead>
						<tbody id="phase_table_[phase_id]">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>`

	$(document).ready(() => {
		fetchAndDisplayPhases();
		$('#add-phase-button').click(addPhase);
	});

	function fetchAndDisplayPhases() {
		let url = "{{ route('api.fases.index') }}";
		let selector = document.getElementById('phase-selector');

		$.get(url, (phases) => {
			for(let phase of phases) {
				let option = document.createElement('option');

				option.value = phase.idfase;
				option.innerText = phase.nombre;

				selector.appendChild(option);
			}
		});
	}

	function addPhase() {
		let phaseSelector = document.getElementById('phase-selector');
		let phaseId = phaseSelector.value;
		let url = "{{ route('api.tipo-proyectos.add-phase', $projectType->id) }}";

		let params = {
			fase_id: phaseId,
		};

		$.post(url, params, (result) => {
			let noPhasesMsg = document.getElementById('no-phases-yet');
			if(noPhasesMsg !== null) 
				noPhasesMsg.remove();
            console.log(result);
			__NEW_PHASE_TEMPLATE = __NEW_PHASE_TEMPLATE.replace(/\[phase_name\]/gi, result.fase.nombre);
			__NEW_PHASE_TEMPLATE = __NEW_PHASE_TEMPLATE.replace(/\[phase_id\]/gi, result.fase.idfase);

			let display = document.getElementById('phases-display');

			display.innerHTML += __NEW_PHASE_TEMPLATE;
		});
	}

</script>