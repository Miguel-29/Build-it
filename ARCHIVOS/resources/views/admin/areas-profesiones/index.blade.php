@extends('admin.layouts.default')
@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Áreas de Profesiones</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Áreas de Profesiones</li>
            </ol>
        </div>
        <div class="card-body">
            <p class="category">
                <a class="btn btn-success btn-fill btn-wd btn-move-right" href="{{ route('areas-profesiones.create') }}">
                    Crear Nuevo
                </a>
            </p>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header bg-blue br-tr-7 br-tl-7">
                            <div class="card-title text-white">Áreas de Profesiones</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
											<th rowspan="1" colspan="1">Nombre</th>
											<th rowspan="1" colspan="1">Profesión</th>
                                            <th class="text-center" rowspan="1" colspan="1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($professionAreas as $key => $professionArea)
                                        	<tr role="row" class="{{ $key%2 === 0 ? 'even' : 'odd' }}">
												<td tabindex="0" class="sorting_1">
													{{ $professionArea->id }}
												</td>
												<td tabindex="0" class="sorting_1">
													{{ $professionArea->nombre }}
												</td>
												<td tabindex="0" class="sorting_1">
													{{ $professionArea->profesion->nombre }}
												</td>
												<td class="text-center">
													<a href="{{ route('areas-profesiones.show', $professionArea->id) }}">
														<i class="fa fa-search btn-space" title="Visualizar"></i>
													</a>
													<a href="{{ route('areas-profesiones.edit', $professionArea->id) }}">
														<i class="fa fa-pencil btn-space" title="Editar"></i>
													</a>
													<a href="{{ route('areas-profesiones.delete', $professionArea->id) }}">
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