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
            <div class="col-10 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Gestión de Contenido</a> >
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Plan de Estudio</a> >
                    >
                    <span>Registrar Nuevo Módulo </span>
                </small>

                <form action="{{ route('theme.update', $data->slug) }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                        <fieldset class="col-md-12 mb-4">
                            <legend class="h5 ">Información
                                General</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'theme_title',
                                        'form_title' => 'Nombre del Tema:',
                                        'type' => 'text',
                                        'icon' => 'bi-pencil-square',
                                        'aria_label' => 'Nombre del tema visual',
                                        'placeholder' => 'Selva de Números',
                                        'form_input_value_default' => old('theme_title', $data->name),
                                        'attribute_a' => 'required',
                                        'form_help_text' => 'El título principal que aparecerá en la interfaz.',
                                    ]"></x-input-text>

                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="col-md-12 mb-4">
                            <legend class="h5 ">Configuración de
                                Colores</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'main_color',
                                        'form_title' => 'Color Principal:',
                                        'type' => 'color',
                                        'icon' => 'bi-droplet-fill',
                                        'aria_label' => 'Selecciona el color primario',
                                        'form_input_value_default' => old('main_color', $data->main_color),
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
                                        'form_input_value_default' => old('topic_color', $data->topic_color),
                                        'form_help_text' => 'Este color se verá en la barra horizontal del tema.',
                                    ]"></x-input-text>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'secondary_color',
                                        'form_title' => 'Color Secundario:',
                                        'type' => 'color',
                                        'icon' => 'bi-droplet-half',
                                        'aria_label' => 'Selecciona el color secundario',
                                        'form_input_value_default' => old('secondary_color', $data->secondary_color),
                                        'attribute_a' => 'required',
                                        'placeholder' => '',

                                        'form_help_text' => 'Color para elementos de acento.',
                                    ]"></x-input-text>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="col-md-12 mb-4">
                            <legend class="h5 ">Apariencia
                                del Fondo</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'solid_background',
                                        'form_title' => 'Color de Fondo Sólido:',
                                        'type' => 'color',
                                        'icon' => 'bi-paint-bucket',
                                        'aria_label' => 'Color de fondo sólido',
                                        'form_input_value_default' => old(
                                            'solid_background',
                                            $data->background_path == null ? $data->solid_background : '#ffffff',
                                        ),
                                        'attribute_a' => 'required',
                                        'placeholder' => '',

                                        'form_help_text' => 'Color de fondo aplicado tras modificar la configuración predeterminada. *rgb(255, 255, 255)*',
                                    ]"></x-input-text>
                                </div>
                                <div class="col-md-6 mb-3">

                                    <div class="form__item">
                                        <label for="background_path" class="form__label form__label--required">Patrón o
                                            Imagen de Fondo:</label>
                                        <div class="input-group">
                                            <span
                                                class="form__icon input-group-text @error('background_path') is-invalid--border @enderror"
                                                id="img-addon">
                                                <i class="bi bi-card-image"></i>
                                            </span>
                                            <input type="file" name="background_path" id="background_path"
                                                class="form-control @error('background_path') is-invalid @enderror"
                                                aria-label="Imagen del Negocio" style="display: none;" accept="image/*"
                                                data-img="{{ $data->background_path != null ? 'true' : 'false' }}">
                                            <label for="background_path" class="btn btn-outline-secondary">Seleccionar
                                                Imagen</label>
                                            <span id="file-name-display" class="ms-3 text-muted">
                                                <input type="hidden" name="url" value="{{ $data->background_path }}">
                                                {{ $data->background_path != null ? $data->background_path : 'Ningún archivo seleccionado' }}
                                            </span>
                                        </div>
                                        <small class="text__gray">
                                            Se repetirá como patrón en la pantalla.
                                        </small>
                                        @error('background_path')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const fileInput = document.getElementById('background_path');
                                                const fileNameDisplay = document.getElementById('file-name-display');

                                                fileInput.addEventListener('change', function(e) {
                                                    if (this.files.length > 0) {
                                                        fileNameDisplay.textContent = this.files[0].name;
                                                    } else {
                                                        fileNameDisplay.textContent = this.getAttribute('data-img') === 'true' ?
                                                            'logo-de-la-empresa.png' :
                                                            'Ningún archivo seleccionado';
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>
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
