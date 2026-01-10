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



        body {
            background: {{ $theme->solid_background }};
        }

        body {
            {!! $bodyCSS !!}
        }

        .welcome__content {
            width: clamp(300px, 50%, 600px) !important;
            height: auto !important;

        }

        .bg-white-border {
            background: none;
            border: none;
        }

        .your-progress-bar {
            background-color: var(--purple);
            transition: width 0.4s ease;
        }

        .bg-white-border {
            background: {{ $theme->topic_color ?? 'white' }} !important;
        }


        .ranking__item--i {
            background: {{ $theme->secondary_color ?? ' #ef7440' }}80;
            border-radius: 0.5rem;
        }

        .your-progress {
            width: 830px;
            height: auto;
        }

        .your-progress__top {
            background: var(--purple);
            border-radius: 1rem 1rem 0 0;
            padding: 0.6rem 1rem;
            color: white;
            width: 100%;
        }

        .ranking__header--the-best {
            background: none;
        }

        .your-progress__title {}

        .your-progress__title-orange {
            background: var(--orange);
            color: white;
            padding: 0.6rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .your-progress__full-name {
            color: color-mix(in srgb, var(--purple), rgb(255, 255, 255) 30%);
        }

        .your-progress__selected-access-level,
        .your-progress_account-registration-date {
            color: color-mix(in srgb, var(--purple), rgb(255, 255, 255) 80%);
        }

        .profile__avatar--progress {
            /*filter: drop-shadow(0px 4px 0px rgb(47, 47, 47));*/
            color: rgb(47, 47, 47);
            transform: perspective(2rem) translateZ(1rem);
            transform: perspective(500px) translateZ(20px);
            transform-style: preserve-3d;
            transition: all 0.5s linear;
            width: 90px;
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header isPlayer="1" img="{{ $player->avatar->url }}"></x-header>

    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <section class="your-progress bg-white-border flex-and-direction-column ">
            <div class="your-progress__top flex-and-direction-row flex-content-space-between">
                <section class="your-progress__user-info">
                    <h1 class="fs-2 your-progress__title">
                        {{ Auth::user()->user }}
                    </h1>
                    <span class="your-progress__full-name">
                        {{ Auth::user()->player->names }} {{ Auth::user()->player->surnames }}
                    </span>
                    <br>
                    <span class="your-progress__selected-access-level">
                        Nivel de Acceso: Nivel {{ Auth::user()->player->level_assigned->number }} -
                        {{ Auth::user()->player->level_assigned->name }}
                    </span>
                    <br>
                    <span class="your-progress__selected-access-level--description ">
                        Descripción del Nivel: {{ Auth::user()->player->level_assigned->description }}
                    </span>
                    <br>
                    <span class="your-progress_account-registration-date">
                        Fecha de Registro: {{ formatting_date(Auth::user()->player->created_at ?? '') }}
                    </span>
                </section>
                <div class="your-progress__avatar">
                    <figure>
                        <img src="{{ asset('img/avatars/' . Auth::user()->player->avatar->url) }}"
                            class="profile__avatar--progress img-fluid  " draggable="false" alt="">
                    </figure>
                </div>
            </div>
            <div class="your-progress__title-orange">
                <h2 class="fs-4"> Progreso</h2>
            </div>
        </section>
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
