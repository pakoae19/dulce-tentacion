@extends('layouts.app')

@section('title', 'Crear Cuenta - Dulce Tentación')

@section('styles')
<style>
    .input-group .form-control {
        border-color: #dee2e6;
    }

    .input-group .btn-password-toggle {
        border-color: #dee2e6;
        background-color: #ffffff;
        color: #6c757d;
        transition: all 0.2s ease;
    }

    .input-group .btn-password-toggle:hover {
        background-color: #f8f9fa;
        color: var(--primary-color);
        border-color: #dee2e6;
    }

    .input-group:focus-within .form-control,
    .input-group:focus-within .btn-password-toggle {
        border-color: var(--primary-color);
        box-shadow: none;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-5 d-none d-md-flex flex-column justify-content-between p-4 text-white position-relative" 
                         style="background: linear-gradient(180deg, rgba(107, 45, 77, 0.75) 0%, rgba(0, 0, 0, 0.55) 100%), 
                                     url('{{ asset('assets/recetas/receta' . ($imagenRandom ?? rand(1, 50)) . '.jpg') }}') center/cover no-repeat;">
                        <div class="position-relative" style="z-index: 2; text-shadow: 0 2px 4px rgba(0,0,0,0.6);">
                            <h3 class="fw-bold font-serif mb-2 text-white">Crea tu Cuenta</h3>
                            <p class="small text-white opacity-90">Regístrate para guardar tu dirección, ver el historial de tus pedidos y recibir ofertas exclusivas.</p>
                        </div>
                        <div class="small opacity-90 position-relative text-white" style="z-index: 2; text-shadow: 0 1px 3px rgba(0,0,0,0.8);">
                            © {{ date('Y') }} Dulce Tentación
                        </div>
                    </div>

                    <!-- Formulario de Registro -->
                    <div class="col-md-7 p-4 p-md-5 bg-white">
                        <h2 class="fw-bold h4 mb-1">Registro de Cliente</h2>
                        <p class="text-muted small mb-4">Completa el formulario para registrarte</p>

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small rounded-3">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Nombre Completo</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3" placeholder="Ej. Ana García" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Correo Electrónico</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-3" placeholder="tu@correo.com" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control border-end-0 rounded-start-3" placeholder="Mínimo 6 caracteres" required>
                                    <button class="btn btn-password-toggle border-start-0 rounded-end-3 toggle-password" type="button" data-target="#password">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-end-0 rounded-start-3" placeholder="Repite tu contraseña" required>
                                    <button class="btn btn-password-toggle border-start-0 rounded-end-3 toggle-password" type="button" data-target="#password_confirmation">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-custom w-100 py-2 mb-3">Crear mi Cuenta</button>

                            <div class="text-center">
                                <span class="small text-muted">¿Ya tienes cuenta?</span>
                                <a href="{{ route('login') }}" class="small text-danger fw-bold text-decoration-none ms-1">Inicia sesión</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.toggle-password').click(function() {
            let targetInput = $($(this).data('target'));
            let icon = $(this).find('i');

            if (targetInput.attr('type') === 'password') {
                targetInput.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                targetInput.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });
    });
</script>
@endsection