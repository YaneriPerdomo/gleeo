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
    <link rel="stylesheet" href="{{ asset('css/components/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/text.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    <style>
        .levels-cards__card {
            background: #7a5bd2;
            padding: 0.3rem;
            border-radius: 100%;
            border-radius: 100%;
            outline-color: #7a5bd2;
            outline-offset: 0.2rem;
            outline-style: solid;
            outline-width: 5px;
            color: white;
            width: clamp(65px, 7vw, 75px);
            text-align: center;

        }

        .levels-cards__card-title {
            width: clamp(65px, 7vw, 75px);
            margin-top: 0.5rem;
        }

        .levels-cards {
            margin-top: 1rem;
        }

        .levels-cards__card-title {
            margin-top: 0.8rem;
            text-align: center;
            color: var(--purple);
            font-weight: bold;
            line-height: 1.2;

        }

        .table__avatar-img {
            width: 70px;
            clip-path: circle(39% at 50% 50%);
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
                    'title' => 'Insignias',
                    'route' => 'initial-decision-patterns.index',
                    'icon' => 'bi bi-patch-check-fill',
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
            <div class="  col-10 bg-white-border main__content">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray"> Gestion de Contenido > </a>
                    <a href="{{ route('study-plan.index') }}" class="text__gray">
                        Temas de Interfaz
                    </a>
                </small>
                <br>
                <div class="flex-and-direction-row flex-content-space-between p-0">
                    <div>
                        <legend><b>Listado de Avatares</b></legend>
                        <div class="search ">
                            <div class="input-group  search__seeker">
                                <span class="search__icon-wrapper input-group-text" id="product-name-addon">
                                    <i class="bi bi-search search__icon"></i>
                                </span>
                                <input type="text" name="name" id="name"
                                    class="search__input  search__input--text form-control"
                                    data-url="/plataforma-educativa/avatares"
                                    placeholder="Ingrese el nombre del avatar a buscar"
                                    aria-label="Ingrese el nombre del avatar a buscar" autofocus
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
                        <a href="{{ route('avatar.create') }}">
                            <button class="button button__color-black color-white" type="button">
                                <i class="bi bi-plus-lg"></i> Agregar Nuevo Avatar
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

                <section class='table'>
                    <table class='dataTable'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Imagen</th>
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
                                        <td>{{ $value->name ?? '' }}</td>
                                        <td>
                                            <img src="{{ asset('img/avatars/' . $value->url) }}"
                                                class="table__avatar-img" alt="" draggable="false"
                                                title="{{ $value->name }}">
                                        </td>
                                        <td>
                                            {{ formatting_date($value->created_at) }}
                                        </td>
                                        @if ($value->avatar_id != '1')
                                            <td class='table__operations'>
                                                <a href=" ">
                                                    <button class="button button__color-green">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('avatar.delete', $value->slug ?? null) }}">
                                                    <button type="button" class="button button__color-red ">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        @endif
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
</body>

</html>
