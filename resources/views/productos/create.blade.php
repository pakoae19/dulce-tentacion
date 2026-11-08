@extends('layouts.app')

@section('title', 'Agregar Nuevo Postre - Dulce Tentación')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold font-serif mb-1">Agregar Nuevo Postre</h2>
                        <p class="text-muted small mb-0">Completa la información para incluirlo en el catálogo principal.</p>
                    </div>
                    <span class="badge bg-danger px-3 py-2 rounded-pill">Panel Admin</span>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 rounded-3 small mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-muted">Nombre del Postre *</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control rounded-3" placeholder="Ej. Torta Helada de Mango" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted">Precio ($ MXN) *</label>
                            <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" class="form-control rounded-3" placeholder="250.00" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Descripción Corta *</label>
                            <input type="text" name="descripcion_corta" value="{{ old('descripcion_corta') }}" class="form-control rounded-3" placeholder="Resumen para la tarjeta del catálogo (máx 100 caracteres)" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Descripción Detallada</label>
                            <textarea name="descripcion_detallada" class="form-control rounded-3" rows="3" placeholder="Explicación extendida de ingredientes y sabor para la vista individual.">{{ old('descripcion_detallada') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Tiempo de Entrega</label>
                            <input type="text" name="tiempo_entrega" value="{{ old('tiempo_entrega') }}" class="form-control rounded-3" placeholder="Ej. 20-30 min">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Porciones / Tamaño</label>
                            <input type="text" name="porciones" value="{{ old('porciones') }}" class="form-control rounded-3" placeholder="Ej. 8 Porciones, Individual">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Categorías / Etiquetas (Tags)</label>
                            <input type="text" name="tags" value="{{ old('tags') }}" class="form-control rounded-3" placeholder="Separa por comas: chocolates, tartas, frios, tradicionales">
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                Usa palabras clave como <b>chocolates</b>, <b>tartas</b>, <b>frios</b> o <b>tradicionales</b> para habilitar el filtro.
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Imagen del Postre</label>
                            <input type="file" name="imagen" class="form-control rounded-3" accept="image/*">
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                        <a href="{{ route('home') }}" class="btn btn-light rounded-pill px-4">Cancelar</a>
                        <button type="submit" class="btn btn-custom rounded-pill px-4">Guardar Postre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection