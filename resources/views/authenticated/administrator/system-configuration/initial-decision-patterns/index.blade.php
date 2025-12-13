<!doctype html>
<html lang="es" class="height-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patrones de Decisión Iniciales del Tutor Inteligente | <x-system-name name="Gleeo"></x-system-name>
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
            <x-tutor-configuration-content
                description-parameters="Parametros de Activación del Contenido de Esfuerzo"
                class="initial-decision-patterns"
                title="Patrones de Decisión Iniciales del Tutor Inteligente"
                url="initial-decision-patterns.edit"
                 :urls-beginning-end="[
                    [
                        'title' => 'Configuración del Tutor > ',
                        'url' => 'alert-thresholds.index'
                    ],
                    ['title' => 'Patrones de Decisión Iniciales del Tutor Inteligente',
                    'url' => 'alert-thresholds.index']
                ]"
                paragraph="Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor."
                :parameters="[
                    [
                        'additional_column' => false,
                        'first_column_title' => 'Nivel de Acceso:',
                        'first_column_title_2' => 'Límite de Fallos',
                        'first_column_title_3' => 'para Refuerzo',
                        'two_column_title' => 'Límite de Fallos',
                        'two_column_title_2' => 'para Refuerzo',
                        'value' =>  $data->refuerzo_fail_limit ?? 0  ,
                        'thre_column_title' => 'Estado',
                        'thre_column_title_value' =>   $data->decision_pattern->is_active == 1 ? 'Activo' : 'Inactivo' ,
                        'icon' => 'bi-x-octagon',
                    ],
                ]"></x-tutor-configuration-content>
        </article>
        <script
            src="{{ asset('js/components/header.js') }}"
            type="module">
        </script>
    </main>
    <x-footer name="Gleeo"></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous">
    </script>
</body>
</html>
