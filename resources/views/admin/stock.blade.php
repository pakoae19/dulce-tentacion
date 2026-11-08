@extends('layouts.app')

@section('title', 'Control de Stock - Dulce Tentación')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold font-serif mb-1">Control de Inventario & Stock</h2>
            <p class="text-muted small mb-0">Gestiona las unidades disponibles horneadas para el día y pausar productos agotados.</p>
        </div>
        <span class="badge bg-danger px-3 py-2 rounded-pill">Panel de Control</span>
    </div>

    <!-- Métrica -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-danger border-4">
                <small class="text-muted fw-bold">Total de Productos</small>
                <h4 class="fw-bold mb-0 mt-1">50 Postres</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-warning border-4">
                <small class="text-muted fw-bold">Bajo Stock (&lt; 5 unidades)</small>
                <h4 class="fw-bold text-warning mb-0 mt-1">3 Postres</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-secondary border-4">
                <small class="text-muted fw-bold">Agotados / Pausados</small>
                <h4 class="fw-bold text-muted mb-0 mt-1">1 Postre</h4>
            </div>
        </div>
    </div>

    <!-- Tabla de Productos e Inventario -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control rounded-pill w-50" placeholder="Buscar postre en inventario...">
            <button class="btn btn-custom rounded-pill btn-sm px-3">
                <i class="bi bi-arrow-clockwise me-1"></i> Guardar Cambios
            </button>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Postre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th style="width: 150px;">Stock Actual</th>
                        <th>Estado</th>
                        <th>Disponible en Web</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="d-flex align-items-center gap-3">
                            <img src="{{ asset('assets/recetas/receta1.jpg') }}" class="rounded-3" style="width: 48px; height: 48px; object-fit: cover;">
                            <span class="fw-bold">Galletas de Chocolate</span>
                        </td>
                        <td><span class="badge bg-light text-dark border">Chocolates</span></td>
                        <td>$45.00 MXN</td>
                        <td>
                            <input type="number" class="form-control form-control-sm text-center rounded-pill fw-bold" value="24" min="0">
                        </td>
                        <td><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">En Stock</span></td>
                        <td>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" checked role="switch">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="d-flex align-items-center gap-3">
                            <img src="{{ asset('assets/recetas/receta6.jpg') }}" class="rounded-3" style="width: 48px; height: 48px; object-fit: cover;">
                            <span class="fw-bold">Cheesecake de Frambuesa</span>
                        </td>
                        <td><span class="badge bg-light text-dark border">Tartas</span></td>
                        <td>$420.00 MXN</td>
                        <td>
                            <input type="number" class="form-control form-control-sm text-center rounded-pill fw-bold text-danger" value="2" min="0">
                        </td>
                        <td><span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">Bajo Stock</span></td>
                        <td>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" checked role="switch">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="d-flex align-items-center gap-3">
                            <img src="{{ asset('assets/recetas/receta18.jpg') }}" class="rounded-3" style="width: 48px; height: 48px; object-fit: cover;">
                            <span class="fw-bold">Pastel Tres Leches</span>
                        </td>
                        <td><span class="badge bg-light text-dark border">Tradicionales</span></td>
                        <td>$360.00 MXN</td>
                        <td>
                            <input type="number" class="form-control form-control-sm text-center rounded-pill fw-bold text-muted" value="0" min="0">
                        </td>
                        <td><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill">Agotado</span></td>
                        <td>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection