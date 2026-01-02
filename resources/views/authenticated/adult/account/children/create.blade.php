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
        <link rel="stylesheet" href="{{ asset('css/components/theme.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    <style>
        .avatar-option__img {
            width: 70px
        }

         .avatar__circle {
            width: 75px;
                height: 95px;
            clip-path: circle(39% at 50% 50%);
        }
    </style>
</head>

<body class="flex-and-direction-column ">
    <x-header></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article container-xl w-100">
            <x-aside-admin :items="[
                [
                    'title' => 'Jugadores',
                    'route' => 'children.index',
                    'icon' => 'bi bi-person-video3',
                ],
            ]"></x-aside-admin>
            <div class="col-10 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Gestión de Contenido</a> >
                    <a href="{{ route('study-plan.index') }}" class="text__gray">Plan de Estudio</a> >
                    <span>Agregar Nuevo Nivel</span>
                </small>

                <form action="{{ route('children.store') }}" class="form" method="POST">
                    @csrf
                    @method('POST')
                    <legend class="form__title">
                        <b>Agregar Nuevo Jugador(a)</b>
                    </legend>
                    @if (session('alert-danger'))
                        <div class="alert alert-danger" role="alert"><i class="bi bi-x-octagon-fill"></i>
                            {{ session('alert-danger') }}</div>
                    @endif

                    <div class="row">
                        <div class="row">
                            {{-- Columna: Información Personal --}}
                            <div class="col-6">
                                <fieldset>
                                    <legend>Información Personal</legend>

                                    {{-- Nombres --}}
                                    <x-input-text :item="[
                                        'form_input_name' => 'names',
                                        'form_title' => 'Nombres:',
                                        'type' => 'text',
                                        'icon' => 'bi-person',
                                        'aria_label' => 'Agregar nombre del jugador(a)',
                                        'placeholder' => 'Yaneri Paola...',
                                        'form_input_value_default' => old('names'),
                                        'attribute_a' => 'required',
                                        'form_help_text' => '',
                                    ]"></x-input-text>

                                    {{-- Apellidos --}}
                                    <x-input-text :item="[
                                        'form_input_name' => 'last_names',
                                        'form_title' => 'Apellidos:',
                                        'type' => 'text',
                                        'icon' => 'bi-person-badge',
                                        'aria_label' => 'Agregar apellidos del jugador(a)',
                                        'placeholder' => 'Pérez García...',
                                        'form_input_value_default' => old('last_names'),
                                        'attribute_a' => 'required',
                                        'form_help_text' => '',
                                    ]"></x-input-text>

                                    {{-- Fecha de Nacimiento --}}
                                    <x-input-text :item="[
                                        'form_input_name' => 'date_of_birth',
                                        'form_title' => 'Fecha de Nacimiento:',
                                        'type' => 'date',
                                        'icon' => 'bi-calendar-event',
                                        'aria_label' => 'Seleccione fecha de nacimiento',
                                        'placeholder' => '',
                                        'form_input_value_default' => old('date_of_birth'),
                                        'attribute_a' => 'required',
                                        'form_help_text' => '',
                                    ]"></x-input-text>


                                    <div class="form__item mt-3">
                                        <label for="gender" class="form__label form__label--required">Género</label>
                                        <div class="input-group">
                                            <span
                                                class="form__icon input-group-text @error('gender_id') is-invalid--border @enderror"
                                                id="gender-addon">
                                                <i class="bi bi-gender-ambiguous"></i>
                                            </span>
                                            <select class="form-select @error('gender_id') is-invalid @enderror"
                                                name="gender_id" id="gender" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1" {{ old('gender_id') == 1 ? 'selected' : '' }}>
                                                    Masculino</option>
                                                <option value="2" {{ old('gender_id') == 2 ? 'selected' : '' }}>
                                                    Femenino</option>
                                            </select>
                                        </div>
                                        @error('gender_id')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-6">
                                <fieldset>
                                    <legend>Información de la Cuenta</legend>
                                    <div class="avatars-selector">
                                        <div class="avatars-selector__header">
                                            <label class="avatars-selector__title">Avatares</label>
                                            <br>
                                            <small class="avatars-selector__subtitle">Selecciona uno para el
                                                jugador</small>
                                        </div>

                                        <div class="avatars-selector__grid flex-and-direction-row">
                                            @forelse ($avatars as $avatar)
                                                <div class="avatar-option flex-and-direction-column">
                                                    <input type="radio" name="avatar_id"
                                                        value="{{ $avatar->avatar_id }}"
                                                        id="avatar-{{ $avatar->avatar_id }}"
                                                        class="avatar-option__input"
                                                        {{ old('avatar_id') == $avatar->avatar_id ? 'checked' : '' }}>
                                                    <label for="avatar-{{ $avatar->avatar_id }}"
                                                        class="avatar-option__labe flex-grow-2l">
                                                        <img src="{{ asset('img/avatars/' . $avatar->url ) }}"
                                                        class=" clip-path-50 avatar__circle"
                                                            title="{{ $avatar->name }}" alt="{{ $avatar->name }}"
                                                            draggable="false" >
                                                    </label>
                                                    <div>
                                                         <span> {{ $avatar->name }}</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="avatars-selector__empty">No hay avatares disponibles.</p>
                                            @endforelse
                                        </div>

                                        @error('avatar_id')
                                            <span class="avatars-selector__error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <x-input-text :item="[
                                        'form_input_name' => 'username',
                                        'form_title' => 'Nombre de Usuario:',
                                        'type' => 'text',
                                        'icon' => 'bi-person-circle',
                                        'aria_label' => 'Agregar nombre de usuario',
                                        'placeholder' => 'yaneri_01',
                                        'form_input_value_default' => old('username'),
                                        'attribute_a' => 'required',
                                        'form_help_text' => 'El nombre de usuario servirá para iniciar sesión.',
                                    ]"></x-input-text>

                                    <div class="theme-selector">
                                        <label class="theme-selector__title">Temas Visuales</label>
                                        <small class="theme-selector__subtitle d-block mb-3">Elige la apariencia de la
                                            interfaz para el jugador</small>

                                        <div class="theme-selector__grid flex-and-direction-row">
                                            @forelse ($themes as $theme)
                                                <div class="theme-option">
                                                    <input type="radio" name="theme_id"
                                                        value="{{ $theme->theme_id }}"
                                                        id="theme-{{ $theme->theme_id }}" class="theme-option__input"
                                                        {{ old('theme_id') == $theme->theme_id ? 'checked' : '' }}>
                                                    <label for="theme-{{ $theme->id }}" class="theme-option__card">

                                                         <div class="theme-option__figure">
                                                            @if ($theme->background_path != null)
                                                                <img src="{{ asset('img/themes/' . $theme->background_path ) }}"
                                                                    class="theme-option__bg-preview"
                                                                    alt="Fondo del tema">
                                                            @else
                                                                <div class="theme-option__no-bg" style="background: {{ $theme->solid_background }}">

                                                                    <span style="filter: invert(1)">Fondo Solido</span>
                                                                </div>
                                                            @endif

                                                            <div class="theme-option__colors-badge">
                                                                <span class="theme-option__dot"
                                                                    style="background-color: {{ $theme->main_color }}"></span>
                                                                <span class="theme-option__dot"
                                                                    style="background-color: {{ $theme->secondary_color }}"></span>
                                                            </div>
                                                        </div>
                                                        <div class="theme-option__body">
                                                            <h6 class="theme-option__name">{{ $theme->name }}</h6>

                                                            <div class="theme-option__status">
                                                                <span class="theme-option__badge">
                                                                    <i
                                                                        class="bi {{ $theme->border_radius == 1 ? 'bi-circle-fill' : 'bi-square' }}"></i>
                                                                    {{ $theme->border_radius == 1 ? 'Redondeado' : 'Cuadrado' }}
                                                                </span>
                                                                <span class="theme-option__badge">
                                                                    <i
                                                                        class="bi {{ $theme->background_path ? 'bi-image' : 'bi-dash-circle' }}"></i>
                                                                    {{ $theme->background_path ? 'Con fondo' : 'Color sólido' }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </label>
                                                </div>
                                            @empty
                                                <p class="theme-selector__empty">No hay temas configurados.</p>
                                            @endforelse
                                        </div>
                                        <div class="form__item mt-3">
                                            <label for="assigned_level"
                                                class="form__label form__label--required">Nivel asignado</label>

                                            <div class="input-group">
                                                <span
                                                    class="form__icon input-group-text @error('assigned_level') is-invalid--border @enderror"
                                                    id="level-addon">
                                                    {{-- Icono de escalera o progreso (más semántico que el de género) --}}
                                                    <i class="bi bi-bar-chart-steps"></i>
                                                </span>

                                                <select
                                                    class="form-select @error('assigned_level') is-invalid @enderror"
                                                    name="assigned_level" id="assigned_level" required>
                                                    <option value="" disabled selected>Seleccione un nivel
                                                        inicial</option>

                                                    @foreach ($levels as $level)
                                                        <option value="{{ $level->level_id }}"
                                                            {{ old('assigned_level') == $level->id ? 'selected' : '' }}>
                                                            Nivel {{ $level->number }}: {{ $level->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            @error('assigned_level')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror

                                            <small class="text-muted">

                                                Si el nivel es superior al Nivel 1, el niño deberá completar retos de
                                                suficiencia.
                                            </small>
                                        </div>
                                        <hr>
                                        <div class="form__item ">

                                            <div class="form-check form-switch" style="padding: 0;">
                                                <label for="">Modo de Lectura</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="reading_mode" value="1" id="switchActive"
                                                        {{ old('reading_mode') == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="switchActive">
                                                        Activado
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form__item">
                                        <label for="password"
                                            class="form__label form__label--required">Contraseña</label>
                                        <div class="input-group ">
                                            <span
                                                class="form__icon input-group-text @error('password') is-invalid--border @enderror"
                                                id="password-addon">
                                                <i class="bi bi-lock"></i>
                                            </span>
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Ingrese su contraseña" aria-label="Contraseña"
                                                aria-describedby="password-addon" value="" autocomplete="off">
                                        </div>
                                        @error('password')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form__item">
                                        <label for="password_confirmation"
                                            class="form__label form__label--required">Confirmar
                                            Contraseña</label>
                                        <div class="input-group ">
                                            <span
                                                class="form__icon input-group-text @error('password_confirmation') is-invalid--border @enderror"
                                                id="password-confirm-addon">
                                                <i class="bi bi-lock-fill"></i>
                                            </span>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="Confirme su contraseña" aria-label="Confirmar Contraseña"
                                                aria-describedby="password-confirm-addon" value="">
                                        </div>
                                        @error('password_confirmation')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                    </div>




                    <div class="flex-and-direction-row flex-content-space-between form-actions mt-4">
                        <a href="{{ route('study-plan.index') }}" class="button text__gray"
                            style="text-decoration: none;">
                            <i class="bi bi-box-arrow-in-left"></i> Regresar
                        </a>

                        <button type="submit" class="button button__color-purple">
                            <i class="bi bi-plus-lg"></i> Agregar Nuevo Jugador(a)
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
