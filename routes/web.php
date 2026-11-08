<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

// Rutas Exclusivas para Administrador
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/agregar-producto', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/producto/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/producto/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    // Rutas para funciones administrativas adicionales
    Route::get('/admin/stock', function () {
        return view('admin.stock');
    })->name('admin.stock');

    Route::get('/admin/promociones', function () {
        return view('admin.promociones');
    })->name('admin.promociones');

    Route::get('/admin/banner', function () {
        return view('admin.banner');
    })->name('admin.banner');
});

// Rutas de Carrito
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/actualizar', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrito/eliminar', [CartController::class, 'remove'])->name('cart.remove');

// Catálogo y Producto Público
Route::get('/', [ProductoController::class, 'index'])->name('home');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('productos.show');

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.post');
});

// Cerrar Sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

