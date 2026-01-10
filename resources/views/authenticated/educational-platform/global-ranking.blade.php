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

        .progress-bar {
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

        .ranking {
            width: 830px;
        }


        .ranking__header--the-best {
            background: none;
        }

        .ranking__selected-access-level {
            background: var(--orange);
            color: white;
            padding: 0.6rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header isPlayer="1" img="{{ $player->avatar->url }}"></x-header>

    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <section class="ranking bg-white-border">
            <div class="ranking__header">
                <h2 class="ranking__title fs-4 m-0">
                    <i class="bi bi-award-fill"></i>
                    <b>Ranking Global</b>
                </h2>
                <div class="ranking__selected-access-level">
                    <span>
                        Nivel de Acceso: Nivel {{ Auth::user()->player->level_assigned->number }} -
                        {{ Auth::user()->player->level_assigned->name }}
                    </span>
                </div>
            </div>

            <div class="ranking__body">
                <div class="ranking__i mt-3">
                    <div
                        class="ranking__item ranking__item--i flex-and-direction-row flex-content-space-between ranking__item--highlight">
                        <div class="ranking__user-info">
                            <img src="{{ asset('img/avatars/' . $player->avatar->url) }}" alt="Avatar"
                                class="ranking__avatar">
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
