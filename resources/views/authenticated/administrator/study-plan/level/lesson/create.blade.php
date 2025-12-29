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
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

    <!-- CSS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/semantic.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />

    <style>
        .modal-dialog {
            max-width: 600px !important;
        }

        .table__all-practices {
            padding: 1rem;
            border: var(--gray) dashed 1px;
            border-radius: 0.5rem;
            min-height: 200px;

        }

        .table__data-number {
            padding: 0.5rem;
            background: var(--purple);
            color: white;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="flex-and-direction-column ">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Plan de Estudio',
                    'route' => 'study-plan.index',
                    'icon' => 'bi bi-book-half',
                ],
                [
                    'title' => 'Insignias',
                    'route' => 'initial-decision-patterns.index',
                    'icon' => 'bi bi-award-fill',
                ],
            ]"></x-aside-admin>

            <div class="col-10 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Gestión de Contenido</a> >
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Plan de Estudio</a> >
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Nivel {{ $infoLevel->number ?? '' }}
                        - {{ $infoLevel->name ?? '' }}</a> >
                    <span>Registrar Nuevo Tema </span>
                </small>

                <form action="{{ route('lesson.store', ['nivel' => $slugLevel, 'topic_slug' => $slugTopic]) }}"
                    class="form " method="POST">
                    @csrf
                    @method('POST')

                    <legend class="form__title">
                        <b> Registrar Nuevo Leccion</b>
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

                    <fieldset class="">
                        <legend class="">Información de la Lección</legend>
                        <div class="row">
                            <div class="col-4">
                                <x-input-text :item="[
                                    'form_input_name' => 'modulo_nombre',
                                    'form_title' => 'Módulo:',
                                    'type' => 'text',
                                    'icon' => 'bi-collection-play-fill',
                                    'aria_label' => 'Nombre del módulo',
                                    'placeholder' => 'Matemáticas Básicas',
                                    'form_input_value_default' => old('modulo_nombre', $moduloTopicInfo->title),
                                    'attribute_a' => 'disabled',
                                    'form_help_text' => '',
                                ]"></x-input-text>
                            </div>
                            <div class="col-4">
                                <x-input-text :item="[
                                    'form_input_name' => 'tema_nombre',
                                    'form_title' => 'Tema:',
                                    'type' => 'text',
                                    'icon' => 'bi-tag-fill',
                                    'aria_label' => 'Nombre del tema',
                                    'placeholder' => 'Números Naturales',
                                    'form_input_value_default' => old('tema_nombre', $moduloTopicInfo->topic[0]->title),
                                    'attribute_a' => 'disabled',
                                    'form_help_text' => '',
                                ]"></x-input-text>
                            </div>
                            <div class="col-4">
                                <x-input-text :item="[
                                    'form_input_name' => 'leccion_titulo',
                                    'form_title' => 'Título de la Lección:',
                                    'type' => 'text',
                                    'icon' => 'bi-journal-bookmark-fill',
                                    'aria_label' => 'Introduce el nombre de la lección',
                                    'placeholder' => 'Introducción a la Suma',
                                    'form_input_value_default' => old('leccion_titulo'),
                                    'attribute_a' => '',
                                    'form_help_text' => '',
                                ]"></x-input-text>
                            </div>
                        </div>

                        <div class="form__item ">
                            <label for="guia_parrafo" class="form__label">Contenido de la Guía (Párrafo)</label>
                            <div class="input-group">
                                <span class="form__icon input-group-text"><i class="bi bi-blockquote-left"></i></span>
                                <textarea name="guia_parrafo" id="guia_parrafo" rows="3" class="form-control"
                                    placeholder="Escribe aquí el texto instructivo para la lección..." aria-label="Contenido de la guía"></textarea>
                            </div>
                        </div>

                        <div class="form__item ">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="leccion_activa"
                                    value="1" id="switchActive" checked>
                                <label class="form-check-label" for="switchActive">
                                    Lección visible para los estudiantes
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <hr>

                    <fieldset>
                        <div class="flex-and-direction-row flex-content-space-between">
                            <div>
                                <legend>Prácticas de la Lección</legend>
                            </div>
                            <div>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#inforLevelModal"
                                    class=" button__add-lesson button button__color-green">
                                    <i class="bi bi-plus-lg"></i> Nueva Practica
                                </button>
                            </div>
                        </div>
                        <small class="text__gray">
                            Añade retos prácticos para reforzar el aprendizaje.
                        </small>
                        <section class="table table__all-practices  w-100">
                            <div
                                class="text-center table__messeger-zero-data flex-and-direction-column flex-center-full">
                                <i class="bi bi-command fs-1  text__purple"></i>
                                <b>
                                    ¡Tu lección no tiene prácticas aún!
                                </b>
                                <p>
                                    Las prácticas ayudan a los niños <br> a retener el conocimiento.
                                </p>
                                <button type="submit" data-bs-toggle="modal" data-bs-target="#inforLevelModal"
                                    style="    border: var(--purple) solid 1px !important;"
                                    class=" button__add-lesson button text__purple">
                                    <i class="bi bi-plus-lg text__purple"></i> <b class="text__purple"> Crear la
                                        Primera
                                        Practica</b>
                                </button>
                            </div>
                            <div class="question-card table__data" data-count="0">

                            </div>
                        </section>

                    </fieldset>

                    <div class="flex-and-direction-row flex-content-space-between form-actions mt-4">
                        <a href=" {{ route('study-plan.level-index', ['nivel' => $slugLevel ?? '']) }}"
                            class="button text__gray" style="text-decoration: none;">
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

<div class="modal fade " id="inforLevelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg__color-purple text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>Operaciones</b></h1>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="" class="modal-form" method="POST">
                <div class="modal-body flex-and-direction-row flex-center-full flex-gap-0-5">
                    <hr>
                    <fieldset>
                        <legend class="">Configuración de la Práctica</legend>
                        <x-input-text :item="[
                            'form_input_name' => 'titulo_practica',
                            'form_title' => 'Titulo de la Practica:',
                            'type' => 'text',
                            'icon' => 'bi-window-sidebar',
                            'aria_label' => 'Nombre de la pantalla',
                            'placeholder' => '¿Cuantos numeros son?',
                            'form_input_value_default' => old('titulo_practica'),
                            'attribute_a' => 'required',
                            'form_help_text' => '',
                        ]"></x-input-text>
                        <label for="tipo_dinamica_id" class="form__label form__label--required">
                            Tipo de Práctica
                        </label>
                        <div class="form__item d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPregunta"
                                    value="Opción Múltiple" checked id="multiple">
                                <label class="form-check-label" for="multiple">
                                    <i class="bi bi-list-ul me-2"></i>Opción múltiple
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPregunta"
                                    value="Verdadero/Falso" id="vf">
                                <label class="form-check-label" for="vf">
                                    <i class="bi bi-check-circle me-2"></i>Verdadero/Falso
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPregunta"
                                    value="Autocompletar" id="auto">
                                <label class="form-check-label" for="auto">
                                    <i class="bi bi-pencil-square me-2"></i>Autocompletar
                                </label>
                            </div>
                        </div>
                        <x-input-text :item="[
                            'form_input_name' => 'practica_pantalla',
                            'form_title' => 'Identificador de Pantalla:',
                            'type' => 'text',
                            'icon' => 'bi-window-sidebar',
                            'aria_label' => 'Nombre de la pantalla',
                            'placeholder' => 'screen_game_01',
                            'form_input_value_default' => old('practica_pantalla'),
                            'attribute_a' => 'required',
                            'form_help_text' => '',
                        ]"></x-input-text>
                        <span class="text__red modal__form-msg-autocompletado" style="display: none">
                            Es obligatorio escribir el enunciado (Usa __ para el hueco)
                        </span>
                        <div class="row">
                            <div class="col-6">
                                <x-input-text :item="[
                                    'form_input_name' => 'variable_1',
                                    'form_title' => 'Valor Variable 1:',
                                    'type' => 'text',
                                    'icon' => 'bi-hash',
                                    'aria_label' => 'Variable 1',
                                    'placeholder' => '1',
                                    'form_input_value_default' => old('variable_1'),
                                    'attribute_a' => 'required',
                                    'form_help_text' => '',
                                ]"></x-input-text>
                                <x-input-text :item="[
                                    'form_input_name' => 'variable_2',
                                    'form_title' => 'Valor Variable 2:',
                                    'type' => 'text',
                                    'icon' => 'bi-hash',
                                    'aria_label' => 'Variable 2',
                                    'placeholder' => '2',
                                    'form_input_value_default' => old('variable_2'),
                                    'attribute_a' => 'required',
                                    'form_help_text' => '',
                                ]"></x-input-text>
                            </div>
                            <div class="col-6">
                                <x-input-text :item="[
                                    'form_input_name' => 'variable_3',
                                    'form_title' => 'Valor Variable 3:',
                                    'type' => 'text',
                                    'icon' => 'bi-hash',
                                    'aria_label' => 'Variable 3',
                                    'placeholder' => '3',
                                    'form_input_value_default' => old('variable_3'),
                                    'attribute_a' => 'required',
                                    'form_help_text' => '',
                                ]"></x-input-text>
                                <x-input-text :item="[
                                    'form_input_name' => 'variable_4',
                                    'form_title' => 'Valor Variable 3:',
                                    'type' => 'text',
                                    'icon' => 'bi-hash',
                                    'aria_label' => 'Variable 4',
                                    'placeholder' => '4',
                                    'form_input_value_default' => old('variable_4'),
                                    'attribute_a' => 'required',
                                    'form_help_text' => '',
                                ]"></x-input-text>


                            </div>
                        </div>

                        <x-input-text :item="[
                            'form_input_name' => 'variable_correcta',
                            'form_title' => 'Respuesta Correcta:',
                            'type' => 'text',
                            'icon' => 'bi-check-circle-fill',
                            'aria_label' => 'Variable correcta',
                            'placeholder' => '15',
                            'form_input_value_default' => old('variable_correcta'),
                            'attribute_a' => 'required',
                            'form_help_text' => 'Indique el valor que valida la práctica.',
                        ]"></x-input-text>

                    </fieldset>

                    <hr>
                    <fieldset class="">
                        <legend class=" border-bottom mb-3">Tutor Inteligente (Refuerzo)</legend>
                        <div class="row ">
                            <div class="col-6">
                                <x-input-text :item="[
                                    'form_input_name' => 'refuerzo_titulo',
                                    'form_title' => 'Título del Refuerzo:',
                                    'type' => 'text',
                                    'icon' => 'bi-megaphone-fill',
                                    'aria_label' => 'Escribir el título del mensaje del tutor',
                                    'placeholder' => 'Ej: ¡Hagámoslo juntos!',
                                    'form_input_value_default' => old('refuerzo_titulo'),
                                    'attribute_a' => 'required',
                                    'form_help_text' => '',
                                ]"></x-input-text>

                                <div class="mt-3">
                                    <x-input-text :item="[
                                        'form_input_name' => 'refuerzo_url',
                                        'form_title' => 'Video de Apoyo (Opcional):',
                                        'type' => 'url',
                                        'icon' => 'bi-play-btn-fill',
                                        'aria_label' => 'Pegar enlace del video de apoyo',
                                        'placeholder' => 'https://youtube.com/ejemplo',
                                        'form_input_value_default' => old('refuerzo_url'),
                                        'attribute_a' => '',
                                        'form_help_text' => '',
                                    ]"></x-input-text>
                                    <!--
                                    <x-input-text :item="[
                                        'form_input_name' => 'refuerzo_img',
                                        'form_title' => 'Img de Apoyo (Opcional):',
                                        'type' => 'file',
                                        'icon' => 'bi-card-image',
                                        'aria_label' => 'Pegar enlace del video de apoyo',
                                        'placeholder' => 'https://youtube.com/ejemplo',
                                        'form_input_value_default' => old('refuerzo_img'),
                                        'attribute_a' => '',
                                        'form_help_text' => '',
                                    ]"></x-input-text>
                                    -->
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form__item">
                                    <label for="refuerzo_parrafo" class="form__label">Explicación del Tutor</label>
                                    <div class="input-group">
                                        <span class="form__icon input-group-text"><i
                                                class="bi bi-chat-dots-fill"></i></span>
                                        <textarea name="refuerzo_parrafo" id="refuerzo_parrafo" rows="4" class="form-control"
                                            placeholder="Mensaje tras fallar 3 veces..." aria-label="Escribir la explicación detallada del tutor"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>


                </div>
                <div class="modal-footer flex-and-direction-row  flex-content-space-between">
                    <button type="button" class="button  text__gray" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="button  button__color-green" data-button-add-data-practice="true"
                        data-bs-dismiss="modal">Añadir Practica</button>
                </div>
            </form>


        </div>
    </div>
</div>
<script>
    let buttonAddDataPractice = document.querySelector('[data-button-add-data-practice="true"]');
    let modalForm = document.querySelector('.modal-form');
    let tableData = document.querySelector('.table__data');
    let tableMsgZeroData = document.querySelector('.table__messeger-zero-data');
    const INPUT_VARIABLE_1_MODAL_FORM = document.querySelector('#variable_1')
    const INPUT_VARIABLE_2_MODAL_FORM = document.querySelector('#variable_2')
    const INPUT_VARIABLE_3_MODAL_FORM = document.querySelector('#variable_3')
    const INPUT_VARIABLE_4_MODAL_FORM = document.querySelector('#variable_4');

    const FORM_ITEM_VARIABLE_1 = INPUT_VARIABLE_1_MODAL_FORM.closest('.form__item');
    const FORM_ITEM_VARIABLE_2 = INPUT_VARIABLE_2_MODAL_FORM.closest('.form__item');
    const FORM_ITEM_VARIABLE_3 = INPUT_VARIABLE_3_MODAL_FORM.closest('.form__item');
    const FORM_ITEM_VARIABLE_4 = INPUT_VARIABLE_4_MODAL_FORM.closest('.form__item');




    const INPUT_PRACTICA_PANTALLA_MODAL_FORM = document.querySelector('#practica_pantalla');
    const INPUT_REFUERZO_PARRAFO_MODAL_FORM = document.querySelector('#refuerzo_parrafo');
    const INPUT_REFUERZO_TITULO_MODAL_FORM = document.querySelector('#refuerzo_titulo');
    const INPUT_VARIABLE_CORRECTA = document.querySelector('#variable_correcta');
    const INPUT_TITULO_PRACTICA = document.querySelector('#titulo_practica');
    const INPUT_TIPO_PREGUNTA = document.querySelector('[name="tipoPregunta"]');
    const MSG_AUTOCOMPLETADO = document.querySelector('.modal__form-msg-autocompletado');
    console.info(INPUT_TIPO_PREGUNTA)
    document.addEventListener('change', e => {
        if (e.target.matches('[name="tipoPregunta"]')) {
            const valorSeleccionado = e.target.value;
            console.info('Valor seleccionado:', valorSeleccionado);
            if (valorSeleccionado == 'Autocompletar') {
                MSG_AUTOCOMPLETADO.removeAttribute('style');
                FORM_ITEM_VARIABLE_3.removeAttribute('style');
                FORM_ITEM_VARIABLE_4.removeAttribute('style');
            } else if (valorSeleccionado == 'Verdadero/Falso') {
                FORM_ITEM_VARIABLE_3.style.visibility = 'hidden';
                FORM_ITEM_VARIABLE_4.style.visibility = 'hidden';
            } else {
                MSG_AUTOCOMPLETADO.style.display = 'none';
                FORM_ITEM_VARIABLE_3.removeAttribute('style');
                FORM_ITEM_VARIABLE_4.removeAttribute('style');
            }

        }
    })

    buttonAddDataPractice.addEventListener('click', e => {
        if (modalForm) {
            console.clear();
            console.group("Datos del Formulario");
            const formData = new FormData(modalForm);
            const data = Object.fromEntries(formData.entries());
            console.info(data);
            let practicaPantalla = data['practica_pantalla'] ?? '';
            let refuerzoParrafo = data['refuerzo_parrafo'] ?? '';
            let refuerzoTitulo = data['refuerzo_titulo'] ?? '';
            let refuerzoUrl = data['refuerzo_url'] ?? '';
            let variables = [data['variable_1'], data['variable_2'], data['variable_3'], data['variable_4']];
            let variableCorrecta = data['variable_correcta'] ?? '';
            let tipoPregunta = data['tipoPregunta'] ?? '';
            let tituloPractica = data['titulo_practica'] ?? ''
            /*Logica del Negocio*/
            let divCount = parseInt(tableData.getAttribute('data-count')) + 1;
            let NewDiv = document.createElement('div');
            console.log(tableMsgZeroData);
            let test = '';
            if (tipoPregunta == 'vf') {
                test = `
                        <div class="question-card__variable-item">
                            <span class="question-card__variable-label">Valor Variable 1</span><br>
                            <span class="question-card__variable-value">${variables[0]}</span>
                        </div>
                        <div class="question-card__variable-item">
                            <span class="question-card__variable-label">Valor Variable 2</span><br>
                            <span class="question-card__variable-value">${variables[1]}</span>
                        </div>
                `;
            } else {
                test = `
                        <div class="question-card__variable-item">
                            <span class="question-card__variable-label">Valor Variable 1</span><br>
                            <span class="question-card__variable-value">${variables[0]}</span>
                        </div>
                        <div class="question-card__variable-item">
                            <span class="question-card__variable-label">Valor Variable 2</span><br>
                            <span class="question-card__variable-value">${variables[1]}</span>
                        </div>
                         <div class="question-card__variable-item">
                            <span class="question-card__variable-label">Valor Variable 3</span><br>
                            <span class="question-card__variable-value">${variables[2]}</span>
                        </div>
                        <div class="question-card__variable-item">
                            <span class="question-card__variable-label">Valor Variable 4</span><br>
                            <span class="question-card__variable-value">${variables[3]}</span>
                        </div>
                `;
            }
            NewDiv.innerHTML = `
                            <div class="question-card__content">
                                 <input type="hidden" name="practicaPantalla"id="practicaPantalla" value="${practicaPantalla ?? 0}  ">
                                <input type="hidden" name="refuerzoParrafo" id="refuerzoParrafo" value="${refuerzoParrafo ?? 0} ">
                                <input type="hidden" name="refuerzoTitulo" id="refuerzoTitulo" value="${refuerzoTitulo ?? 0}">
                                <input type="hidden" name="refuerzoUrl"  id="refuerzoUrl"  value="${refuerzoUrl ?? 0}  ">
                                <input type="hidden" name="variables" id="variables" value="${variables ?? 0} ">
                                <input type="hidden" name="variableCorrecta" id="variableCorrecta" value="${variableCorrecta ?? 0} ">
                                <input type="hidden" name="tipoPregunta" id="tipoPregunta" value="${tipoPregunta  ?? 0}">
                                <input type="hidden" name="tituloPractica" id="tituloPractica" value="${tituloPractica ?? 0}  ">

                                <div class="question-card__header flex-and-direction-row flex-content-space-between">
                                    <div class="question-card__id-group">
                                        <span class="question-card__number table__data-number" id="table__data-number">P1</span>
                                        <b class="question-card__title">${tituloPractica}</b>
                                    </div>
                                    <div class="question-card__type-d">
                                        <span class="question-card__badge text__purple"><i>${tipoPregunta}</i></span>
                                          <i class="bi bi-trash-fill text__red remove-item-btn" data-number="${divCount}"></i>
                                    </div>
                                </div>
                                <div class="question-card__body mt-3">
                                    <span class="question-card__label">Indicador de pantalla</span>
                                    <div class="question-card__display text__purple fs-5">
                                        <b class="question-card__equation">${practicaPantalla}</b>
                                    </div>
                                </div>
                                <div class="question-card__variables flex-and-direction-row flex-gap-0-5 ">
                                    ${test}
                                </div>
                                <div class="question-card__footer">
                                    <div class="question-card__feedback">
                                        <span class="question-card__feedback-label text__green"><b>Respuesta
                                                Correcta</b></span>
                                    </div>
                                    <div class="question-card__result">
                                        <span class="question-card__result-value text__green"><b>${variableCorrecta}</b></span>
                                    </div>
                                </div>
                                </div>
                                <hr>
                        `;

            tableData.appendChild(NewDiv);
            console.info(tableMsgZeroData);
            tableMsgZeroData.style.display = 'none'


            let InputNameTotal = 0;
            document.querySelectorAll('#practicaPantalla').forEach(element => {
                InputNameTotal++;
            });
            let inputPracticaPantalla = document.querySelectorAll('#practicaPantalla');
            let inputRefuerzoParrafo = document.querySelectorAll('#refuerzoParrafo');
            let inputRefuerzoTitulo = document.querySelectorAll('#refuerzoTitulo');
            let inputRefuerzoUrl = document.querySelectorAll('#refuerzoUrl');
            let inputVariables = document.querySelectorAll('#variables');
            let inputVariableCorrecta = document.querySelectorAll('#variableCorrecta');
            let inputTituloPractica = document.querySelectorAll('#tituloPractica');
            let inputTipoPregunta = document.querySelectorAll('#tipoPregunta');
            let tableDataNumber = document.querySelectorAll('#table__data-number');


            let sequentialIndex = 1
            for (let i = 0; i <= InputNameTotal; i++) {
                if (!inputPracticaPantalla[i]) {
                    break;
                }
                inputPracticaPantalla[i].setAttribute('name', `practicaPantalla_${sequentialIndex}`)
                inputRefuerzoParrafo[i].setAttribute('name', `refuerzoParrafo_${sequentialIndex}`)
                inputRefuerzoTitulo[i].setAttribute('name', `refuerzoTitulo_${sequentialIndex}`)
                inputRefuerzoUrl[i].setAttribute('name', `refuerzoUrl_${sequentialIndex}`)
                inputVariables[i].setAttribute('name', `variables_${sequentialIndex}`)
                inputVariableCorrecta[i].setAttribute('name', `variableCorrecta_${sequentialIndex}`)
                inputTipoPregunta[i].setAttribute('name', `tipoPregunta_${sequentialIndex}`)
                inputTituloPractica[i].setAttribute('name', `tituloPractica_${sequentialIndex}`)
                tableDataNumber[i].innerHTML = `P${sequentialIndex}`;
                sequentialIndex++;
            }

            cleanEntryForm([INPUT_PRACTICA_PANTALLA_MODAL_FORM, INPUT_REFUERZO_PARRAFO_MODAL_FORM,
                INPUT_VARIABLE_1_MODAL_FORM, INPUT_VARIABLE_2_MODAL_FORM, INPUT_VARIABLE_2_MODAL_FORM,
                INPUT_VARIABLE_3_MODAL_FORM, INPUT_VARIABLE_4_MODAL_FORM,
                INPUT_REFUERZO_TITULO_MODAL_FORM, INPUT_VARIABLE_CORRECTA, INPUT_TITULO_PRACTICA
            ]);

            alertify.success('¡La práctica ha sido añadida con éxito!')

        } else {
            console.warn("No se encontró un elemento <form> dentro de .modal-form");
        }
    });

    document.addEventListener('click', async e => {
        if (e.target.matches('.remove-item-btn')) {

            e.target.closest('.question-card__content').remove();

            let InputNameTotal = 0;
            document.querySelectorAll('#practicaPantalla').forEach(element => {
                InputNameTotal++;
            });
            let inputPracticaPantalla = document.querySelectorAll('#practicaPantalla');
            let inputRefuerzoParrafo = document.querySelectorAll('#refuerzoParrafo');
            let inputRefuerzoTitulo = document.querySelectorAll('#refuerzoTitulo');
            let inputRefuerzoUrl = document.querySelectorAll('#refuerzoUrl');
            let inputVariables = document.querySelectorAll('#variables');
            let inputVariableCorrecta = document.querySelectorAll('#variableCorrecta');
            let inputTituloPractica = document.querySelectorAll('#tituloPractica');
            let inputTipoPregunta = document.querySelectorAll('#tipoPregunta');
            let tableDataNumber = document.querySelectorAll('#table__data-number');


            let sequentialIndex = await 1
            for (let i = 0; i <= InputNameTotal; i++) {
                if (!inputPracticaPantalla[i]) {
                    break;
                }
                inputPracticaPantalla[i].setAttribute('name', `practicaPantalla_${sequentialIndex}`)
                inputRefuerzoParrafo[i].setAttribute('name', `refuerzoParrafo_${sequentialIndex}`)
                inputRefuerzoTitulo[i].setAttribute('name', `refuerzoTitulo_${sequentialIndex}`)
                inputRefuerzoUrl[i].setAttribute('name', `refuerzoUrl_${sequentialIndex}`)
                inputVariables[i].setAttribute('name', `variables_${sequentialIndex}`)
                inputVariableCorrecta[i].setAttribute('name', `variableCorrecta_${sequentialIndex}`)
                inputTipoPregunta[i].setAttribute('name', `tipoPregunta_${sequentialIndex}`)
                inputTituloPractica[i].setAttribute('name', `tituloPractica_${sequentialIndex}`)
                tableDataNumber[i].innerHTML = `P${sequentialIndex}`;

                sequentialIndex++;
            }

            if (document.querySelector('[name="practicaPantalla_1"]') == null) {
                tableMsgZeroData.removeAttribute('style')
            }

            cleanEntryForm([INPUT_PRACTICA_PANTALLA_MODAL_FORM, INPUT_REFUERZO_PARRAFO_MODAL_FORM,
                INPUT_VARIABLE_1_MODAL_FORM, INPUT_VARIABLE_2_MODAL_FORM,
                INPUT_VARIABLE_2_MODAL_FORM,
                INPUT_VARIABLE_3_MODAL_FORM, INPUT_VARIABLE_4_MODAL_FORM,
                INPUT_REFUERZO_TITULO_MODAL_FORM, INPUT_VARIABLE_CORRECTA, INPUT_TITULO_PRACTICA
            ]);

            alertify.notify('¡La práctica ha sido eliminada con éxito!')
        }
    })

    function cleanEntryForm(inputs = []) {
        inputs.forEach(input => {
            if (input != null) {
                input.value = '';
            }
        })
        return true;
    }
</script>

</html>
