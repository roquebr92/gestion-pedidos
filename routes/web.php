<?php
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PedidoController;


Route::get('/', [WelcomeController::class, 'index'])
     ->name('welcome');

Route::get('/login', [LoginController::class, 'showLoginForm'])
     ->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {
     // ... tus demás rutas protegidas
 
     Route::get('/pedidos', [PedidoController::class, 'index'])
          ->name('pedidos.index');
     Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])
          ->name('pedidos.show');
     Route::get('pedidos/{pedido}/etiquetas', [PedidoController::class, 'etiquetas'])
          ->name('pedidos.etiquetas');
          Route::get('/pedidos/{pedido}/etiquetas/pdf', [PedidoController::class, 'pdfEtiquetas'])
          ->name('pedidos.qr.pdf');
 });

 // 2. Formulario/tabla para generar etiquetas de una comanda
Route::get('/pedidos/{pedido}/etiquetas', [PedidoController::class, 'etiquetas'])
->name('pedidos.etiquetas');

// 3. Acción para generar un sólo QR (línea concreta)
Route::get(
     '/pedidos/{pedido}/etiquetas/{linea}/generar',
     [PedidoController::class, 'generar']
 )->name('pedidos.etiquetas.generar');
// 4. Acción para ver un QR ya generado
Route::get('/pedidos/{pedido}/etiquetas/{linea}/ver', [PedidoController::class, 'ver'])
->name('pedidos.etiquetas.ver');

// 5. Acción para generar todas las etiquetas de la comanda
Route::get('/pedidos/{pedido}/etiquetas/generar-todas', [PedidoController::class, 'generarTodas'])
->name('pedidos.etiquetas.generar-todas');

Route::get(
     '/pedidos/{pedido}/lineas/{linea}/qr.png',
     [PedidoController::class, 'qrImage']
 )->name('pedidos.qr.image');

