<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Héctor & Daniela — Nuestra Boda</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Great+Vibes&display=swap" rel="stylesheet">

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="wedding-public-body" style="background: linear-gradient(to bottom, rgba(255,255,255,0) 70%, rgba(249,246,240,1) 100%), radial-gradient(circle at center, rgba(255, 255, 255, 0.2) 0%, rgba(249, 246, 240, 0.8) 85%), url('{{ asset('images/fondo-floral.avif') }}');">
    <header class="section-wedding d-flex flex-column align-items-center justify-content-center min-vh-md-100 py-5">
        
        <img src="{{ asset('images/logo-hyd.jpeg') }}" alt="Logo Héctor & Daniela" class="wedding-logo-cover">

        <div class="mb-1 text-uppercase tracking-widest small text-muted text-center" style="font-family: sans-serif; font-size: 0.75rem; letter-spacing: 0.25em;">
            Invitación a Nuestra Boda
        </div>
        
        <h1 class="serif-title mb-1 text-center">Héctor & Daniela</h1>
        
        <div class="wedding-date-badge">
            19 • Marzo • 2027
        </div>

        <div class="countdown-container animate__animated animate__fadeIn">
            <div class="countdown-box">
                <span class="number" id="days">00</span>
                <span class="label">Días</span>
            </div>
            <div class="countdown-box">
                <span class="number" id="hours">00</span>
                <span class="label">Horas</span>
            </div>
            <div class="countdown-box">
                <span class="number" id="minutes">00</span>
                <span class="label">Min</span>
            </div>
            <div class="countdown-box">
                <span class="number" id="seconds">00</span>
                <span class="label">Seg</span>
            </div>
        </div>

        <div class="w-100 text-center px-3 mt-4" style="max-width: 550px;">
            <p class="style-quote" style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-style: italic; color: #6b1f38; line-height: 1.4;">
                “Hay momentos en la vida que son inolvidables, y compartirlos con quienes más amamos los hace eternos.”
            </p>
        </div>

        <div class="mt-3 mb-2 py-5">
            <a href="#detalles" class="btn btn-view-details">
                ✨ Ver Detalles de la Boda ✨
            </a>
        </div>
    </header>

    <!-- 🌟 NUEVA SECCIÓN: MENSAJE DE BIENVENIDA -->
    <div class="container my-4 px-3" style="max-width: 650px;">
        <div class="wedding-scroll-box">
            <h2 class="serif-title mb-3" style="font-size: 2.2rem; color: #6b1f38;">¡Bienvenidos a Nuestra Boda!</h2>
            <p class="wedding-welcome-text">
                Queridos familiares y amigos, la Biblia nos recuerda que el amor todo lo soporta y nunca falla. Para nosotros es una inmensa alegría contar con su presencia en este día tan significativo, donde uniremos nuestras vidas legalmente y bajo los principios que guían nuestro andar. Su cariño y apoyo son un regalo invaluable. ¡Gracias por acompañarnos a celebrar este nuevo comienzo!
            </p>
            <div class="wedding-scroll-divider">🎕 ──── 🎕</div>
        </div>
    </div>

    <div id="detalles" class="bg-white">
        <section class="container section-wedding py-5">
            <!-- DOS COLUMNAS SIMÉTRICAS: CIVIL Y DISCURSO -->
            <div class="row g-4 justify-content-center text-center">
                
                <!-- 🏛️ COLUMNA 1: MATRIMONIO CIVIL -->
                <div class="col-12 col-md-5 px-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="wedding-icon" style="font-size: 2.5rem;">📜✍️</div>
                        <h3 class="fw-bold text-uppercase tracking-wide mb-2 fs-5 text-dark">Matrimonio Civil</h3>
                        <p class="mb-1 fw-bold fs-5">Hora: 04:00 PM</p>
                        <p class="text-muted small mb-3 mx-auto" style="max-width: 280px;">Lugar del registro civil, sala municipal o dirección informativa aquí</p>
                    </div>
                    <div>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-wedding-location">
                            📍 Ver Ubicación Civil
                        </a>
                    </div>
                </div>

                <!-- SEPARADOR ADAPTATIVO MÓVIL -->
                <div class="col-12 d-md-none">
                    <hr class="w-25 mx-auto my-2" style="color: rgba(197, 137, 109, 0.4);">
                </div>

                <!-- 📖 COLUMNA 2: DISCURSO DE BODA -->
                <div class="col-12 col-md-5 px-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="wedding-icon" style="font-size: 2.5rem;">📖✨</div>
                        <h3 class="fw-bold text-uppercase tracking-wide mb-2 fs-5 text-dark">Discurso de Boda</h3>
                        <p class="mb-1 fw-bold fs-5">Hora: 06:00 PM</p>
                        <p class="text-muted small mb-3 mx-auto" style="max-width: 280px;">Salón del Reino de los Testigos de Jehová</p>
                    </div>
                    <div>
                        <a href="https://maps.app.goo.gl/qUQmdC16VokMAfhS8?g_st=aw" target="_blank" class="btn btn-wedding-location">
                            📍 Ver Ubicación Discurso
                        </a>
                    </div>
                </div>

            </div>

            <!-- BLOQUE INFERIOR: TEXTO BÍBLICO DE ANCLA -->
            <div class="row justify-content-center text-center mt-5">
                <div class="col-11 col-md-8">
                    <div class="p-3 bg-light rounded-3 mx-auto shadow-sm" style="max-width: 480px; border-left: 3px solid #6b1f38;">
                        <p class="mb-1 small text-dark fw-bold" style="font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; font-style: italic; line-height: 1.4;">
                            Por lo tanto, lo que Dios ha unido, que no lo separe ningún hombre”.
                        </p>
                        <span class="text-muted d-block text-end" style="font-family: sans-serif; font-size: 0.75rem;">— Marcos 10:9</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="section-wedding bg-light py-5">
        <div class="container px-3">
            <div class="wedding-icon">👗👔</div>
            <h3 class="fw-bold text-uppercase tracking-wide mb-2 fs-5">Código de Vestimenta</h3>
            <p class="fs-2 text-muted mb-1">Formal / Traje de Gala</p>
            <small class="text-secondary d-block mt-2" style="font-family: sans-serif; font-size: 0.8rem; font-style: italic;">
                * Reservamos amablemente el color blanco de forma exclusiva para la novia.
            </small>
        </div>
    </section>

    <section class="section-wedding py-5">
        <div class="container px-3">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <div class="card card-wedding-public text-start shadow-sm border-0">
                        <div class="text-center mb-4">
                            <div class="wedding-icon m-0">💌</div>
                            <h3 class="fw-bold text-uppercase tracking-wide mt-2 mb-1 fs-5">Confirmar Asistencia</h3>
                            <p class="text-muted small" style="font-family: sans-serif;">Por favor, indícanos tus datos a continuación.</p>
                        </div>
                        
                        <div class="px-1">
                            @livewire('rsvp-form', ['invitado' => $invitado])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const targetDate = new Date('March 19, 2027 16:00:00').getTime();

            function updateCountdown() {
                const now = new Date().getTime();
                const difference = targetDate - now;

                if (difference <= 0) {
                    document.querySelector('.countdown-container').innerHTML = "<b style='font-family:sans-serif; color:#c5896d;'>¡Llegó el Gran Día! 🎉</b>";
                    return;
                }

                const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                document.getElementById('days').innerText = days < 10 ? '0' + days : days;
                document.getElementById('hours').innerText = hours < 10 ? '0' + hours : hours;
                document.getElementById('minutes').innerText = minutes < 10 ? '0' + minutes : minutes;
                document.getElementById('seconds').innerText = seconds < 10 ? '0' + seconds : seconds;
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    </script>

    @livewireScripts
</body>
</html>