@extends('layouts.app')

@section('title', 'Editar ' . $producto->nombre . ' - Dulce Tentación')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold font-serif mb-1">Editar Postre</h2>
                        <p class="text-muted small mb-0">Modifica los detalles de "{{ $producto->nombre }}".</p>
                    </div>
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">Edición Admin</span>
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

                <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-muted">Nombre del Postre *</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" class="form-control rounded-3" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted">Precio ($ MXN) *</label>
                            <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" class="form-control rounded-3" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Descripción Corta *</label>
                            <input type="text" name="descripcion_corta" value="{{ old('descripcion_corta', $producto->descripcion_corta) }}" class="form-control rounded-3" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Descripción Detallada</label>
                            <textarea name="descripcion_detallada" class="form-control rounded-3" rows="3">{{ old('descripcion_detallada', $producto->descripcion_detallada ?? $producto->descripcion) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Tiempo de Entrega</label>
                            <input type="text" name="tiempo_entrega" value="{{ old('tiempo_entrega', $producto->tiempo_entrega) }}" class="form-control rounded-3">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Porciones / Tamaño</label>
                            <input type="text" name="porciones" value="{{ old('porciones', $producto->porciones) }}" class="form-control rounded-3">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Categorías / Etiquetas (Tags)</label>
                            <input type="text" name="tags" value="{{ old('tags', $producto->tags) }}" class="form-control rounded-3">
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                Palabras clave separadas por comas (ej. chocolates, tartas, frios, tradicionales).
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Imagen Actual</label>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <img src="{{ asset($producto->imagen) }}" class="rounded-3 shadow-sm" style="width: 70px; height: 70px; object-fit: cover;" onerror="this.onerror=null;this.src='{{ asset('assets/recetas/receta1.jpg') }}';">
                                <span class="text-muted small">Subir una nueva imagen solo si deseas reemplazar la actual:</span>
                            </div>
                            <input type="file" name="imagen" class="form-control rounded-3" accept="image/*">
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-light rounded-pill px-4">Cancelar</a>
                        <button type="submit" class="btn btn-custom rounded-pill px-4">Actualizar Postre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection