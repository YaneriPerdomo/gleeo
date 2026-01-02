<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio | <x-system-name name="Gleeo"></x-system-name>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/tutor-settings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/body.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/text.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/study-plan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/ranking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/level.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    @php
        $bodyCSS = '';
        if ($theme->background_path != null) {
            $urlAsset = asset('img/themes/' . $theme->background_path);
            $bodyCSS = "background-image: url('$urlAsset');
                background-repeat: repeat;
                background-attachment: fixed;
                background-size: auto;";
        } else {
            $bodyCSS = "background-color: {$theme->solid_background};";
        }
    @endphp
    <style>
        :root {
            --purple: {{ $theme->main_color ?? '#7052c2' }};
            --orange: {{ $theme->secondary_color ?? '#ef7440' }};
        }


        .welcome__img {
            width: 230px;
        }


        .progress-bar {
            background-color: var(--orange);
        }

        body {
            background: {{ $theme->solid_background }};
        }

        .welcome {
            width: clamp(300px, 50%, 600px) !important;
            height: auto !important;

        }

        .bg-white-border {
            background: none;
            border: none;
        }

        /* Antes: .progress-bar */
        .welcome__progress-bar {
            background-color: var(--orange) !important;
            transition: width 0.4s ease;
            /* Para que el movimiento no sea brusco */
        }

        /* Antes: .welcome__descripcion */
        .welcome__description {
            /* tus estilos aquí */
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header isPlayer="1" img="{{ $player->avatar->url }}" splashScreen="true"></x-header>

    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full">
        <section class="welcome bg-white-border w-100 h-100 flex-and-direction-column flex-center-full">

            <div class="welcome__logo">
                <figure class="welcome__figure">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Gleeo" draggable="false" class="welcome__img">
                </figure>
            </div>

            <div class="welcome__info text__gray">
                <b class="welcome__label">Materia: </b>
                <span class="welcome__subject">{{ $data->subject }}</span>
                <p class="welcome__description">
                    {{ $data->description }}
                </p>
            </div>

            <div class="welcome__progress-container w-100">
                <div class="progress welcome__progress-track" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated welcome__progress-bar"
                        style="width: 0%">
                    </div>
                </div>

                <div class="welcome__percentage-wrapper text_center d-none">
                    <small class="text__gray welcome__percentage-text">0%</small>
                </div>

                <a href="{{ route('educational-platform.index', ['slugCurrentLevel' => $player->level_assigned->slug]) }}"
                    class="welcome__link-hidden"></a>
            </div>

            <script>
                // Encapsulamos en un bloque para evitar colisiones de variables
                (function() {
                    const progressBar = document.querySelector('.welcome__progress-bar');
                    const percentageText = document.querySelector('.welcome__percentage-text');
                    const redirectLink = document.querySelector('.welcome__link-hidden');
                    let count = 0;

                    const interval = setInterval(() => {
                        if (count >= 100) {
                            clearInterval(interval);
                            // Activamos el enlace automáticamente al terminar
                             redirectLink.click();
                        } else {
                            count += 10;
                            progressBar.style.width = `${count}%`;
                            if (percentageText) {
                                percentageText.innerHTML = `${count}%`;
                            }
                        }
                    }, 800);
                })();
            </script>
        </section>
    </main>
        <x-footer name="Gleeo"></x-footer>

</body>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
</body>

</html>
