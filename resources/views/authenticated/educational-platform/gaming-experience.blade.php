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
    <link rel="stylesheet" href="{{ asset('css/components/lesson-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/study-plan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/ranking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/level.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @php
        $bodyCSS = '';
        if ($theme->background_path != null) {
            $urlAsset = asset('img/themes/' . $theme->background_path);
            $bodyCSS = "background-image: url('$urlAsset');
            background-repeat: repeat;
            background-attachment: fixed;
            background-size: cover;";
        } else {
            $bodyCSS = "background-color: {$theme->solid_background};";
        }
    @endphp
    <style>
        :root {
            --purple: {{ $theme->main_color ?? '#7052c2' }};
            --orange: {{ $theme->secondary_color ?? '#ef7440' }};
        }

        body {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        .ranking__item--i {
            background: {{ $theme->secondary_color ?? ' #ef7440' }}80;
            border-radius: 0.5rem;
        }

        .ranking__item--highlight {
            border-bottom: solid var(--purple);

        }

        .bg-white-border {
            background: {{ $theme->topic_color ?? 'white' }} !important;
        }

        body {
            {!! $bodyCSS !!}
        }

        .lesson-modal {
            {!! $bodyCSS !!}
        }

        .game-layout {
            padding: 0.5rem 1rem;
            margin-top: 1.5rem;
        }

        .game-header__icon--gem,
        .statistics-icon--gem {
            color: var(--blue);
        }

        . .game-header__icon--back {
            color: var(--purple);
        }

        .game-header__tutor {}

        .game-header__figure {
            padding: 1rem;
            background: var(--purple);
            padding: 2rem;
            border-radius: 5rem;
        }

        .statistics-time {
            outline-color: var(--blue);
        }

        .statistics-diamonds {
            outline-color: var(--purple);
        }

        .statistics-success-rate {
            outline-color: var(--green);
        }


        .statistics__value {
            margin: 0rem 0.8rem;
        }

        .game-header__stat-badge,
        .statistics {
            display: flex;

            align-items: center;
            background: var(--black);
            color: white;
            border-radius: 4rem;
            outline-offset: 0;
            outline-style: solid;
            outline-width: 3px;
            color: white;
            border: 0rem;
            min-width: 40px !important;
            min-height: 40px;
            color: rgb(255, 255, 255);
            font-weight: bold;
            font-size: clamp(1rem, 3vw, 1.5rem);
            filter: drop-shadow(2px 3px #222);
            width: 120px;
        }

        .game-header__icon,
        .statistics-icon {
            padding: 2rem;

        }

        .game-header__icon--gem,
        .statistics-icon {
            border-radius: 2rem;
            padding: 0.5rem;
            color: white;
            z-index: 99;
            border-radius: 4rem;
            outline-offset: 0;
            outline-style: solid;
            outline-width: 3px;
            color: white;
            border: 0rem;
            min-width: 40px !important;
            min-height: 40px;
            color: rgb(255, 255, 255);
            font-weight: bold;
            font-size: clamp(1rem, 3vw, 1.5rem);
        }

        .statistics-icon--gem {
            background: var(--purple) !important;
            outline-color: var(--purple) !important;
        }

        .statistics-icon--time {
            background: var(--blue) !important;
            outline-color: var(--blue) !important;
        }

        .statistics-icon--success-rate {
            background: var(--green) !important;
            outline-color: var(--green) !important;
        }

        .game-header__value {
            padding-right: 1rem;
            padding-right: 0rem;
            padding-top: 0.3rem;
            padding-bottom: 0.3rem;

        }

        .game-header__description {
            padding: 1rem;
            background: var(--black);
            color: white;
        }

        .game-header {

            padding-bottom: 1rem;
        }

        .game-header__tutor {
            background: var(--black);
        }

        .game-header__icon--back {
            color: var(--gray);
        }

        .game-header__progress {
            width: 100%;
        }

        .progress {
            background: var(--black);

        }

        .progress-bar {
            background-color: var(--purple);

        }

        .progress_avatar-img {
            position: absolute;
            width: 30px;
            z-index: 999;
            right: 0rem;
        }


        .game-content__type-dynamics>button,
        .game-select {

            background: var(--purple);
            color: white;
            border-radius: 1rem;
            /*outline-color: color-mix(in srgb, var(--purple), black 20%);
            outline-offset: 0;
            outline-style: solid;
            outline-width: 3px;*/
            color: white;
            border: 0rem;
            min-width: 40px !important;
            min-height: 40px;
            color: rgb(255, 255, 255);
            font-weight: bold;
            font-size: clamp(1rem, 3vw, 1.5rem);
            filter: drop-shadow(2px 3px color-mix(in srgb, var(--purple), black 20%));
            padding: 0rem 1.5em;
            color: white;
            border: none;

            border-radius: 12px;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            /* El secreto: un resplandor en lugar de outline */
            box-shadow: 0 4px 2px color-mix(in srgb, var(--purple), black 20%);
        }

        .game-content__type-dynamics>button:hover {

            transform: translateY(-2px);
            background: color-mix(in srgb, var(--purple), white 20%)
        }

        .button__incorrect {
            background: #d55252 !important;
            outline-color: #d55252 !important;
            outline-offset: none !important;
            transition: all 1s;
            transform: perspective(5rem) scale(0.9);
            box-shadow: 0 4px 2px color-mix(in srgb, var(--red), black 20%) !important;
            filter: drop-shadow(2px 3px color-mix(in srgb, var(--red), black 20%)) !important;
        }

        .button__correct {
            background: rgb(26 139 87) !important;
            outline-color: rgb(26 139 87) !important;
            transition: all 1s;
            box-shadow: 0 4px 2px color-mix(in srgb, var(--green), black 20%) !important;
            filter: drop-shadow(2px 3px color-mix(in srgb, var(--green), black 20%)) !important;
            transform: perspective(5rem) scale(1.1);
        }

        .lesson__button {
            border: none;
            text-align: center;
        }

        /* Bloque Principal */


        #estimatedTime {}

        .main__top {
            padding: 0rem 1rem;
            position: absolute;
            text-align: end;
            width: 100vw;
            right: 0;
            background: var(--black);
            color: white;
        }

        .game-content__attempts {
            background: var(--black);
            padding: 0.5rem 3rem;
            border-radius: 4rem;
            color: white;
        }

        .is-locked {
            pointer-events: none
        }

        .game-content__screen {
            background: var(--purple);
            color: white;
            border-radius: 1rem;
            color: white;
            border: 0rem;
            min-width: 40px !important;
            min-height: 40px;
            color: rgb(255, 255, 255);
            font-weight: bold;
            font-size: clamp(1rem, 3vw, 1.5rem);
            filter: drop-shadow(2px 3px color-mix(in srgb, var(--purple), black 20%));
            padding: 0rem 1.5em;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 2px color-mix(in srgb, var(--purple), black 20%);
            margin-bottom: 1rem;
            padding: 0.5rem 7rem;
        }

        .tutor {
            position: fixed;
            bottom: 0;
            z-index: 999;
            right: 0;
        }

        .tutor__img {
            width: 100px;
        }

        .tutor__description {
            position: absolute;
            top: -2rem;
            left: -10rem;
        }

        .introduction {
            height: 100vh;
            width: 100vw;
            position: absolute;
            z-index: 9;

            {!! $bodyCSS !!}
        }

        .introduction__stats {

            background: white;
            border-radius: 2rem;
        }

        .guide {
            cursor: pointer;
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--purple);
            padding: 1rem;
            color: white;
            border-radius: 0.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            filter: drop-shadow(2px 2px #2d2d2d);
        }

        .guide__ring {
            position: absolute;
            width: 15px;
            background: var(--black);
            height: 10px;
            left: -0.5rem;
            border-radius: 0.5rem;
        }

        .guide__one-ring {
            top: 0%;

        }

        .guide__two-ring {
            top: 45%;

        }

        .guide__third-ring {
            top: 90%;

        }

        .introduction__begin {
            filter: drop-shadow(2px 3px color-mix(in srgb, var(--black), black 5%));
            box-shadow: 0 4px 2px color-mix(in srgb, var(--black), black 5%);
            transition: all 0.3s ease;
        }

        .introduction__begin:hover {
            transform: translateY(-2px);
            background: color-mix(in srgb, var(--black), white 20%) !important;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1),
        }



        .introduction__title {
            background: var(--orange);
            color: white;
            padding: 0.6rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .introduction__current-progress {
            background: var(--purple);
            margin: 0;
            border-radius: 1rem 1rem 0 0;
            padding: 0.6rem 1rem;
            color: white;

        }

        .introduction__body {
            padding: 1rem;
        }

        .game-header__button--exit {
            padding: 0;
            margin: 0;
        }

        .introduction__buttons>a {
            display: none;
        }

        .introduction>a {
            display: none;
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full  flex-center-full-start"
        style="height: 100vh;">
        <div class="main__top flex-and-direction-row flex-content-space-between">
            <button class="main__top-background-music  button p-0 ">
                <i class="bi bi-volume-up-fill"></i>
            </button>
            <small id="estimatedTime">

            </small>
        </div>

        <div class="game-layout w-100 h-100 flex-and-direction-column">
            <section class="game-header flex-content-space-between flex-and-direction-row"
                style="flex-wrap: nowrap; gap:1rem;">
                <div class="game-header__back">
                    <button class="button game-header__button--exit" data-bs-toggle="modal"
                        data-bs-target="#inforExitModal">
                        <i class="bi bi-caret-left-fill game-header__icon--back fs-1"></i>
                    </button>
                </div>
                <div class="game-header__progress">
                    <div class="progress level-item__progress-fill" role="progressbar"
                        aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%;     ">
                        </div>

                    </div>
                </div>
                <div class="game-header__stats">
                    <div class="game-header__stat-badge statistics-diamonds">
                        <div clas="game-header__icon">
                            <i class="bi bi-gem game-header__icon--gem statistics-icon--gem fs-2"></i>
                        </div>
                        <div class="game-header__value fs-2 flex-and-direction-row statistics__value "
                            style="flex-wrap: nowrap">
                            <div><b>+</b></div>
                            <b>0</b>
                        </div>
                    </div>
                </div>
            </section>
            <section class="game-content flex-grow-2 flex-and-direction-column flex-center-full">
                <div class="game-content__screen ">

                </div>
                <div class="game-content__type-dynamics flex-and-direction-row  " style="gap:1rem;"
                    data-total-practices="{{ $totalExercises }}">
                </div>

                <div class="game-content__attempts mt-3">
                    <span class="game-content__attempts-text">Intentos: </span>
                    <span
                        class="game-content__attempts-number">{{ $reinforcementFailureLimit->refuerzo_fail_limit || 3 }}</span>
                </div>
            </section>

        </div>
    </main>
    <div class="modal fade refuerzo-modal refuerzo-modal__modal" id="inforlessonModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="levelModalTitle" aria-hidden="true">
        <div class="modal-dialog refuerzo-modal__dialog">
            <div class="modal-content refuerzo-modal__content">
                <div class="modal-header refuerzo-modal__header bg__color-purple text-white">
                    <h1 class="modal-title refuerzo-modal__header-title   fs-4 " id="levelModalTitle">
                        <b>¡Refuerza tus conocimientos!</b>
                    </h1>
                    <button type="button" class="btn-close refuerzo-modal__close r  text-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body refuerzo-modal__body">


                    <div class="refuerzo-modal__item ">
                        <label for="guia_parrafo" class="form__label">Resumen clave</label>
                        <div class="input-group">
                            <span class="form__icon input-group-text"><i class="bi bi-blockquote-left"></i></span>
                            <textarea rows="3" disabled class="form-control refuerzo-modal__text-tarea"
                                placeholder="Aquí aparecerán los puntos más importantes de la lección para ayudarte a mejorar."
                                aria-label="Contenido de la guía"></textarea>
                        </div>
                    </div>
                    <div class="refuerzo-modal__video">
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/NunfNnd-T9A?si=EbojiYTssWIMpnL0"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>

                </div>
                <div class="modal-footer refuerzo-modal__footer flex-and-direction-row flex-content-end ">
                    <button type="button "
                        class="button button__color-green button--secondary   refuerzo-modal__close"
                        data-bs-dismiss="modal">
                        Entendido
                    </button>

                </div>
            </div>
        </div>

    </div>

    <div class="tutor flex-and-direction-row">
        <figure class="tutor__figure">
            <img src="{{ asset('img/logo.png') }}" draggable="false" data-bs-toggle="popover"
                data-bs-title="¡Gleeo dice!" data-bs-content="haga la operacion!" alt="Tutor Inteligente Gleeo"
                data-bs-placement="top" class="tutor__img img-fluid">
        </figure>
        <p class="tuto__descripcion d-none">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
        </p>
    </div>

    <div class="modal fade lesson-modal" id="inforEndGameModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="levelModalTitle" aria-hidden="true">
        <div class="modal-dialog lesson-modal__dialog">
            <div class="modal-content lesson-modal__content">
                <div class="modal-header lesson-modal__header bg__color-purple text-white">
                    <h1 class="modal-title lesson-modal__title fs-5  " id="levelModalTitle">
                        <i class="bi bi-rocket-takeoff-fill"></i> <b>¡Completaste la Leccion!</b>
                    </h1>

                </div>
                <div class="modal-body lesson-modal__body">
                    <div class="lesson-modal__header text-center mb-4">
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
                                        <span class="lesson-stats__value lesson-stats__value--diamond">+50</span>
                                        <span class="lesson-stats__unit">Diamantes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="lesson-stats__badge">EPICO</div>
                        </div>

                        <!-- Contenedor para métricas secundarias -->
                        <div class="lesson-stats__grid flex-and-direction-row flex-center-full flex-gap-1 mt-3">

                            <!-- Elemento: Tiempo -->
                            <div class="lesson-stats__item lesson-stats__item--secondary">
                                <i class="bi bi-speedometer2 lesson-stats__icon lesson-stats__icon--time fs-2"></i>
                                <div class="lesson-stats__text">
                                    <span class="lesson-stats__label text__gray"><b>Tiempo estimado</b></span>
                                    <div class="lesson-stats__value-container">
                                        <span class="lesson-stats__value--time">1:22</span>

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
                                        <span class="lesson-stats__value--success">40%</span>
                                        <span class="lesson-stats__unit">Global</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
                <div class="modal-footer lesson-modal__footer flex-and-direction-row flex-content-space-between ">
                    <button class="button text__gray" onclick="location.reload();">
                        Repetir Lección
                    </button>
                    <button style="border: none">
                        <b>
                            <a href="{{ route('educational-platform.index', ['slugCurrentLevel' => Auth::user()->player->current_level->slug]) }}"
                                class="button button__color-black lesson-modal__link-play">
                                ¡Ir a la ruta!
                            </a>
                        </b>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade guide-modal" id="inforGuideModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="levelModalTitle" aria-hidden="true">
        <div class="modal-dialog guide-modal__dialog">
            <div class="modal-content guide-modal__content">
                <div class="modal-header guide-modal__header bg__color-purple text-white">
                    <h1 class="modal-title guide-modal__title fs-5  " id="levelModalTitle">
                        <i class="bi bi-rocket-takeoff-fill"></i> <b>Guia el Desafío</b>
                    </h1>
                    <button type="button" class="btn-close guide-modal__close text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body guide-modal__body">
                    <div class="guide-modal__header text-center mb-4">

                        <p class="guide-modal__description">
                            {{ $lesson->guide }}
                        </p>
                    </div>

                </div>
                <div class="modal-footer guide-modal__footer flex-and-direction-row flex-content-end ">
                    <button type="button" class="button button__color-green  " data-bs-dismiss="modal">
                        Entendido
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="audio-library">
        <audio src="{{ asset('audios/player/lesson/Click on the item.mp3') }}"
            class="audio-library__player audio-library__player--click"></audio>
        <audio src="{{ asset('audios/player/lesson/Correct element.mp3') }}"
            class="audio-library__player audio-library__player--correct"></audio>
        <audio src="{{ asset('audios/player/lesson/Incorrect item.mp3') }}"
            class="audio-library__player audio-library__player--incorrect"></audio>
        <audio src="{{ asset('audios/player/lesson/Lesson completed.mp3') }}"
            class="audio-library__player audio-library__player--completed"></audio>
        <audio src="{{ asset('audios/player/lesson/Starting the lesson.mp3') }}"
            class="audio-library__player audio-library__player--start"></audio>
        <audio src="{{ asset('audios/player/lesson/Next modal.mp3') }}"
            class="audio-library__player audio-library__player--next-modal"></audio>
        <audio src="{{ asset('audios/player/lesson/background music.mp3') }}"
            class="audio-library__player audio-library__player--background-music"></audio>
        <audio src="{{ asset('audios/player/lesson/Reinforcement.mp3') }}"
            class="audio-library__player audio-library__player--reinforcement"></audio>
    </div>

    <script>
        const backgroundMusicBtn = document.querySelector('.main__top-background-music');
        backgroundMusicBtn.addEventListener('click', e => {
            const audioBackgroundMusic = document.querySelector('.audio-library__player--background-music');
            if (audioBackgroundMusic.paused) {
                audioBackgroundMusic.play();
                backgroundMusicBtn.innerHTML = '<i class="bi bi-volume-up-fill"></i>';
            } else {
                audioBackgroundMusic.pause();
                backgroundMusicBtn.innerHTML = '<i class="bi bi-volume-mute-fill"></i>';
            }
        });
    </script>
    <div class="modal fade exit-modal" id="inforExitModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="levelModalTitle" aria-hidden="true">
        <div class="modal-dialog exit-modal__dialog">
            <div class="modal-content exit-modal__content">
                <div class="modal-header exit-modal__header bg__color-red text-white">
                    <h1 class="modal-title exit-modal__title fs-5  " id="levelModalTitle">
                        <b>
                            Salir de la Lección
                        </b>
                    </h1>
                    <button type="button" class="btn-close exit-modal__close text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body exit-modal__body">
                    <div class="exit-modal__header text-center mb-4">

                        <p class="exit-modal__description">
                            ¿Estás seguro que deseas salir de la lección? Tu progreso no se guardará y deberás
                            reiniciar la lección desde el principio.
                        </p>
                    </div>

                </div>
                <div class="modal-footer exit-modal__footer flex-and-direction-row flex-content-space-between">
                    <button type="button" class="button button--secondary text__gray" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <a
                        href="{{ route('educational-platform.index', ['slugCurrentLevel' => $lesson->topic->module->level->slug]) }}">
                        <button type="button" class="button button__color-red exit-modal__confirm-exit">
                            <i class="bi bi-box-arrow-right"></i> Salir de la Lección
                        </button>
                </div>
            </div>
        </div>
    </div>

    <section class="introduction flex-and-direction-row flex-center-full" style="    background-size: cover;">
        <div class="introduction__stats   ">
            <div class="introduction__header text-center mb-3">
                <h1 class=" text__white introduction__current-progress fs-2">
                    <b>
                        ¡Vamos por tus primeros diamantes!"
                    </b>
                </h1>
                <div class="introduction__title">
                    <span>
                        <b>{{ $lesson->title }}</b>
                    </span>
                </div>
            </div>
            <div class="introduction__body">
                <div class="introduction__content  flex-center-full flex-and-direction-row" style="gap: 1rem">
                    <div class="introduction__stat  statistics statistics-diamonds" title="Diamantes">
                        <div clas="introduction__stats-icon  ">
                            <i class="bi bi-gem    fs-2 statistics-icon statistics-icon--gem"></i>
                        </div>
                        <div class="statistics__value fs-2 flex-and-direction-row" style="flex-wrap: nowrap">
                            <b>+ {{ $playerLessonInfo->reward_diamonds || 0 }}</b>
                        </div>
                    </div>
                    <div class="introduction__stat  statistics statistics-time w-auto">
                        <div clas="introduction__stats-icon  ">
                            <i class="bi bi-speedometer2  fs-2 statistics-icon--time statistics-icon "></i>
                        </div>
                        <div class="statistics__value  fs-2 flex-and-direction-row" title="Tiempo"
                            style="flex-wrap: nowrap">
                            <b class="statistics__value--time">0</b>
                            <span class="statistics__time-unit " style="margin-left: 0.3rem;"></span>
                        </div>
                        <script>
                            let statisticsValueTime = document.querySelector('.statistics__value--time');
                            let statisticsTimeUnit = document.querySelector('.statistics__time-unit');

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
                            let estimated_time = @js($playerLessonInfo->estimated_time) || '00:00:00';
                            statisticsValueTime.innerHTML = estimated_time;
                            statisticsTimeUnit.innerHTML = getTimeUnit(estimated_time) != undefined ? getTimeUnit(estimated_time) : '';
                        </script>
                    </div>
                    <div class="introduction__stat  statistics statistics-success-rate" title="Tasa de Exito">
                        <div clas="introduction__stats-icon  ">
                            <i
                                class="bi bi-rocket-takeoff-fill statistics-icon    fs-2 statistics-icon--success-rate"></i>
                        </div>
                        <div class="statistics__value fs-2 flex-and-direction-row" style="flex-wrap: nowrap">
                            <b>{{ $playerLessonInfo->success_rate || 0 }}%</b>
                        </div>
                    </div>
                </div>
                <br>
                <div
                    class="introduction__buttons introduction__buttons flex-and-direction-row flex-content-space-between">
                    <button class="text__gray button">
                        <a
                            href="{{ route('educational-platform.index', ['slugCurrentLevel' => $lesson->topic->module->level->slug]) }}">
                            <small>
                                Salir
                        </a> </small>
                    </button>
                    <button class="button button__color-black introduction__begin">COMENZAR</button>
                </div>
            </div>

        </div>
        <div class="introduction__guide guide">
            <div data-bs-toggle="modal" data-bs-target="#inforGuideModal"><i class="bi bi-journal-text fs-4"></i>
            </div>
            <div class="guide__one-ring guide__ring"></div>
            <div class="guide__two-ring guide__ring"></div>
            <div class="guide__third-ring guide__ring"></div>
        </div>
    </section>


</body>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>


<script>
    const espIP = "192.168.100.178";

    function cambiarColor(color) {
        fetch(`http://${espIP}/set-color?color=${color}`, {
                mode: 'no-cors'
            })
            .then(response => {
                console.log("Comando enviado: " + color);
            })
            .catch(error => {
                console.error("Error al conectar con el ESP8266:", error);
            });
    }

    //dispose destruir
    let gameContentAttemptsText = document.querySelector('.game-content__attempts-text')
    let introductionSection = document.querySelector('.introduction');
    let introductionBeginBtn = document.querySelector('.introduction__begin')



    //Audios Library
    const audioClick = document.querySelector('.audio-library__player--click');
    const audioCorrect = document.querySelector('.audio-library__player--correct');
    const audioIncorrect = document.querySelector('.audio-library__player--incorrect');
    const audioCompleted = document.querySelector('.audio-library__player--completed');
    const audioStart = document.querySelector('.audio-library__player--start');
    const audioNextModal = document.querySelector('.audio-library__player--next-modal');
    const audioBackgroundMusic = document.querySelector('.audio-library__player--background-music');
    const audioReinforcement = document.querySelector('.audio-library__player--reinforcement');


    introductionBeginBtn.addEventListener('click', e => {
        setTimeout(() => {
            audioBackgroundMusic.volume = 0.2;
            audioBackgroundMusic.loop = true;
            audioBackgroundMusic.play().catch(err => console.log("Esperando interacción..."));
        }, 2000);

        introductionSection.remove();
        setTimeout(() => {
            start();
            renderPractice(practices[0]);
        }, 500);
    })

    let refuerzoModalButtonExit = document.querySelector('.refuerzo-modal__close');

    let gameContentAttemptsNumber = document.querySelector('.game-content__attempts-number');

    let gleoIndicatesPopover = document.querySelector('[data-bs-toggle="popover"]')
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
    const instanciaPopover = new bootstrap.Popover(document.querySelector('[data-bs-toggle="popover"]'));
    let genderMsgWelcome = @js(Auth::user()->player->gender_id == 1 ? 'o' : 'a');

    updateTutor('.tutor__img', '¡Bienvenid' + genderMsgWelcome + ' a Gleeo!',
        'Soy tu tutor inteligente, diseñado para acompañarte en cada paso de tu aprendizaje. Mi misión es brindarte un apoyo constante y personalizado para que juntos alcancemos tus metas educativas con éxito.'
    );
    setTimeout(() => {
        instanciaPopover.hide();
    }, 5000);
    let timer = null;
    let seconds = 0,
        minutes = 0,
        hours = 0;

    let timeDom = document.getElementById('estimatedTime')

    function updateDisplay() {
        const format = (unit) => (unit < 10 ? "0" + unit : unit);
        timeDom.innerText =
            `${format(hours)}:${format(minutes)}:${format(seconds)}`;
    }

    function start() {
        if (!timer) { // Evita que se disparen múltiples intervalos
            timer = setInterval(() => {
                seconds++;
                if (seconds === 60) {
                    seconds = 0;
                    minutes++;
                    if (minutes === 60) {
                        minutes = 0;
                        hours++;
                    }
                }
                updateDisplay();
            }, 1000);
            console.info("Cronómetro iniciado");
        }
    }




    function pause() {
        if (timer) {
            clearInterval(timer);
            timer = null; // Limpiamos la variable para que 'start' pueda reanudar
            console.info("Cronómetro pausado");
        }
    }


    const modalElement = document.getElementById('inforlessonModal')
    const miModal = new bootstrap.Modal(modalElement);




    const practices = JSON.parse(`{!! $lessonExercises !!}`);
    console.info(practices);
    const GAME_CONTENT_TYPE_DYNAMICS = document.querySelector('.game-content__type-dynamics');
    let refuerzoModalTextTarea = document.querySelector('.refuerzo-modal__text-tarea');
    let refuerzoModalVideo = document.querySelector('.refuerzo-modal__video');
    const VALUE_DIAMONTD = document.querySelector('.game-header__value > b');
    let lessonStatsBadge = document.querySelector('.lesson-stats__badge');
    let gameContentScreen = document.querySelector('.game-content__screen');
    console.log(practices[1]);
    const totalPractices = @js($totalExercises);

    console.info('hola');
    console.info(@js($reinforcementFailureLimit->is_active))
    let refuerzoFailLimit = 3;

    const gameState = {
        currentPracticeIndex: 0,
        totalFailuresPractice: 0,
        originalScreenText: '',
        failLimit: {
            fixed: @js($reinforcementFailureLimit->is_active) == 1 ? @js($reinforcementFailureLimit->refuerzo_fail_limit) || 3 : null,
            playerDom: @js($reinforcementFailureLimit->refuerzo_fail_limit) || 3
        },
        correctAnswers: 0,
        incorrectAnswers: 0,
        totalPractices: parseInt(totalPractices),
        diamonds: 0,
        summerBarPercentage: 100 / parseInt(totalPractices),
        currentProgressBar: 0,

    };


    let gameContentAttempts = document.querySelector('.game-content__attempts');
    if (@js($reinforcementFailureLimit->is_active) == 0) {
        gameContentAttempts.remove();
    } else {
        gameContentAttemptsNumber.innerHTML = gameState.failLimit.fixed;

    }

    // 2. Delegación de eventos limpia
    document.addEventListener('click', e => {
        const trigger = e.target.closest('.game-content__type-dynamics > button');
        if (trigger) {
            const selectedValue = trigger.textContent.trim();
            verifyAnswer(selectedValue, trigger);
        }

        if (e.target.closest('.tutor__img')) {
            hablar(e.target.getAttribute('data-voice'));
            e.target.getAttribute('data-is-he-talking', true);
        }
    });

    document.addEventListener('change', e => {
        if (e.target.matches('.game-select') || e.target.classList.contains('game-select')) {
            const selectedValue = e.target.value.trim();
            verifyAnswer(selectedValue, selectedValue, true);
        }
    });

    document.addEventListener('mouseover', (e) => {
        const trigger = e.target.closest('.game-content__type-dynamics button');

        if (trigger) {
            const audioClick = document.querySelector('.audio-library__player--click');
            if (audioClick) {
                audioClick.play().catch(err => console.log("Esperando interacción..."));
            }
        }
    });

    function verifyAnswer(value, button, autoComplete) {
        const currentPractice = practices[gameState.currentPracticeIndex];

        const isCorrect = GAME_CONTENT_TYPE_DYNAMICS.dataset.correctVariable === value;
        if (isCorrect) {
            audioCorrect.play();
            handleSuccess(button, autoComplete);
        } else {
            audioIncorrect.play();
            handleFailure(button, currentPractice.reinforcement, GAME_CONTENT_TYPE_DYNAMICS.dataset.correctVariable,
                autoComplete);
        }
    }

    function handleSuccess(button, autoComplete) {
        cambiarColor('verde');
        hablar('¡Respuesta acertada!');
        gameState.correctAnswers = gameState.correctAnswers + 1;
        gameState.diamonds = gameState.diamonds + 1;
        VALUE_DIAMONTD.innerHTML = gameState.diamonds;
        if (autoComplete) {
            let gameSelect = document.querySelector('.game-select');
            gameSelect.classList.add('button__correct');
            pause();
            gameContentScreen.classList.add('button__correct');
            gameContentScreen.textContent = practices[gameState.currentPracticeIndex].screen.replace('__', button);
            setTimeout(() => {
                gameContentScreen.classList.remove('button__correct');
                gameSelect.classList.remove('button__correct');
                nextLevel();
                start();
            }, 1500);
        } else {
            gameContentScreen.classList.add('button__correct');
            button.classList.add('button__correct');
            pause();
            setTimeout(() => {
                gameContentScreen.classList.remove('button__correct');
                button.classList.remove('button__correct');
                nextLevel();
                start();
            }, 1500);
        }
    }

    function handleFailure(button, reinforcement, correctVariable, autoComplete) {
        cambiarColor('rojo')
        hablar('Respuesta errónea.');
        gameState.totalFailuresPractice += 1;
        const gameSelect = '';
        if (autoComplete) {
            const gameSelect = document.querySelector('.game-select');
            gameSelect.classList.add('button__incorrect');
        } else {
            button.classList.add('button__incorrect');
        }
        pause()
        let showCorrect = gameState.totalFailuresPractice > gameState.failLimit.fixed;
        let showReinforcementDialogue = gameState.totalFailuresPractice == gameState.failLimit.fixed;
        if (showReinforcementDialogue) {
            ;
            updateTutor('.tutor__img', '¡Gleeo al rescate!',
                '¡Mira! He preparado un refuerzo especial para ayudarte en este paso.');
            hablar('¡Gleeo dice! ' +
                '¡Mira! He preparado un refuerzo especial para ayudarte en este paso.'
            )

        }
        if (autoComplete) {
            if (showCorrect) {
                gameContentScreen.classList.add('button__correct');
                document.querySelector('.game-select').classList.add('is-locked')
                gameContentScreen.textContent = practices[gameState.currentPracticeIndex].screen.replace('__',
                    correctVariable);
            }
        } {
            document.querySelectorAll('.game-content__type-dynamics > button').forEach(element => {
                element.classList.add('is-locked');
                if (showCorrect) {
                    if (element.textContent == correctVariable) {
                        element.classList.add('button__correct');
                    }
                }
            });
        }
        gameState.incorrectAnswers = gameState.incorrectAnswers += 1;
        gameState.failLimit.playerDom = gameState.failLimit.playerDom -= 1;
        gameContentAttemptsNumber.innerHTML = gameState.failLimit.playerDom;

        if (gameState.totalFailuresPractice == gameState.failLimit.fixed - 1 && gameState.failLimit.fixed != null) {
            gameContentAttemptsText.textContent = 'Intento: ';
            updateTutor('.tutor__img', '¡Gleeo dice!',
                '¡Cuidado! Nos queda una última oportunidad, antes de activar el modo de refuerzo. ¡Concéntrate, tú puedes hacerlo!.'
            );
            hablar('¡Cuidado! Nos queda una última oportunidad, antes de activar el modo de refuerzo. ¡Concéntrate, tú puedes hacerlo!.')
            setTimeout(() => {
                instanciaPopover.hide();
            }, 5000);
        }
        setTimeout(() => {
            start();
            if (autoComplete) {
                const gameSelect = document.querySelector('.game-select');
                gameSelect.classList.remove('button__incorrect');
                document.querySelector('.game-select').classList.remove('is-locked')
            } else {
                button.classList.remove('button__incorrect');
                document.querySelectorAll('.game-content__type-dynamics > button').forEach(element => {
                    element.classList.remove('is-locked');
                });
            }

            if (gameState.failLimit.fixed == null) {
                gameState.totalFailuresPractice = 0;
                return nextLevel();
            }

            // Si alcanza el límite, mostramos refuerzo
            if (gameState.totalFailuresPractice == gameState.failLimit.fixed) {
                instanciaPopover.hide();
                pause();
                showReinforcementModal(reinforcement);
            }

            if (gameState.totalFailuresPractice > gameState.failLimit.fixed) {
                gameState.totalFailuresPractice = 0;
                return nextLevel();
            }
        }, 2000);
    }

    async function showReinforcementModal(reinforcement) {
        audioReinforcement.play();
        let calculoFailplayerDom = gameState.failLimit.playerDom + 1;
        gameState.failLimit.playerDom = calculoFailplayerDom;
        gameContentAttemptsNumber.innerHTML = await calculoFailplayerDom;

        console.info(calculoFailplayerDom);
        miModal.show();
        //refuerzoModalTitle.textContent = reinforcement.title;
        refuerzoModalTextTarea.value = reinforcement.paragraph;

        // Sanitización básica o reemplazo de URL
        const videoHtml = await reinforcement.url
            .replace(/\*/g, '"')
            .replace(/width="\d+"/, 'width="100%"');
        await document.querySelector('iframe').setAttribute('width', '100%'); //Por si acaso
        refuerzoModalVideo.innerHTML = videoHtml;
    }

    async function nextLevel() {
        gameState.currentPracticeIndex++;
        gameState.failLimit.playerDom = gameState.failLimit.fixed;
        gameContentAttemptsNumber.textContent = await gameState.failLimit.playerDom;

        console.info(gameState.currentPracticeIndex);
        //summerBarPercentage
        let progressBar = document.querySelector('.progress-bar');
        gameState.currentProgressBar = gameState.currentProgressBar + gameState.summerBarPercentage
        let calculoProgressBar = gameState.currentProgressBar;
        progressBar.setAttribute('style', `width: ${calculoProgressBar}%;`)
        if (gameState.currentPracticeIndex < practices.length) {
            renderPractice(practices[gameState.currentPracticeIndex]);

        } else {
            audioCompleted.volume = 0.4; // Baja el volumen al 40%
            audioCompleted.play();
            audioBackgroundMusic.pause();
            console.info('¡Lección completada!');
            let EndGameModal = document.querySelector('#inforEndGameModal');
            let myModalEndGame = new bootstrap.Modal(EndGameModal);
            let endGameDiam = document.querySelector('.lesson-stats__value--diamond');
            let endGameTime = document.querySelector('.lesson-stats__value--time');
            let endGameSuccess = document.querySelector('.lesson-stats__value--success');
            let successRate = (gameState.correctAnswers / gameState.totalPractices) * 100;
            pause();
            endGameDiam.innerHTML = `+${gameState.diamonds}`;
            endGameTime.innerHTML =
                `<b>${timeDom.textContent}</b> <span class="lesson-stats__unit"> ${getTimeUnit(timeDom.textContent)} </span>`;
            endGameSuccess.innerHTML = `<b>${successRate}%</b>`;

            //lessonStatsBadge

            myModalEndGame.show();
            document.querySelectorAll('.game-content__type-dynamics > button').forEach(element => {
                element.disabled = true;
            });

            gameContentAttemptsText.textContent = 'Intentos: ';
            const score = (gameState.correctAnswers / gameState.totalPractices) * 100;
            let lessonModalTitle = document.querySelector('.lesson-modal__title > b');
            let lessonModalButtonBack = document.querySelector('.lesson-modal__footer > button');
            let lessonModalButtonContinue = document.querySelector('.lesson-modal__footer > button > b > a');
            let lessonModalMsg = document.querySelector('.lesson-modal__description')
            if (score > 0) {
                const lesson = @js($lesson);
                const playerId = @js(Auth::user()->player->player_id);
                console.info("Completando lección:", lesson);
                getData(`/${lesson.lesson_id}/complete-lesson/${playerId}`);
            } else {
                lessonModalTitle.textContent = '¡Sigue practicando!';
                lessonModalButtonBack.textContent = 'Mejorar puntaje';
                lessonModalButtonContinue.textContent = 'Volver al inicio';
                hablar('Necesitas al menos un acierto para completar esta lección.')
                lessonModalMsg.textContent = 'Necesitas al menos un acierto para completar esta lección.';
            }

            if (gameState.diamonds == 0) {
                const msg =
                    "¡Oh, no! Parece que esta vez no logramos recolectar diamantes. No te preocupes, ¡la próxima lección será tu revancha!";
                hablar(msg);
                return lessonStatsBadge.textContent = 'SIGUE INTENTÁNDOLO';
            }

            if (gameState.diamonds <= (gameState.totalPractices / 2)) {
                const msg =
                    "¡Excelente trabajo! Has demostrado un gran dominio. ¡Sigue así y pronto serás un experto!";
                hablar(msg);
                return lessonStatsBadge.textContent = '¡EXCELENTE!';
            } else {
                const msg =
                    "¡Esto ha sido épico! Tu desempeño es de otro nivel. ¡Has superado todas las expectativas!";
                hablar(msg);
                return lessonStatsBadge.textContent = '¡ÉPICO!';
            }
        }
    }


    async function getData(urlData) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const url = urlData;
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ // Enviando datos del juego - Convertir objeto js a JSON
                    reward_diamonds: gameState.diamonds,
                    estimated_time: timeDom.textContent,
                    success_rate: (gameState.correctAnswers / gameState.totalPractices) * 100,
                    motivational_message: lessonStatsBadge.textContent,
                    // total que fallo
                    total_number_incorrect: gameState.incorrectAnswers,
                    total_number_correct: gameState.correctAnswers
                })
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


    function renderPractice(practice) {
        audioStart.play();
        GAME_CONTENT_TYPE_DYNAMICS.innerHTML = '';
        const {
            variables,
            correct_variable
        } = practice.practice_option;
        GAME_CONTENT_TYPE_DYNAMICS.setAttribute('data-correct-variable', correct_variable);
        gameContentScreen.textContent = practice.screen;
        const options = variables.split(",");
        updateTutor('.tutor__img', '¡Gleeo dice!', practice.title);
        setTimeout(() => {
            hablar('¡Gleeo dice! ' + practice.title)
        }, 3000);
        setTimeout(() => {
            instanciaPopover.hide();
        }, 5000);
        if (practice.type_dynamic == 'Autocompletar') {
            const select = document.createElement('select');
            select.className = 'game-select';
            GAME_CONTENT_TYPE_DYNAMICS.appendChild(select);
            const selectGame = document.querySelector('.game-select');
            let option = document.createElement('option');
            option.textContent = 'Seleccione una respuesta';
            selectGame.appendChild(option)
            options.forEach((text, index) => {
                let option = document.createElement('option');
                option.textContent = text.trim();
                option.className = 'game-button';
                selectGame.appendChild(option);
            })
        } else {
            options.forEach((text, index) => {
                // Limitar a 2 si es Verdadero/Falso (según tu lógica original)
                if (practice.type_dynamic === 'Verdadero/Falso' && index > 1) return;
                const button = document.createElement('button');
                button.textContent = text.trim();
                button.className = 'game-button';
                GAME_CONTENT_TYPE_DYNAMICS.appendChild(button);
            });
        }



    }

    const hablar = (mensaje) => {
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(mensaje);
        utterance.lang = 'es-ES';
        utterance.pitch = 1.1;
        utterance.rate = 1;
        window.speechSynthesis.speak(utterance);
    };


    function updateTutor(element, header, body) {
        const el = document.querySelector(element);
        let instancia = bootstrap.Popover.getInstance(el);
        if (!instancia) {
            instancia = new bootstrap.Popover(el);
        }
        instancia.setContent({
            '.popover-body': body,
            '.popover-header': header
        });
        instancia.show();
        const tutorImg = document.querySelector('.tutor__img')
        console.info('holas')
        console.info(tutorImg);
        tutorImg.setAttribute('data-voice', header + '...' + body);
    }


    console.clear();
    hablar(`¡Bienvenid${genderMsgWelcome} a Gleeo! Soy tu tutor inteligente y estaré contigo en cada paso de tu aprendizaje.
                 Mi misión es darte el apoyo personalizado que necesitas para que alcancemos tus metas juntos. Para empezar, exploraremos
                 la lección que tiene como nombre,: ${@js($lesson->title)}.`);
    console.info(@js($lesson->title))

    refuerzoModalButtonExit.addEventListener('click', e => {

        start();
        updateTutor('.tutor__img', '¡Gleeo dice!',
            'Recuerda que eres capaz, Dios está contigo, ¿quién contra ti? ¡Te doy otra oportunidad para que esta vez triunfes!'
        );

        hablar('¡Gleeo dice! ' +
            'Recuerda que eres capaz, Dios está contigo, ¿quién contra ti? ¡Te doy otra oportunidad para que esta vez triunfes!'
        )
        setTimeout(() => {
            instanciaPopover.hide();
        }, 5000);
    })
</script>
</body>

</html>
