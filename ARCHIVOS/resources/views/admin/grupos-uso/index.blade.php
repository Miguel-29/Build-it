@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Grupos de Uso</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Grupos de Uso</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{ route('grupos-uso.create') }}">
                    Crear Nuevo
                </a>
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Grupos de Uso</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
											<th rowspan="1" colspan="1">Nombre</th>
											<th rowspan="1" colspan="1">Sub Usos de Ocupación</th>
                                            <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($useGroups as $key => $useGroup)
                                        	<tr role="row" class="{{ $key%2 === 0 ? 'even' : 'odd' }}">
												<td tabindex="0" class="sorting_1">
													{{ $useGroup->id }}
												</td>
												<td tabindex="0" class="sorting_1">
													{{ $useGroup->nombre }}
												</td>
												<td>
													<a class="btn btn-link" href="{{ route('sub-uso-ocupaciones.index-by-use-group', $useGroup->id) }}">
														<i class="fa fa-list btn-space" title="Sub Uso Ocupaciones"></i>Ver Todas
													</a>
												</td>
												<td class="text-center">
													<a href="{{ route('grupos-uso.show', $useGroup->id) }}">
														<i class="fa fa-search btn-space" title="Visualizar"></i>
													</a>
													<a href="{{ route('grupos-uso.edit', $useGroup->id) }}">
														<i class="fa fa-pencil btn-space" title="Editar"></i>
													</a>
													<a href="{{ route('grupos-uso.delete', $useGroup->id) }}">
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