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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

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

        .ranking__item--me {
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
            border: solid var(--orange) 2px;
            margin-top: 0.5rem;
            filter: drop-shadow(1px 1px 0px var(--orange));
            background: white;
        }

        .progress-bar {
            background-color: var(--purple);
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

        .level-item--current-icon {
            color: var(--orange);
        }

        .level-item--current-prograss-bar {
            background-color: var(--orange);
        }

        [ data-state="Completada"] {
            outline: solid var(--purple) 5px;
            background: var(--purple);
        }

        [ data-state="En Espera"] {
            outline: solid var(--orange) 5px;
            background: var(--orange);
        }

        [ data-state="Bloqueada"] {
            background:
                color-mix(in srgb, var(--purple), gray 80%);
            outline: solid 5px color-mix(in srgb, var(--purple), gray 80%);
        }


        body {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
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
                                <div class="level-item__icon {{ $level->progress->state }}">
                                    <i
                                        class="bi fs-1
                                        {{ $level->level_id === $currentLevel->level_id ? 'level-item--current-icon' : '' }}
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
                                </div>
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
                                            <div class="progress-bar progress-bar-striped progress-bar-animated {{ $level->level_id === $currentLevel->level_id ? 'level-item--current-prograss-bar' : '' }}"
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
                    @forelse ($CurrentModules->items() as $keyModule =>  $module)
                        <section class="study-plan">
                            <div class="study-plan__module flex-and-direction-row flex-content-space-between">
                                <b class="study-plan__module-title">
                                    Módulo {{ $loop->iteration ?? '' }}: {{ $module->title }}
                                </b>
                            </div>
                            @forelse ($module->topics ?? [] as $keyTopic =>  $topic)
                                <div class="study-plan__topic flex-and-direction-row flex-content-space-between">
                                    <div class="study-plan__topic-info">
                                        <b>Tema {{ $loop->iteration ?? '' }}: {{ $topic->title ?? 'NADA' }}</b>
                                    </div>
                                </div>
                                <div class="flex-and-direction-row ">
                                    @forelse ($topic->lessons as $keyLesson => $lesson)
                                        <button
                                            data-key="{{ $keyModule }}, {{ $keyTopic }}, {{ $keyLesson }}"
                                            data-open-modal-window="{{ $lesson->playerProgress->state == 'Bloqueada' ? 'False' : 'True' }}"
                                            class="flex-center-full flex-and-direction-column lesson__button  px-4 my-3 px-4 my-3"
                                            @if ($lesson->playerProgress->state != 'Bloqueada') data-bs-target="#inforlessonModal"
                                                data-bs-toggle="modal"
                                                data-lesson-slug = "{{ $lesson->slug }}"
                                                data-name="{{ $lesson->title }}"
                                                data-route="{{ route('player.gaming-experience', [
                                                    'level' => $slugCurrentLevel,
                                                    'module' => $module->slug,
                                                    'topic' => $topic->slug,
                                                    'lesson' => $lesson->slug,
                                                ]) }}" @endif>
                                            <div class="level-card__circle"
                                                data-state="{{ $lesson->playerProgress->state }}">
                                                <i
                                                    class="bi
                                                    @php
$stateIconLesson = $lesson->playerProgress->state;
                                                        switch ($stateIconLesson) {
                                                            case 'Completada':
                                                                echo 'bi-check';
                                                            break;
                                                            case 'En Espera':
                                                                //Un reloj de arena
                                                                echo 'bi-hourglass-split';
                                                            break;
                                                            case 'Bloqueada':
                                                                echo 'bi-lock-fill';
                                                            break;
                                                            default:
                                                                echo 'bi-lock-fill';
                                                            break;
                                                        } @endphp
                                                bi-check fs-1"></i>
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
                                class="ranking__item ranking__item--me flex-and-direction-row flex-content-space-between ranking__item--highlight">
                                <div class="ranking__user-info">
                                    <img src="{{ asset('img/avatars/' . $player->avatar->url) }}" alt="Avatar"
                                        class="ranking__avatar " draggable="false">
                                    <span class="ranking__username">{{ $player->user->user }}</span>
                                </div>
                                <span class="ranking__score"><b>{{ $progress->diamonds ?? 0 }} <i
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
                                <div
                                    class=" ranking__number ranking__number-one
                                    {{ $bestRanking[0]->player->player_id == $player->player_id ? 'ranking__number-one-me' : '' }}">
                                    <span class="fs-1">1</span>
                                </div>
                                <div class=" ranking__number ranking__number-then">
                                    <span class="fs-3">3</span>
                                </div>
                            </div>

                            <div class="ranking__body">
                                @forelse ($bestRanking as $key =>  $theBest)
                                    <div data-key="{{ $key + 1 }}"
                                        class="rankink__item   mt-2 flex-and-direction-row flex-content-space-between
                                                {{ $theBest->player->player_id == $player->player_id ? 'ranking__item--highlight ranking__item--me' : 'ranking__item--other' }}">
                                        <div class="ranking__user-info">
                                            <img src="{{ asset('img/avatars/' . $theBest->player->avatar->url) }}"
                                                alt="Avatar"
                                                class="ranking__avatar {{ $theBest->player->player_id != $player->player_id ? 'ranking__avatar--player-other' : '' }}"
                                                draggable="false">
                                            <span
                                                class="ranking__username {{ $theBest->player->player_id != $player->player_id ? 'ranking__username--player-other' : '' }}  ">{{ $theBest->player->user->user }}</span>
                                        </div>
                                        <span
                                            class="ranking__score  {{ $theBest->player->player_id != $player->player_id ? 'ranking__score--player-other' : 'ranking__score--player-me' }}  "><b>{{ $theBest->diamonds }}
                                                <i class="bi bi-gem"></i></b></span>
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
                            <div class="lesson-stats__badge lesson-stats__motivational-message text-center">EPICO</div>
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



</body>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
</body>
<script>
    let levelUnlocked = @js($levelUnlocked);
    if (levelUnlocked.state == true) {
        console.info(levelUnlocked);
        alert('Felicitaciones! Has desbloqueado un nuevo nivel.');
        window.location.href = `/niveles/${levelUnlocked.levelSlug}`;
    }

    let allLevel = @js($levels);
    let $allModule = @js($CurrentModules->items());

    function getTimeUnit(timeText) {
        let parts = timeText.split(':');

        if (parts.length !== 3) return "Formato inválido";
        const [hour, minute, second] = parts;
        if (hour != '00') {
            return hour == '01' ? 'hor' : 'hors';
        }
        if (minute != '00') {
            return 'min';
        }
        if (second != '00') {
            return 'seg';
        }
    }
    console.info('Todos los modulos:', $allModule);
    document.addEventListener('click', e => {
        const trigger = e.target.closest('[data-bs-target="#inforlessonModal"]');
        if (trigger) {
            if (trigger.dataset.openModalWindow === 'False') {
                alert('La leccion esta bloqueada.');
                return console.info(trigger);
            }
            // indexes to access the lesson
            const indexes = trigger.dataset.key.split(',');
            let lessonStatsValueModal = document.querySelectorAll('.lesson-stats__value');
            let lessonStatsUnit = document.querySelectorAll('.lesson-stats__unit');
            let lessonKeyword = document.querySelector('.lesson-stats__motivational-message');
            let estimated_time = $allModule[parseInt(indexes[0])].topics[parseInt(indexes[1])].lessons[parseInt(
                indexes[2])].player_progress.estimated_time || '00:00:00';
            let diamondsReward = $allModule[parseInt(indexes[0])].topics[parseInt(indexes[1])].lessons[parseInt(
                indexes[2])].player_progress.reward_diamonds || '0';
            let wordDiamonds = $allModule[parseInt(indexes[0])].topics[parseInt(indexes[1])].lessons[parseInt(
                indexes[2])].player_progress.motivational_message;
            lessonKeyword.innerHTML = wordDiamonds == '¡COMIENZA TU AVENTURA!' ? '¡COMIENZA TU <br> AVENTURA!' :
                wordDiamonds || 'HUBO UN ERROR';
            lessonStatsValueModal[0].textContent = diamondsReward;
            lessonStatsUnit[0].textContent = diamondsReward == '0' ? 'Diamante' : 'Diamantes';
            lessonStatsValueModal[1].textContent = estimated_time;
            lessonStatsUnit[1].textContent = getTimeUnit(estimated_time);
            lessonStatsValueModal[2].textContent = $allModule[parseInt(indexes[0])].topics[parseInt(indexes[1])]
                .lessons[parseInt(indexes[2])].player_progress.success_rate + '%' || '0%';
            console.info('Datos de La leccion seleccionada:', $allModule[parseInt(indexes[0])].topics[parseInt(
                indexes[1])].lessons[parseInt(indexes[2])].player_progress);
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
