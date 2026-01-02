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

<body class="flex-and-direction-column  ">
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
                    >
                    <span>Registrar Nuevo Módulo </span>
                </small>

                <form action="{{ route('avatar.store') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <legend class="form__title">
                        <b><i class="bi bi-person-plus-fill me-2"></i> Agregar Nuevo Avatar</b>
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

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-input-text :item="[
                                'form_input_name' => 'name_avatar',
                                'form_title' => 'Nombre del Avatar:',
                                'type' => 'text',
                                'icon' => 'bi-tag-fill',
                                'aria_label' => 'Introduce el nombre del avatar',
                                'form_input_value_default' => old('name_avatar'),
                                'attribute_a' => 'required',
                                'placeholder' => 'Súper Dustin',
                                'form_help_text' => 'Asigna un nombre divertido para este personaje.',
                            ]"></x-input-text>
                        </div>

                        <div class="col-md-6 mb-3">
                            <x-input-text :item="[
                                'form_input_name' => 'avatar_path',
                                'form_title' => 'Imagen del Personaje:',
                                'type' => 'file',
                                'icon' => 'bi-person-bounding-box',
                                'aria_label' => 'Sube la imagen del avatar',
                                'form_input_value_default' => '',
                                'attribute_a' => 'accept=image/* required',
                                'placeholder' => '',
                                'form_help_text' => 'Se recomienda una imagen cuadrada (PNG) sin fondo.',
                            ]"></x-input-text>
                        </div>
                    </div>

                    <hr>

                    <div class="flex-and-direction-row flex-content-space-between form-actions mt-4">
                        <a href="{{ route('avatar.index') }}" class="button text__gray" style="text-decoration: none;">
                            <i class="bi bi-arrow-left-circle"></i> Regresar a la lista
                        </a>

                        <button type="submit" class="button button__color-purple">
                            <i class="bi bi-save-fill"></i> Guardar Nuevo Avatar
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
