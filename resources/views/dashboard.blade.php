<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Boda H&D</title>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-uppercase tracking-wide" href="#">
            <img src="{{ asset('images/logo-hyd.jpeg') }}" 
                 alt="Logo Boda H&D" 
                 width="60" 
                 height="60" 
                 class="rounded-circle me-2 border border-2 border-white shadow-sm"
                 style="object-fit: cover;">
            <span class="fw-secondary opacity-75">• Backoffice</span>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="ms-auto">
                @csrf
                <button type="submit" class="btn btn-sm btn-admin-logout py-1 px-3">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-dark fw-bold mb-3">Gestión de Invitaciones</h2>
                @livewire('admin.invitados-index')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>