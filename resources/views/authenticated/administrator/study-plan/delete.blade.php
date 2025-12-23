<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eliminar Módulo | <x-system-name name="Gleeo"></x-system-name>
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
</head>

<body class="flex-and-direction-column height-full">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Plan de Estudio',
                    'route' => 'study-plan.index',
                    'icon' => 'bi bi-book-half',
                ],
                [
                    'title' => 'Insignias',
                    'route' => 'initial-decision-patterns.index',
                    'icon' => 'bi bi-award-fill',
                ],
            ]"></x-aside-admin>


            <div class="col-10 bg-white-border main__content">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Plan de Estudio</a> >
                    <a href="#" class="text__gray">Nivel {{ $infoLevel['number'] }}</a> >
                    <span>Confirmar Eliminación</span>
                </small>

                <div class="delete-card mt-4">
                    <div class="delete-card__header">
                        <b class="delete-card__title">
                            <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                            Eliminar Nivel: {{ $infoLevel['name'] }}
                        </b>
                        <br>
                        <span class="delete-card__subtitle delete-card__subtitle--warning">
                            Esta acción es irreversible y borrará todo el contenido asociado.
                        </span>
                        <hr class="delete-card__divider">
                    </div>

                    <div class="delete-card__body">
                        <i class="delete-card__alert-label text__red">Advertencia de Impacto:</i>
                        <p class="delete-card__description">
                            Está a punto de eliminar permanentemente el <strong>"{{ $infoLevel['name'] }} (Nivel
                                {{ $infoLevel['number'] }})"</strong>.
                            Al confirmar, se eliminará el progreso de los alumnos y la siguiente estructura de
                            contenido:
                        </p>

                        <ul class="mt-2">
                            <li><strong>{{ $infoLevel['count']['modules'] }}</strong>
                                Módulo{{ $infoLevel['count']['modules'] >= 0 ? '' : 's' }}
                                asociado{{ $infoLevel['count']['modules'] >= 0 ? '' : 's' }}.
                            </li>
                            <li><strong>{{ $infoLevel['count']['topics'] }}</strong>
                                Tema{{ $infoLevel['count']['topics'] >= 0 ? '' : 's' }}
                                contenido{{ $infoLevel['count']['topics'] > 0 ? 's' : '' }}
                                en eso{{ $infoLevel['count']['modules'] >= 0 ? '' : 's' }}
                                módulo{{ $infoLevel['count']['modules'] >= 0 ? '' : 's' }}.</li>
                        </ul>
                    </div>

                    <hr class="delete-card__divider">

                    <div class="delete-card__actions d-flex justify-content-between align-items-center">
                        <a href="{{ route('study-plan.index') }}" class="delete-card__link">
                            <button class="button button__color-green" type="button">
                                <i class="bi bi-arrow-left-short"></i> Cancelar, conservar nivel
                            </button>
                        </a>

                        <form action="" method="POST" class="delete-card__form">
                            @method('DELETE')
                            @csrf
                            <button class="button button__color-red" type="submit">
                                <i class="bi bi-trash-fill"></i> Confirmar Eliminación Permanente
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </article>
        <script src="{{ asset('js/components/header.js') }}" type="module"></script>
    </main>
    <x-footer name="Gleeo"></x-footer>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
