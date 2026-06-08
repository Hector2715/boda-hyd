<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo - Boda H&D</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                
                <div class="card card-wedding p-4">
                    <div class="text-center mb-4">
                        <h3 class="mb-1">Panel de Control</h3>
                        <p class="text-muted small">Boda Héctor & Daniela</p>
                    </div>

                    <form action="{{ route('admin.login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label text-dark small fw-bold">Correo Electrónico</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-dark small fw-bold">Contraseña</label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label class="form-check-label text-muted small" for="remember">Recordarme en este equipo</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                            Ingresar al Panel
                        </button>
                    </form>
                    <div class="mt-4 pt-3 border-top text-center">
                        <p class="text-muted small mb-2" style="font-family: sans-serif; font-size: 0.85rem;">¿Deseas revisar la vista pública?</p>
                        <a href="{{ url('/') }}" class="btn btn-sm w-100 fw-bold py-2" 
                        style="color: #6b1f38; background-color: #f9f6f0; border: 1.5px solid #6b1f38; border-radius: 20px; font-size: 0.8rem; transition: all 0.3s ease;">
                            ✨ Ir a la Invitación Principal
                        </a>
                   </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>