@extends('layouts.app')

@section('title', 'Cupones y Promociones - Dulce Tentación')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold font-serif mb-1">Cupones y Promociones</h2>
            <p class="text-muted small mb-0">Crea y gestiona códigos promocionales de descuento para tus clientes.</p>
        </div>
        <button class="btn btn-custom rounded-pill" data-bs-toggle="modal" data-bs-target="#modalCrearCupon">
            <i class="bi bi-plus-lg me-1"></i> Crear Nuevo Cupón
        </button>
    </div>

    <!-- Lista de Cupones -->
    <div class="row g-4 mb-4">
        <!-- Cupón 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 position-relative overflow-hidden bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-3 py-2 rounded-pill fs-6">
                        DULCE10
                    </span>
                    <span class="badge bg-success border rounded-pill">Activo</span>
                </div>
                <h5 class="fw-bold mb-1">10% de Descuento</h5>
                <p class="text-muted small mb-3">Válido en la compra mínima de $200 MXN en cualquier tarta o pastel.</p>
                
                <div class="border-top pt-3 d-flex justify-content-between align-items-center text-muted small">
                    <span>Usos: <strong>24 / 100</strong></span>
                    <button class="btn btn-sm btn-outline-danger rounded-circle"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>

        <!-- Cupón 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 position-relative overflow-hidden bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-3 py-2 rounded-pill fs-6">
                        BIENVENIDA50
                    </span>
                    <span class="badge bg-success border rounded-pill">Activo</span>
                </div>
                <h5 class="fw-bold mb-1">$50 MXN de Regalo</h5>
                <p class="text-muted small mb-3">Aplica exclusivamente para nuevos clientes registrados en su primer pedido.</p>
                
                <div class="border-top pt-3 d-flex justify-content-between align-items-center text-muted small">
                    <span>Usos: <strong>58 / ∞</strong></span>
                    <button class="btn btn-sm btn-outline-danger rounded-circle"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>

        <!-- Cupón 3 (Expirado) -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 opacity-75 bg-light border">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-secondary text-white fw-bold px-3 py-2 rounded-pill fs-6">
                        CHOCO20
                    </span>
                    <span class="badge bg-secondary rounded-pill">Expirado</span>
                </div>
                <h5 class="fw-bold mb-1">20% en Chocolates</h5>
                <p class="text-muted small mb-3">Promoción especial del día del chocolate finalizada.</p>
                
                <div class="border-top pt-3 d-flex justify-content-between align-items-center text-muted small">
                    <span>Usos: <strong>50 / 50</strong></span>
                    <button class="btn btn-sm btn-outline-danger rounded-circle"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Crear Nuevo Cupón -->
<div class="modal fade" id="modalCrearCupon" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg p-3">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Crear Código de Descuento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Código del Cupón (Ej. POSTRE15)</label>
                        <input type="text" class="form-control rounded-3 text-uppercase" placeholder="POSTRE15">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Tipo Descuento</label>
                            <select class="form-select rounded-3">
                                <option>Porcentaje (%)</option>
                                <option>Monto Fijo ($)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Valor</label>
                            <input type="number" class="form-control rounded-3" placeholder="15">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Monto Mínimo de Compra ($ MXN)</label>
                        <input type="number" class="form-control rounded-3" placeholder="150">
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-custom rounded-pill px-4" data-bs-dismiss="modal">Crear Cupón</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection