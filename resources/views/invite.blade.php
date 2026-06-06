<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitación Especial - Boda H&D</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/mesh.min.css" rel="stylesheet">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center mb-4">
                <h1 class="display-5 fw-bold text-dark">Héctor & Daniela</h1>
                <p class="text-muted lead">¡Nos casamos y queremos que formes parte de este día tan especial!</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card card-wedding p-4 p-md-5 bg-white">
                    <h3 class="mb-4 text-center text-secondary">Confirmación de Asistencia</h3>
                    
                    @livewire('rsvp-form', ['invitado' => $invitado])
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>