<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informacion Personal | <x-system-name name="Gleeo"></x-system-name>
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


            <div class="col-10 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Gestión de Contenido</a> >
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Plan de Estudio</a> >
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Nivel {{ $infoLevel->number ?? '' }} - {{ $infoLevel->name ?? '' }}</a> >
                    <span>Registrar Nuevo Tema </span>
                </small>

                <form
                    action="{{ route('topic.store', ['nivel' =>  $slugLevel ?? '', 'slug' => $slugModule]) }}"
                    class="form" method="POST">
                    @csrf
                    @method('POST')

                    <legend class="form__title">
                        <b> Registrar Nuevo Tema</b>
                    </legend>

                    @if (session('alert-success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle-fill"></i> {{ session('alert-success') }}
                        </div>
                    @endif

                    @if (session('alert-danger'))
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-octagon-fill"></i> {{ session('alert-danger') }}
                        </div>
                    @endif

                        <x-input-text :item="[
                        'form_input_name' => 'topic_title',
                        'form_title' => 'Nombre del Tema:',
                        'type' => 'text',
                        'icon' => 'bi-journal-bookmark-fill',
                        'aria_label' => 'Introduce el nombre del tema.',
                        'placeholder' => 'Números Naturales',
                        'form_input_value_default' => old('topic_title'),
                        'attribute_a' => 'required',
                        'form_help_text' => 'Título del primer tema asociado a este módulo.',
                    ]"></x-input-text>



                    <hr>
                     <div class="flex-and-direction-row flex-content-space-between form-actions mt-4">
                        <a href=" {{ route('study-plan.level-index', ['nivel' => $slugLevel ?? '']) }}" class="button text__gray" style="text-decoration: none;">
                            <i class="bi bi-box-arrow-in-left"></i> Regresar
                        </a>

                        <button type="submit" class="button button__color-purple">
                            <i class="bi bi-plus-lg"></i> Registrar Nuevo Tema
                        </button>
                    </div>
                </form>
            </div>

        </article>
        <script src="{{ asset('js/components/header.js') }}" type="module"></script>
    </main>
    <x-footer name="Gleeo"></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
