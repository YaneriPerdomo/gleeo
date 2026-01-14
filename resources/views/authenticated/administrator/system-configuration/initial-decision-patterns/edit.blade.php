<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Umbrales de Alerta Intervención Requerida | <x-system-name name="Gleeo"></x-system-name>
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
    <style>
        .flex-gap-0-5 {
            gap: 0.5rem;
        }

        .is-invalid--border{
            border:  solid 1px var(--red);
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Patrones de Decisión Iniciales del Tutor Inteligente',
                    'route' => 'initial-decision-patterns.index',
                    'icon' => 'bi bi-gear-wide-connected',
                ],
                [
                    'title' => 'Umbrales de Alerta Intervención Requerida',
                    'route' => 'alert-thresholds.index',
                    'icon' => 'bi bi-bell-fill',
                ],
            ]"></x-aside-admin>
            <div class="col-10 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('initial-decision-patterns.index') }}" class="text__gray">
                        Configuración del Tutor  </a>
                    >
                    <a href="{{ route('initial-decision-patterns.index') }}" class="text__gray"> Patrones de Decisión
                        Iniciales del Tutor Inteligente </a>
                    >
                    <a href="{{ route('initial-decision-patterns.edit') }}" class="text__gray"> Configurar Parámetros
                    </a>
                </small>
                <form action="{{ route('initial-decision-patterns.update') }}" method="POST" class="form ">
                    @csrf
                    @method('PUT')
                    <legend class="form__title">
                        <b> Configurar Patrones de Decisión
                            Iniciales del Tutor Inteligente</b>
                    </legend>
                    @if (session('alert-success'))
                    <div class="alert alert-success"><i class="bi bi-check-circle-fill"></i>
                        {{ session('alert-success') }}</div>
                    @endif
                    @if (session('alert-danger'))
                    <div class="alert alert-danger" role="alert"><i class="bi bi-x-octagon-fill"></i>
                        {{ session('alert-danger') }}</div>
                    @endif
                    <div class="row mt-4">
                        <fieldset class="col-6">
                            <legend class="fs-5 mb-3">
                                Umbral de Ayuda Inmediata (Contenido de
                                Esfuerzo)
                            </legend>
                            <x-input-text :item="
                                [
                                    'form_input_name' => 'refuerzo_limit',
                                    'form_title' => 'Límite de Fallos para Refuerzo (CE):',
                                    'type' => 'text',
                                    'icon' => 'bi-x-octagon-fill',
                                    'aria_label' => 'Límite de fallos consecutivos antes de activar el Contenido de Esfuerzo.',
                                    'placeholder' => 3,
                                    'form_input_value_default' => $data->refuerzo_fail_limit ?? 0,
                                    'attribute_a' => 'min=1',
                                    'form_help_text' => 'Cantidad de errores consecutivos para que el sistema active automáticamente el Contenido de Esfuerzo (CE) remedial.'
                                ]"></x-input-text>
                        </fieldset>
                        <fieldset class="col-6">
                            <legend class="fs-5 mb-3">
                                Estado y Umbral de Notificación (Profesor)
                            </legend>
                            <div class="form__item">
                                <label for="pattern_status" class="form__label">Estado del Patrón:</label>
                                <div class="input-group">
                                    <span
                                        class="form__icon input-group-text @error('pattern_status') is-invalid--border @enderror">
                                        <i class="bi bi-toggle-on "></i>
                                    </span>
                                    <select id="pattern_status" name="pattern_status"
                                        class="form-control form__input-select @error('pattern_status') is-invalid @enderror">
                                        <option disabled selected>Seleccione una opción</option>
                                        <option value="activo" @if ( $data->is_active == 1)
                                            selected
                                            @endif >Activo</option>
                                        <option value="inactivo" @if ( $data->is_active == 0)
                                            selected
                                            @endif
                                            >Inactivo</option>
                                    </select>
                                </div>
                                @error('pattern_status')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="form-help text-muted mt-1">
                                    <small>Define si este patrón de decisión se encuentra activo o inactivo para los
                                        estudiantes.</small>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <hr>
                    <div class="flex-and-direction-row flex-content-space-between  form-actions mt-4">
                        <a href="{{ route('initial-decision-patterns.index') }}">
                            <button type="button" class="button text__gray">
                                <i class="bi bi-box-arrow-in-left"></i> Regresar
                            </button>
                        </a>
                        <button type="submit" class="button button__color-purple">
                            <i class="bi bi-save"></i> Guardar Configuración
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
