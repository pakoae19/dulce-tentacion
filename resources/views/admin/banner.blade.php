@extends('layouts.app')

@section('title', 'Banner y Anuncios - Dulce Tentación')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold font-serif mb-1">Configuración de Anuncios y Banner</h2>
                        <p class="text-muted small mb-0">Personaliza los avisos globales visibles para todos los clientes en la tienda.</p>
                    </div>
                    <span class="badge bg-danger px-3 py-2 rounded-pill">Panel Admin</span>
                </div>

                <form>
                    <!-- Sección 1: Estado de Recepción de Pedidos -->
                    <div class="mb-4 p-3 bg-light rounded-3 border">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1">Recepción de Pedidos Online</h6>
                                <small class="text-muted">Si desactivas esta opción, los clientes verán un aviso de "Fuera de Horario" y no podrán enviar pedidos.</small>
                            </div>
                            <div class="form-check form-switch fs-4">
                                <input class="form-check-input" type="checkbox" checked role="switch">
                            </div>
                        </div>
                    </div>

                    <!-- Sección 2: Barra de Anuncio Superior -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Mensaje de Barra Superior Promocional</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-white"><i class="bi bi-megaphone-fill text-danger"></i></span>
                            <input type="text" class="form-control rounded-end-3" value="✨ Repostería Fina & Delivery Express - ¡Envíos gratis en compras mayores a $300 MXN!">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked id="checkBanner">
                            <label class="form-check-label small text-muted" for="checkBanner">Mostrar esta barra en la cima del sitio</label>
                        </div>
                    </div>

                    <!-- Sección 3: Textos Principales del Inicio -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2">Textos del Encabezado Principal</h6>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Título Principal</label>
                            <input type="text" class="form-control rounded-3" value="Postres artesanales horneados para enamorar tu paladar">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Subtítulo / Mensaje de Bienvenida</label>
                            <textarea class="form-control rounded-3" rows="3">Explora nuestro catálogo de 50 creaciones exclusivas. Desde galletas crujientes hasta tartas y flanes tradicionales con entrega directa a tu domicilio.</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                        <a href="{{ route('home') }}" class="btn btn-light rounded-pill px-4">Cancelar</a>
                        <button type="button" class="btn btn-custom rounded-pill px-4">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection