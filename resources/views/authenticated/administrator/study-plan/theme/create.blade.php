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
            <div class="col-lg-10 col-12 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Gestión de Contenido</a> >
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Plan de Estudio</a> >
                    >
                    <span>Registrar Nuevo Módulo </span>
                </small>

                <form action="{{ route('theme.store') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <legend class="form__title">
                        <b> Agregar Nuevo Tema de Interfaz</b>
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
                        <fieldset class="col-4 col-12">
                            <legend class="h5 ">Información
                                General</legend>
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'name',
                                        'form_title' => 'Nombre del Tema:',
                                        'type' => 'text',
                                        'icon' => 'bi-pencil-square',
                                        'aria_label' => 'Nombre del tema visual',
                                        'placeholder' => 'Selva de Números',
                                        'form_input_value_default' => old('name'),
                                        'attribute_a' => '',
                                        'form_help_text' => 'El título principal que aparecerá en la interfaz.',
                                    ]"></x-input-text>
                                    <div class="form__item ">



                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="col-lg-12 col-6 mb-4">
                            <legend class="h5 ">Configuración de
                                Colores</legend>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'main_color',
                                        'form_title' => 'Color Principal:',
                                        'type' => 'color',
                                        'icon' => 'bi-droplet-fill',
                                        'aria_label' => 'Selecciona el color primario',
                                        'form_input_value_default' => old('main_color', '#7052c2'),
                                        'attribute_a' => 'required',
                                        'placeholder' => '',

                                        'form_help_text' => 'Color de botones y cabeceras.',
                                    ]"></x-input-text>
                                    <x-input-text :item="[
                                        'form_input_name' => 'topic_color',
                                        'form_title' => 'Color de la Barra del Tema:',
                                        'type' => 'color',
                                        'icon' => 'bi-paint-bucket',
                                        'aria_label' => 'Selecciona el color primario',
                                        'placeholder' => '',
                                        'attribute_a' => '',
                                        'form_input_value_default' => old('topic_color', '#ef7440'),
                                        'form_help_text' => 'Este color se verá en la barra horizontal del tema.',
                                    ]"></x-input-text>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'secondary_color',
                                        'form_title' => 'Color Secundario:',
                                        'type' => 'color',
                                        'icon' => 'bi-droplet-half',
                                        'aria_label' => 'Selecciona el color secundario',
                                        'form_input_value_default' => old('secondary_color', '#ef7440'),
                                        'attribute_a' => 'required',
                                        'placeholder' => '',

                                        'form_help_text' => 'Color para elementos de acento.',
                                    ]"></x-input-text>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="col-lg-12 col-6 mb-4">
                            <legend class="h5 ">Apariencia
                                del Fondo</legend>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'solid_background',
                                        'form_title' => 'Color de Fondo Sólido:',
                                        'type' => 'color',
                                        'icon' => 'bi-paint-bucket',
                                        'aria_label' => 'Color de fondo sólido',
                                        'form_input_value_default' => old('solid_background', '#ffffff'),
                                        'attribute_a' => 'required',
                                        'placeholder' => '',

                                        'form_help_text' => 'Fondo base si no hay imagen activa.',
                                    ]"></x-input-text>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'background_path',
                                        'form_title' => 'Patrón o Imagen de Fondo:',
                                        'type' => 'file',
                                        'icon' => 'bi-image-fill',
                                        'aria_label' => 'Sube la imagen de fondo',
                                        'form_input_value_default' => '',
                                        'attribute_a' => 'accept=image/*',
                                        'placeholder' => '',
                                        'form_help_text' => 'Se repetirá como patrón en la pantalla.',
                                    ]"></x-input-text>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <hr>
                    <div class="flex-and-direction-row flex-content-space-between form-actions mt-4">
                        <a href="{{ route('theme.index') }}" class="button text__gray" style="text-decoration: none;">
                            <i class="bi bi-box-arrow-in-left"></i> Regresar
                        </a>

                        <button type="submit" class="button button__color-purple">
                            <i class="bi bi-plus-lg"></i> Agregar Nuevo Tema de Interfaz
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
