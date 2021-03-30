<script>
	var __NEW_ROW_TEMPLATE = `
	<tr id="row_[result_id]">
		<td>
			[[subuse_name]]
		</td>
		<td>
			[[discipline_name]]
		</td>
		<td>
			[[is_required]]
		</td>
		<td>
			<a href="/api/fases-disciplinas-subusos/[result_id]/delete" class="btn btn-link" onclick="funcionHabilitaEliminars(event, [result_id])" id="link_[result_id]"  >
				<i class="mdi mdi-close-circle btn-space" title="Eliminar"></i>
			</a>
		</td>
	</tr>
	`;
	var __PHASE_TARGET_ID;

	$(document).ready(() => {
		fetchAndDisplayDisciplines();
		fetchAndDisplaySubuses();
		$('#add-discipline-subuse-button').click(addDisciplineSubuse);
	});

	function fetchAndDisplayDisciplines() {
		let url = "{{ route('api.disciplinas.index') }}";
		let selector = document.getElementById('discipline-selector');

		$.get(url, (disciplines) => {
			for(let discipline of disciplines) {
				let option = document.createElement('option');

				option.value = discipline.iddisciplina;
				option.innerText = discipline.nombre;

				selector.appendChild(option);
			}
		});
	}

	function fetchAndDisplaySubuses() {
		let url = "{{ route('api.sub-uso-ocupaciones.index') }}";
		let selector = document.getElementById('subuse-selector');

		$.get(url, (subuses) => {
			for(let subuse of subuses) {
				let option = document.createElement('option');

				option.value = subuse.id;
				option.innerText = subuse.nombre;

				selector.appendChild(option);
			}
		});
	}

	function addDisciplineSubuse() {
		let subuseSelector = document.getElementById('subuse-selector');
		let subuseId = subuseSelector.value;
		let disciplineSelector = document.getElementById('discipline-selector');
		let disciplineId = disciplineSelector.value;
		let isRequiredChecker = document.getElementById('is-required-checkbox');
		let isRequired = isRequiredChecker.checked;
		let url = "{{ route('api.fases-disciplinas-subusos.create-or-update') }}";

		let params = {
			fase_id: __PHASE_TARGET_ID,
			sub_uso_ocupacion_id: subuseId,
			disciplina_id: disciplineId,
			tipo_proyecto_id: {{ $projectType->id }},
			es_obligatorio: isRequired ? 1 : 0
		};

		$.post(url, params, (result) => {
			__NEW_ROW_TEMPLATE = __NEW_ROW_TEMPLATE.replace('[[subuse_name]]', result.subUsoOcupacion.nombre);
			__NEW_ROW_TEMPLATE = __NEW_ROW_TEMPLATE.replace('[[discipline_name]]', result.disciplina.nombre);
			__NEW_ROW_TEMPLATE = __NEW_ROW_TEMPLATE.replace('[[is_required]]', result.es_obligatorio ? 'Sí' : 'No');
			__NEW_ROW_TEMPLATE = __NEW_ROW_TEMPLATE.replace(/\[result_id\]/gi, result.id);

			let display = document.getElementById('phase_table_' + __PHASE_TARGET_ID);

			let emptyPlaceholder = document.getElementById('no-disciplines-phase-' + __PHASE_TARGET_ID);
			if(emptyPlaceholder !== null)
				emptyPlaceholder.remove();

			display.innerHTML += __NEW_ROW_TEMPLATE;
		});
	}

	function setPhaseForModal(target) {
		let phaseId = target.dataset.phase;
		__PHASE_TARGET_ID = phaseId;
	}
</script>