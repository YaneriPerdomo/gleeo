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
    <link rel="stylesheet" href="{{ asset('css/components/lesson-modal.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


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

        .ranking__item--i {
            background: {{ $theme->secondary_color ?? ' #ef7440' }}80;
            border-radius: 0.5rem;
        }


        .bg-white-border {
            background: {{ $theme->topic_color ?? 'white' }} !important;
        }

        body {
            {!! $bodyCSS !!}
        }



        .ranking__header--the-best {
            background: none;
        }

        .level-item {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 8px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .progress {
            background: var(--gray);
            height: 10px;
        }

        .level-item__icon {
            color: var(--purple);
        }

        .level-item--active {}

        .level-item--locked {}

        .level-item__progress-bar {}

        .level-item__progress-fill {}

        [data-link-deactivated="true"] {
            pointer-events: none;
            cursor: default;
            opacity: 0.5;
            text-decoration: none;
            color: inherit;
        }

        .level-item--current {
            border: solid var(--purple) 2px;
            margin-top: 0.5rem;
            filter: drop-shadow(1px 1px 0px var(--purple));
            background: white;
        }

        .progress-bar {
            background-color: var(--orange);
        }


        @media screen and (max-width: 992px) {
            .my-levels {
                height: 200px !important;
                margin-bottom: 1rem !important;
            }
        }

        .my-levels {
            overflow-x: hidden;
        }

        .lesson__button {
            border: none;
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header isPlayer="1" img="{{ $player->avatar->url }}"></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article     w-100">
            <div class="col-12 col-lg-3 bg-white-border my-levels">
                <aside class="sidebar-levels">
                    <div class="sidebar-levels__header">
                        <h2 class="sidebar-levels__title fs-4">
                            <b>
                                <i class="bi bi-play-fill"></i>
                                Mis Niveles</b>
                        </h2>
                    </div>
                    <nav class="sidebar-levels__nav">
                        @forelse ($levels as  $key =>  $level)
                            <a href="{{ route('educational-platform.index', ['slugCurrentLevel' => $level->slug]) }}"
                                data-key = "{{ $key }}"
                                data-link-deactivated="{{ $level->progress->state == 'Completado' || $level->progress->state == 'En Progreso' ? 'false' : 'true' }}"
                                class="level-item level-item-link  flex-and-direction-row {{ $level->level_id === $currentLevel->level_id ? 'level-item--current' : '' }}">
                                <div class="level-item__icon">
                                    <i
                                        class="bi fs-1
                                        @php
if ($level->progress->state == 'Completado') { //ENUM ['Bloqueado','Completado', 'En Progreso']
                                                                //Completado
                                                                echo 'bi bi-check';
                                                            }else{
                                                                //Bloqueado
                                                                if($level->progress->state == 'En Progreso'){
                                                                    echo 'bi-hourglass-bottom';
                                                                }  else{
                                                                    echo 'bi-lock-fill';
                                                                }
                                                            } @endphp
                                                    "></i>
                                </div><!---    border: solid var(--purple) 2px;
                    filter: drop-shadow(1px 1px 6px black);
                    background: white;-->
                                <div class="level-item__content flex-grow-2">
                                    <span class="level-item__name">
                                        <b>
                                            Nivel {{ $level->number }} -
                                            {{ $level->name }}
                                        </b>
                                    </span>
                                    <div class="level-item__progress-bar">
                                        <div class="progress level-item__progress-fill" role="progressbar"
                                            aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                style="width: {{ $level->progress->percentage_bar ?? '' }}%">

                                            </div>
                                        </div>
                                        <small class="text__gray">
                                            {{ $level->progress->percentage_bar ?? '2' }}%
                                        </small>
                                    </div>
                                </div>
                            </a>

                        @empty
                            NO HAY NIVELES
                        @endforelse
                        <!--level-item--locked--->
                    </nav>

                </aside>
            </div>
            <div class="col-6 bg-white-border main__content">



                <div class="mt-2">
                    @forelse ($CurrentModules->items() as $module)
                        <section class="study-plan">
                            <div class="study-plan__module flex-and-direction-row flex-content-space-between">
                                <b class="study-plan__module-title">
                                    Módulo {{ $loop->iteration ?? '' }}: {{ $module->title }}
                                </b>
                            </div>
                            @forelse ($module->topics ?? [] as $topic)
                                <div class="study-plan__topic flex-and-direction-row flex-content-space-between">
                                    <div class="study-plan__topic-info">
                                        <b>Tema {{ $loop->iteration ?? '' }}: {{ $topic->title ?? 'NADA' }}</b>
                                    </div>
                                </div>
                                <div class="flex-and-direction-row ">
                                    @forelse ($topic->lessons as $key => $lesson)
                                        <button data-key="{{ $key }}" data-bs-toggle="modal"
                                            data-lesson-slug = "{{ $lesson->slug }}" data-name="{{ $lesson->title }}"
                                            data-route="{{ route('player.gaming-experience', [
                                                'level' => $slugCurrentLevel,
                                                'module' => $module->slug,
                                                'topic' => $topic->slug,
                                                'lesson' => $lesson->slug,
                                            ]) }}"
                                            class="flex-center-full flex-and-direction-column lesson__button  px-4 my-3 px-4 my-3"
                                            data-bs-target="#inforlessonModal">
                                            <div class="level-card__circle">
                                                <i class="bi bi-check fs-1"></i>
                                            </div>
                                            <div class="level-card__title">
                                                <i class="text__gray">{{ $lesson->title }}</i>
                                            </div>
                                        </button>
                                    @empty
                                        NO HAY LECCIONES
                                    @endforelse

                                </div>
                            @empty
                                NO HAY TEMAS
                            @endforelse
                        </section>
                    @empty
                        <p>No hay módulos registrados.</p>
                    @endforelse


                </div>
            </div>
            <div class="col-3 bg-white-border">
                <section class="ranking">
                    <div class="ranking__header">
                        <h2 class="ranking__title fs-4">
                            <i class="bi bi-award-fill"></i>
                            <b>Ranking Global</b>
                        </h2>
                    </div>

                    <div class="ranking__body">
                        <div class="ranking__i mt-3">
                            <div
                                class="ranking__item ranking__item--i flex-and-direction-row flex-content-space-between ranking__item--highlight">
                                <div class="ranking__user-info">
                                    <img src="{{ asset('img/avatars/' . $player->avatar->url) }}" alt="Avatar"
                                        class="ranking__avatar " draggable="false">
                                    <span class="ranking__username">{{ $player->user->user }}</span>
                                </div>
                                <span class="ranking__score"><b>{{ $player->diamonds ?? 0 }} <i
                                            class="bi bi-gem"></i></b></span>
                            </div>
                        </div>
                        <br>

                        <div class="ranking__the-best mt-2">
                            <div
                                class="ranking__header ranking__header--the-best ranking__top flex-and-direction-row flex-center-full">
                                <div class=" ranking__number ranking__number-two">
                                    <span class="fs-2">2</span>
                                </div>
                                <div class=" ranking__number ranking__number-one">
                                    <span class="fs-1">1</span>
                                </div>
                                <div class=" ranking__number ranking__number-then">
                                    <span class="fs-3">3</span>
                                </div>
                            </div>

                            <div class="ranking__body">
                                @forelse ($bestRanking as $theBest)
                                    <div
                                        class="rankink__item ranking__item--i mt-2 flex-and-direction-row flex-content-space-between {{ $theBest->player->player_id == $player->player_id ? 'ranking__item--highlight' : '' }}">
                                        <div class="ranking__user-info">
                                            <img src="{{ asset('img/avatars/' . $theBest->player->avatar->url) }}"
                                                alt="Avatar" class="ranking__avatar" draggable="false">
                                            <span class="ranking__username">{{ $theBest->player->user->user }}</span>
                                        </div>
                                        <span class="ranking__score"><b>{{ $theBest->diamonds }} <i
                                                    class="bi bi-gem"></i></b></span>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </article>
        <script src="{{ asset('js/components/header.js') }}" type="module"></script>
    </main>
    <x-footer name="Gleeo"></x-footer>
    <div class="modal fade level-modal" id="inforlessonModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="levelModalTitle" aria-hidden="true">
        <div class="modal-dialog level-modal__dialog">
            <div class="modal-content level-modal__content">
                <div class="modal-header level-modal__header bg__color-purple text-white">
                    <h1 class="modal-title level-modal__title fs-5  " id="levelModalTitle">
                        <i class="bi bi-rocket-takeoff-fill"></i> <b>Detalles del Desafío</b>
                    </h1>
                    <button type="button" class="btn-close level-modal__close text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body lesson-modal__body">
                    <div class="lesson-modal__header text-center mb-4">
                        <h2 class="lesson-modal__title fs-4 p-0 m-0 text__black"></h2>
                        <p class="lesson-modal__description"></p>
                    </div>
                    <section class="lesson-stats">
                        <div
                            class="lesson-stats__item lesson-stats__item--highlight flex-and-direction-row flex-content-space-between flex-center-vertical">
                            <div class="lesson-stats__group flex-and-direction-row flex-center-vertical flex-gap-1">
                                <i class="bi bi-gem lesson-stats__icon lesson-stats__icon--diamond fs-2"></i>
                                <div class="lesson-stats__text">
                                    <span class="lesson-stats__label text__gray"><b>Recompensa</b></span>
                                    <div class="lesson-stats__value-container">
                                        <span class="lesson-stats__value">+50</span>
                                        <span class="lesson-stats__unit">Diamantes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="lesson-stats__badge">EPICO</div>
                        </div>
                        <div class="lesson-stats__grid flex-and-direction-row flex-center-full flex-gap-1 mt-3">
                            <div class="lesson-stats__item lesson-stats__item--secondary">
                                <i class="bi bi-speedometer2 lesson-stats__icon lesson-stats__icon--time fs-2"></i>
                                <div class="lesson-stats__text">
                                    <span class="lesson-stats__label text__gray"><b>Tiempo estimado</b></span>
                                    <div class="lesson-stats__value-container">
                                        <span class="lesson-stats__value">1:22</span>
                                        <span class="lesson-stats__unit">min</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Elemento: Tasa de éxito -->
                            <div class="lesson-stats__item lesson-stats__item--secondary">
                                <i
                                    class="bi bi-rocket-takeoff-fill lesson-stats__icon lesson-stats__icon--success fs-2"></i>
                                <div class="lesson-stats__text">
                                    <span class="lesson-stats__label text__gray"><b>Tasa de Éxito</b></span>
                                    <div class="lesson-stats__value-container">
                                        <span class="lesson-stats__value">40%</span>
                                        <span class="lesson-stats__unit">Global</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
                <div class="modal-footer level-modal__footer flex-and-direction-row flex-content-space-between">
                    <button type="button" class="button button--secondary text__gray" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button style="border: none">
                        <b>
                            <a href="" class="button button__color-black lesson-modal__link-play">
                                ¡JUGAR AHORA!
                            </a>
                        </b>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade skip-previous-lessons-modal" id="inforSkipPreviousLessonsModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="skip-previous-lessonsModalTitle"
        aria-hidden="true">
        <div class="modal-dialog skip-previous-lessons-modal__dialog">
            <div class="modal-content skip-previous-lessons-modal__content">
                <div class="modal-header skip-previous-lessons-modal__header bg__color-purple text-white">
                    <h1 class="modal-title skip-previous-lessons-modal__title fs-5  "
                        id="skip-previous-lessonsModalTitle">
                         <b>Omitir lecciones anteriores</b>
                    </h1>
                    <button type="button" class="btn-close skip-previous-lessons-modal__close text-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body lesson-modal__body">
                    <div class="skip-previous-lessons-modal__content">
                        <p>Para asegurarte de que tienes los conocimientos necesarios para este nivel, es importante que
                            completes una prueba. Esta prueba consiste en seleccionar un fragmento de la última
                            selección de cada nivel antes de continuar. Esto te garantizará una base sólida y te
                            permitirá aprovechar al máximo el contenido futuro.</p>
                        <small>
                            Si cree que esto es un error, comuníquese con su adulto para una evaluación.
                        </small>
                    </div>
                </div>
                <div
                    class="modal-footer skip-previous-lessons-modal__footer flex-and-direction-row flex-content-space-between">
                    <button type="button" class="button button--secondary text__gray" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button style="border: none">
                        <b>
                            <a href="" class="button button__color-black lesson-modal__link-play">
                                ¡JUGAR LA PRUEBA AHORA!
                            </a>
                        </b>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', e => {
            const trigger = e.target.closest('[data-bs-target="#inforlessonModal"]');
            if (trigger) {
                const linkPlay = document.querySelector('.lesson-modal__link-play');
                const lessonModalName = document.querySelector('.lesson-modal__title');
                const lessonName = trigger.dataset.name;
                const lessonRoute = trigger.dataset.route;
                console.info('Cargando lección:', lessonName);
                if (lessonModalName) {
                    lessonModalName.textContent = lessonName || 'Lección sin nombre';
                }
                if (linkPlay) {
                    linkPlay.href = lessonRoute || '#';
                }
                console.info('Ruta asignada:', linkPlay ? linkPlay.href : 'No encontrada');
            }
        });



        let levelItemLinks = document.querySelectorAll('.level-item-link');
        let allLevel = @js($levels);
        console.info(allLevel);
        document.addEventListener('click', e => {
            let trigger = e.target.closest('.level-item-link');
            if (trigger) {
                let key = trigger.getAttribute('data-key');
                //desactivar el link
                e.preventDefault();
                let level = allLevel[key]['level_id'];
                console.info('id Nivel:', level);
                getData(level) ?
                    window.location.href = trigger.href :
                    console.warn('Nivel bloqueado');
            }
        })

        async function getData(levelID) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = `../current-level-by-the-player/${levelID}`;
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        'Accept': 'application/json',
                    },
                });
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                const result = await response.json();
                console.log(result);
            } catch (error) {
                console.error(error.message);
            }
        }
    </script>

</body>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
</body>
<script>
    let player = @js(Auth::user()->player->validated);
    console.info('El jugador requiere validacion para omitir niveles anteriores:', player ? 'SI' : 'NO');
    //inforSkipPreviousLessonsModal
    if (player) {
        let skipPreviousLessonsModal = new bootstrap.Modal(document.getElementById('inforSkipPreviousLessonsModal'));
        skipPreviousLessonsModal.show();
    }
</script>

</html>
