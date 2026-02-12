<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progreso | <x-system-name name="Gleeo"></x-system-name>
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
    <link rel="stylesheet" href="{{ asset('css/components/progress.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/level.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <style>


        .welcome__img {
            width: 230px;
        }




        .welcome__content {
            width: clamp(300px, 50%, 600px) !important;
            height: auto !important;

        }


        .ranking__item--i {
            background: {{ $theme->secondary_color ?? ' #ef7440' }}80;
            border-radius: 0.5rem;
        }

    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article container-xl w-100">
               @if (Auth::user()->rol_id == 2)
                <x-aside-admin :items="[
                    [
                        'title' => 'Jugadores',
                        'route' => 'children.index',
                        'icon' => 'bi bi-person-video3',
                    ],
                ]"></x-aside-admin>
            @else
                <x-aside-admin :items="[
                    [
                        'title' => 'Representantes y <br> Profesionales',
                        'route' => 'representative.index',
                        'icon' => 'bi bi-people-fill',
                    ],
                ]"></x-aside-admin>
            @endif
            <div class="col-lg-10 col-12 main__content bg-white-border ">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Gestión de Contenido</a> >
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Plan de Estudio</a> >
                    <span>Agregar Nuevo Nivel</span>
                </small>
                <section class="your-progress mt-2  flex-and-direction-column ">
                    <div class="your-progress__top flex-and-direction-row flex-content-space-between">
                        <section class="your-progress__user-info">
                            <h1 class="fs-2 your-progress__title mb-0">
                                {{ ucfirst($player->user->user) }}
                            </h1>
                            <span class="your-progress__full-name">
                                {{ ucfirst($player->names) }} {{ ucfirst($player->surnames) }}
                            </span>
                            <br>
                            <span class="your-progress_account-registration-date">
                                Fecha de Registro: {{ formatting_date($player->user->created_at) }}
                            </span>
                            <br>
                            <span class="your-progress_account-registration-date">
                                Fecha de Ultima Sesion: {{ formatting_date($player->user->last_session) }}
                            </span>
                        </section>
                        <div class="your-progress__avatar">
                            <figure>
                                <img src="{{ asset('img/avatars/' . $player->avatar->url) }}"
                                    class="profile__avatar--progress img-fluid profile__avatar  " draggable="false"
                                    alt="">
                            </figure>
                        </div>
                    </div>
                    <div
                        class="your-progress__title your-progress__title-orange flex-and-direction-row flex-content-space-between">
                        <h2 class="fs-4"> Progreso General
                        </h2>
                        <span class="you-progress__lessons-completed">
                            <b>{{ $totalNumberLessonsCompleted }}/{{ $totalNumberLessons }} Lecciones</b>
                        </span>
                    </div>
                    <div class="you-progress__content ">
                        <div class="you-progress__content  ">
                            <div class="you-progress__progress-bar level-item mb-0  flex-and-direction-row">
                                <div class="level-item__icon ">
                                    <i
                                        class="bi fs-1
                                        @php
                        if ($percentage_bar == 100) {
                                                    echo 'bi bi-check';
                                            }else{
                                                if($percentage_bar != 0){
                                                    echo 'bi-hourglass-bottom';
                                                }  else{
                                                    echo 'bi-lock-fill';
                                                }
                                            } @endphp
                                        "></i>
                                </div>
                                <div class="flex-grow-2 level-item__content">
                                    <div class="level-item__name">
                                        <b>
                                            Trayectoria: Nivel {{ $min }} al {{ $max }}
                                        </b>
                                    </div>
                                    <div class="progress level-item__progress-fill " role="progressbar"
                                        aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0"
                                        aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated "
                                            style="width: {{ $percentage_bar }}%">
                                        </div>
                                    </div>
                                    <small class="text__gray">
                                        {{ $percentage_bar }}%
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0 you-progress__divider">
                    <section class="you-progress__statistics flex-and-direction-row flex-content-center gap-2 p-2">
                        <div class="row w-100">
                            <div class="col-lg-5 col-12">
                                <section class="topic-stats ">
                                    <div class="chart-controls flex-and-direction-row"
                                        style="gap: 1rem; margin-bottom: 1rem;">
                                        <label class="control-option">
                                            <input type="radio" name="chart-type" value="errores" checked
                                                onchange="switchChart(this.value)">
                                            <span class="custom-radio">Ver Errores</span>
                                        </label>
                                        <label class="control-option">
                                            <input type="radio" name="chart-type" value="puntos"
                                                onchange="switchChart(this.value)">
                                            <span class="custom-radio">Ver Puntos</span>
                                        </label>
                                    </div>
                                    <div style="display:flex; align-items: end;">
                                        <div class="topic-stats__item topic-stats__item--errors">
                                            <span class="topic-stats__title">
                                                <b>
                                                    Curva de Errores por Tema
                                                </b>
                                            </span>
                                            <div class="flex-and-direction-row gap-2 topic-stats__content">
                                                @if ($totalErrorsTopic != [] && $totalPointsObtainedTopic != [])
                                                    <div
                                                        class="topic-stats__numbers flex-and-direction-column flex-content-space-between">
                                                        <span
                                                            class="topic-stats__final-number text__gray"><small>{{ isset($totalErrorsTopic[0]->value) ? $totalErrorsTopic[0]->value : 0 }}</small></span>
                                                        <span
                                                            class="topic-stats__zero-number text__gray"><small>0</small></span>
                                                    </div>
                                                @endif
                                                <div
                                                    class="topic-stats__towers flex-and-direction-row flex-align-items-end gap-3">
                                                    @foreach ($totalErrorsTopic as $index => $error)
                                                        @php
                                                            $ranks = ['red', 'blue', 'orange', 'green'];
                                                            $rank = $ranks[$index] ?? 'other';
                                                        @endphp
                                                        <div
                                                            class="topic-stats__tower topic-stats__tower--{{ $rank }}">
                                                            <span
                                                                class="topic-stats__value text__gray">{{ $error->value }}</span>
                                                            <div class="topic-stats__bar topic-stats__bar--{{ $rank }}"
                                                                title="Error en el tema {{ $error->topic_title }} del módulo {{ $error->module_title }} - del nivel {{ $error->level_title }}">
                                                            </div>
                                                            <span
                                                                class="topic-stats__label text__gray">{{ $error->topic_title }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="topic-stats__item topic-stats__item--points "
                                            style="display: none;">
                                            <span class="topic-stats__title">
                                                <b>
                                                    Curva de Puntos por Tema
                                                </b>
                                            </span>
                                            <div class="flex-and-direction-row gap-2 topic-stats__content">
                                                @if ($totalErrorsTopic != [] && $totalPointsObtainedTopic != [])
                                                    <div
                                                        class="topic-stats__numbers flex-and-direction-column flex-content-space-between">
                                                        <span
                                                            class="topic-stats__final-number text__gray"><small>{{ isset($totalPointsObtainedTopic[0]->value) ? $totalPointsObtainedTopic[0]->value : 0 }}</small></span>
                                                        <span
                                                            class="topic-stats__zero-number text__gray"><small>0</small></span>
                                                    </div>
                                                @endif
                                                <div
                                                    class="topic-stats__towers flex-and-direction-row flex-aligh-items-end gap-3">
                                                    @foreach ($totalPointsObtainedTopic as $index => $error)
                                                        @php
                                                            $ranks = ['purple', 'blue', 'orange', 'green'];
                                                            $rank = $ranks[$index] ?? 'other';
                                                        @endphp
                                                        <div
                                                            class="topic-stats__tower topic-stats__tower--{{ $rank }}">
                                                            <span
                                                                class="topic-stats__value text__gray">{{ $error->value }}</span>
                                                            <div class="topic-stats__bar topic-stats__bar--{{ $rank }}"
                                                                title="Error en el tema {{ $error->topic_title }} del módulo {{ $error->module_title }} - del nivel {{ $error->level_title }}">
                                                            </div>
                                                            <span
                                                                class="topic-stats__label text__gray">{{ $error->topic_title }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            function switchChart(tipo) {
                                                const divControlPption = document.querySelectorAll('.custom-radio');
                                                const divErrores = document.querySelector('.topic-stats__item--errors');
                                                const divPuntos = document.querySelector('.topic-stats__item--points');
                                                console.log('hola' + tipo);
                                                if (tipo === 'errores') {
                                                    divControlPption[0].classList.add('control-option__input--color-red');
                                                    divControlPption[1].classList.remove('control-option__input--color-green');
                                                    divErrores.style.display = 'block';
                                                    divPuntos.style.display = 'none';
                                                } else {
                                                    divControlPption[1].classList.add('control-option__input--color-green');
                                                    divControlPption[0].classList.remove('control-option__input--color-red');
                                                    divErrores.style.display = 'none';
                                                    divPuntos.style.display = 'block';
                                                }
                                            }
                                        </script>
                                    </div>
                                </section>
                            </div>
                            <div class="col-lg-7 col-12">
                                <div class="row mb-3">
                                    <div class="col-6 total-diamonds flex-and-direction-row flex-start-full gap-2">
                                        <div class="total-diamonds__icon  ">
                                            <i class="bi bi-gem fs-1 color__purple"></i>
                                        </div>
                                        <div class="total-diamonds__info flex-and-direction-column flex-center-full">
                                            <span class="total-diamonds__info-value   ">
                                                <b class="fs-5">{{ $totalDiamonds }}</b>
                                            </span>
                                            <span class="total-diamonds__info-title ">
                                                <i>
                                                    @if ($totalDiamonds <= 1)
                                                        Diamante <br> Obtenido
                                                    @else
                                                        Diamantes <br> Obtenidos
                                                    @endif
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="you-progress__lessons-completed flex-and-direction-row flex-start-full gap-2">
                                            <div class="lessons-completed__icon  ">
                                                <i class="bi bi-journal-check fs-1 color__purple"></i>
                                            </div>
                                            <div
                                                class="lessons-completed__info flex-and-direction-column flex-center-full">
                                                <span class="lessons-completed__info-value ">
                                                    <b class="fs-5">{{ $totalNumberLessonsCompleted }}</b>
                                                </span>
                                                <span class="lessons-completed__info-title ">
                                                    <i>
                                                        @if ($totalNumberLessonsCompleted <= 1)
                                                            Lección <br> Completada
                                                        @else
                                                            Lecciones <br> Completadas
                                                        @endif

                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="you-progress__pointer-statistics pointer-statistics flex-and-direction-row flex-content-space-between"
                                    style="flex-wrap:nowrap; " style="gap:1.5rem; justify-content: center;">

                                    <div
                                        class="pointer-statistics__item pointer-statistics__item--success-rate flex-and-direction-column">
                                        <div class="circle-ring"
                                            style="--clr:var(--blue); --percent: {{ $AVGSuccessRate }};">
                                            <div class="circle-inner">
                                                <span class="pointer-statistics__item-title">Éxito Actual</span>
                                                <span
                                                    class="pointer-statistics__item-value fs-2">{{ $AVGSuccessRate }}%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="pointer-statistics__item pointer-statistics__item--errors flex-and-direction-column">
                                        <div class="circle-ring"
                                            style="--clr: var(--red); --percent: {{ $mistakesMade > 0 ? 100 : 0 }};">
                                            <div class="circle-inner">
                                                <span
                                                    class="pointer-statistics__item-title">{{ $mistakesMade <= 1 ? 'Error Actual' : 'Errores Actuales' }}</span>
                                                <span
                                                    class="pointer-statistics__item-value fs-2">{{ $mistakesMade }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="pointer-statistics__item pointer-statistics__item--success flex-and-direction-column">
                                        <div class="circle-ring" style="--clr:var(--green); --percent: 100;">
                                            <div class="circle-inner">
                                                <span
                                                    class="pointer-statistics__item-title">{{ $pointsObtained <= 1 ? 'Acierto Actual' : 'Aciertos Actuales' }}</span>
                                                <span
                                                    class="pointer-statistics__item-value fs-2">{{ $pointsObtained }}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </section>
                    <hr class=" you-progress__divider">

                    <div class="you-progress__button    flex-and-direction-row flex-center-full   w-100">
                        <form action="{{ route('children.progress-reportPDF', $player->slug) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button class="button__color-gray button">Descargar <b>PDF</b></button>
                        </form>
                    </div>
                </section>
            </div>
        </article>
        <script src="{{ asset('js/components/header.js') }}" type="module"></script>
    </main>


    <x-footer name="Gleeo"></x-footer>
    <script src="{{ asset('js/components/header.js') }}" type="module"></script>

</body>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
</body>

</html>
