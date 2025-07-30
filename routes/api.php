    <?php

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\DireccionController;
use App\Http\Controllers\Api\MetodoPagoController;
use App\Http\Controllers\Api\VehiculoController;
use App\Http\Controllers\Api\RepartidorController;
use App\Http\Controllers\Api\VentaController;
use App\Http\Controllers\Api\DetalleVentaController;
use App\Http\Controllers\Api\TallaController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ImagenController;

Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('productos', ProductoController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('roles', RolController::class);
Route::apiResource('direcciones', DireccionController::class);
Route::apiResource('metodospago', MetodoPagoController::class);
Route::apiResource('vehiculos', VehiculoController::class);
Route::apiResource('repartidores', RepartidorController::class);
Route::apiResource('ventas', VentaController::class);
Route::apiResource('detalleventas', DetalleVentaController::class);
Route::apiResource('tallas', TallaController::class);
Route::apiResource('colores', ColorController::class);
Route::apiResource('imagenes', ImagenController::class);