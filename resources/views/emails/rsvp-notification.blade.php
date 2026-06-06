<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', Helvetica, Arial, sans-serif; background-color: #fdfbf7; margin: 0; padding: 20px; color: #3a3530; }
        .email-container { max-width: 600px; background: #ffffff; margin: 0 auto; border-radius: 12px; border: 1px solid #eaddd7; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.02); }
        .header { background-color: #c97d60; padding: 30px; text-align: center; color: #ffffff; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 600; letter-spacing: 1px; }
        .content { padding: 30px; line-height: 1.6; }
        .status-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-weight: bold; font-size: 14px; margin-bottom: 20px; }
        .badge-success { background-color: #e2f0d9; color: #385723; }
        .badge-danger { background-color: #fce4d6; color: #c65911; }
        .info-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .info-table td { padding: 10px; border-bottom: 1px solid #f2ece9; }
        .info-table td.label { font-weight: bold; color: #8c827a; width: 40%; }
        .quote-box { background-color: #fdfbf7; border-left: 4px solid #c97d60; padding: 15px; margin-top: 20px; font-style: italic; border-radius: 0 8px 8px 0; }
        .footer { background-color: #fdfbf7; text-align: center; padding: 15px; font-size: 12px; color: #8c827a; border-top: 1px solid #f2ece9; }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="header">
            <h1>Nueva Respuesta RSVP</h1>
            <p style="margin: 5px 0 0 0; opacity: 0.9;">Control de Asistencia - Boda H&D</p>
        </div>

        <div class="content">
            <p>Hola Héctor y Daniela,</p>
            <p>Se ha registrado una nueva actualización en los pases de la invitación web:</p>

            @if($invitado->asistira)
                <div class="status-badge badge-success">✓ ¡Sí, asistirá!</div>
            @else
                <div class="status-badge badge-danger">✗ Lamentablemente no asistirá</div>
            @endif

            <table class="info-table">
                <tr>
                    <td class="label">Familia / Invitado:</td>
                    <td><strong>{{ $invitado->nombre_familia }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Pases Confirmados:</td>
                    <td><strong>{{ $invitado->cupos_confirmados }}</strong> de {{ $invitado->cupos_max }} pases</td>
                </tr>
                <tr>
                    <td class="label">Fecha de Respuesta:</td>
                    <td>{{ $invitado->confirmado_el->format('d/m/Y h:i A') }}</td>
                </tr>
            </table>

            @if($invitado->mensaje_novios)
                <div style="margin-top: 25px; font-weight: bold; color: #c97d60;">Mensaje enviado:</div>
                <div class="quote-box">
                    "{{ $invitado->mensaje_novios }}"
                </div>
            @endif
        </div>

        <div class="footer">
            Sistema de Invitaciones Automatizado por Zenith Support
        </div>
    </div>

</body>
</html>