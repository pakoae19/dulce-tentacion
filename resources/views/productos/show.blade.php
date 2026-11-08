@extends('layouts.app')

@section('title', $producto->nombre . ' - Dulce Tentación')

@section('styles')
    <style>
        .product-detail-card {
            border: none;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .product-detail-img-box {
            position: relative;
            height: 450px;
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .product-detail-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-delivery {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            color: var(--primary-color);
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .price-tag {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .info-badge {
            background: #fdf2f4;
            color: var(--secondary-color);
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .admin-actions-box {
            background-color: #fcf8f9;
            border: 1px dashed rgba(179, 0, 45, 0.2);
            border-radius: 16px;
            padding: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">

        <!-- Botón para Volver al Catálogo -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i> Volver al Catálogo
            </a>
        </div>

        <!-- Mensajes de Notificación -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card product-detail-card">
            <div class="row g-0">

                <!-- Fotografía del Postre -->
                <div class="col-lg-6">
                    <div class="product-detail-img-box">
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}"
                            onerror="this.onerror=null;this.src='{{ asset('assets/recetas/receta1.jpg') }}';">

                        <span class="position-absolute top-0 start-0 m-3 badge-delivery shadow-sm">
                            <i class="bi bi-clock-history me-1"></i> {{ $producto->tiempo_entrega ?? '20-30 min' }}
                        </span>
                    </div>
                </div>

                <!-- Detalles e Información -->
                <div class="col-lg-6 p-4 p-md-5 d-flex flex-column justify-content-between">
                    <div>
                        <!-- Valoración -->
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="text-warning small">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <span class="text-muted small font-semibold">(4.9 / 5.0)</span>
                        </div>

                        <h1 class="display-6 fw-bold mb-3">{{ $producto->nombre }}</h1>

                        <!-- Precio y Tamaño -->
                        <div class="d-flex align-items-baseline gap-3 mb-4">
                            <span class="price-tag">${{ number_format($producto->precio, 2) }} <small
                                    class="fs-6 text-muted">MXN</small></span>
                            <span class="info-badge">
                                <i class="bi bi-pie-chart-fill me-1 text-danger"></i>
                                {{ $producto->porciones ?? 'Individual' }}
                            </span>
                        </div>

                        <h6 class="fw-bold text-muted text-uppercase small mb-2">Descripción del Postre</h6>
                        <p class="text-secondary fs-6 lead mb-4">
                            {{ $producto->descripcion ?? $producto->descripcion_corta ?? 'Elaborado artesanalmente día a día con ingredientes frescos y seleccionados para garantizar la máxima calidad y sabor.' }}
                        </p>
                    </div>

                    <!-- Botones para el Cliente / Usuario General -->
                    <div>
                        <div class="d-flex gap-3 mb-4">
                            <input type="number" id="cantidad-producto" class="form-control rounded-pill text-center"
                                value="1" min="1" style="width: 80px;">

                            <button class="btn btn-custom btn-lg rounded-pill flex-grow-1 py-3" id="btn-agregar-detalle"
                                data-id="{{ $producto->id }}">
                                <i class="bi bi-bag-heart-fill me-2"></i> Añadir al Carrito
                            </button>
                        </div>

                        <!-- Panel Exclusivo para Administradores (Editar y Eliminar) -->
                        @auth
                            @if(auth()->user()->isAdmin())
                                <div class="admin-actions-box mt-3">
                                    <span class="badge bg-danger mb-2">Panel de Administración</span>
                                    <h6 class="fw-bold mb-3">Gestión de este Producto</h6>

                                    <div class="d-flex gap-2">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('productos.edit', $producto->id) }}"
                                            class="btn btn-warning text-dark rounded-pill fw-semibold px-4">
                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                        </a>

                                        <!-- Botón Eliminar con Modal de Confirmación -->
                                        <button type="button" class="btn btn-outline-danger rounded-pill fw-semibold px-4"
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                            <i class="bi bi-trash-fill me-1"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Eliminar (Solo Admin) -->
    @auth
        @if(auth()->user()->isAdmin())
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 rounded-4 shadow-lg">
                        <div class="modal-body text-center p-4">
                            <div class="text-danger fs-1 mb-2"><i class="bi bi-exclamation-triangle-fill"></i></div>
                            <h5 class="fw-bold mb-2">¿Eliminar este postre?</h5>
                            <p class="text-muted small mb-4">Esta acción no se puede deshacer. El producto "{{ $producto->nombre }}"
                                se borrará permanentemente del catálogo.</p>

                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-light rounded-pill px-4"
                                    data-bs-dismiss="modal">Cancelar</button>

                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">Sí, Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth

@endsection

@section('scripts')

    <script>
        $('#btn-agregar-detalle').click(function () {
            let id = $(this).data('id');
            let cantidad = $('#cantidad-producto').val();

            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    cantidad: cantidad
                },
                success: function (response) {
                    $('.cart-badge').text(response.totalItems);
                    alert('¡Producto añadido al carrito correctamente!');
                    location.reload();
                }
            });
        });
    </script>
    
@endsection