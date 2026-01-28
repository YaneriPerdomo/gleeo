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
                    <a href="{{ route('account-profile.index') }}" class="text__gray"> Perfil
                        > </a>
                    <a href="{{ route('account-profile.index') }}" class="text__gray"> Información de la Cuenta</a> >
                    <a href="{{ route('account-profile.edit') }}" class="text__gray"> Editar</a>
                </small>
                <form action="{{ route('news-board.update') }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    <legend class="form__title">
                        <b>Editar Información de la Cuenta </b>
                    </legend>
                    @if (session('alert-success'))
                        <div class="alert alert-success"><i class="bi bi-check-circle-fill"></i>
                            {{ session('alert-success') }}</div>
                    @endif
                    @if (session('alert-danger'))
                        <div class="alert alert-danger" role="alert"><i class="bi bi-x-octagon-fill"></i>
                            {{ session('alert-danger') }}</div>
                    @endif

                    <fieldset class=" ">
                        <legend class="   ">
                            Información de la Materia
                        </legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <x-input-text :item="[
                                    'form_input_name' => 'subject',
                                    'form_title' => 'Materia/Asignatura:',
                                    'type' => 'text',
                                    'icon' => 'bi-book-half',
                                    'aria_label' => 'Nombre de la materia',
                                    'placeholder' => 'ej. Matemáticas Divertidas',
                                    'form_input_value_default' => $data->subject ?? '',
                                    'attribute_a' => 'required',
                                    'form_help_text' => 'Nombre de la asignatura que verá el niño.',
                                ]"></x-input-text>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form__item">
                                    <label for="description" class="form__label">Descripción:</label>
                                    <div class="input-group">
                                        <span class="form__icon input-group-text"><i
                                                class="bi bi-blockquote-left"></i></span>
                                        <textarea name="description" id="description" rows="3" class="form-control"
                                            placeholder="Escribe aquí el texto instructivo para la lección..." aria-label="Contenido de la guía">{{ $data->description ?? '' }}</textarea>
                                    </div>
                                    <small class="text-muted">Breve explicación para orientar al niño al entrar a la
                                        plataforma educativa.</small>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <hr>
                    <div class="flex-and-direction-row flex-content-space-between  form-actions mt-4">
                        <a href="{{ route('news-board.index') }}">
                            <button type="button" class="button text__gray">
                                <i class="bi bi-box-arrow-in-left"></i> Regresar
                            </button>
                        </a>
                        <button type="submit" class="button button__color-purple">
                            <i class="bi bi-save"></i> Guardar Cambios
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
