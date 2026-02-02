<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <style>
        /* Configuraciones críticas para PDF (DomPDF / Snappy) */
        @page {
            margin: 0.5cm;
        }

        body {
            font-family: "Helvetica", "Arial", sans-serif;
            background-color: #e3e3e3;
            margin: 0;
            padding: 20px;
            color: #2f2f2f;
        }

        .your-progress {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
        }

        /* Encabezado Púrpura - DATOS DEL USUARIO */
        .your-progress__top {
            background-color: #7052c2;
            padding: 25px;
            color: white;
            position: relative;
        }

        /* Variables de Nombres */
        .user-nickname {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .user-full-name {
            margin: 5px 0;
            font-size: 16px;
            opacity: 0.9;
        }

        .user-registration,
        .last-session {
            font-size: 12px;
            opacity: 0.7;
        }

        .avatar-container {
            position: absolute;
            right: 25px;
            top: 25px;
        }

        .profile__avatar--progress {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            background-color: white;
        }

        /* Franja Naranja - PROGRESO */
        .your-progress__title-orange {
            background-color: #ef7440;
            color: white;
            padding: 12px 25px;
        }

        .title-table {
            display: table;
            width: 100%;
        }

        .table-cell {
            display: table-cell;
            vertical-align: middle;
            font-weight: bold;
        }

        /* Trayectoria y Barra Lineal */
        .level-item {
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
        }

        .progress-container {
            background-color: #e9ecef;
            border-radius: 15px;
            height: 22px;
            width: 100%;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-bar-fill {
            background-color: #7052c2;
            height: 22px;
            text-align: center;
            color: white;
            font-size: 11px;
            line-height: 22px;
            font-weight: bold;
        }

        /* Gráficos Circulares */
        .stats-section {
            padding: 30px 20px;
            text-align: center;
        }

        .circle-wrapper {
            display: inline-block;
            width: 30%;
            vertical-align: top;
        }

        .pdf-circle {
            width: 115px;
            height: 115px;
            border-radius: 50%;
            margin: 0 auto;
            position: relative;
            border: 10px solid #e2e8f0;
            /* Color base gris */
            box-sizing: border-box;
        }

        /* Lógica de colores de los círculos */
        .ring-blue {
            border-top-color: #3498db;
            border-right-color: #3498db;
            border-bottom-color: #3498db;
        }

        .ring-red {
            border-color: #e74c3c;
        }

        .ring-green {
            border-color: #2ecc71;
        }

        .circle-inner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            text-align: center;
        }

        .label {
            font-size: 10px;
            color: #7f8c8d;
            display: block;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .value {
            font-size: 20px;
            font-weight: 900;
            display: block;
            color: #333;
        }

        /* Iconos de Diamantes y Lecciones */
        .summary-box {
            display: inline-block;
            width: 40%;
            background: #fdfdfd;
            border: 1px solid #f0f0f0;
            padding: 15px;
            border-radius: 12px;
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="your-progress">

        <div class="your-progress__top">
            <div class="user-info">
                <div class="user-nickname">{{ $player->user->user }}</div>

                <div class="user-full-name">
                    {{ $player->names }} {{ $player->surnames }}
                </div>

                <div class="user-registration">
                    Fecha de Registro: {{ formatting_date($player->user->created_at) }}
                </div>

                <span class="last-session">
                    Fecha de Ultima Sesion: {{ formatting_date($player->user->last_session) }}
                </span>
            </div>

            <div class="avatar-container">
                <img src="{{ public_path('img/avatars/' . $player->avatar->url) }}" class="profile__avatar--progress">
            </div>
        </div>

        <div class="your-progress__title-orange">
            <div class="title-table">
                <div class="table-cell" style="text-align: left; font-size: 18px;">Progreso General</div>
                <div class="table-cell" style="text-align: right;">
                    {{ $totalNumberLessonsCompleted }}/{{ $totalNumberLessons }} Lecciones</div>
            </div>
        </div>

        <div class="level-item">
            <div class="title-table">
                <div class="table-cell" style="text-align: left; color: #7052c2;">
                    Trayectoria: Nivel {{ $min }} al {{ $max }}
                </div>
                <div class="table-cell" style="text-align: right; color: #7f8c8d; font-size: 12px;">
                    {{ $percentage_bar }}%
                </div>
            </div>
            <div class="progress-container">
                <div class="progress-bar-fill" style="width: {{ $percentage_bar }}%">
                    {{ $percentage_bar }}%
                </div>
            </div>
        </div>

        <div class="stats-section">
            <div style="margin-bottom: 20px;">
                <div class="summary-box">
                    <figure>
                        <img src="{{ public_path('img/reportPDF/diamante.PNG') }}" alt="">
                    </figure>
                    <div style="font-size: 22px; font-weight: bold;">{{ $totalDiamonds }}</div>
                    <div style="color: #7f8c8d; font-size: 11px; text-transform: uppercase;">Diamantes</div>
                </div>
                <div class="summary-box">
                    <figure>
                        <img src="{{ public_path('img/reportPDF/leccion.PNG') }}" alt="">
                    </figure>
                    <div style="font-size: 22px; font-weight: bold;">{{ $totalNumberLessonsCompleted }}</div>
                    <div style="color: #7f8c8d; font-size: 11px; text-transform: uppercase;">Lecciones</div>
                </div>
            </div>

            <div class="circle-wrapper">
                <div class="pdf-circle ring-blue">
                    <div class="circle-inner-text">
                        <span class="label">ÉXITO</span>
                        <span class="value">{{ $AVGSuccessRate }}%</span>
                    </div>
                </div>
            </div>

            <div class="circle-wrapper">
                <div class="pdf-circle {{ $mistakesMade > 0 ? '' : 'ring-gray' }}"
                    style="{{ $mistakesMade > 0 ? 'border-color: #e74c3c;' : '' }}">
                    <div class="circle-inner-text">
                        <span class="label">ERRORES</span>
                        <span class="value">{{ $mistakesMade }}</span>
                    </div>
                </div>
            </div>

            <div class="circle-wrapper">
                <div class="pdf-circle ring-green">
                    <div class="circle-inner-text">
                        <span class="label">ACIERTOS</span>
                        <span class="value">{{ $pointsObtained }}</span>
                    </div>
                </div>
            </div>
        </div>


        <style>
            /* Contenedor principal para forzar una sola línea */
            .topic-charts-row {
                width: 100%;
                margin-top: 10px;
                height: 200px;
            }

            /* Cada caja ocupará el 48% para dejar margen y evitar el salto de página */
            .chart-box-half {
                width: 48%;
                float: left;
                /* Alineación izquierda */
                margin-right: 2%;
                border: 1px solid #f0f0f0;
                border-radius: 10px;
                padding: 10px;
                background-color: #fff;
                box-sizing: border-box;
                height: 100%;
                /* Asegura que el padding no sume al ancho */
            }

            /* La segunda caja no necesita margen derecho */
            .chart-box-half:last-child {
                margin-right: 0;
            }

            .topic-stats__title {
                display: block;
                margin-bottom: 10px;
                font-size: 12px;
                color: #333;
                border-left: 3px solid #7052c2;
                padding-left: 8px;
            }

            .chart-flex-container {
                display: table;
                width: 100%;
                height: 120px;
                /* Reducimos un poco la altura para ahorrar espacio */
            }

            .y-axis {
                display: table-cell;
                vertical-align: bottom;
                width: 15px;
            }

            .y-axis span {
                display: block;
                font-size: 9px;
                color: #999;
            }

            .bars-container {
                display: table-cell;
                vertical-align: bottom;
                text-align: center;
            }

            .bar-wrapper {
                display: inline-block;
                width: 8%;
                /* Ajustado para que quepan varias barras */
                margin: 0 2px;
                vertical-align: bottom;
            }

            .bar-value {
                font-size: 9px;
                color: #777;
            }

            .bar-visual {
                width: 100%;
                border-radius: 3px 3px 0 0;
            }

            .bar-label {
                font-size: 11px;
                color: #888;
                display: block;
                height: 25px;
                /* overflow:hidden;*/
            }

            /* Limpiar el float al final */
            .clearfix::after {
                content: "";
                clear: both;
                display: table;
            }

            /* Colores */
            .bg-red {
                background-color: #e74c3c;
            }

            .bg-blue {
                background-color: #3498db;
            }

            .bg-orange {
                background-color: #ef7440;
            }

            .bg-green {
                background-color: #2ecc71;
            }

            .bg-purple {
                background-color: #7052c2;
            }
        </style>

        <div class="topic-charts-row clearfix">

            <div class="chart-box-half">
                <span class="topic-stats__title"><b>Errores por Tema</b></span>

                <div class="chart-flex-container">
                    <div class="y-axis">
                        <span>{{ isset($totalErrorsTopic[0]->value) ? $totalErrorsTopic[0]->value : 0 }}</span>
                        <div style="height: 60px;"></div>
                        <span>0</span>
                    </div>

                    <div class="bars-container">
                        @foreach ($totalErrorsTopic as $index => $error)
                            @php
                                $colors = ['red', 'blue', 'orange', 'green'];
                                $color = $colors[$index % 4];
                                $maxVal =
                                    isset($totalErrorsTopic[0]->value) && $totalErrorsTopic[0]->value > 0
                                        ? $totalErrorsTopic[0]->value
                                        : 1;
                                $height = ($error->value / $maxVal) * 80;
                            @endphp
                            <div class="bar-wrapper">
                                <div class="bar-value">{{ $error->value }}</div>
                                <div class="bar-visual bg-{{ $color }}" style="height: {{ $height }}px;">
                                </div>
                                <span class="bar-label">{{ $error->topic_title }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="chart-box-half">
                <span class="topic-stats__title"><b>Puntos por Tema</b></span>

                <div class="chart-flex-container">
                    <div class="y-axis">
                        <span>{{ isset($totalPointsObtainedTopic[0]->value) ? $totalPointsObtainedTopic[0]->value : 0 }}</span>
                        <div style="height: 60px;"></div>
                        <span>0</span>
                    </div>

                    <div class="bars-container">
                        @foreach ($totalPointsObtainedTopic as $index => $point)
                            @php
                                $colors = ['purple', 'blue', 'orange', 'green'];
                                $color = $colors[$index % 4];
                                $maxVal =
                                    isset($totalPointsObtainedTopic[0]->value) &&
                                    $totalPointsObtainedTopic[0]->value > 0
                                        ? $totalPointsObtainedTopic[0]->value
                                        : 1;
                                $height = ($point->value / $maxVal) * 80;
                            @endphp
                            <div class="bar-wrapper">
                                <div class="bar-value">{{ $point->value }}</div>
                                <div class="bar-visual bg-{{ $color }}" style="height: {{ $height }}px;">
                                </div>
                                <span class="bar-label">{{ $point->topic_title }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
