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
        .study-plan {
            margin-bottom: 2rem;
        }

        .study-plan__module,
        .ranking__header,
        .sidebar-levels__header {
            background: var(--purple);
            border-radius: 1rem 1rem 0 0;
            padding: 0.6rem 1rem;
            color: white;
        }

        .level-card__circle--add {
            background: var(--green) !important;
            outline: 5px solid var(--green) !important;
        }

        .study-plan__module-title {
            font-size: 1.75rem;
            /* fs-3 */
            font-weight: bold;
        }

        .study-plan__topic {
            background: var(--orange);
            color: white;
            padding: 0.6rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .study-plan__add-action {
            background: var(--green);
            padding: 0.3rem;
            display: flex;
            justify-content: center;
        }

        .levels-section {
            margin-top: 1.5rem;
            display: flex;
            gap: 1.25rem;
        }

        .level-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
        }

        .level-card__circle {
            background: #7a5bd2;
            color: white;
            width: clamp(65px, 7vw, 75px);
            height: clamp(65px, 7vw, 75px);
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            outline: 5px solid #7a5bd2;
            outline-offset: 0.2rem;
            transition: transform 0.2s;
        }

        .level-card__circle:hover {
            transform: scale(1.05);
        }

        .level-card__title {
            margin-top: 0.8rem;
            text-align: center;
            color: var(--purple);
            font-weight: bold;
            line-height: 1.4;
        }

        .button--icon-only {
            background: none !important;
            border-radius: 0 !important;
            padding: 0.5rem;
        }


        .header__content--rol-player {
            padding: 0rem 1rem !important;
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header isPlayer="1"></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article     w-100">
            <div class="col-3 bg-white-border">
                <aside class="sidebar-levels">
                    <div class="sidebar-levels__header">
                        <h2 class="sidebar-levels__title">Mis Niveles</h2>
                    </div>
                    <nav class="sidebar-levels__nav">
                        <div class="level-item level-item--completed">
                            <div class="level-item__icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="level-item__content">
                                <span class="level-item__name">Nivel 1</span>
                                <div class="level-item__progress-bar">
                                    <div class="level-item__progress-fill" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="level-item level-item--active">
                            <div class="level-item__icon">
                                <i class="bi bi-play-fill"></i>
                            </div>
                            <div class="level-item__content">
                                <span class="level-item__name">Nivel 2</span>
                                <div class="level-item__progress-bar">
                                    <div class="level-item__progress-fill" style="width: 45%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="level-item level-item--locked">
                            <div class="level-item__icon">
                                <i class="bi bi-lock-fill"></i>
                            </div>
                            <div class="level-item__content">
                                <span class="level-item__name">Nivel 3</span>
                            </div>
                        </div>
                    </nav>
                </aside>
            </div>
            <div class="  col-6 bg-white-border main__content">



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
                        <h2 class="ranking__title fs-4">Clasificaciones Actuales</h2>
                    </div>
                    <hr>
                    <div class="ranking__body">
                        <div class="ranking__item ranking__item--highlight">
                            <div class="ranking__user-info">
                                <img src="avatar.png" alt="Avatar" class="ranking__avatar">
                                <span class="ranking__username">Yane2024</span>
                            </div>
                            <span class="ranking__score">87</span>
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
