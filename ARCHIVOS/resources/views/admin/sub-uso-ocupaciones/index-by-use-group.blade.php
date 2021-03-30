@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Sub Usos de Ocupaciones de Grupo de Uso</h4>
            <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('grupos-uso.index') }}">Grupos de Uso</a></li>
				<li class="breadcrumb-item"><a href="{{ route('grupos-uso.show', $useGroup->id) }}">{{ $useGroup->nombre }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sub Usos de Ocupaciones</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{ route('sub-uso-ocupaciones.create-by-use-group', $useGroup->id) }}">
                    Crear Nuevo
                </a>
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Sub Usos de Ocupaciones</div>
                        </div>
                        <div class="card-body">
							<p>Mostrando los sub usos de ocupaciones pertenecientes al grupo: <strong>{{ $useGroup->id }} - {{ $useGroup->nombre }}</strong></p>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
											<th rowspan="1" colspan="1">Nombre</th>
											<th rowspan="1" colspan="1">Grupo de Uso</th>
                                            <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ocupationSubUses as $key => $ocupationSubUse)
                                        	<tr role="row" class="{{ $key%2 === 0 ? 'even' : 'odd' }}">
												<td tabindex="0" class="sorting_1">
													{{ $ocupationSubUse->id }}
												</td>
												<td tabindex="0" class="sorting_1">
													{{ $ocupationSubUse->nombre }}
												</td>
												<td tabindex="0" class="sorting_1">
													{{ $ocupationSubUse->grupoUso->nombre }}
												</td>
												<td class="text-center">
													<a href="{{ route('sub-uso-ocupaciones.show', $ocupationSubUse->id) }}">
														<i class="fa fa-search btn-space" title="Visualizar"></i>
													</a>
													<a href="{{ route('sub-uso-ocupaciones.edit', $ocupationSubUse->id) }}">
														<i class="fa fa-pencil btn-space" title="Editar"></i>
													</a>
													<a href="{{ route('sub-uso-ocupaciones.delete', $ocupationSubUse->id) }}">
														<i class="mdi mdi-close-circle btn-space" title="Eliminar"></i>
													</a>
												</td>
											</tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop