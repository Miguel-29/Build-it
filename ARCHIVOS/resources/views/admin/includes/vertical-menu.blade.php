<aside class="app-sidebar ">
    <div class="app-sidebar__user">
        <div class="dropdown">
            <a class="nav-link p-0 leading-none d-flex" data-toggle="dropdown" href="#">
                <img class="avatar avatar-md brround" src="{{ URL::asset('assets/admin/images/user-2.png')}}"/>
                <span class="ml-2 "><span class="text-dark app-sidebar__user-name font-weight-semibold">                                    
                @if(Auth::user() !== null) 
                    {{Auth::user()->name}}
                @endif
                </span><br>
                <span class="text-muted app-sidebar__user-name text-sm">
                @if(Auth::user() !== null) 
                    <?php
                    $usuarios =Auth::user();
                    $roles = $usuarios->getRoleNames();
                    $reemplazo =array('"','[',']');
                    $texto=str_replace($reemplazo,'',$roles); 
                    echo $texto;
                    ?>
                @endif
                </span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item" href="{{ URL::to('/logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="dropdown-icon mdi mdi-logout-variant"></i>Salir</a>
                <form id="logout-form" action="{{ URL::to('/logout') }}"
                method="POST" style="display: none;">
                @csrf
                </form>
            </div>
        </div>
    </div>
    <ul class="side-menu">
        @if(Gate::check('permisos-index') || Gate::check('roles-index') || Gate::check('usuarios-index'))
            @can('usuarios-index')
                <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-vcard"></i><span class="side-menu__label">USUARIOS</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    @can('permisos-index')
                    <li>
                            <a class="slide-item" href="{{URL::to('/permisos')}}"><i class="side-menu__icon fa fa-key"></i><span class="side-label">Permisos</a></span>
                    </li>
                    @endcan
                    @can('roles-index')
                    <li>
                            <a class="slide-item" href="{{URL::to('/roles')}}"><i class="side-menu__icon fa fa-user-plus"></i><span class="side-label">Roles</a></span>
                    </li>
                    @endcan
                    @can('usuarios-index')
                            <li>
                            <a class="slide-item" href="{{URL::to('/usuarios')}}"><i class="side-menu__icon fa fa-user-circle"></i><span class="side-label">Usuarios</a></span>
                    </li>
                    @endcan
                </ul>
                </li>
            @endcan
        @endif
        @can('listados-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/listados')}}"><i class="side-menu__icon fa fa-book"></i><span class="side-menu__label">LISTADOS</span></a>
            </li>
        @endcan
        @can('opcionlistados-index')
        <li class="slide">
            <a class="side-menu__item" href="{{URL::to('/opcionlistados')}}"><i class="side-menu__icon fa fa-columns"></i><span class="side-menu__label">OPCION LISTADOS</span></a>
        </li>
		@endcan
		
		<!-- Project Types Options --> 
		@can('tipo-proyectos.index')
			<li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="#">
					<i class="side-menu__icon fa fa-suitcase"></i>
					<span class="side-menu__label">Tipos de Proyecto</span>
					<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					@can('tipo-proyectos.index')
						<li>
							<a class="slide-item" href="{{ route('tipo-proyectos.index') }}">
								<i class="side-menu__icon fa fa-list"></i>
								<span class="side-label">Ver Todos</span>
							</a>
						</li>
					@endcan
					@can('tipo-proyectos.create')
						<li>
							<a class="slide-item" href="{{ route('tipo-proyectos.create') }}">
								<i class="side-menu__icon fa fa-plus"></i>
								<span class="side-label">Crear Nuevo</span>
							</a>
						</li>
					@endcan
				</ul>
			</li>
		@endcan

		<!-- Use Groups Options --> 
		@can('grupos-uso.index')
			<li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="#">
					<i class="side-menu__icon fa fa-tasks"></i>
					<span class="side-menu__label">Grupos de Uso</span>
					<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					@can('grupos-uso.index')
						<li>
							<a class="slide-item" href="{{ route('grupos-uso.index') }}">
								<i class="side-menu__icon fa fa-list"></i>
								<span class="side-label">Ver Todos</span>
							</a>
						</li>
					@endcan
					@can('grupos-uso.create')
						<li>
							<a class="slide-item" href="{{ route('grupos-uso.create') }}">
								<i class="side-menu__icon fa fa-plus"></i>
								<span class="side-label">Crear Nuevo</span>
							</a>
						</li>
					@endcan
				</ul>
			</li>
		@endcan

		<!-- Sub Use Ocupations Options --> 
		@can('sub-uso-ocupaciones.index')
			<li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="#">
					<i class="side-menu__icon fa fa-th-large"></i>
					<span class="side-menu__label">Sub Usos de Ocupación</span>
					<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					@can('sub-uso-ocupaciones.index')
						<li>
							<a class="slide-item" href="{{ route('sub-uso-ocupaciones.index') }}">
								<i class="side-menu__icon fa fa-list"></i>
								<span class="side-label">Ver Todos</span>
							</a>
						</li>
					@endcan
					@can('sub-uso-ocupaciones.create')
						<li>
							<a class="slide-item" href="{{ route('sub-uso-ocupaciones.create') }}">
								<i class="side-menu__icon fa fa-plus"></i>
								<span class="side-label">Crear Nuevo</span>
							</a>
						</li>
					@endcan
				</ul>
			</li>
		@endcan
		
        @can('fases-index')
        <li class="slide">
            <a class="side-menu__item" href="{{URL::to('/fases')}}"><i class="side-menu__icon fa fa-signal"></i><span class="side-menu__label">FASES</span></a>
        </li>
        @endcan

        @can('especialidades-proveedor-index')
        <li class="slide">
            <a class="side-menu__item" href="{{URL::to('/especialidades-proveedor')}}"><i class="side-menu__icon fa fa-user-secret"></i><span class="side-menu__label" style="white-space: normal;">ESPECIALIDADES PROVEEDOR</span></a>
        </li>
        @endcan

        @can('servicios-especialidad-index')
        <li class="slide">
            <a class="side-menu__item" href="{{URL::to('/servicios-especialidad')}}"><i class="side-menu__icon fa fa-thumb-tack"></i><span class="side-menu__label" style="white-space: normal;">SERVICIOS ESPECIALIDAD</span></a>
        </li>
        @endcan
        
        @can('disciplinas-index')
        <li class="slide">
            <a class="side-menu__item" href="{{URL::to('/disciplinas')}}"><i class="side-menu__icon fa fa-plus-square"></i><span class="side-menu__label" style="white-space: normal;">DISCIPLINAS</span></a>
        </li>
		@endcan
		
		<!-- Document Tags Options --> 
		@can('tag-documentos.index')
			<li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="#">
					<i class="side-menu__icon fa fa-tags"></i>
					<span class="side-menu__label">Tags de Documentos</span>
					<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					@can('tag-documentos.index')
						<li>
							<a class="slide-item" href="{{ route('tag-documentos.index') }}">
								<i class="side-menu__icon fa fa-list"></i>
								<span class="side-label">Ver Todos</span>
							</a>
						</li>
					@endcan
					@can('tag-documentos.create')
						<li>
							<a class="slide-item" href="{{ route('tag-documentos.create') }}">
								<i class="side-menu__icon fa fa-plus"></i>
								<span class="side-label">Crear Nuevo</span>
							</a>
						</li>
					@endcan
				</ul>
			</li>
		@endcan

		<!-- Professions Options --> 
		@can('profesiones.index')
			<li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="#">
					<i class="side-menu__icon fa fa-user-md"></i>
					<span class="side-menu__label">Profesiones</span>
					<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					@can('profesiones.index')
						<li>
							<a class="slide-item" href="{{ route('profesiones.index') }}">
								<i class="side-menu__icon fa fa-list"></i>
								<span class="side-label">Ver Todos</span>
							</a>
						</li>
					@endcan
					@can('profesiones.create')
						<li>
							<a class="slide-item" href="{{ route('profesiones.create') }}">
								<i class="side-menu__icon fa fa-plus"></i>
								<span class="side-label">Crear Nuevo</span>
							</a>
						</li>
					@endcan
				</ul>
			</li>
		@endcan

		<!-- Areas Professions Options --> 
		@can('areas-profesiones.index')
			<li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="#">
					<i class="side-menu__icon fa fa-user-md"></i>
					<span class="side-menu__label">Áreas Profesiones</span>
					<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					@can('areas-profesiones.index')
						<li>
							<a class="slide-item" href="{{ route('areas-profesiones.index') }}">
								<i class="side-menu__icon fa fa-list"></i>
								<span class="side-label">Ver Todos</span>
							</a>
						</li>
					@endcan
					@can('areas-profesiones.create')
						<li>
							<a class="slide-item" href="{{ route('areas-profesiones.create') }}">
								<i class="side-menu__icon fa fa-plus"></i>
								<span class="side-label">Crear Nuevo</span>
							</a>
						</li>
					@endcan
				</ul>
			</li>
        @endcan
        
        @can('categorias-beneficios-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/categorias-beneficios')}}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">CATEGORIAS DE BENEFICIOS</span></a>
            </li>
        @endcan

        @can('beneficios-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/beneficios')}}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">BENEFICIOS</span></a>
            </li>
        @endcan

        @can('paginas-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/paginas')}}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">PÁGINAS</span></a>
            </li>
        @endcan

        @can('contenidos-paginas-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/contenidos-paginas')}}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">CONTENIDOS DE PÁGINAS</span></a>
            </li>
        @endcan



        @can('categorias-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/categorias')}}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">CATEGORIAS</span></a>
            </li>
        @endcan

        @can('posts-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/posts')}}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">POSTS</span></a>
            </li>
        @endcan

        @can('contactos-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/contactos')}}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">CONTACTOS</span></a>
            </li>
        @endcan

        @can('parametros-index')
            <li class="slide">
                <a class="side-menu__item" href="{{URL::to('/parametros')}}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">PARÁMETROS</span></a>
            </li>
        @endcan
    </ul>
</aside>