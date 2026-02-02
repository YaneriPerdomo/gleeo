<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Umbrales de Alerta Intervención Requerida | <x-system-name name="Gleeo"></x-system-name></title>
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
            @php

                $timeWindowValue_1 = $data[0]->time_window ?? null;
                $timeWindowDisplay_1 = match ($timeWindowValue_1) {
                    '24 Horas' => '24 Horas (Día)',
                    '7 Dias' => '7 Días (Semana)',
                    '30 Dias' => '30 Días (Mes)',
                    default => 'N/A',
                };
                $timeWindowValue_2 = $data[1]->time_window ?? null;
                $timeWindowDisplay_2 = match ($timeWindowValue_2) {
                    '24 Horas' => '24 Horas (Día)',
                    '7 Dias' => '7 Días (Semana)',
                    '30 Dias' => '30 Días (Mes)',
                    default => 'N/A',
                };
                $timeWindowValue_3 = $data[2]->time_window ?? null;
                $timeWindowDisplay_3 = match ($timeWindowValue_3) {
                    '24 Horas' => '24 Horas (Día)',
                    '7 Dias' => '7 Días (Semana)',
                    '30 Dias' => '30 Días (Mes)',
                    default => 'N/A',
                };
            @endphp

            @php
                $allParameters = [];

                foreach ($data as $value) {

                    $allParameters[] = [
                        'first_column_title' => $value->level->name ?? 'N/A',
                        'first_column_title_2' => '',
                        'first_column_title_3' => '',
                        'two_column_title' => 'Activaciones de CE',
                        'two_column_title_2' => 'para Alerta',
                        'value' => $value->max_errors_allowed,
                        'icon' => 'bi-bell-fill',
                        'thre_column_title' => 'Ventana de Tiempo',
                        'thre_column_title_value' => $value->time_frame,
                        'additional_column' => true,
                        'state' => $value->state
                    ];
                }
            @endphp


            <x-tutor-configuration-content description-parameters="Parámetros de Notificación al Profesor"
                class="alert-thresholds" title="Umbrales de Alerta Intervención Requerida" url="alert-thresholds.edit"
                :urls-beginning-end="[
                    [
                        'title' => 'Configuración del Tutor > ',
                        'url' => 'alert-thresholds.index',
                    ],
                    ['title' => 'Umbrales de Alerta Intervención Requerida', 'url' => 'alert-thresholds.index'],
                ]"
                paragraph="Este módulo configura los umbrales de alerta escalonada.
                    Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3)
                    dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de
                    Intervención Requerida para el profesional o representante."
                :parameters="$allParameters"
                ></x-tutor-configuration-content>
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
