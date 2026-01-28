<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Representantes y Profesionales | <x-system-name name="Gleeo"></x-system-name>
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
    <link rel="stylesheet" href="{{ asset('css/components/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/text.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    <style>
        .delete-card__players-count {
            font-size: 1.2rem;
            filter: drop-shadow(0px 1px 0px var(--red));
            color: var(--red);
            border-bottom: solid;
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article   container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Informacion General',
                    'route' => 'news-board.index',
                    'icon' => 'bi bi-info-square-fill',
                ],
                [
                    'title' => 'Plan de Estudio',
                    'route' => 'study-plan.index',
                    'icon' => 'bi bi-journal-check',
                ],
                [
                    'title' => 'Avatares',
                    'route' => 'avatar.index',
                    'icon' => 'bi bi-person-badge-fill',
                ],
                [
                    'title' => 'Temas de Interfaz',
                    'route' => 'theme.index',
                    'icon' => 'bi bi-palette-fill',
                ],
            ]"></x-aside-admin>
            <div class="col-lg-10 col-12 bg-white-border main__content">
                <div class="delete-card">
                    <div class="delete-card__header">
                        <b class="delete-card__title text__red">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Eliminar Avatar: {{ $data->name_avatar }}
                        </b>
                        <br>
                        <span class="delete-card__subtitle">
                            Esta acción no se puede deshacer. Por favor, asegúrate de querer borrar este personaje.
                        </span>
                        <hr class="delete-card__divider">
                    </div>
                    <div class="delete-card__body ">
                        <i class="delete-card__alert-label text__red">Advertencia Crítica:</i>

                        <p class="delete-card__description mt-2">
                            Está a punto de eliminar el avatar <strong>"{{ $data->name }}"</strong>.
                            Actualmente, este personaje está siendo utilizado por:
                            <br>
                            <span class="delete-card__players-count  mt-2" style="  ">
                                <i class="bi bi-people-fill"></i> {{ $countAvatar }}
                                Jugador{{ $countAvatar > 1 ? 'es' : '' }}
                            </span>
                        </p>
                        <p class="text-muted small">
                            Si confirma, estos usuarios jugadores se quedarán con la imagen de perfil "Defecto" y
                            deberán elegir una nueva si es necesario.
                        </p>
                        <figure class="my-4">
                            <img src="{{ asset('img/avatars/' . $data->url) }}" alt="{{ $data->name_avatar }}"
                                draggable="false"
                                style="max-width: 120px;     clip-path: circle(39% at 50% 50%); border: 3px solid #f8d7da;">
                        </figure>
                    </div>

                    <hr class="delete-card__divider">
                    <div class="delete-card__actions form-actions flex-and-direction-row flex-content-space-between mt-3">

                        <a href="{{ route('avatar.index') }}" class="button text__gray" style="text-decoration: none;">
                            <i class="bi bi-arrow-left-circle"></i> Cancelar, conservar registro
                        </a>

                        <form action="{{ route('avatar.destroy', $data->slug) }}" method="POST"
                            class="delete-card__form">
                            @method('DELETE')
                            @csrf
                            <button class="button button__color-red" type="submit">
                                <i class="bi bi-trash3-fill"></i> Confirmar Eliminación
                            </button>
                        </form>
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
