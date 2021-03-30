@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Tipo de Proyecto, Fases, Disciplinas y Subusos</h4>
            <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('tipo-proyectos.index') }}">Tipos de Proyecto</a></li>
				<li class="breadcrumb-item"><a href="{{ route('tipo-proyectos.show', $projectType->id) }}">{{ $projectType->nombre }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Fases, Disciplinas y Subusos</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                @include('admin.fases-disciplinas-subusos.fases.modal-button')
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Fases, Disciplinas y Subusos</div>
                        </div>
                        <div class="card-body">
							<div class="row">
								<div class="col-sm-12">
									<p>Mostrando las fases, disciplinas y subusos pertenecientes al tipo de proyecto: <strong>{{ $projectType->id }} - {{ $projectType->nombre }}</strong></p>
								</div>
							</div>
                            <div class="row" id="phases-display">
                                @forelse($phases as $phaseId => $phase)

									<div class="col-sm-12" id="container_{{$phase->idfase}}">
										<div class="expanel expanel-secondary">
											<div class="expanel-heading d-flex align-items-center">
												<div class="col-sm-6">
													<h3 class="expanel-title">{{ $phase->nombre }}</h3>
												</div>
												<div class="col-md-4 text-right">
													@include('admin.fases-disciplinas-subusos.disciplinas-subusos.modal-button', [
														'phaseId' => $phase->idfase
													])
												</div>
                                                <div class="col-md-2 text-left">
                                                    <a href="/api/fases-disciplinas-subusos/tipo/{{$projectType->id}}/fase/{{$phase->idfase}}/deletefase"  id="phase_{{$projectType->id}}_{{$phase->idfase}}" class="btn btn-danger" onclick="check(event, {{$projectType->id}}, {{$phase->idfase}})">Eliminar</a>
                                                </div>
                            
											</div>
											<div class="expanel-body">
												<div class="table-responsive">
													<table  class="table table-striped table-bordered dataFase" style="width:100%">
														<thead>
															<tr>
																<th rowspan="1" colspan="1">Subuso Ocupación</th>
																<th rowspan="1" colspan="1">Disciplina</th>
																<th rowspan="1" colspan="1">Es Obligatorio</th>
																<th class="text-center" rowspan="1" colspan="1">Acciones</th>
															</tr>
														</thead>
														<tbody id="phase_table_{{ $phase->idfase }}">
															@if($phaseDisciplineSubuses->get($phase->idfase) !== null)
																@foreach ($phaseDisciplineSubuses->get($phase->idfase) as $phaseDisciplineSubuse)
																	<tr id="row_{{$phaseDisciplineSubuse->id}}">
																		<td>
																			{{ $phaseDisciplineSubuse->subUsoOcupacion->nombre }}
																		</td>
																		<td>
																			{{ $phaseDisciplineSubuse->disciplina->nombre }}
																		</td>
																		<td>
																			{{ $phaseDisciplineSubuse->es_obligatorio ? 'Sí' : 'No' }}
																		</td>
																		<td>
																			<a href="{{ route('api.fases-disciplinas-subusos.delete', $phaseDisciplineSubuse->id) }}"  onclick="funcionHabilitaEliminars(event, {{$phaseDisciplineSubuse->id}})" id="link_{{$phaseDisciplineSubuse->id}}" class="btn btn-link">
																				<i class="mdi mdi-close-circle btn-space" title="Eliminar"></i>
																			</a>
																		</td>
																	</tr>
																@endforeach
															@else
																<tr id="no-disciplines-phase-{{ $phaseId }}">
																	<td colspan="4" class="text-center">
																		<h4>No hay Subusos ni Disciplinas asociadas a esta fase del tipo de proyecto</h4>
																	</td>
																</tr>
															@endif
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								@empty
									<div class="col-sm-12" id="no-phases-yet">
										<h4>No se ha agregado ninguna fase a este tipo de proyecto</h4>
									</div>
								@endforelse
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	
	@include('admin.fases-disciplinas-subusos.fases.modal', [
		'projectType' => $projectType
	])
	@include('admin.fases-disciplinas-subusos.disciplinas-subusos.modal', [
		'projectType' => $projectType
	])
@stop

@push('scripts')
	<!-- INICIO DE LOS SCRIPTS -->
	@include('admin.fases-disciplinas-subusos.fases.scripting', [
		'projectType' => $projectType
	])
	@include('admin.fases-disciplinas-subusos.disciplinas-subusos.scripting', [
		'projectType' => $projectType
	])
    @include('admin.fases-disciplinas-subusos.delete.delete-disciplina', [
        'projectType' => $projectType
    ])

    @include('admin.fases-disciplinas-subusos.delete.delete-fase', [
        'projectType' => $projectType
    ])
@endpush