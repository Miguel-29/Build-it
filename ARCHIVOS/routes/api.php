<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tipo/{disciplina}/{seleccion}', 'Front\ProyectosController@getTipo')->name('api-proyectos.paso4');
Route::get('fase-revision/{disciplina}/{seleccion}', 'Front\ProyectosController@getRevision')->name('api-proyectos.paso4.revision');

Route::get('idfinal/{id}/{seleccion}/{disciplina}', 'Front\ProyectosController@getContratista')->name('api-proyectos-final.paso4');
Route::get('check-email/{disciplinas}/{email}/{contratista}', 'Front\ProyectosController@checkEmail')->name('api-proyectos-email.paso4');



