<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Informacion
        @if ($data->type != 'Profesional')
            de{{ $data->gender_id == 1 ? 'l' : ' la ' }}
            Representante
        @else
            de{{ $data->gender_id == 1 ? 'l' : ' la ' }}
            Profesional
        @endif | <x-system-name name="Gleeo"></x-system-name>
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

        .d-none {
            display: none;
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Representantes y <br> Profesionales ',
                    'route' => 'representative.index',
                    'icon' => 'bi bi-people-fill',
                ],
            ]"></x-aside-admin>
            <div class="col-10 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('representative.index') }}" class="text__gray"> Gestión de Cuentas
                        > </a>
                    <a href="{{ route('representative.edit', $data->slug) }}" class="text__gray"> Editar
                        Información</a>
                </small>
                <form action="{{ route('representative.update', $data->slug) }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    <legend class="form__title"><b>Editar Informacion
                            @if ($data->type != 'Profesional')
                                de{{ $data->gender_id == 1 ? 'l' : ' la ' }}
                                Representante
                            @else
                                de{{ $data->gender_id == 1 ? 'l' : ' la ' }}
                                Profesional
                            @endif
                        </b>
                    </legend>
                    @if (session('alert-success'))
                        <div class="alert alert-success"><i class="bi bi-check-circle"></i>
                            {{ session('alert-success') }}</div>
                    @endif
                    @if (session('alert-danger'))
                        <div class="alert alert-danger" role="alert"><i class="bi bi-x-octagon"></i>
                            {{ session('alert-danger') }}</div>
                    @endif
                    <fieldset>
                        <div class="row">
                            <fieldset class="col-6">
                                <legend class="fs-5 mb-3 ">Informacion Personal</legend>

                                <!--<x-input-text :item="[
                                    'form_input_name' => 'name',
                                    'form_title' => 'Nombre:',
                                    'type' => 'text',
                                    'icon' => 'bi bi-person-fill',
                                    'aria_label' => 'Nombre del usuario o profesional.',
                                    'placeholder' => 'Ej: Juan Carlos',
                                    'form_input_value_default' => old('name', $data->names ?? ''),
                                    'attribute_a' => '',
                                    'form_help_text' => '',
                                ]"></x-input-text>

                                <x-input-text :item="[
                                    'form_input_name' => 'surnames',
                                    'form_title' => 'Apellidos:',
                                    'type' => 'text',
                                    'icon' => 'bi bi-person-fill',
                                    'aria_label' => 'Apellidos del usuario o profesional.',
                                    'placeholder' => 'Ej: Pérez Gómez',
                                    'form_input_value_default' => old('surnames', $data->surnames ?? ''),
                                    'attribute_a' => '',
                                    'form_help_text' => '',
                                ]"></x-input-text>-->
                                <div class="form__item">
                                    <label for="role_identification" class="form__label">Identificación de Rol:</label>
                                    <div class="input-group">
                                        <span
                                            class="form__icon input-group-text @error('role_identification') is-invalid--border @enderror">
                                            <i class="bi bi-person-badge-fill "></i>
                                        </span>
                                        <select id="role_identification" name="role_identification"
                                            class="form-control initial-decision-patterns__select @error('role_identification') is-invalid @enderror"
                                            aria-label="Selección de identificación de rol">
                                            <option value="lesson" selected disabled>Seleccione una opcion</option>

                                            <option value="Profesional"
                                                @if (old('role_identification', $data->type) == 'Profesional') selected @endif>
                                                Profesional</option>
                                            <option value="Representante"
                                                @if (old('role_identification', $data->type) == 'Representante') selected @endif>
                                                Representante
                                            </option>
                                        </select>
                                    </div>
                                    <script>
                                        document.getElementById('role_identification').addEventListener('change', function() {
                                            var educationalCenterField = document.querySelector(
                                                'input[name="educational_center"]').parentElement.parentElement;
                                            if (this.value ===
                                                'Profesional') { //This es el elemento que disparo el evento es decir, es el mismo select!
                                                educationalCenterField.classList.remove('d-none');
                                            } else {
                                                educationalCenterField.classList.add('d-none');
                                            }
                                        });
                                    </script>
                                    @error('role_identification')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <x-input-text :item="[
                                    'form_input_name' => 'educational_center',
                                    'form_title' => 'Centro Educativo:',
                                    'type' => 'text',
                                    'icon' => 'bi-building-fill',
                                    'aria_label' => 'Nombre del centro educativo.',
                                    'placeholder' => 'Ej: Universidad Dr. José Gregorio Hernández',
                                    'form_input_value_default' => old(
                                        'educational_center',
                                        $data->educational_center ?? '',
                                    ),
                                    'additional_class' => $data->type != 'Profesional' ? 'd-none' : '',
                                    'attribute_a' => '',
                                    'form_help_text' => '',
                                ]"></x-input-text>
                                <div class="form__item">
                                    <label for="gender_id" class="form__label">Genero:</label>
                                    <div class="input-group">
                                        <span
                                            class="form__icon input-group-text @error('gender_id') is-invalid--border @enderror">
                                            <i class="bi bi-gender-ambiguous "></i>
                                        </span>
                                        <select id="gender_id" name="gender_id"
                                            class="form-control initial-decision-patterns__select @error('gender_id') is-invalid @enderror"
                                            aria-label="Selección de identificación de rol">
                                            <option value="lesson" selected disabled>Seleccione una opcion</option>

                                            <option value="1" @if (old('gender_id', $data->gender_id) == 1) selected @endif>
                                                Masculino</option>
                                            <option value="0" @if (old('gender_id', $data->gender_id) == 0) selected @endif>
                                                Femenina
                                            </option>
                                        </select>
                                    </div>
                                    @error('gender_id')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                 <div class="form__item">
                                    <label for="country_id" class="form__label">Pais de Referencia</label>
                                    <div class="input-group">
                                        <span
                                            class="form__icon input-group-text @error('country_id') is-invalid--border @enderror">
                                            <i class="bi bi-globe "></i>
                                        </span>
                                        <select id="country_id" name="country_id"
                                            class="form-control initial-decision-patterns__select @error('country_id') is-invalid @enderror"
                                            aria-label="Selección de identificación de rol">
                                            <option value="0"   disabled>Seleccione una opcion</option>
                                             @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if (old('country_id', $data->country_id) == $country->country_id) selected @endif
                                                >
                                                    {{ $country->country }}</option>

                                             @endforeach

                                        </select>
                                    </div>
                                    @error('country_id')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                            </fieldset>

                            <fieldset class="col-6">
                                <legend class="fs-5 mb-3 ">Informacion de la Cuenta</legend>

                                <x-input-text :item="[
                                    'form_input_name' => 'Username',
                                    'form_title' => 'Nombre de Usuario:',
                                    'type' => 'text',
                                    'icon' => 'bi-person-badge-fill',
                                    'aria_label' => 'Nombre de usuario para iniciar sesión.',
                                    'placeholder' => 'Ej: juanperez123',
                                    'form_input_value_default' => old('Username', $data->user->user ?? ''),
                                    'attribute_a' => '',
                                    'form_help_text' => '',
                                ]"></x-input-text>

                                <x-input-text :item="[
                                    'form_input_name' => 'email',
                                    'form_title' => 'Correo Electrónico:',
                                    'type' => 'text',
                                    'icon' => 'bi bi-envelope-fill',
                                    'aria_label' => 'Dirección de correo electrónico.',
                                    'placeholder' => 'Ej: juanperez@ejemplo.com',
                                    'form_input_value_default' => old('email', $data->user->email ?? ''),
                                    'attribute_a' => '',
                                    'form_help_text' => '',
                                ]"></x-input-text>
                                <div class="form__item">
                                    <label for="pattern_status" class="form__label">Estado de la Cuenta:</label>
                                    <div class="input-group">
                                        <span
                                            class="form__icon input-group-text @error('pattern_status') is-invalid--border @enderror">
                                            <i class="bi bi-toggle-on "></i>
                                        </span>
                                        <select id="pattern_status" name="pattern_status"
                                            class="form-control form__input-select @error('pattern_status') is-invalid @enderror"
                                            aria-label="Selección del estado de la cuenta">
                                            <option disabled selected>Seleccione una opción</option>

                                            <option value="1" @if (old('pattern_status', $data->user->state ?? 0) == 1 || old('pattern_status') == '1') selected @endif>
                                                Activo</option>
                                            <option value="0" @if (
                                                (old('pattern_status', $data->user->state ?? 0) == 0 && old('pattern_status') !== '0') ||
                                                    old('pattern_status') == '0') selected @endif>
                                                Inactivo</option>
                                        </select>
                                    </div>
                                    @error('pattern_status')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>

                                <small class="">
                                    Para cambiar la contraseña
                                    @if ($data->type != 'Profesional')
                                        de{{ $data->gender_id == 1 ? 'l' : ' la ' }}
                                        Representante
                                    @else
                                        de{{ $data->gender_id == 1 ? 'l' : ' la ' }}
                                        Profesional
                                    @endif, introduzca una
                                    nueva. De lo contrario, deje estos campos en blanco.
                                </small>

                                <x-input-text :item="[
                                    'form_input_name' => 'password',
                                    'form_title' => 'Contraseña (opcional):',
                                    'type' => 'password',
                                    'icon' => 'bi bi-key ',
                                    'aria_label' => 'Nueva contraseña (dejar vacío para no cambiar).',
                                    'placeholder' => 'Ej: ********',
                                    'form_input_value_default' => '',
                                    'attribute_a' => '',
                                    'form_help_text' => '',
                                ]"></x-input-text>

                                <x-input-text :item="[
                                    'form_input_name' => 'password_confirmation',
                                    'form_title' => 'Confirmar Contraseña (opcional):',
                                    'type' => 'password',
                                    'icon' => 'bi bi-key ',
                                    'aria_label' => 'Confirme la nueva contraseña.',
                                    'placeholder' => 'Ej: ********',
                                    'form_input_value_default' => '',
                                    'attribute_a' => '',
                                    'form_help_text' => '',
                                ]"></x-input-text>


                            </fieldset>
                        </div>
                    </fieldset>

                    <hr>


                    <div class="flex-and-direction-row flex-content-space-between  form-actions mt-4">
                        <a href="{{ route('representative.index') }}">
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
