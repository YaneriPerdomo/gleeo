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
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    <style>
        .border-bottom-black {
            border-bottom: solid 2px var(--black);
        }

        .msg__title {
            background: var(--blue);
            padding: 0.5rem;
            color: white;
            border-radius: 1rem 1rem 0rem 0rem;
        }

        .msg_paragraph {
            margin-block: 0.5rem;
        }

        .rapid-actions__title {
            padding: 0.5rem;
            border-bottom: solid var(--purple) 2px;
        }


        .rapid-actions__subtitle {}

        .rapid-actions__card {
            gap: 0.3rem;
            cursor: pointer;
            /*  border-left: solid var(--green) 2px;*/
            padding-left: 0.5rem;
            flex-basis: 400px;

        }

        .rapid-actions__content {
            flex-wrap: wrap;

        }

        .rapid-actions__card:hover {
            transition: 0.5s ease-in;
            filter: invert(30%);
            transform: rotateY(-5deg);
            padding: 1rem;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">

    <x-header notificationIsActiveCount="{{ $notificationIsActiveCount }}"></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article   container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Inicio',
                    'route' => 'initial-decision-patterns.index',
                    'icon' => 'bi bi-house-door-fill',
                ],
                [
                    'title' => 'Ayuda y Soporte',
                    'route' => 'initial-decision-patterns.index',
                    'icon' => 'bi bi-question-circle-fill',
                ],
            ]"></x-aside-admin>
            <div class=" col-lg-10 col-12 bg-white-border main__content">
                <div class="row ">
                    <div class="col-6 welcome ">
                        <small class="text__gray">
                            <a href="{{ route('initial-decision-patterns.index') }}" class="text__gray">Inicio > </a>
                            <a href="{{ route('alert-thresholds.index') }}" class="text__gray">
                                @php
                                    if (Auth::user()->rol_id == 1) {
                                        echo 'Bienvenido-a';
                                    } else {
                                        if (Auth::user()->representative->gender_id == 1) {
                                            echo 'Bienvenido';
                                        } else {
                                            echo 'Bienvenida';
                                        }
                                    }
                                @endphp </a>
                        </small>
                        <h1 class="fs-2">
                            <span class="">
                                <div class="">
                                    <b>
                                        <span class="note ">
                                        </span>
                                        <span class="text__purple">{{ ucfirst(Auth::user()->user) }}</span>!
                                    </b>
                                </div>

                                <script>
                                    async function addNoteHTML(label) {
                                        let text = '¡';
                                        let date = new Date();
                                        if (date.getHours() >= 0 && date.getHours() <= 12) {
                                            text = 'Buenos dias,'
                                        }
                                        if (date.getHours() >= 12 && date.getHours() <= 18) {
                                            text = 'Buenas tardes,'
                                        }
                                        if (date.getHours() >= 18 && date.getHours() <= 24) {
                                            text = 'Buenas noches, '
                                        }
                                        return label.innerHTML = '¡' + text;
                                    }
                                    let formHeaderNote = document.querySelector('.note');
                                    console.info(addNoteHTML(formHeaderNote))
                                </script>
                            </span>
                        </h1>

                        <div class="msg text__gray">

                            <div class="msg_paragraph">
                                @php
                                    if (Auth::user()->rol_id == 1) {
                                        echo 'Bienvenido-a';
                                    } else {
                                        if (Auth::user()->representative->gender_id == 1) {
                                            echo 'Bienvenido';
                                        } else {
                                            echo 'Bienvenida';
                                        }
                                    }
                                @endphp al panel central de Gleeo, el Sistema Educativo con Tutor
                                Inteligente
                                (STI) basado en reglas. Tu rol es clave para mantener la precisión y eficiencia
                                pedagógica.
                            </div>
                        </div>

                    </div>
                    <div class="col-6 flex-center-full flex-and-direction-column">
                        <figure style="margin:0rem;">
                            <img src="{{ asset('img/logo.png') }}" draggable="false" class="img-fluid"
                                style="height: 140px;" alt="">
                        </figure>
                    </div>
                </div>
                <div class="rapid-actions ">
                    <div class="rapid-actions__title text__purple fs-4"><b>
                            <i class="bi bi-lightning-charge-fill"></i>
                            Acciones Rápidas y Configuración </b> </div>
                    <div class="rapid-actions__content flex-and-direction-row py-2" style="gap:1rem">
                        @if (Auth::user()->rol_id == 1)
                            <a href="{{ route('initial-decision-patterns.index') }}">
                                <div class="rapid-actions__card flex-and-direction-column  ">
                                    <i class="bi bi-gear-wide-connected text__blue fs-1"></i>
                                    <span class="rapid-actions__subtitle"><b>Patrones de Decisión</b></span>
                                    <p class="text__gray">
                                        Define la lógica de intervención <br> requeridad y las reglas del STI.
                                    </p>
                                </div>
                            </a>
                            <a href="{{ route('alert-thresholds.index') }}">
                                <div class="rapid-actions__card flex-and-direction-column   ">
                                    <i class="bi bi-bell-fill fs-1 text__red"></i>
                                    <span class="rapid-actions__subtitle fs-5"><b>Umbrales de Alerta</b></span>
                                    <p class="text__gray">
                                        Establece los límites para activar <br> las alertas de refuerzo.
                                    </p>
                                </div>
                            </a>
                            <a href="{{ route('study-plan.index') }}">
                                <div class="rapid-actions__card flex-and-direction-column  ">
                                    <i class="bi bi-journals fs-1 text__green"></i>
                                    <span class="rapid-actions__subtitle"><b> Gestión de Contenido</b></span>
                                    <p class="text__gray">
                                        Carga, organiza y clasifica los materiales de aprendizaje.
                                    </p>
                                </div>
                            </a>
                            <a href="{{ route('representative.index') }}">
                                <div class="rapid-actions__card flex-and-direction-column  ">
                                    <i class="bi bi-people-fill fs-1 text__gold"></i>
                                    <span class="rapid-actions__subtitle"><b>
                                            Gestión de Cuentas</b></span>
                                    <p class="text__gray">
                                        Administra estudiantes, profesores y sus roles/permisos.
                                    </p>
                                </div>
                            </a>
                        @endif
                        @if (Auth::user()->rol_id == 2)
                            <div class="rapid-actions__card flex-and-direction-column">
                                <i class="bi bi-person-video3 fs-1 text__gold"></i>
                                <span class="rapid-actions__subtitle"><b>
                                        Gestión de Cuentas de Jugadores</b></span>
                                <p class="text__gray">
                                    Administra las cuentas de los niños y consulta el historial de decisiones del
                                    tutor para cada uno.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </article>
        <script src="{{ asset('js/components/header.js') }}" type="module"></script>
    </main>
    <x-footer name="Gleeo"></x-footer>
</body>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
</body>

</html>
