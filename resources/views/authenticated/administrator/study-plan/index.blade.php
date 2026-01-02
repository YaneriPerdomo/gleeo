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
                        Plan de Estudio
                    </a>
                </small>
                <br>
                <div class="flex-and-direction-row flex-content-space-between p-0">
                    <div>
                        <legend><b>Listado de Niveles</b></legend>
                        <div class="search ">
                            <div class="input-group  search__seeker">
                                <span class="search__icon-wrapper input-group-text" id="product-name-addon">
                                    <i class="bi bi-search search__icon"></i>
                                </span>
                                <input type="text" name="name" id="name"
                                    class="search__input  search__input--text form-control"
                                    data-url="/plataforma-educativa/plan-de-estudio"
                                    placeholder="Ingrese el nombre del nivel" aria-label="Ingrese el nombre del nivel"
                                    autofocus
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
                        <a href="{{ route('study-plan.create') }}">
                            <button class="button button__color-black color-white" type="button">
                                <i class="bi bi-plus-lg"></i> Agregar Nuevo Nivel
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
                <div>
                    <section class="levels-cards flex-and-direction-row gap-5">
                        @if ($levels->items() == [])
                            <tr>
                                <td colspan="7" style="text-align: center;">
                                    @if (isset($searchValue))
                                        <div>

                                            <p>Por el momento no hay registros que coincidan con tu búsqueda.</p>
                                            <p>Te sugerimos:</p>
                                            <ul>
                                                <li>Revisa la ortografía de la palabra.</li>
                                                <li>Utiliza palabras más genéricas o menos palabras.</li>
                                            </ul>
                                        </div>
                                    @else
                                        <br>
                                        <p>Por el momento no hay registros.</p>
                                    @endif
                                </td>
                            </tr>
                        @else
                            @foreach ($levels->items() as $level)
                                <div class="levels-cards__content">
                                    <button type="button" class="button" data-level="{{ $level->number }}"
                                        data-slug="{{ $level->slug }}" data-bs-toggle="modal"
                                        data-route="{{ route('study-plan.level-index', ['nivel' => 'eliminarlo']) }}"
                                        data-bs-target="#inforLevelModal">
                                        <div class="levels-cards__card flex-and-direction-column flex-center-full">
                                            <i
                                                class="
                                                                            @if ($level->module->count() == 0) bi bi-hourglass-top fs-1
                                                                            @else
                                                                                bi bi-check fs-1 @endif
                                                                            "></i>
                                        </div>
                                        <div
                                            class="levels-cards__card-title text-center flex-and-direction-column flex-center-full ">
                                            <span>
                                                Nivel {{ $level->number }} <br>
                                                <i class="text__gray">
                                                    {{ $level->name }}
                                                </i>
                                            </span>
                                        </div>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        <div class="modal fade " id="inforLevelModal" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg__color-purple text-white">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Operaciones</b></h1>
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body flex-and-direction-row flex-center-full flex-gap-0-5">
                                        <a href="" class="modal-buttons__link-platform">
                                            <button type="button" class="button button__color-gold ">
                                                <label for=""><i class="bi bi-journal-bookmark-fill fs-3"></i>
                                                    <br>Plataforma</label>
                                            </button>
                                        </a>
                                        <a href="" class="modal-buttons__link-edit">
                                            <button type="button" class="button button__color-green ">

                                                <label for=""><i class="bi bi-pencil-square fs-3"></i>
                                                    <br>Editar</label>
                                            </button>
                                        </a>
                                        <a href="" class="modal-buttons__link-delete">
                                            <button type="button" class="button button__color-red">
                                                <label for=""><i class="bi bi-trash-fill fs-3"></i> <br>
                                                    Eliminar</label>
                                            </button>
                                        </a>

                                    </div>
                                    <div class="modal-footer flex-and-direction-row flex-center-full-start ">
                                        <button type="button" class="button  text__gray"
                                            data-bs-dismiss="modal">Cerrar</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            let infoLevelButtons = document.querySelectorAll('[data-bs-target="#inforLevelModal"]');
                            let levelIdModalInput = document.querySelector('#level_id');
                            let buttonLinkPlatform = document.querySelector('.modal-buttons__link-platform');
                            let buttonLinkDelete = document.querySelector('.modal-buttons__link-delete');
                            let buttonLinkEdit = document.querySelector('.modal-buttons__link-edit');
                            infoLevelButtons.forEach(button => {
                                button.addEventListener('click', function(event) {
                                    let levelData = this.getAttribute('data-level');
                                    let slugData = this.getAttribute('data-slug');
                                    let routeData = this.getAttribute('data-route').replace('/eliminarlo', '');
                                    buttonLinkPlatform.href = routeData + '/' + slugData;
                                    buttonLinkDelete.href = routeData + '/' + slugData + '/eliminar';
                                    buttonLinkEdit.href = routeData + '/' + slugData + '/editar';
                                    console.info(routeData);
                                    console.info("Datos del nivel seleccionado:", levelData);
                                });
                            });
                        </script>
                    </section>
                    <div class="flex-and-direction-row flex-content-space-between mt-2 ">
                        <div>
                            <small class="text__gray">
                                Mostrando {{ $levels->count() == 1 ? ' registro' : 'registros' }} 1 -
                                {{ $levels->count() }}
                                de un total de {{ $levels->total() }}
                            </small>
                        </div>
                        <div>
                            {{ $levels->links() }}
                        </div>
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
