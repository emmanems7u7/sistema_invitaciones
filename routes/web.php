<?php

use App\Http\Controllers\InvitacionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BloqueController;
use App\Http\Controllers\TextoController;
use App\Http\Controllers\ColoresController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\ComponenteController;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ContenidoController;
// routes/web.php
use App\Http\Controllers\FuenteController;
use App\Http\Controllers\TexturaController;
use App\Http\Controllers\InvitadoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['role:Administrador'])->group(function () {
    Route::resource('roles', RoleController::class);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Rutas de usuarios
    Route::resource('users', UserController::class);
    Route::get('users/{user}/data', [UserController::class, 'getUserData'])->name('users.getData');

    // Rutas de invitaciones
    Route::get('crear/{id}/invitacion', [InvitacionController::class, 'create'])->name('crear_invitacion');
    Route::get('ver/{id}/invitacion', [InvitacionController::class, 'show'])->name('invitacion');
    Route::get('ver/{id}/invitacion/boda', [InvitacionController::class, 'show_boda'])->name('invitacion_boda');
    Route::resource('invitaciones', InvitacionController::class);
    Route::get('/invitacion/ver/{id}', [InvitacionController::class, 'previsualizar'])->name('invitacion.ver');

    // Rutas de bloques
    Route::post('/bloques', [BloqueController::class, 'store'])->name('bloques.store');
    Route::get('/bloques/crear/{id}', [BloqueController::class, 'create'])->name('bloques.create');
    Route::post('/bloque/plantilla', [BloqueController::class, 'storePlantilla'])->name('bloque.componente');
    Route::post('/bloques/update-posicion', [BloqueController::class, 'updatePosicion'])->name('bloques.updatePosicion');
    // Rutas de colores
    Route::prefix('colores')->name('colores.')->group(function () {
        Route::get('/', [ColoresController::class, 'index'])->name('index');
        Route::get('/create', [ColoresController::class, 'create'])->name('create');
        Route::post('/', [ColoresController::class, 'store'])->name('store');
        Route::get('/{id}', [ColoresController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ColoresController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ColoresController::class, 'update'])->name('update');
        Route::delete('/eliminar/{id}', [ColoresController::class, 'destroy'])->name('destroy');
    });

    // Rutas de textos
    Route::get('/textos/create', [TextoController::class, 'create'])->name('textos.create');
    Route::post('/textos', [TextoController::class, 'store'])->name('textos.store');
    Route::get('/textos/{id}/edit', [TextoController::class, 'edit'])->name('textos.edit');
    Route::put('/texto/editar/{id}', [TextoController::class, 'update'])->name('textos.update');
    Route::delete('/textos/{id}', [TextoController::class, 'destroy'])->name('textos.destroy');

    // Rutas de multimedia
    Route::post('/multimedia/crear', [MultimediaController::class, 'store'])->name('multimedia.store');
    Route::post('/multimedia/crea', [MultimediaController::class, 'prueba'])->name('multimedia.prueba');
    Route::delete('/multimedia/eliminar/{id}', [MultimediaController::class, 'eliminar'])->name('multimedia.eliminar');

    // Rutas de mensajes
    Route::post('/mensajes/crear/{id}', [MensajeController::class, 'store'])->name('mensajes.store');

    // Rutas de componentes
    Route::get('/componentes', [ComponenteController::class, 'index'])->name('componentes.index');
    Route::post('/componentes', [ComponenteController::class, 'store'])->name('componentes.store');
    Route::get('/componentes/{id}/edit', [ComponenteController::class, 'edit'])->name('componentes.edit');
    Route::put('/componentes/{id}', [ComponenteController::class, 'update'])->name('componentes.update');
    Route::delete('/componentes/{id}', [ComponenteController::class, 'destroy'])->name('componentes.destroy');
    Route::get('/componentes/tipo/{id}', [ComponenteController::class, 'componenetesTipo'])->name('componentes.tipo');
    Route::get('/componentes/tipo/t/{tipo}', [ComponenteController::class, 'componenetesTipot'])->name('componentes.tipot');


    Route::get('/componentes/textura', [TexturaController::class, 'texturas'])->name('componentes.textura');
    Route::post('/bloque/textura/{id}', [TexturaController::class, 'storeTextura'])->name('bloque.textura');
    Route::post('/bloque/textura/asociar/{id}', [TexturaController::class, 'asociar_textura'])->name('bloque.asociar.textura');
    Route::delete('/textura/eliminar/{bloque}', [TexturaController::class, 'destroy'])->name('textura.eliminar');

    // Rutas de tipos de letras

    Route::get('tipos_letras/{invitacion_id}', [FuenteController::class, 'index'])->name('tipos_letras.index');

    // Rutas de contenido
    Route::post('/contenidos', [ContenidoController::class, 'store'])->name('contenidos.store');


    Route::get('/fuentes/edit/{id}', [FuenteController::class, 'edit'])->name('fuentes.edit');
    Route::post('/fuentes', [FuenteController::class, 'store'])->name('fuentes.store');
    Route::put('/fuentes/{fuente}', [FuenteController::class, 'update'])->name('fuentes.update');
    Route::delete('/fuentes/{fuente}', [FuenteController::class, 'destroy'])->name('fuentes.destroy');



    Route::post('/invitados/{invitacion}', [InvitadoController::class, 'store'])->name('invitados.store');
    Route::put('/invitados/{invitado}', [InvitadoController::class, 'update'])->name('invitados.update');
    Route::delete('/invitados/{invitado}', [InvitadoController::class, 'destroy'])->name('invitados.destroy');

    Route::get('/export/invitados/{id}', [InvitadoController::class, 'export'])->name('invitados.export');

});




Route::get('/invitacion/{id}', [InvitacionController::class, 'generar'])->name('invitacion.generar');
Route::get('/invitacion/{id}/{invitado_id}', [InvitacionController::class, 'generar_invitado'])->name('invitacion.generar_invitado');
Route::post('/confirmar/asistencia/{invitado_id}', [InvitadoController::class, 'confirmar_asistencia'])->name('asistencia.confirmar');

