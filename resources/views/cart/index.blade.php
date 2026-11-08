@extends('layouts.app')

@section('title', 'Mi Carrito - Dulce Tentación')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold font-serif mb-4">Tu Carrito de Compras</h2>

    <div id="cart-wrapper">
        @if(count($cart) > 0)
            <div class="row g-4" id="cart-content-wrapper">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-table-body">
                                    @php $total = 0; @endphp
                                    @foreach($cart as $id => $item)
                                        @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
                                        <tr id="cart-row-{{ $id }}">
                                            <td class="d-flex align-items-center gap-3">
                                                <img src="{{ asset($item['imagen']) }}" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;" onerror="this.onerror=null;this.src='{{ asset('assets/recetas/receta1.jpg') }}';">
                                                <span class="fw-bold">{{ $item['nombre'] }}</span>
                                            </td>
                                            <td>${{ number_format($item['precio'], 2) }}</td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm rounded-pill text-center btn-update-cart-main" 
                                                       data-id="{{ $id }}" value="{{ $item['cantidad'] }}" min="1" style="width: 70px;">
                                            </td>
                                            <td class="fw-bold text-danger subtotal-item" id="subtotal-{{ $id }}">
                                                ${{ number_format($subtotal, 2) }}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-danger rounded-circle btn-remove-cart-main" data-id="{{ $id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Resumen de Pedido -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold mb-3">Resumen de la Orden</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="summary-subtotal">${{ number_format($total, 2) }} MXN</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Envío Express</span>
                            <span class="text-success fw-bold">GRATIS</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5 fw-bold mb-4">
                            <span>Total</span>
                            <span class="text-danger" id="summary-total">${{ number_format($total, 2) }} MXN</span>
                        </div>
                        <button class="btn btn-custom w-100 py-3 rounded-pill fw-bold">Finalizar Pedido</button>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-bag-x display-1 text-muted"></i>
                <h4 class="mt-3">Tu carrito está vacío</h4>
                <p class="text-muted">Explora nuestro catálogo y agrega tus postres favoritos.</p>
                <a href="{{ route('home') }}" class="btn btn-custom rounded-pill mt-2">Ir al Catálogo</a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        // Función auxiliar para recalcular subtotales y total en la pantalla principal
        function actualizarPantallaPrincipalCarrito(cart) {
            let totalGeneral = 0;

            if (Object.keys(cart).length === 0) {
                $('#cart-wrapper').html(`
                    <div class="text-center py-5">
                        <i class="bi bi-bag-x display-1 text-muted"></i>
                        <h4 class="mt-3">Tu carrito está vacío</h4>
                        <p class="text-muted">Explora nuestro catálogo y agrega tus postres favoritos.</p>
                        <a href="{{ route('home') }}" class="btn btn-custom rounded-pill mt-2">Ir al Catálogo</a>
                    </div>
                `);
                return;
            }

            $.each(cart, function(id, item) {
                let subtotal = parseFloat(item.precio) * parseInt(item.cantidad);
                totalGeneral += subtotal;

                $('#subtotal-' + id).text('$' + subtotal.toFixed(2));
            });

            $('#summary-subtotal').text('$' + totalGeneral.toFixed(2) + ' MXN');
            $('#summary-total').text('$' + totalGeneral.toFixed(2) + ' MXN');
        }

        // Actualizar cantidad desde la vista principal del carrito
        $(document).on('change', '.btn-update-cart-main', function() {
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
                success: function(response) {
                    if (response.success) {
                        // Sincronizar desplegable del header y badge
                        renderizarCarritoHeader(response.cart, response.totalItems);
                        // Actualizar totales de la tabla principal
                        actualizarPantallaPrincipalCarrito(response.cart);
                    }
                }
            });
        });

        // Eliminar producto desde la vista principal del carrito
        $(document).on('click', '.btn-remove-cart-main', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let row = $('#cart-row-' + id);

            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        // Sincronizar desplegable del header y badge
                        renderizarCarritoHeader(response.cart, response.totalItems);

                        row.fadeOut(200, function() {
                            $(this).remove();
                            actualizarPantallaPrincipalCarrito(response.cart);
                        });
                    }
                }
            });
        });

    });
</script>
@endsection