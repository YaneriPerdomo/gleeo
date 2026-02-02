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
</head>

<body class="flex-and-direction-column height-full">
    <x-header  notificationIsActiveCount="{{ $notificationIsActiveCount }}"></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article   container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Representantes y <br> Profesionales',
                    'route' => 'representative.index',
                    'icon' => 'bi bi-people-fill',
                ],
            ]"></x-aside-admin>
            <div class="col-lg-10 col-12 bg-white-border main__content">
                <div class="delete-card">
                    <div class="delete-card__header">
                        <b class="delete-card__title">
                            <i class="bi bi-exclamation-diamond"></i>
                            Eliminar perfil de {{ $data->gender_id == 1 ? 'Jugador' : 'Jugadora' }}:
                            {{ $data->user->user }}
                        </b>
                        <br>
                        <span class="delete-card__subtitle delete-card__subtitle--warning">
                            Esta acción es irreversible y eliminará toda la información asociada.
                        </span>
                        <hr class="delete-card__divider">
                    </div>

                    @if (session('alert-danger'))
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-octagon-fill"></i> {{ session('alert-danger') }}
                        </div>
                    @endif
                    <div class="delete-card__body">
                        <i class="delete-card__alert-label text__red">Aviso de Seguridad:</i>
                        <p class="delete-card__description">
                            Está a punto de borrar definitivamente el registro de: <strong>{{ $data->names }}
                                {{ $data->surnames }}</strong>.
                            Al confirmar, se perderá permanentemente el acceso a la cuenta, así como todo el historial
                            de aprendizaje, logros y progreso alcanzado hasta la fecha.
                        </p>
                    </div>

                    <hr class="delete-card__divider">
                    <div class="delete-card__actions form-actions flex-and-direction-row flex-content-space-between">
                        <a href="{{ route('children.index') }}" class="delete-card__link">
                            <button class="button button__color-green " type="button">
                                <i class="bi bi-box-arrow-in-left"></i> Cancelar, conservar registro
                            </button>
                        </a>

                        <form action="{{ route('children.destroy', $data->slug) }}" method="POST"
                            class="delete-card__form">
                            @method('DELETE')
                            @csrf

                            <button class="button button__color-red" type="submit">
                                <i class="bi bi-trash-fill"></i> Sí, confirmar eliminación definitiva
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
