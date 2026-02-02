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
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Contenido de Esfuerzo',
                    'route' => 'initial-decision-patterns.index',
                    'icon' => 'bi bi-gear-wide-connected',
                ],
                [
                    'title' => 'Intervención Requerida',
                    'route' => 'alert-thresholds.index',
                    'icon' => 'bi bi-bell-fill',
                ],
            ]"></x-aside-admin>
            <div class="col-lg-10 col-12 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('initial-decision-patterns.index') }}" class="text__gray"> Configuración del
                        Tutor > </a>
                    <a href="{{ route('alert-thresholds.index') }}" class="text__gray"> Umbrales de Alerta Intervención
                        Requerida</a> > <a href="{{ route('alert-thresholds.edit') }}" class="text__gray"> Configurar
                        Parámetros</a>
                </small>
                <form action="{{ route('alert-thresholds.update') }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    <legend class="form__title">
                        <b>Configurar Umbrales de Intervención </b>
                    </legend>
                    @if (session('alert-success'))
                        <div class="alert alert-success"><i class="bi bi-check-circle-fill"></i>
                            {{ session('alert-success') }}</div>
                    @endif
                    @if (session('alert-danger'))
                        <div class="alert alert-danger" role="alert"><i class="bi bi-x-octagon-fill"></i>
                            {{ session('alert-danger') }}</div>
                    @endif

                    @php
                        $count = 0;
                    @endphp
                    @foreach ($data as $key => $value)
                        @php
                            $count++;
                        @endphp
                        <fieldset>
                            <input type="hidden" name="id_{{ $count }}" value="{{ $value->alert_config_id }}">
                            <legend>
                                Nivel de Acceso de {{ $value->level->name }}
                            </legend>
                            <div class="row">
                                <fieldset class="col-lg-6 col-12">
                                    <legend class="fs-5 mb-3 ">Umbral de Activación de Ayuda</legend>
                                    <x-input-text :item="[
                                        'form_input_name' => 'max_errors_allowed_' . $count,
                                        'form_title' => 'Activaciones de CE para Alerta:',
                                        'type' => 'text',
                                        'icon' => 'bi-exclamation-octagon-fill',
                                        'aria_label' =>
                                            'Límite de fallos consecutivos antes de activar el Contenido de Esfuerzo.',
                                        'placeholder' => 3,
                                        'form_input_value_default' => old(
                                            'max_errors_allowed_' . $count,
                                            $value->max_errors_allowed,
                                        ),
                                        'attribute_a' => '',
                                        'form_help_text' =>
                                            'Veces que el estudiante debe activar el Contenido de Esfuerzo (CE) antes de generar una alerta al profesor.',
                                    ]"></x-input-text>
                                </fieldset>
                                <fieldset class="col-lg-6 col-12">
                                    <legend class="fs-5 mb-3 ">Ventana de Medición Temporal</legend>
                                    <div class="form__item">
                                        <label for="time_window" class="form__label">Ventana de
                                            Tiempo(Frecuencia):</label>
                                        <div class="input-group">
                                            <span
                                                class="form__icon input-group-text @error('time_window') is-invalid--border @enderror">
                                                <i class="bi bi-calendar-date-fill "></i>
                                            </span>
                                            <select id="time_window" name="time_window_{{ $count }}"
                                                class="form-control initial-decision-patterns__select @error('time_window') is-invalid @enderror">
                                                <option value="lesson" selected disabled>En una sola Lección</option>
                                                <option value="24 Horas"
                                                    @if (old('time_window_{{ $count }}', $data[0]->time_frame) == '24 Horas') selected @endif> 24 Horas (Día)
                                                </option>
                                                <option value="7 Dias"
                                                    @if (old('time_window_{{ $count }}', $data[0]->time_frame) == '24 Horas') selected @endif> 7 Días (Semana)
                                                </option>
                                                <option value="30 Dias"
                                                    @if (old('time_window_{{ $count }}', $data[0]->time_frame) == '24 Horas') selected @endif> 30 Días (Mes)
                                                </option>

                                            </select>
                                        </div>
                                        @error('time_window')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror

                                        <div class="initial-decision-patterns__form-help text-muted mt-1">
                                            <small>Periodo dentro del cual se contabilizan las activaciones de CE para
                                                disparar
                                                la alerta (e.g., por día, por semana).</small>
                                        </div>
                                    </div>
                                    <div class="form__item">
                                        <label for="state" class="form__label">Estado del Patrón:</label>
                                        <div class="input-group">
                                            <span
                                                class="form__icon input-group-text @error('state') is-invalid--border @enderror">
                                                <i class="bi bi-toggle-on "></i>
                                            </span>
                                            <select id="state" name="state_{{ $count }}"
                                                class="form-control form__input-select @error('state') is-invalid @enderror">
                                                <option disabled selected>Seleccione una opción</option>
                                                <option value="activo"
                                                    @if (old('state_' . $count, $value->state) == 1) selected @endif>Activo</option>
                                                <option value="inactivo"
                                                    @if (old('state_' . $count, $value->state) == 0) selected @endif>Inactivo</option>
                                            </select>
                                        </div>
                                        @error('state')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <div class="form-help text-muted mt-1">
                                            <small>Define si este patrón de decisión se encuentra activo o inactivo para
                                                los
                                                estudiantes.</small>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </fieldset>
                    @endforeach

                    <hr>
                    <div class="flex-and-direction-row flex-content-space-between  form-actions mt-4">
                        <a href="{{ route('alert-thresholds.index') }}">
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
