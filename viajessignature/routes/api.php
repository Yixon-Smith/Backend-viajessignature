<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Login Auntentificacion
Route::post('login', 'App\Http\Controllers\Api\ApiAuthController@login')->name('login');


/**
 * Middleware: CheckRolePermissionApi
 * Objetivo: Proteger Rutas A Traves de los Roles Y Permisos 
 */
Route::middleware(['auth:api', 'CheckRolePermissionApi'])->group(function() {

    //Inicio
    Route::resource('inicio', 'App\Http\Controllers\InicioController');

    //Usuarios
    Route::resource('usuarios', 'App\Http\Controllers\UsuariosController');

    //Afiliados
    Route::resource('afiliados', 'App\Http\Controllers\AfiliadosController');

    //Comisiones
    Route::resource('comisiones', 'App\Http\Controllers\ComisionesController');

    //Contratos
    Route::resource('contratos', 'App\Http\Controllers\ContratosController');

});