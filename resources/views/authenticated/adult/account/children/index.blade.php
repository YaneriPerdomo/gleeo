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
</head>

<body class="flex-and-direction-column height-full">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article   container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Jugadores',
                    'route' => 'children.index',
                    'icon' => 'bi bi-person-video3',
                ],
            ]"></x-aside-admin>
            <div class="  col-10 bg-white-border main__content">
                <div class="flex-and-direction-row flex-content-space-between p-0">
                    <div>
                        <legend><b>Listado de Jugadores</b></legend>
                        <div class="search ">
                            <div class="input-group  search__seeker">
                                <span class="search__icon-wrapper input-group-text" id="product-name-addon">
                                    <i class="bi bi-search search__icon"></i>
                                </span>
                                <input type="text" name="name" id="name"
                                    class="search__input  search__input--text form-control"
                                    data-url="/gestion-de-cuentas" placeholder="Ingrese usuario o correo electronico"
                                    aria-label="Ingrese usuario o correo electronico" autofocus
                                    data-name="{{ isset($searchValue) ? str_replace('-', ' ', $searchValue) : '' }}"
                                    value="{{ isset($searchValue) ? str_replace('-', ' ', $searchValue) : '' }}">
                            </div>
                            <div class="search__action">
                                <button class="button search__button   button__color-purple color-white" type="button">
                                    <i class="bi bi-search"></i>
                                    Buscar
                                </button>
                            </div>
                        </div>
                        <script type="module" src="{{ asset('js/components/buttonSearch.js') }}"></script>
                    </div>
                    <div>
                        <a href="{{ route('children.create') }}">
                          <button class="button  button__color-black">
                            <i class="bi bi-plus-lg"></i> Agregar Nuevo Jugador
                        </button>
                        </a>

                    </div>
                </div>
                <div class="">
                    @if (session('alert-success'))
                        <div class="alert alert-success">
                            {!! session('alert-success') !!}
                        </div>
                    @endif

                    <section class='table'>
                        <table class='dataTable'>
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Usuario</th>

                                    <th>Edad Actual</th>
                                    <th>Nivel Actual</th>
                                    <th>
                                        Estado
                                    </th>
                                    <th>Ultimo Acceso</th>
                                    <th>Fecha de Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->items() == [])
                                    <tr>
                                        <td colspan="7" style="text-align: center;">
                                            @if (isset($searchValue))
                                                <br>
                                                <p>Por el momento no hay registros que coincidan con tu búsqueda.</p>
                                                <ul>
                                                    <li>Revisa la ortografía de la palabra.</li>
                                                    <li>Utiliza palabras más genéricas o menos palabras.</li>
                                                </ul>
                                            @else
                                                <br>
                                                <p>Por el momento no hay registros.</p>
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($data->items() as $value)
                                        <tr class='show'>
                                            <td>{{ $value->names ?? '' }}</td>
                                            <td>{{ $value->surnames ?? '' }}</td>
                                            <td>{{ $value->user->user ?? '' }}</td>
                                            <td>
                                                @php
                                                    $anioNacimiento = substr($value->date_of_birth, 0, 4);
                                                    $anioActual = date('Y');
                                                    echo intval($anioActual) - intval($anioNacimiento) . ' ';
                                                    echo ' ' .
                                                        intval($anioActual) -
                                                        intval($anioNacimiento) >
                                                    1
                                                        ? 'Años'
                                                        : 'Año';
                                                @endphp
                                            </td>
                                            <th>Nivel {{ $value->level_assigned->number ?? ''}} - {{ $value->level_assigned->name ?? '' }} </th>
                                            <td>
                                                @php
                                                    $badgeClass = match ($value->user->state ?? '') {
                                                        1 => 'bg-success',
                                                        0 => 'bg-danger',
                                                        default => 'bg-secondary',
                                                    };
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">
                                                    @if ($value->user->state ?? '' == 1)
                                                        {{ $value->gender_id == 1 ? 'Activo' : 'Activa' }}
                                                    @else
                                                        {{ $value->gender_id == 1 ? 'Inactivo' : 'Inactiva' }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                {{ formatting_date($value->user->last_session ?? '') }}
                                            </td>
                                            <td>
                                                {{ formatting_date($value->user->created_at ?? '') }}
                                            </td>
                                            <td class='table__operations'>
                                                <a href=" ">
                                                    <button type="button" class="button button__color-gold ">
                                                        <i class="bi bi-card-list"></i>
                                                    </button>
                                                </a>
                                                <a href="">
                                                    <button class="button button__color-green">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </a>
                                                <a href="">
                                                    <button type="button" class="button button__color-red ">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </section>

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
