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

        .study-plan__module {
            background: var(--purple);
            border-radius: 1rem 1rem 0 0;
            padding: 0.6rem 1rem;
            color: white;
        }

        .level-card__circle--add{
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
            padding: 0.2rem 1rem;
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
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article   container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Plan de Estudio',
                    'route' => 'study-plan.index',
                    'icon' => 'bi bi-highlighter',
                ],
                [
                    'title' => 'Insignias',
                    'route' => 'initial-decision-patterns.index',
                    'icon' => 'bi bi-question-circle-fill',
                ],
            ]"></x-aside-admin>
            <div class="  col-10 bg-white-border main__content">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray"> Gestion de Contenido > </a>
                    <a href="{{ route('study-plan.index') }}" class="text__gray">
                        Plan de Estudio >
                    </a>
                    <a href="{{ route('study-plan.level-index', ['nivel' => $infoLevel['slug']]) }}" class="text__gray">
                        Nivel {{ $infoLevel['number'] }} - {{ $infoLevel['name'] }}
                    </a>
                </small>
                <div class="flex-and-direction-row flex-content-space-between p-0">
                    <div>
                        <legend>
                            <b>
                                Nivel {{ $infoLevel['number'] }} - {{ $infoLevel['name'] }}
                            </b>
                        </legend>
                    </div>
                    <div>
                        <a href="{{ route('module.create', ['nivel' => $infoLevel['slug']]) }}">
                            <button class="button button__color-black">
                                Agregar Módulo
                            </button>
                        </a>
                    </div>
                </div>
                @if (session('alert-success'))
                    <div class="alert alert-success"><i class="bi bi-check-circle-fill"></i>
                        {{ session('alert-success') }}</div>
                @endif
                @if (session('alert-danger'))
                    <div class="alert alert-danger" role="alert"><i class="bi bi-x-octagon-fill"></i>
                        {{ session('alert-danger') }}</div>
                @endif
                <div class="mt-2">
                    @forelse ($modules->items() as $module)
                        <section class="study-plan">

                            <div class="study-plan__module flex-and-direction-row flex-content-space-between">
                                <b class="study-plan__module-title">
                                    Módulo {{ $loop->iteration }}: {{ $module->title }}
                                </b>
                                <div class="study-plan__module-actions">
                                    <a
                                        href="{{ route('module.edit', ['nivel' => $infoLevel['slug'], 'slug' => $module->slug ?? '']) }}">
                                        <button class="button button__color-green button--icon-only">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('module.delete', ['nivel' => $infoLevel['slug'], 'slug' => $module->slug ?? '']) }}">
                                        <button class="button button__color-red button--icon-only">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    </a>
                                </div>
                            </div>

                            <div class="study-plan__add-action">
                                <a
                                    href="{{ route('topic.create', ['nivel' => $infoLevel['slug'], 'slug' => $module->slug ?? '']) }}">
                                    <button class="button button__color-green">
                                        <i class="bi bi-plus-lg"></i> Agregar Tema
                                    </button>
                                </a>
                            </div>

                            @foreach ($module->topics as $topic)
                                <div class="study-plan__topic flex-and-direction-row flex-content-space-between">
                                    <div class="study-plan__topic-info">
                                        <b>Tema {{ $loop->iteration }}: {{ $topic->title }}</b>
                                    </div>
                                    <div class="study-plan__topic-actions">
                                        <a
                                            href="{{ route('topic.edit', ['nivel' => $infoLevel['slug'], 'slug' => $topic->slug ?? '']) }}">
                                            <button class="button button__color-green button--icon-only"
                                                style="padding: 0.8rem;">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </a>
                                        <a
                                            href="{{ route('topic.delete', ['nivel' => 'nivel-1-basico', 'slug' => $topic->slug ?? '']) }}">
                                            <button class="button button__color-red button--icon-only"
                                                style="padding: 0.8rem;">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="flex-and-direction-row ">
                                    @forelse ($topic->lessons as $lesson)
                                        <div class="levels-section px-4 my-3">
                                            <a href="{{ route('study-plan.level-index', ['nivel' => $infoLevel['slug']]) }}" class="level-card">
                                                <div class="level-card__circle">
                                                    <i class="bi bi-check fs-1"></i>
                                                </div>
                                                <div class="level-card__title">
                                                    <i class="text__gray">{{ $lesson->title }}</i>
                                                </div>
                                            </a>
                                        </div>
                                    @empty

                                    @endforelse
                                    <div class="levels-section px-4 my-3">
                                        <a href="{{ route('study-plan.level-index', ['nivel' => $infoLevel['slug']]) }}" class="level-card level-card--add">
                                            <div class="level-card__circle level-card__circle--add">
                                                <i class="bi bi-plus-lg fs-1"></i>
                                            </div>
                                            <div class="level-card__title">
                                                <i class="text__gray"> Agregar <br> Nueva Lección</i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach



                        </section>
                        @empty
                            <p>No hay módulos registrados.</p>
                        @endforelse


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
