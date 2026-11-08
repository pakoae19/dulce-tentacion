@extends('layouts.app')

@section('title', 'Dulce Tentación - Repostería & Delivery Express')

@section('styles')
    <style>
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #fef4f4 0%, #f7e6eb 100%);
            padding: 60px 0;
            border-bottom: 1px solid rgba(179, 0, 45, 0.05);
        }

        .hero-title {
            font-size: 3.2rem;
            font-weight: 800;
            color: #2b2b2b;
            line-height: 1.15;
        }

        .hero-title span {
            color: var(--primary-color);
            font-style: italic;
        }

        /* Carrusel */
        .hero-carousel {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(107, 45, 77, 0.18);
            border: 5px solid #ffffff;
        }

        .hero-carousel .carousel-item img {
            height: 380px;
            object-fit: cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 48px;
            height: 48px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .carousel-control-prev { left: 15px; }
        .carousel-control-next { right: 15px; }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: var(--primary-color);
            opacity: 1;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1) grayscale(100%);
        }

        .carousel-control-prev:hover .carousel-control-prev-icon,
        .carousel-control-next:hover .carousel-control-next-icon {
            filter: none;
        }

        /* Tarjetas promocionales */
        .feature-box {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        /* Pestañas de Filtros */
        .category-tabs {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .tab-btn {
            background: white;
            border: 1px solid #ead6dc;
            color: #555;
            padding: 10px 22px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn:hover,
        .tab-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 6px 15px rgba(179, 0, 45, 0.25);
        }

        /* Tarjetas de Producto */
        .product-card {
            border: none;
            border-radius: 20px;
            background: white;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
            transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 30px rgba(179, 0, 45, 0.12);
        }

        .card-img-box {
            position: relative;
            height: 210px;
            overflow: hidden;
        }

        .card-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .card-img-box img {
            transform: scale(1.08);
        }

        .delivery-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #333;
        }

        .btn-quick-add {
            position: absolute;
            bottom: 14px;
            right: 14px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: white;
            color: var(--primary-color);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.25s ease;
        }

        .btn-quick-add:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.12) rotate(90deg);
        }
    </style>
@endsection

@section('content')

    <!-- Hero Section Principal -->
    <section class="hero-section mb-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="badge bg-danger bg-opacity-10 text-danger mb-3 px-3 py-2 rounded-pill fw-bold">
                        ✨ Repostería Fina & Delivery Express
                    </span>
                    <h1 class="hero-title mb-3">
                        Postres artesanales horneados para <span>enamorar tu paladar</span>
                    </h1>
                    <p class="text-muted fs-5 mb-4 pe-lg-4">
                        Explora nuestro catálogo de 50 creaciones exclusivas. Desde galletas crujientes hasta tartas y
                        flanes tradicionales con entrega directa a tu domicilio.
                    </p>
                    <div class="d-flex gap-3 align-items-center flex-wrap">
                        <a href="#catalogo" class="btn btn-custom fs-6">
                            Ver Catálogo Completo <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <span class="text-muted small">
                            <i class="bi bi-shield-check text-success fs-5 align-middle me-1"></i> Garantía de Frescura
                        </span>
                    </div>
                </div>

                <!-- Carrusel -->
                <div class="col-lg-6">
                    <div id="heroPostresCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="3500">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroPostresCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#heroPostresCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#heroPostresCarousel" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#heroPostresCarousel" data-bs-slide-to="3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/recetas/receta6.jpg') }}" class="d-block w-100" alt="Cheesecake">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/recetas/receta4.jpg') }}" class="d-block w-100" alt="Brownies">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/recetas/receta10.jpg') }}" class="d-block w-100" alt="Tiramisú">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/recetas/receta18.jpg') }}" class="d-block w-100" alt="Pastel Tres Leches">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroPostresCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroPostresCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Secciones Promocionales -->
            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="feature-box d-flex align-items-center gap-3">
                        <span class="fs-1 text-danger"><i class="bi bi-lightning-charge-fill"></i></span>
                        <div>
                            <h6 class="fw-bold mb-0">Entrega Veloz</h6>
                            <small class="text-muted">Promedio de 25 a 35 min en tu zona.</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box d-flex align-items-center gap-3">
                        <span class="fs-1 text-warning"><i class="bi bi-award-fill"></i></span>
                        <div>
                            <h6 class="fw-bold mb-0">100% Artesanal</h6>
                            <small class="text-muted">Sin conservantes, horneado hoy mismo.</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box d-flex align-items-center gap-3">
                        <span class="fs-1 text-success"><i class="bi bi-bag-check-fill"></i></span>
                        <div>
                            <h6 class="fw-bold mb-0">Empaque Térmico</h6>
                            <small class="text-muted">Llega a la temperatura perfecta.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Catálogo de Productos -->
    <section class="container mb-5" id="catalogo">
        <div class="text-center mb-4">
            <h2 class="display-6 fw-bold mb-2">Nuestro Catálogo Especial</h2>
            <p class="text-muted">Selecciona tu categoría preferida y pide en un par de clics</p>
        </div>

        <!-- Pestañas de Filtro Dinámico por Tags -->
        <div class="category-tabs">
            <button class="tab-btn active" data-filter="todos">🧁 Todos (50)</button>
            <button class="tab-btn" data-filter="chocolates">🍫 Chocolates & Brownies</button>
            <button class="tab-btn" data-filter="tartas">🥧 Tartas & Pays</button>
            <button class="tab-btn" data-filter="frios">🍨 Helados & Fríos</button>
            <button class="tab-btn" data-filter="tradicionales">🇲🇽 Tradicionales</button>
        </div>

        <!-- Grid de Productos -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="grid-productos">
            @forelse ($productos as $producto)
                <div class="col item-producto" data-tags="{{ strtolower($producto->tags ?? 'tradicionales') }}">
                    <div class="card h-100 product-card">
                        <div class="card-img-box">
                            <a href="{{ route('productos.show', $producto->id) }}">
                                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/recetas/receta1.jpg') }}';">
                            </a>
                            <span class="delivery-badge">
                                <i class="bi bi-clock-history text-danger me-1"></i>{{ $producto->tiempo_entrega ?? '20-30 min' }}
                            </span>
                            <button class="btn-quick-add btn-agregar-carrito" data-id="{{ $producto->id }}" title="Añadir directo al carrito">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between p-3">
                            <div>
                                <h5 class="card-title h6 fw-bold mb-1">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="text-decoration-none text-dark">
                                        {{ $producto->nombre }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small mb-2" style="height: 38px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $producto->descripcion_corta }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                <span class="fw-bold text-danger fs-5">${{ number_format($producto->precio, 2) }} <small class="fs-6 text-muted">MXN</small></span>
                                <span class="badge bg-light text-secondary border fw-normal">{{ $producto->porciones ?? 'Individual' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No se encontraron postres registrados.</p>
                </div>
            @endforelse
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Filtrado estricto por tags
            $('.tab-btn').click(function () {
                $('.tab-btn').removeClass('active');
                $(this).addClass('active');

                let filtro = $(this).data('filter');

                if (filtro === 'todos') {
                    $('.item-producto').fadeIn(300);
                } else {
                    $('.item-producto').each(function() {
                        let tags = $(this).data('tags') || '';
                        if (tags.includes(filtro)) {
                            $(this).fadeIn(300);
                        } else {
                            $(this).hide();
                        }
                    });
                }
            });

            $('.btn-agregar-carrito').click(function (e) {
                e.preventDefault();
                let btn = $(this);
                let id = btn.data('id');

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        cantidad: 1
                    },
                    success: function (response) {
                        if (response.success) {
                            renderizarCarritoHeader(response.cart, response.totalItems);

                            btn.addClass('bg-success text-white').html('<i class="bi bi-check-lg"></i>');
                            
                            setTimeout(() => {
                                btn.removeClass('bg-success text-white').html('<i class="bi bi-plus-lg"></i>');
                            }, 1000);
                        }
                    }
                });
            });
        });
    </script>
@endsection