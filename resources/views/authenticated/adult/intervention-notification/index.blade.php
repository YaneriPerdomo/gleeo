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
    <link rel="stylesheet" href="{{ asset('css/components/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/text.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    <style>
        .notification-data__card-img {
            width: 90px;
            margin-left: 0.8rem;
            clip-path: circle(39% at 50% 50%);
            object-fit: cover;
        }

        .is-active--circle {
            background: var(--black);
            width: 20px;
            height: 40px;
            clip-path: circle();

        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header notificationIsActiveCount="{{ $notificationIsActiveCount }}"></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article   container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Jugadores',
                    'route' => 'children.index',
                    'icon' => 'bi bi-person-video3',
                ],
            ]"></x-aside-admin>
            <div class="  col-lg-10 col-12 bg-white-border main__content">
                <div class="flex-and-direction-row flex-content-space-between p-0 flex-gap-0-5">
                    <div class="w-100">
                        <legend><b>Listado de Notificaciones de Intervención</b></legend>
                        @if (session('alert-success'))
                            <div class="alert alert-success mb-3"><i class="bi bi-check-circle-fill"></i>
                                {{ session('alert-success') }}</div>
                        @endif
                        @if (session('alert-danger'))
                            <div class="alert alert-danger mb-3" role="alert"><i class="bi bi-x-octagon-fill"></i>
                                {{ session('alert-danger') }}</div>
                        @endif
                        <div class="flex-and-direction-row flex-content-space-between">
                            <div class="search ">
                                <div class="input-group  search__seeker">
                                    <span class="search__icon-wrapper input-group-text" id="product-name-addon">
                                        <i class="bi bi-search search__icon"></i>
                                    </span>
                                    <input type="text" name="name" id="name"
                                        class="search__input  search__input--text form-control"
                                        data-url="/notificacion-de-intervencion"
                                        placeholder="Ingrese usuario o correo electronico"
                                        aria-label="Ingrese usuario o correo electronico" autofocus
                                        data-name="{{ isset($searchValue) ? str_replace('-', ' ', $searchValue) : '' }}"
                                        value="{{ isset($searchValue) ? str_replace('-', ' ', $searchValue) : '' }}">
                                </div>
                                <div class="search__action">
                                    <button class="button search__button   button__color-purple color-white"
                                        type="button">
                                        <i class="bi bi-search"></i>
                                        Buscar
                                    </button>
                                </div>
                            </div>
                            <script type="module" src="{{ asset('js/components/buttonSearch.js') }}"></script>

                            @if ($data->count() != 0)
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link text-secondary p-0" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <form action="{{ route('invervention-notification.update-all') }}"
                                                    method="POST">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="dropdown-item">Marcar Todas como
                                                        Leidas</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="notification-data mt-2">

                        @if ($data->items() == [])
                            @if (!isset($searchValue))
                                <br>
                                <p>Por el momento no hay registros que coincidan con tu búsqueda.</p>
                                <ul>
                                    <li>Revisa la ortografía de la palabra.</li>
                                    <li>Utiliza palabras más genéricas o menos palabras.</li>
                                </ul>
                            @else
                                <div class="text-center ">
                                    <p class="text__gray">No tienes notificaciones pendientes.</p>
                                </div>
                            @endif
                        @else
                            @foreach ($data as $value)
                                <div
                                    class="notification-data__card {{ $value->is_read ? 'notification-read' : 'notification-unread' }}">
                                    <div class="notification-data__card-content d-flex align-items-center"
                                        style="gap: 0.75rem;">

                                        {{-- Avatar --}}
                                        <figure class="mb-0">
                                            <img src="{{ asset('img/avatars/' . ($value->player->avatar->url ?? 'default.png')) }}"
                                                class="notification-data__card-img"
                                                alt="Avatar de {{ $value->player->name }}" draggable="false">
                                        </figure>

                                        {{-- Contenido --}}
                                        <div class="flex-grow-1">
                                            <p class="mb-0 text-dark">
                                                {{ $value->reason }}
                                                <strong>
                                                    Con un total de {{ $value->total_errors_detected }}
                                                    {{ Str::plural('error', $value->total_errors_detected) }}.
                                                </strong>
                                            </p>
                                            <small class="text-muted">
                                                {{ formatting_date_h($value->created_at) }}
                                            </small>
                                        </div>

                                        {{-- Acciones --}}
                                        <div class="dropdown">
                                            <button class="btn btn-link text-secondary p-0" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i> {{-- O el icono que prefieras --}}
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                @if (!$value->is_read)
                                                    <li>
                                                        <form
                                                            action="{{ route('invervention-notification.update', $value->notification_id) }}"
                                                            method="POST">
                                                            @csrf @method('PUT')
                                                            <button type="submit" class="dropdown-item">Marcar como
                                                                leída</button>
                                                        </form>
                                                    </li>
                                                @endif
                                                <li>
                                                    <form
                                                        action="{{ route('invervention-notification.destroy', $value->notification_id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item text-danger">Eliminar
                                                            notificación</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>

                                        {{-- Indicador de No Leído --}}
                                        @if (!$value->is_read)
                                            <span class="is-active--circle ms-2" title="Nueva notificación"></span>
                                        @endif
                                    </div>
                                    <hr class="my-3 opacity-25">
                                </div>
                            @endforeach

                        @endif

                        <div class="flex-and-direction-row flex-content-space-between">
                            <div>
                                <small class="text__gray">
                                    Mostrando {{ $data->count() == 1 ? ' registro' : 'registros' }} 1 -
                                    {{ $data->count() }}
                                    de un total de {{ $data->total() }}
                                </small>
                            </div>
                            <div>
                                {{ $data->links() }}
                            </div>
                        </div>
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
