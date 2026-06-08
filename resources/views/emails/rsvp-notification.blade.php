<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; background-color: #f9f6f0; color: #202b3d; padding: 20px; }
        .card { background-color: #ffffff; border-radius: 8px; padding: 25px; max-width: 500px; margin: 0 auto; border: 1px solid #c5896d; }
        h2 { color: #6b1f38; margin-top: 0; }
        .info { margin-bottom: 15px; font-size: 14px; }
        .bold { font-weight: bold; color: #202b3d; }
    </style>
</head>
<body>
    <div class=\"card\">
        <h2>✨ ¡Nueva asistencia confirmada!</h2>
        <p>Se ha registrado un nuevo grupo familiar desde la invitación web:</p>
        <hr style="border-color: #f9f6f0;">
        
        <div class="info"><span class="bold">Familia:</span> {{ $invitado->nombre_familia }}</div>
        <div class="info"><span class="bold">Lugares ocupados:</span> {{ $invitado->cupos_confirmados }} personas</div>
        <div class="info"><span class="bold">Quiénes asisten:</span> {{ $invitado->nombres_asistentes }}</div>
        
        @if($invitado->mensaje_novios)
            <div class="info"><span class="bold">Mensaje para los novios:</span> "<i>{{ $invitado->mensaje_novios }}</i>"</div>
        @endif
    </div>
</body>
</html>