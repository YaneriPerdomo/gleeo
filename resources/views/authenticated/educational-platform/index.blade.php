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

        .study-plan__module,
        .ranking__header,
        .sidebar-levels__header {
            background: var(--purple);
            border-radius: 1rem 1rem 0 0;
            padding: 0.6rem 1rem;
            color: white;
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
                        @forelse ($levels as $level)
                            <a href="{{ route('educational-platform.index', ['slugCurrentLevel' => $level->slug]) }}"
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
                                    @forelse ($topic->lessons as $lesson)
                                        <div class="levels-section px-4 my-3">
                                            <a href=" " class="level-card">
                                                <div class="level-card__circle">
                                                    <i class="bi bi-check fs-1"></i>
                                                </div>
                                                <div class="level-card__title">
                                                    <i class="text__gray">{{ $lesson->title }}</i>
                                                </div>
                                            </a>
                                        </div>
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
                                    <img src="{{ asset('img/avatars/' . $player->avatar->url ) }}"
                                        alt="Avatar" class="ranking__avatar">
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
                                                alt="Avatar" class="ranking__avatar">
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
</body>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
</body>

</html>
