<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return Redirect::to('/clientes/inicio');
    //return view('welcome');
});
Route::get('/home_validation', 'Front\HomeController@homeValidation')->name('home_validation');
Route::get('/auth-user', 'Front\HomeController@userAuthenticate')->name('auth-user');

/****************************************
 * 										*
 * 		ROUTES FOR API SERVICES			*
 * 										*
 ****************************************/
Route::prefix('api')->group(function () {

	/* 
		ROUTES FOR PHASE DISCIPLINE SUBUSE CRUD
	*/
	Route::post('tipo-proyectos/{projectTypeId}/fases', 'Admin\Api\FaseDisciplinaSubusoController@addPhase')->name('api.tipo-proyectos.add-phase');
	Route::post('fases-disciplinas-subusos/{phaseDisciplineSubuseId}', 'Admin\Api\FaseDisciplinaSubusoController@update')->name('api.fases-disciplinas-subusos.update');
	Route::post('fases-disciplinas-subusos/', 'Admin\Api\FaseDisciplinaSubusoController@createOrUpdate')->name('api.fases-disciplinas-subusos.create-or-update');
	Route::get('fases-disciplinas-subusos/{phaseDisciplineSubuseId}/delete', 'Admin\Api\FaseDisciplinaSubusoController@delete')->name('api.fases-disciplinas-subusos.delete');
	Route::get('fases-disciplinas-subusos/tipo/{tipo}/fase/{fase}/deletefase', 'Admin\Api\FaseDisciplinaSubusoController@deleteFase')->name('api.fases-disciplinas-subusos.deleteFase');

	/* 
		ROUTES FOR DISCIPLINES CRUD
	*/
	Route::get('disciplinas/', 'Admin\Api\DisciplinaController@index')->name('api.disciplinas.index');

	/* 
		ROUTES FOR OCUPATION SUB USES CRUD
	*/
	Route::get('sub-uso-ocupaciones/', 'Admin\Api\SubUsoOcupacionController@index')->name('api.sub-uso-ocupaciones.index');

	/* 
		ROUTES FOR PHASES CRUD
	*/
    Route::get('fases/', 'Admin\Api\FaseController@index')->name('api.fases.index');

    //GET PROFESIONES-FREELANCER
    
    Route::get('profesion/{profesion}', 'Front\FreelancerController@profesion')->name('api.profesion.area');

    //GET PROFESIONES - EMPRESA
    Route::get('profesion/empresa/{profesion}', 'Front\EmpresasController@profesion')->name('api.profesion.empresa');

    //GET SERVICIOS - ESPECIALIDAD
    Route::get('especialidad/{especialidad}', 'Front\ProveedoresController@especialidad')->name('api.especialidad');

    //GET PROYECTOS 
    Route::get('proyectos/get-proyectos/{id}', 'Front\ProyectosController@get_proyectos')->name('api.proyectos');

    //GET USO -SUBUSO 
    Route::get('grupouso/{id}', 'Front\ProyectosController@get_usos')->name('api.subuso');

});

Route::prefix('clientes')->group(function () {

    Route::get('/inicio', 'Front\HomeController@landing_page')->name('clientes.inicio');
    //PAGINAS ESTÁTICAS
    Route::get('/contenidos/{id}', 'Front\HomeController@getContenidos')->name('clientes.contenidos');


    Route::get('/', 'Front\HomeController@index')->name('clientes.index');
    Route::get('/crear', 'Front\HomeController@crear')->name('front.crear');
    //LOGIN

    Route::get('/login', 'Front\Auth\LoginController@showLoginForm')->name('clientes.login');
    Route::post("/login",'Front\Auth\LoginController@login')->name('login-front');

    //FREELANCER
    Route::get('/crear-f/{tipo}', 'Front\FreelancerController@crear')->name('freelancer.crear');
    Route::post('/crear-f/{tipo}', 'Front\FreelancerController@post_email')->name('freelancer.crear.envio');

    Route::get('/crear-f/{tipo}/{id}/paso-1', 'Front\FreelancerController@paso1')->name('freelancer.paso1');
    Route::post('/crear-f/{tipo}/{id}/paso-1', 'Front\FreelancerController@post_paso1')->name('freelancer.paso1.envio');

    Route::get('/crear-f/{tipo}/{id}/paso-2', 'Front\FreelancerController@paso2')->name('freelancer.paso2');
    Route::post('/crear-f/{tipo}/{id}/paso-2', 'Front\FreelancerController@post_paso2')->name('freelancer.paso2.envio');

    Route::get('/crear-f/{tipo}/{id}/paso-3', 'Front\FreelancerController@paso3')->name('freelancer.paso3');
    Route::post('/crear-f/{tipo}/{id}/paso-3', 'Front\FreelancerController@post_paso3')->name('freelancer.paso3.envio');

    Route::get('/crear-f/{tipo}/{id}/paso-4', 'Front\FreelancerController@paso4')->name('freelancer.paso4');
    Route::post('/crear-f/{tipo}/{id}/paso-4', 'Front\FreelancerController@post_paso4')->name('freelancer.paso4.envio');

    Route::get('/crear-f/{tipo}/{id}/paso-5', 'Front\FreelancerController@paso5')->name('freelancer.paso5');
    Route::post('/crear-f/{tipo}/{id}/paso-5', 'Front\FreelancerController@post_paso5')->name('freelancer.paso5.envio');

    Route::get('/crear-f/{tipo}/{id}/paso-6', 'Front\FreelancerController@paso6')->name('freelancer.paso6');
    Route::post('/crear-f/{tipo}/{id}/paso-6', 'Front\FreelancerController@post_paso6')->name('freelancer.paso6.envio');

    Route::get('/crear-f/{tipo}/{id}/paso-7', 'Front\FreelancerController@paso7')->name('freelancer.paso7');
    Route::post('/crear-f/{tipo}/{id}/paso-7', 'Front\FreelancerController@post_paso7')->name('freelancer.paso7.envio');

    Route::get('/crear-f/{tipo}/{id}/paso-8', 'Front\FreelancerController@paso8')->name('freelancer.paso8');
    Route::post('/crear-f/{tipo}/{id}/paso-8', 'Front\FreelancerController@post_paso8')->name('freelancer.paso8.envio');

    //CLIENTES

    Route::get('/crear-c/{tipo}', 'Front\ClientesController@crear')->name('clientes.crear');
    Route::post('/crear-c/{tipo}', 'Front\ClientesController@post_email')->name('clientes.crear.envio');

    Route::get('/crear-c/{tipo}/{id}/paso-1', 'Front\ClientesController@paso1')->name('clientes.paso1');
    Route::post('/crear-c/{tipo}/{id}/paso-1', 'Front\ClientesController@post_paso1')->name('clientes.paso1.envio');
    
    //EMPRESAS


    Route::get('/crear-e/{tipo}', 'Front\EmpresasController@crear')->name('empresas.crear');
    Route::post('/crear-e/{tipo}', 'Front\EmpresasController@post_email')->name('empresas.crear.envio');

    Route::get('/crear-e/{tipo}/{id}/paso-1', 'Front\EmpresasController@paso1')->name('empresas.paso1');
    Route::post('/crear-e/{tipo}/{id}/paso-1', 'Front\EmpresasController@post_paso1')->name('empresas.paso1.envio');
    
    Route::get('/crear-e/{tipo}/{id}/paso-2', 'Front\EmpresasController@paso2')->name('empresas.paso2');
    Route::post('/crear-e/{tipo}/{id}/paso-2', 'Front\EmpresasController@post_paso2')->name('empresas.paso2.envio');

    Route::get('/crear-e/{tipo}/{id}/paso-3', 'Front\EmpresasController@paso3')->name('empresas.paso3');
    Route::post('/crear-e/{tipo}/{id}/paso-3', 'Front\EmpresasController@post_paso3')->name('empresas.paso3.envio');

    Route::get('/crear-e/{tipo}/{id}/paso-4', 'Front\EmpresasController@paso4')->name('empresas.paso4');
    Route::post('/crear-e/{tipo}/{id}/paso-4', 'Front\EmpresasController@post_paso4')->name('empresas.paso4.envio');

    Route::get('/crear-e/{tipo}/{id}/paso-5', 'Front\EmpresasController@paso5')->name('empresas.paso5');
    Route::post('/crear-e/{tipo}/{id}/paso-5', 'Front\EmpresasController@post_paso5')->name('empresas.paso5.envio');

    Route::get('/crear-e/{tipo}/{id}/paso-6', 'Front\EmpresasController@paso6')->name('empresas.paso6');
    Route::post('/crear-e/{tipo}/{id}/paso-6', 'Front\EmpresasController@post_paso6')->name('empresas.paso6.envio');

    Route::get('/crear-e/{tipo}/{id}/paso-7', 'Front\EmpresasController@paso7')->name('empresas.paso7');
    Route::post('/crear-e/{tipo}/{id}/paso-7', 'Front\EmpresasController@post_paso7')->name('empresas.paso7.envio');

    Route::get('/crear-e/{tipo}/{id}/paso-8', 'Front\EmpresasController@paso8')->name('empresas.paso8');
    Route::post('/crear-e/{tipo}/{id}/paso-8', 'Front\EmpresasController@post_paso8')->name('empresas.paso8.envio');

    Route::get('/crear-e/{tipo}/{id}/paso-9', 'Front\EmpresasController@paso9')->name('empresas.paso9');
    Route::post('/crear-e/{tipo}/{id}/paso-9', 'Front\EmpresasController@post_paso9')->name('empresas.paso9.envio');

    //PROVEEDORES

    Route::get('/crear-p/{tipo}', 'Front\ProveedoresController@crear')->name('proveedores.crear');
    Route::post('/crear-p/{tipo}', 'Front\ProveedoresController@post_email')->name('proveedores.crear.envio');
    
    Route::get('/crear-p/{tipo}/{id}/paso-1', 'Front\ProveedoresController@paso1')->name('proveedores.paso1');
    Route::post('/crear-p/{tipo}/{id}/paso-1', 'Front\ProveedoresController@post_paso1')->name('proveedores.paso1.envio');

    Route::get('/crear-p/{tipo}/{id}/paso-2', 'Front\ProveedoresController@paso2')->name('proveedores.paso2');
    Route::post('/crear-p/{tipo}/{id}/paso-2', 'Front\ProveedoresController@post_paso2')->name('proveedores.paso2.envio');

    Route::get('/crear-p/{tipo}/{id}/paso-3', 'Front\ProveedoresController@paso3')->name('proveedores.paso3');
    Route::post('/crear-p/{tipo}/{id}/paso-3', 'Front\ProveedoresController@post_paso3')->name('proveedores.paso3.envio');

    Route::get('/crear-p/{tipo}/{id}/paso-4', 'Front\ProveedoresController@paso4')->name('proveedores.paso4');
    Route::post('/crear-p/{tipo}/{id}/paso-4', 'Front\ProveedoresController@post_paso4')->name('proveedores.paso4.envio');
    



});
Route::group(['prefix' => 'clientes','middleware' => 'auth'], function () {

	//MENÙ PRINCIPAL
    Route::get('/ultimas-noticias', 'Front\HomeController@get_noticias')->name('clientes.get-noticias');
    Route::get('/ultimas-noticias/post/{idpost}', 'Front\HomeController@get_post')->name('clientes.get-post');
    Route::get('/beneficios', 'Front\HomeController@beneficios')->name('clientes.beneficios');

    Route::get('/ver-contratistas', 'Front\HomeController@get_contratistas')->name('clientes.get-contratistas');
    Route::get('api/get-freelancer-filter', 'Front\HomeController@get_freelancer_filter')->name('get-freelancer-filter');
    Route::get('api/get-empresa-filter', 'Front\HomeController@get_empresas_filter')->name('get-empresa-filter');
    Route::get('api/get-proveedor-filter', 'Front\HomeController@get_proveedor_filter')->name('get-proveedor-filter');

    Route::get('/ver-proveedores', 'Front\HomeController@get_proveedores_filter')->name('clientes.get-proveedores');
    Route::get('/perfil-cliente/{id}', 'Front\HomeController@get_perfilCliente')->name('clientes.get-pCliente');
    Route::get('/perfil-freelancer/{id}', 'Front\HomeController@get_perfilFreelancer')->name('clientes.get-pFreelancer');
    Route::get('/perfil-empresa/{id}', 'Front\HomeController@get_perfilEmpresa')->name('clientes.get-pEmpresa');
    Route::get('/perfil-proveedor/{id}', 'Front\HomeController@get_perfilProveedor')->name('clientes.get-pProveedor');

    //EDITAR CLIENTES
    Route::get('/editar-perfil/{tipo}/{id}', 'Front\ClientesController@paso1')->name('clientes.editarP');
    Route::get('/{idc}/{tipo}/mis-proyectos', 'Front\HomeController@get_proyectosCliente')->name('clientes.proyectosVer');
    Route::get('/proyecto-actualizar-estado/{proceso}/{idc}/{proyectos}', 'Front\HomeController@updateCliente')->name('clientes.proyectosAct');
    Route::get('/{tipo}/{idc}/mis-proyectos/{idproyecto}', 'Front\HomeController@proyectoInfo')->name('clientes.proyectoInfo');
    Route::post('/agregar-contratistas/{idproyecto}/{idfase}/{iddisciplina}/{idcliente}/agregar', 'Front\HomeController@saveNewContratista')->name('clientes.saveContratista');

    //EDITAR FREELANCER
    Route::get('/editar-freelancer/{tipo}/{id}', 'Front\FreelancerController@paso1')->name('freelancer.editarP');
    Route::get('/agregar-disciplinas/freelancer/{id}', 'Front\FreelancerController@addDisciplinas')->name('freelancer.add-disciplinas');
    Route::post('/add-disciplinas/{tipo}/{id}/save', 'Front\FreelancerController@post_savedisciplina')->name('freelancer.save-disciplina');



    Route::get('/editar-freelancer/{tipo}/{id}/formacion-academica', 'Front\FreelancerController@paso3')->name('freelancer.editarP3');
    Route::get('/editar-freelancer/{tipo}/{id}/experiencia-laboral', 'Front\FreelancerController@paso4')->name('freelancer.editarP4');
    Route::get('/editar-freelancer/{tipo}/{id}/modelacion-bim', 'Front\FreelancerController@paso5')->name('freelancer.editarP5');
    Route::get('/editar-freelancer/{tipo}/{id}/revision-bim', 'Front\FreelancerController@paso6')->name('freelancer.editarP6');
    Route::get('/editar-freelancer/{tipo}/{id}/supervision-bim', 'Front\FreelancerController@paso7')->name('freelancer.editarP7');

    //EDITAR EMPRESAS
    Route::get('/editar-empresa/{tipo}/{id}', 'Front\EmpresasController@paso1')->name('empresa.editarP');
    Route::get('/agregar-disciplinas-emp/empresa/{id}', 'Front\EmpresasController@addDisciplinas')->name('empresa.add-disciplinas');
    Route::post('/add-disciplinas-emp/{tipo}/{id}/save', 'Front\EmpresasController@post_savedisciplina')->name('empresa.save-disciplina');

    Route::get('/editar-empresa/{tipo}/{id}/formacion-academica', 'Front\EmpresasController@paso4')->name('empresa.editarP4');
    Route::get('/editar-empresa/{tipo}/{id}/experiencia-laboral', 'Front\EmpresasController@paso5')->name('empresa.editarP5');
    Route::get('/editar-empresa/{tipo}/{id}/modelacion-bim', 'Front\EmpresasController@paso6')->name('empresa.editarP6');
    Route::get('/editar-empresa/{tipo}/{id}/revision-bim', 'Front\EmpresasController@paso7')->name('empresa.editarP7');
    Route::get('/editar-empresa/{tipo}/{id}/supervision-bim', 'Front\EmpresasController@paso8')->name('empresa.editarP8');

    //EDITAR PROVEEDOR
    Route::get('/editar-proveedor/{tipo}/{id}', 'Front\ProveedoresController@paso1')->name('proveedor.editarP');
    Route::get('/editar-proveedor/{tipo}/{id}/servicios', 'Front\ProveedoresController@paso3')->name('proveedor.editarP3');

    //CREAR GALERIA
    Route::post('/crear-galeria', 'Front\GaleriaController@createGaleria')->name('clientes.crear-galeria');
    Route::post('/editar-galeria', 'Front\GaleriaController@editarGaleria')->name('clientes.edit-galeria');
    //CREAR COMENTARIO
    Route::post('/crear-comentario', 'Front\GaleriaController@createComentario')->name('clientes.crear-comentario');

    //PROYECTO

    Route::get('/crear-proyecto/{idcliente}/paso-1', 'Front\ProyectosController@paso1')->name('proyectos.crear');
    Route::post('/crear-proyecto/{idcliente}/paso-1', 'Front\ProyectosController@post_paso1')->name('proyectos.crear.envio');

    //SI EL TIPO DE PROYECTO ES REMODELACION
    Route::get('/crear-proyecto/{proyecto}/{idcliente}/remodelacion/paso-2', 'Front\ProyectosController@paso2_remodelacion')->name('proyectos.paso2remodelacion');
    Route::post('/crear-proyecto/{proyecto}/{idcliente}/remodelacion/paso-2', 'Front\ProyectosController@post_paso2remodelacion')->name('proyectos.paso2remodelacion.envio');

    //SI EL TIPO DE PROYECTO ES ARREGLOS LOCATIVOS
    Route::get('/crear-proyecto/{proyecto}/{idcliente}/arreglos-locativos/paso-2', 'Front\ProyectosController@paso2_arreglos')->name('proyectos.paso2arreglos');
    Route::post('/crear-proyecto/{proyecto}/{idcliente}/arreglos-locativos/paso-2', 'Front\ProyectosController@post_paso2arreglos')->name('proyectos.paso2arreglos.envio');

    //SI EL TIPO DE PROYECTO ES INMOBILIARIAS
    Route::get('/crear-proyecto/{proyecto}/{idcliente}/inmobiliaria/paso-2', 'Front\ProyectosController@paso2_inmobiliaria')->name('proyectos.paso2inmobiliaria');
    Route::post('/crear-proyecto/{proyecto}/{idcliente}/inmobiliaria/paso-2', 'Front\ProyectosController@post_paso2inmobiliaria')->name('proyectos.paso2inmobiliaria.envio');

    //SI EL TIPO DE PROYECTO PERTENECE AL GRUPO DE LICENCIA DE CONSTRUCCIÓN O URBANIZACIÓN
    Route::get('/crear-proyecto/{proyecto}/{idcliente}/paso-2', 'Front\ProyectosController@paso2')->name('proyectos.paso2');
    Route::post('/crear-proyecto/{proyecto}/{idcliente}/paso-2', 'Front\ProyectosController@post_paso2')->name('proyectos.paso2.envio');

    Route::get('/crear-proyecto/{proyecto}/{idcliente}/paso-3', 'Front\ProyectosController@paso3')->name('proyectos.paso3');
    Route::post('/crear-proyecto/{proyecto}/{idcliente}/paso-3', 'Front\ProyectosController@post_paso3')->name('proyectos.paso3.envio');

    Route::get('/crear-proyecto/{proyecto}/{idcliente}/paso-4', 'Front\ProyectosController@paso4')->name('proyectos.paso4');
    Route::post('/crear-proyecto/{proyecto}/{idcliente}/paso-4', 'Front\ProyectosController@post_paso4')->name('proyectos.paso4.envio');

    Route::get('/crear-proyecto/{proyecto}/{idcliente}/paso-5', 'Front\ProyectosController@paso5')->name('proyectos.paso5');
    Route::post('/crear-proyecto/{proyecto}/{idcliente}/paso-5', 'Front\ProyectosController@post_paso5')->name('proyectos.paso5.envio');

    //SAVE CONTACTO
    Route::post("/contacto/save",'Front\ProyectosController@save_contacto')->name('contacto-save');
    
});



Auth::routes();

Route::group(['middleware' => 'auth'], function () {
		Route::get('/home', 'Admin\HomeController@index')->name('home'); 
	
	//Route::group(['middleware' => ['permissionautomatic']], function () {

        /*
		Rutas para módulo de usuarios
		*/
		Route::get("usuarios/",['uses'=>'Admin\UsersController@get_index'])->name('usuarios-index');
		Route::get("usuarios/crearusuario",['uses'=>'Admin\UsersController@get_crear'])->name('usuarios-crear');
		Route::post('usuarios/crearusuario',"Admin\UsersController@post_crear")->name('usuarios-crear-envio');
		//rutas para actualizar un usuario
		Route::get('usuarios/{id}/editar',"Admin\UsersController@editar")->name('usuarios-editar');
		Route::post('usuarios/{id}',"Admin\UsersController@actualizar")->name('usuarios-editar-envio');
		//mostrar y eliminar usuario
		Route::get('usuarios/{id}',"Admin\UsersController@mostrar")->name('usuarios-consultar');
        Route::get('usuarios/{id}/eliminar',"Admin\UsersController@eliminar")->name('usuarios-eliminar');
        Route::get('password/hash',"Admin\UsersController@pass")->name('usuarios-eliminar');

		/*
		Rutas para módulo de creación de permisos
		*/
		Route::get("permisos/",['uses'=>'Admin\PermissionsController@get_index'])->name('permisos-index');
		Route::get("permisos/crear",['uses'=>'Admin\PermissionsController@get_crear'])->name('permisos-crear');
		Route::post('permisos/crear',"Admin\PermissionsController@post_crear")->name('permisos-crear-envio');
		//rutas para actualizar
		Route::get('permisos/{id}/editar',"Admin\PermissionsController@editar")->name('permisos-editar');
		Route::post('permisos/{id}',"Admin\PermissionsController@actualizar")->name('permisos-editar-envio');
		//mostrar y eliminar un docente
		Route::get('permisos/{id}',"Admin\PermissionsController@mostrar")->name('permisos-consultar');
		Route::get('permisos/{id}/eliminar',"Admin\PermissionsController@eliminar")->name('permisos-eliminar');
		Route::get('actualizarpermisos',"Admin\PermissionsController@actualizarPermisos")->name('permisos-actualizarpermisos');

		/*
		Rutas para módulo de creación de roles
		*/
		Route::get("roles/",['uses'=>'Admin\RolesController@get_index'])->name('roles-index');
		Route::get("roles/crear",['uses'=>'Admin\RolesController@get_crear'])->name('roles-crear');
		Route::post('roles/crear',"Admin\RolesController@post_crear")->name('roles-crear-envio');
		//rutas para actualizar un estudiante
		Route::get('roles/{id}/editar',"Admin\RolesController@editar")->name('roles-editar');
		Route::post('roles/{id}',"Admin\RolesController@actualizar")->name('roles-editar-envio');
		//mostrar y eliminar un docente
		Route::get('roles/{id}',"Admin\RolesController@mostrar")->name('roles-consultar');
		Route::get('roles/{id}/eliminar',"Admin\RolesController@eliminar")->name('roles-eliminar');

		/*
		Rutas para módulo de roles - permisos
		*/
		Route::get("roles/{id}/permisos",'Admin\RolesController@get_permisos')->name('rolespermisos-index');
		Route::post('roles/{id}/permisos/guardar',"Admin\RolesController@save_permisos")->name('rolespermisos-guardar');

		/*
		Rutas para módulo de parametros
		*/
		Route::get("parametros/",['uses'=>'Admin\ParametrosController@get_index'])->name('parametros-index');
		Route::get("parametros/crear",['uses'=>'Admin\ParametrosController@get_crear'])->name('parametros-crear');
		Route::post('parametros/crear',"Admin\ParametrosController@post_crear")->name('parametros-crear-envio');
		// Rutas para actualizar parametros
		Route::get('parametros/{id}/editar',"Admin\ParametrosController@editar")->name('parametros-editar');
		Route::post('parametros/{id}',"Admin\ParametrosController@actualizar")->name('parametros-editar-envio');
		// Mostrar y eliminar parametros
		Route::get('parametros/{id}',"Admin\ParametrosController@mostrar")->name('parametros-consultar');
		Route::get('parametros/{id}/eliminar',"Admin\ParametrosController@eliminar")->name('parametros-eliminar');

        /*
        Rutas para módulo de Listados
        */
        Route::get("listados/",['uses'=>'Admin\ListadosController@get_index'])->name('listados-index');
		Route::get("listados/crear",['uses'=>'Admin\ListadosController@get_crear'])->name('listados-crear');
		Route::post('listados/crear',"Admin\ListadosController@post_crear")->name('listados-crear-envio');
		// Rutas para actualizar listados
		Route::get('listados/{id}/editar',"Admin\ListadosController@editar")->name('listados-editar');
		Route::post('listados/{id}',"Admin\ListadosController@actualizar")->name('listados-editar-envio');
		// Mostrar y eliminar listados
		Route::get('listados/{id}',"Admin\ListadosController@mostrar")->name('listados-consultar');
		Route::get('listados/{id}/eliminar',"Admin\ListadosController@eliminar")->name('listados-eliminar');
        /*
        Rutas para módulo de Opcion Listados
        */
        Route::get("opcionlistados/",['uses'=>'Admin\OpcionListadoController@get_index'])->name('opcionlistados-index');
        Route::get("api-opcion/",['uses'=>'Admin\Api\OpcionesController@get_opciones'])->name('api-opcionlistados-index');
        Route::get("api-opc/{idlistado}",['uses'=>'Admin\Api\OpcionesController@get_opcioneslist'])->name('api-opcionlistados-get');

        Route::get("opcionlistados/crear",['uses'=>'Admin\OpcionListadoController@get_crear'])->name('opcionlistados-crear');
		Route::post('opcionlistados/crear',"Admin\OpcionListadoController@post_crear")->name('opcionlistados-crear-envio');
		// Rutas para actualizar listados
		Route::get('opcionlistados/{id}/editar',"Admin\OpcionListadoController@editar")->name('opcionlistados-editar');
		Route::post('opcionlistados/{id}',"Admin\OpcionListadoController@actualizar")->name('opcionlistados-editar-envio');
		// Mostrar y eliminar listados
		Route::get('opcionlistados/{id}',"Admin\OpcionListadoController@mostrar")->name('opcionlistados-consultar');
		Route::get('opcionlistados/{id}/eliminar',"Admin\OpcionListadoController@eliminar")->name('opcionlistados-eliminar');
        /*
        Rutas para módulo de Listados-Opcion
        */
		Route::get('listados/{id}/opcionlistados',"Admin\ListadosController@index_opcion")->name('listadosopcion-index');
		Route::get('listados/{id}/opcionlistados/crear',"Admin\ListadosController@crear_opcion")->name('listadosopcion-crear');
        Route::get('listados/{idlistado}/opcionlistados/{idopcion}/editar',"Admin\ListadosController@editar_opcion")->name('listadosopcion-editar');

        /*
        Rutas para módulo de Fases
        */
        Route::get("fases/",['uses'=>'Admin\FasesController@get_index'])->name('fases-index');
		Route::get("fases/crear",['uses'=>'Admin\FasesController@get_crear'])->name('fases-crear');
		Route::post('fases/crear',"Admin\FasesController@post_crear")->name('fases-crear-envio');
		// Rutas para actualizar fases
		Route::get('fases/{id}/editar',"Admin\FasesController@editar")->name('fases-editar');
		Route::post('fases/{id}',"Admin\FasesController@actualizar")->name('fases-editar-envio');
		// Mostrar y eliminar fase
		Route::get('fases/{id}',"Admin\FasesController@mostrar")->name('fases-consultar');
        Route::get('fases/{id}/eliminar',"Admin\FasesController@eliminar")->name('fases-eliminar');
        
        /*
        Rutas para módulo de Especialidad Proveedores
        */
        Route::get("especialidades-proveedor/",['uses'=>'Admin\EspecialidadesProveedorController@get_index'])->name('especialidades-proveedor-index');
		Route::get("especialidades-proveedor/crear",['uses'=>'Admin\EspecialidadesProveedorController@get_crear'])->name('especialidades-proveedor-crear');
		Route::post('especialidades-proveedor/crear',"Admin\EspecialidadesProveedorController@post_crear")->name('especialidades-proveedor-crear-envio');
		// Rutas para actualizar Especialidad Proveedores
		Route::get('especialidades-proveedor/{id}/editar',"Admin\EspecialidadesProveedorController@editar")->name('especialidades-proveedor-editar');
		Route::post('especialidades-proveedor/{id}',"Admin\EspecialidadesProveedorController@actualizar")->name('especialidades-proveedor-editar-envio');
		// Mostrar y eliminar Especialidad Proveedores
		Route::get('especialidades-proveedor/{id}',"Admin\EspecialidadesProveedorController@mostrar")->name('especialidades-proveedor-consultar');
		Route::get('especialidades-proveedor/{id}/eliminar',"Admin\EspecialidadesProveedorController@eliminar")->name('especialidades-proveedor-eliminar');


        /*
        Rutas para módulo de Servicios Especialidad
        */
        Route::get("servicios-especialidad/",['uses'=>'Admin\ServiciosEspecialidadController@get_index'])->name('servicios-especialidad-index');
		Route::get("servicios-especialidad/crear",['uses'=>'Admin\ServiciosEspecialidadController@get_crear'])->name('servicios-especialidad-crear');
		Route::post('servicios-especialidad/crear',"Admin\ServiciosEspecialidadController@post_crear")->name('servicios-especialidad-crear-envio');
		// Rutas para actualizar Servicios Especialidad
		Route::get('servicios-especialidad/{id}/editar',"Admin\ServiciosEspecialidadController@editar")->name('servicios-especialidad-editar');
		Route::post('servicios-especialidad/{id}',"Admin\ServiciosEspecialidadController@actualizar")->name('servicios-especialidad-editar-envio');
		// Mostrar y eliminar Servicios Especialidad
		Route::get('servicios-especialidad/{id}',"Admin\ServiciosEspecialidadController@mostrar")->name('servicios-especialidad-consultar');
		Route::get('servicios-especialidad/{id}/eliminar',"Admin\ServiciosEspecialidadController@eliminar")->name('servicios-especialidad-eliminar');

        /*
        Rutas para módulo de Especialidad-Servicios
        */
		Route::get('especialidades-proveedor/{id}/servicios-especialidad',"Admin\EspecialidadesProveedorController@index_servicio")->name('especialidadservicios-index');
		Route::get('especialidades-proveedor/{id}/servicios-especialidad/crear',"Admin\EspecialidadesProveedorController@crear_servicio")->name('especialidadservicios-crear');
        Route::get('especialidades-proveedor/{idespecialidad}/servicios-especialidad/{idservicio}/editar',"Admin\EspecialidadesProveedorController@editar_servicio")->name('especialidadservicios-editar');

        /*
        Rutas para módulo de Disciplinas
        */
        Route::get("disciplinas/",['uses'=>'Admin\DisciplinasController@get_index'])->name('disciplinas-index');
		Route::get("disciplinas/crear",['uses'=>'Admin\DisciplinasController@get_crear'])->name('disciplinas-crear');
		Route::post('disciplinas/crear',"Admin\DisciplinasController@post_crear")->name('disciplinas-crear-envio');
		// Rutas para actualizar Disciplinas
		Route::get('disciplinas/{id}/editar',"Admin\DisciplinasController@editar")->name('disciplinas-editar');
		Route::post('disciplinas/{id}',"Admin\DisciplinasController@actualizar")->name('disciplinas-editar-envio');
		// Mostrar y eliminar Disciplinas
		Route::get('disciplinas/{id}',"Admin\DisciplinasController@mostrar")->name('disciplinas-consultar');
		Route::get('disciplinas/{id}/eliminar',"Admin\DisciplinasController@eliminar")->name('disciplinas-eliminar');
        /*
        Rutas para módulo de Disciplinas
        */
        Route::get("disciplinas/",['uses'=>'Admin\DisciplinasController@get_index'])->name('disciplinas-index');
		Route::get("disciplinas/crear",['uses'=>'Admin\DisciplinasController@get_crear'])->name('disciplinas-crear');
		Route::post('disciplinas/crear',"Admin\DisciplinasController@post_crear")->name('disciplinas-crear-envio');
		// Rutas para actualizar Disciplinas
		Route::get('disciplinas/{id}/editar',"Admin\DisciplinasController@editar")->name('disciplinas-editar');
		Route::post('disciplinas/{id}',"Admin\DisciplinasController@actualizar")->name('disciplinas-editar-envio');
		// Mostrar y eliminar Disciplinas
		Route::get('disciplinas/{id}',"Admin\DisciplinasController@mostrar")->name('disciplinas-consultar');
		Route::get('disciplinas/{id}/eliminar',"Admin\DisciplinasController@eliminar")->name('disciplinas-eliminar');

		/*
		Rutas para módulo de disciplinas - servicios
		*/
		Route::get("disciplinas/{id}/servicios",'Admin\DisciplinasController@get_servicios')->name('disciplinasservicios-index');
		Route::post('disciplinas/{id}/servicios/guardar',"Admin\DisciplinasController@save_servicios")->name('disciplinasservicios-guardar');

		/*
		Rutas para módulo de disciplinas - profesiones
		*/
		Route::get("disciplinas/{id}/profesiones",'Admin\DisciplinasController@get_profesiones')->name('disciplinasprofesiones-index');
		Route::post('disciplinas/{id}/profesiones/guardar',"Admin\DisciplinasController@save_profesiones")->name('disciplinasprofesiones-guardar');


		/* 
			ROUTES FOR PROJECT TYPES CRUD
		*/

		Route::get("tipo-proyectos", 'Admin\TipoProyectoController@index')->name('tipo-proyectos.index');
		Route::get("tipo-proyectos/crear", 'Admin\TipoProyectoController@create')->name('tipo-proyectos.create');
		Route::post("tipo-proyectos/crear", 'Admin\TipoProyectoController@store')->name('tipo-proyectos.store');
		Route::get("tipo-proyectos/{projectId}/editar", 'Admin\TipoProyectoController@edit')->name('tipo-proyectos.edit');
		Route::post("tipo-proyectos/{projectId}/editar", 'Admin\TipoProyectoController@update')->name('tipo-proyectos.update');
		Route::get("tipo-proyectos/{projectId}", 'Admin\TipoProyectoController@show')->name('tipo-proyectos.show');
		Route::get("tipo-proyectos/{projectId}/eliminar", 'Admin\TipoProyectoController@delete')->name('tipo-proyectos.delete');

		/* 
			ROUTES FOR USE GROUPS CRUD
		*/
		Route::get("grupos-uso", 'Admin\GrupoUsoController@index')->name('grupos-uso.index');
		Route::get("grupos-uso/crear", 'Admin\GrupoUsoController@create')->name('grupos-uso.create');
		Route::post("grupos-uso/crear", 'Admin\GrupoUsoController@store')->name('grupos-uso.store');
		Route::get("grupos-uso/{projectId}/editar", 'Admin\GrupoUsoController@edit')->name('grupos-uso.edit');
		Route::post("grupos-uso/{projectId}/editar", 'Admin\GrupoUsoController@update')->name('grupos-uso.update');
		Route::get("grupos-uso/{projectId}", 'Admin\GrupoUsoController@show')->name('grupos-uso.show');
		Route::get("grupos-uso/{projectId}/eliminar", 'Admin\GrupoUsoController@delete')->name('grupos-uso.delete');


		/* 
			ROUTES FOR OCUPATIONS SUB USES CRUD
		*/
		Route::get("sub-uso-ocupaciones", 'Admin\SubUsoOcupacionController@index')->name('sub-uso-ocupaciones.index');
		Route::get("grupos-uso/{useGroupId}/sub-uso-ocupaciones", 'Admin\SubUsoOcupacionController@indexByUseGroup')->name('sub-uso-ocupaciones.index-by-use-group');
		Route::get("sub-uso-ocupaciones/crear", 'Admin\SubUsoOcupacionController@create')->name('sub-uso-ocupaciones.create');
		Route::get("grupos-uso/{useGroupId}/sub-uso-ocupaciones/crear", 'Admin\SubUsoOcupacionController@createByUseGroup')->name('sub-uso-ocupaciones.create-by-use-group');
		Route::post("sub-uso-ocupaciones/crear", 'Admin\SubUsoOcupacionController@store')->name('sub-uso-ocupaciones.store');
		Route::get("sub-uso-ocupaciones/{projectId}/editar", 'Admin\SubUsoOcupacionController@edit')->name('sub-uso-ocupaciones.edit');
		Route::post("sub-uso-ocupaciones/{projectId}/editar", 'Admin\SubUsoOcupacionController@update')->name('sub-uso-ocupaciones.update');
		Route::get("sub-uso-ocupaciones/{projectId}", 'Admin\SubUsoOcupacionController@show')->name('sub-uso-ocupaciones.show');
		Route::get("sub-uso-ocupaciones/{projectId}/eliminar", 'Admin\SubUsoOcupacionController@delete')->name('sub-uso-ocupaciones.delete');

		/* 
			ROUTES FOR PROFESSION AREAS CRUD
		*/
		Route::get("areas-profesiones", 'Admin\AreaProfesionController@index')->name('areas-profesiones.index');
		Route::get("grupos-uso/{useGroupId}/areas-profesiones", 'Admin\AreaProfesionController@indexByUseGroup')->name('areas-profesiones.index-by-use-group');
		Route::get("areas-profesiones/crear", 'Admin\AreaProfesionController@create')->name('areas-profesiones.create');
		Route::get("grupos-uso/{useGroupId}/areas-profesiones/crear", 'Admin\AreaProfesionController@createByUseGroup')->name('areas-profesiones.create-by-use-group');
		Route::post("areas-profesiones/crear", 'Admin\AreaProfesionController@store')->name('areas-profesiones.store');
		Route::get("areas-profesiones/{projectId}/editar", 'Admin\AreaProfesionController@edit')->name('areas-profesiones.edit');
		Route::post("areas-profesiones/{projectId}/editar", 'Admin\AreaProfesionController@update')->name('areas-profesiones.update');
		Route::get("areas-profesiones/{projectId}", 'Admin\AreaProfesionController@show')->name('areas-profesiones.show');
		Route::get("areas-profesiones/{projectId}/eliminar", 'Admin\AreaProfesionController@delete')->name('areas-profesiones.delete');
		
		/* 
			ROUTES FOR DOCUMENT TAGS CRUD
		*/
		Route::get("tag-documentos", 'Admin\TagDocumentoController@index')->name('tag-documentos.index');
		Route::get("tag-documentos/crear", 'Admin\TagDocumentoController@create')->name('tag-documentos.create');
		Route::post("tag-documentos/crear", 'Admin\TagDocumentoController@store')->name('tag-documentos.store');
		Route::get("tag-documentos/{projectId}/editar", 'Admin\TagDocumentoController@edit')->name('tag-documentos.edit');
		Route::post("tag-documentos/{projectId}/editar", 'Admin\TagDocumentoController@update')->name('tag-documentos.update');
		Route::get("tag-documentos/{projectId}", 'Admin\TagDocumentoController@show')->name('tag-documentos.show');
		Route::get("tag-documentos/{projectId}/eliminar", 'Admin\TagDocumentoController@delete')->name('tag-documentos.delete');

		/* 
			ROUTES FOR PROFESSIONS CRUD
		*/
		Route::get("profesiones", 'Admin\ProfesionController@index')->name('profesiones.index');
		Route::get("profesiones/crear", 'Admin\ProfesionController@create')->name('profesiones.create');
		Route::post("profesiones/crear", 'Admin\ProfesionController@store')->name('profesiones.store');
		Route::get("profesiones/{projectId}/editar", 'Admin\ProfesionController@edit')->name('profesiones.edit');
		Route::post("profesiones/{projectId}/editar", 'Admin\ProfesionController@update')->name('profesiones.update');
		Route::get("profesiones/{projectId}", 'Admin\ProfesionController@show')->name('profesiones.show');
		Route::get("profesiones/{projectId}/eliminar", 'Admin\ProfesionController@delete')->name('profesiones.delete');

		/* 
			ROUTES FOR PHASE DISCIPLINE SUBUSE CRUD
		*/
		Route::get("tipo-proyectos/{projectTypeId}/fases", 'Admin\FaseDisciplinaSubusoController@index')->name('fases-disciplinas-subusos.index');


        /*
		Rutas para módulo de creación de categorias
		*/
		Route::get("categorias/",['uses'=>'Admin\CategoriasController@get_index'])->name('categorias-index');
		Route::get("categorias/crear",['uses'=>'Admin\CategoriasController@get_crear'])->name('categorias-crear');
		Route::post('categorias/crear',"Admin\CategoriasController@post_crear")->name('categorias-crear-envio');
		//rutas para actualizar un posts
		Route::get('categorias/{id}/editar',"Admin\CategoriasController@editar")->name('categorias-editar');
		Route::post('categorias/{id}',"Admin\CategoriasController@actualizar")->name('categorias-editar-envio');
		//mostrar y eliminar un posts
		Route::get('categorias/{id}',"Admin\CategoriasController@mostrar")->name('categorias-consultar');
		Route::get('categorias/{id}/eliminar',"Admin\CategoriasController@eliminar")->name('categorias-eliminar');

        /*
		Rutas para módulo de creación de posts
		*/
		Route::get("posts/",['uses'=>'Admin\PostsController@get_index'])->name('posts-index');
		Route::get("posts/crear",['uses'=>'Admin\PostsController@get_crear'])->name('posts-crear');
		Route::post('posts/crear',"Admin\PostsController@post_crear")->name('posts-crear-envio');
		//rutas para actualizar un posts
		Route::get('posts/{id}/editar',"Admin\PostsController@editar")->name('posts-editar');
		Route::post('posts/{id}',"Admin\PostsController@actualizar")->name('posts-editar-envio');
		//mostrar y eliminar un posts
		Route::get('posts/{id}',"Admin\PostsController@mostrar")->name('posts-consultar');
		Route::get('posts/{id}/eliminar',"Admin\PostsController@eliminar")->name('posts-eliminar');



                /*
		Rutas para módulo de creación de categorias
		*/
		Route::get("categorias-beneficios/",['uses'=>'Admin\CategoriasBeneficiosController@get_index'])->name('categorias-beneficios-index');
		Route::get("categorias-beneficios/crear",['uses'=>'Admin\CategoriasBeneficiosController@get_crear'])->name('categorias-beneficios-crear');
		Route::post('categorias-beneficios/crear',"Admin\CategoriasBeneficiosController@post_crear")->name('categorias-beneficios-crear-envio');
		//rutas para actualizar un posts
		Route::get('categorias-beneficios/{id}/editar',"Admin\CategoriasBeneficiosController@editar")->name('categorias-beneficios-editar');
		Route::post('categorias-beneficios/{id}',"Admin\CategoriasBeneficiosController@actualizar")->name('categorias-beneficios-editar-envio');
		//mostrar y eliminar un posts
		Route::get('categorias-beneficios/{id}',"Admin\CategoriasBeneficiosController@mostrar")->name('categorias-beneficios-consultar');
		Route::get('categorias-beneficios/{id}/eliminar',"Admin\CategoriasBeneficiosController@eliminar")->name('categorias-beneficios-eliminar');


        Route::get("beneficios/",['uses'=>'Admin\BeneficiosController@get_index'])->name('beneficios-index');
		Route::get("beneficios/crear",['uses'=>'Admin\BeneficiosController@get_crear'])->name('beneficios-crear');
		Route::post('beneficios/crear',"Admin\BeneficiosController@post_crear")->name('beneficios-crear-envio');
		//rutas para actualizar un posts
		Route::get('beneficios/{id}/editar',"Admin\BeneficiosController@editar")->name('beneficios-editar');
		Route::post('beneficios/{id}',"Admin\BeneficiosController@actualizar")->name('beneficios-editar-envio');
		//mostrar y eliminar un posts
		Route::get('beneficios/{id}',"Admin\BeneficiosController@mostrar")->name('beneficios-consultar');
		Route::get('beneficios/{id}/eliminar',"Admin\BeneficiosController@eliminar")->name('beneficios-eliminar');


                /*
		Rutas para módulo de creación de posts
		*/
		Route::get("posts/",['uses'=>'Admin\PostsController@get_index'])->name('posts-index');
		Route::get("posts/crear",['uses'=>'Admin\PostsController@get_crear'])->name('posts-crear');
		Route::post('posts/crear',"Admin\PostsController@post_crear")->name('posts-crear-envio');
		//rutas para actualizar un posts
		Route::get('posts/{id}/editar',"Admin\PostsController@editar")->name('posts-editar');
		Route::post('posts/{id}',"Admin\PostsController@actualizar")->name('posts-editar-envio');
		//mostrar y eliminar un posts
		Route::get('posts/{id}',"Admin\PostsController@mostrar")->name('posts-consultar');
        Route::get('posts/{id}/eliminar',"Admin\PostsController@eliminar")->name('posts-eliminar');
        

                        /*
		Rutas para módulo de creación de paginas
		*/
		Route::get("paginas/",['uses'=>'Admin\PaginasController@get_index'])->name('paginas-index');
		Route::get("paginas/crear",['uses'=>'Admin\PaginasController@get_crear'])->name('paginas-crear');
		Route::post('paginas/crear',"Admin\PaginasController@post_crear")->name('paginas-crear-envio');
		//rutas para actualizar un paginas
		Route::get('paginas/{id}/editar',"Admin\PaginasController@editar")->name('paginas-editar');
		Route::post('paginas/{id}',"Admin\PaginasController@actualizar")->name('paginas-editar-envio');
		//mostrar y eliminar un paginas
		Route::get('paginas/{id}',"Admin\PaginasController@mostrar")->name('paginas-consultar');
		Route::get('paginas/{id}/eliminar',"Admin\PaginasController@eliminar")->name('paginas-eliminar');

                        /*
		Rutas para módulo de creación de contenidos
		*/
		Route::get("contenidos-paginas/",['uses'=>'Admin\ContenidosPaginasController@get_index'])->name('contenidos-paginas-index');
		Route::get("contenidos-paginas/crear",['uses'=>'Admin\ContenidosPaginasController@get_crear'])->name('contenidos-paginas-crear');
		Route::post('contenidos-paginas/crear',"Admin\ContenidosPaginasController@post_crear")->name('contenidos-paginas-crear-envio');
		//rutas para actualizar un paginas
		Route::get('contenidos-paginas/{id}/editar',"Admin\ContenidosPaginasController@editar")->name('contenidos-paginas-editar');
		Route::post('contenidos-paginas/{id}',"Admin\ContenidosPaginasController@actualizar")->name('contenidos-paginas-editar-envio');
		//mostrar y eliminar un paginas
		Route::get('contenidos-paginas/{id}',"Admin\ContenidosPaginasController@mostrar")->name('contenidos-paginas-consultar');
		Route::get('contenidos-paginas/{id}/eliminar',"Admin\ContenidosPaginasController@eliminar")->name('contenidos-paginas-eliminar');


        Route::get("contactos/",['uses'=>'Admin\HomeController@contactos'])->name('contactos-index');

	//});
});