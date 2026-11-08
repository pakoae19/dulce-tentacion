<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dulce Tentación - Repostería & Delivery')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #b3002d;
            --primary-dark: #8f0024;
            --secondary-color: #6b2d4d;
            --accent-soft: #fce8ed;
            --accent-link: #f0c4d0;
            --bg-light: #fdfbf7;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-light);
            color: #2b2b2b;
        }

        h1, h2, h3, h4, h5, .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* Cursor Personalizado */
        @media (pointer: fine) {
            .custom-cursor {
                width: 14px;
                height: 14px;
                background-color: var(--secondary-color);
                border-radius: 50%;
                position: fixed;
                top: 0;
                left: 0;
                pointer-events: none;
                z-index: 9999;
                transform: translate(-50%, -50%);
                transition: width 0.25s cubic-bezier(0.165, 0.84, 0.44, 1),
                    height 0.25s cubic-bezier(0.165, 0.84, 0.44, 1),
                    background-color 0.25s ease,
                    transform 0.1s ease-out;
            }

            .custom-cursor.active-hover {
                width: 55px;
                height: 55px;
                background-color: #ffffff;
                mix-blend-mode: difference;
            }

            .custom-cursor.fast-move {
                transform: translate(-50%, -50%) scale(1.3);
            }
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(179, 0, 45, 0.08);
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 800;
            font-size: 1.5rem;
        }

        .nav-link {
            font-weight: 600;
            color: #4a4a4a !important;
            transition: color 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            border-radius: 30px;
            font-weight: 600;
            padding: 10px 24px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(179, 0, 45, 0.2);
        }

        .btn-custom:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
        }

        .cart-dropdown-menu {
            width: 340px;
            max-height: 460px;
            overflow-y: auto;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .dropdown-cart-wrapper:hover .cart-dropdown-menu {
            display: block;
        }

        .footer {
            background-color: var(--secondary-color);
            color: #ffffff;
            padding-top: 60px;
            padding-bottom: 30px;
        }

        .footer-title {
            color: var(--accent-soft);
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .footer-icon {
            color: var(--accent-link) !important;
            transition: transform 0.2s ease;
        }

        .footer-icon:hover {
            transform: scale(1.15);
            color: #ffffff !important;
        }

        .cart-badge {
            font-size: 0.7rem;
            padding: 5px 8px;
        }
    </style>
    @yield('styles')
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Círculo del Cursor Personalizado -->
    <div class="custom-cursor" id="cursor"></div>

    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span class="fs-3">🧁</span> Dulce Tentación
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-lg-5 gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Catálogo</a>
                    </li>

                    <!-- Acceso para Administrador -->
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-shield-lock-fill me-1"></i> Administración
                                </a>
                                <ul class="dropdown-menu shadow-sm border-0 rounded-3 mt-2" aria-labelledby="adminDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('productos.create') }}">
                                            <i class="bi bi-plus-circle text-danger"></i> Agregar Postre
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.stock') }}">
                                            <i class="bi bi-box-seam text-danger"></i> Control de Stock
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.promociones') }}">
                                            <i class="bi bi-ticket-perforated text-danger"></i> Cupones y Promociones
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.banner') }}">
                                            <i class="bi bi-megaphone text-danger"></i> Banner y Mensaje Tienda
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <!-- Botón con Dropdown en la Navbar -->
                    <div class="dropdown dropdown-cart-wrapper position-relative">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-danger rounded-pill px-3 d-flex align-items-center gap-1" id="btn-cart">
                            <i class="bi bi-bag-heart-fill"></i> Mi Carrito
                            <span class="badge rounded-circle bg-danger text-white cart-badge ms-1">
                                {{ array_sum(array_column(session('cart', []), 'cantidad')) }}
                            </span>
                        </a>

                        <!-- Menú Desplegable Hover -->
                        <div class="dropdown-menu dropdown-menu-end cart-dropdown-menu p-3 rounded-4">
                            <h6 class="fw-bold border-bottom pb-2 mb-3">Mi Pedido</h6>
                            
                            <div id="cart-dropdown-items">
                                @php $totalCarritoHeader = 0; @endphp
                                @forelse(session('cart', []) as $item)
                                    @php 
                                        $subtotalItem = $item['precio'] * $item['cantidad']; 
                                        $totalCarritoHeader += $subtotalItem;
                                    @endphp
                                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2 item-dropdown-cart" data-id="{{ $item['id'] }}">
                                        <img src="{{ asset($item['imagen']) }}" class="rounded-3" style="width: 45px; height: 45px; object-fit: cover;" onerror="this.onerror=null;this.src='{{ asset('assets/recetas/receta1.jpg') }}';">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 small fw-bold text-truncate" style="max-width: 120px;">{{ $item['nombre'] }}</h6>
                                            <div class="small text-muted" style="font-size: 0.75rem;">
                                                ${{ number_format($item['precio'], 2) }} x {{ $item['cantidad'] }}
                                            </div>
                                            <div class="text-danger fw-bold small">
                                                Total: ${{ number_format($subtotalItem, 2) }}
                                            </div>
                                        </div>

                                        <!-- Controles de Cantidad -->
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="number" class="form-control form-control-sm text-center p-0 input-qty-header" 
                                                   data-id="{{ $item['id'] }}" value="{{ $item['cantidad'] }}" min="1" style="width: 38px; height: 28px;">
                                            <button class="btn btn-sm btn-light text-danger p-1 btn-remove-cart-header" data-id="{{ $item['id'] }}" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted small text-center my-3" id="empty-cart-msg">Tu carrito está vacío.</p>
                                @endforelse
                            </div>

                            <!-- Total General del Carrito -->
                            <div id="cart-dropdown-footer" class="pt-2 border-top {{ count(session('cart', [])) == 0 ? 'd-none' : '' }}">
                                <div class="d-flex justify-content-between align-items-center fw-bold mb-3">
                                    <span>Total Pedido:</span>
                                    <span class="text-danger fs-6" id="cart-dropdown-total">${{ number_format($totalCarritoHeader, 2) }} MXN</span>
                                </div>
                                <a href="{{ route('cart.index') }}" class="btn btn-custom btn-sm w-100 rounded-pill">Ver Carrito Completo</a>
                            </div>
                        </div>
                    </div>

                    <!-- Estado de Sesión del Usuario -->
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-light rounded-pill border dropdown-toggle px-3 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-5 text-danger"></i>
                                <span class="fw-semibold small">{{ auth()->user()->name }}</span>
                                <span class="badge bg-secondary text-capitalize" style="font-size: 0.65rem;">{{ auth()->user()->role }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                                <li><span class="dropdown-item-text text-muted small">{{ auth()->user()->email }}</span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary rounded-pill px-3 fs-6">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-custom px-3 fs-6">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <h4 class="footer-title">Dulce Tentación</h4>
                    <p class="text-white-50 small pe-lg-4">
                        Repostería artesanal horneada con insumos de alta calidad todos los días. Llevamos tus antojos directos a tu puerta.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-title">Horarios de Entrega</h5>
                    <p class="text-white-50 mb-1 small"><i class="bi bi-clock me-2" style="color: var(--accent-link);"></i>Lunes a Viernes: 8:00 AM - 9:00 PM</p>
                    <p class="text-white-50 small"><i class="bi bi-clock me-2" style="color: var(--accent-link);"></i>Sábados y Domingos: 9:00 AM - 10:00 PM</p>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-title">Contacto & Redes</h5>
                    <div class="d-flex gap-3 fs-4 mb-2">
                        <a href="#" class="footer-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="footer-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="footer-icon"><i class="bi bi-whatsapp"></i></a>
                    </div>
                    <span class="text-white-50 small">Soporte: pedidos@dulcetentacion.com</span>
                </div>
            </div>
            <div class="border-top border-secondary pt-3 text-center">
                <p class="m-0 text-white-50 small">© {{ date('Y') }} Dulce Tentación. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script del Cursor y Carrito Dropdown -->
    <script>
        $(document).ready(function () {
            // Cursor
            const cursor = $('#cursor');
            let lastX = 0, lastY = 0;
            let speedTimeout;

            $(document).on('mousemove', function (e) {
                const currentX = e.clientX;
                const currentY = e.clientY;

                cursor.css({
                    left: currentX + 'px',
                    top: currentY + 'px'
                });

                const deltaX = Math.abs(currentX - lastX);
                const deltaY = Math.abs(currentY - lastY);
                const speed = deltaX + deltaY;

                if (speed > 45) {
                    cursor.addClass('fast-move');
                    clearTimeout(speedTimeout);
                    speedTimeout = setTimeout(() => {
                        cursor.removeClass('fast-move');
                    }, 140);
                }

                lastX = currentX;
                lastY = currentY;
            });

            const textSelector = 'h1, h2, h3, h4, h5, h6, p, small, label';

            $(document).on('mouseenter', textSelector, function (e) {
                const isInsideButton = $(this).closest('button, .btn, .tab-btn, a.btn, input').length > 0;
                const isInsideFooter = $(this).closest('footer, .footer').length > 0;

                if (!isInsideButton && !isInsideFooter) {
                    cursor.addClass('active-hover');
                }
            }).on('mouseleave', textSelector, function () {
                cursor.removeClass('active-hover');
            });

            $(document).on('mouseleave', function () {
                cursor.removeClass('active-hover fast-move');
            });

            // Función global auxiliar para renderizar y actualizar el desplegable del carrito
            window.renderizarCarritoHeader = function(cart, totalItems) {
                $('.cart-badge').text(totalItems);

                if (totalItems === 0) {
                    $('#cart-dropdown-items').html('<p class="text-muted small text-center my-3" id="empty-cart-msg">Tu carrito está vacío.</p>');
                    $('#cart-dropdown-footer').addClass('d-none');
                    return;
                }

                let html = '';
                let totalGeneral = 0;

                $.each(cart, function(id, item) {
                    let subtotal = parseFloat(item.precio) * parseInt(item.cantidad);
                    totalGeneral += subtotal;

                    html += `
                        <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2 item-dropdown-cart" data-id="${item.id}">
                            <img src="${item.imagen}" class="rounded-3" style="width: 45px; height: 45px; object-fit: cover;" onerror="this.onerror=null;this.src='/assets/recetas/receta1.jpg';">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 small fw-bold text-truncate" style="max-width: 120px;">${item.nombre}</h6>
                                <div class="small text-muted" style="font-size: 0.75rem;">
                                    $${parseFloat(item.precio).toFixed(2)} x ${item.cantidad}
                                </div>
                                <div class="text-danger fw-bold small">
                                    Total: $${subtotal.toFixed(2)}
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <input type="number" class="form-control form-control-sm text-center p-0 input-qty-header" 
                                       data-id="${item.id}" value="${item.cantidad}" min="1" style="width: 38px; height: 28px;">
                                <button class="btn btn-sm btn-light text-danger p-1 btn-remove-cart-header" data-id="${item.id}" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });

                $('#cart-dropdown-items').html(html);
                $('#cart-dropdown-total').text('$' + totalGeneral.toFixed(2) + ' MXN');
                $('#cart-dropdown-footer').removeClass('d-none');
            };

            // Editar cantidad desde el header
            $(document).on('change', '.input-qty-header', function () {
                let id = $(this).data('id');
                let cantidad = parseInt($(this).val());

                if (isNaN(cantidad) || cantidad < 1) cantidad = 1;

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        cantidad: cantidad
                    },
                    success: function (response) {
                        if (response.success) {
                            renderizarCarritoHeader(response.cart, response.totalItems);
                            if (window.location.pathname === '/carrito') {
                                location.reload();
                            }
                        }
                    }
                });
            });

            // Eliminar producto desde el header
            $(document).on('click', '.btn-remove-cart-header', function (e) {
                e.preventDefault();
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('cart.remove') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function (response) {
                        if (response.success) {
                            renderizarCarritoHeader(response.cart, response.totalItems);
                            if (window.location.pathname === '/carrito') {
                                location.reload();
                            }
                        }
                    }
                });
            });
        });
    </script>

    @yield('scripts')
</body>

</html>