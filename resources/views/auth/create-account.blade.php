<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesion | <x-system-name name="Gleeo"></x-system-name>
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
        .login__imgs {
            background: var(--purple);
        }

        .login__content {

            /*
            background-image: linear-gradient(220deg,
                    var(--purple) 10%,
                    white 10%,
                    white 80%,
                    var(--purple) 80%);
           */
        }



        .carousel-item>img {
            height: 100vh
        }

        .login__form {
            width: clamp(230px, 60vw, 400px);
        }

        .border-top-purple {
            border-top: 4px solid var(--purple);
        }

        .form__item {
            margin-bottom: 0.3rem;
        }
    </style>
</head>

<body class="h-100 height-full ">
    <main class="row height-full  border-top-purple login h-100 login login__row p-0 m-0 flex-and-direction-row  flex-center-full">
        <section class="flex-and-direction-column  flex-center-full">

            <form action="{{ route('representative.create') }}" class="form form--create-account " method="POST">
                <figure class="text-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Imagen de inicio de sesion" class=" img-fluid"
                        style="width: 100px;" draggable="false">
                </figure>
                @csrf
                @method('POST')
                @if (session('alert-success'))
                    <div class="alert alert-success"><i class="bi bi-check-circle"></i>
                        {{ session('alert-success') }}</div>
                @endif
                @if (session('alert-danger'))
                    <div class="alert alert-danger" role="alert"><i class="bi bi-x-octagon"></i>
                        {{ session('alert-danger') }}</div>
                @endif
                <legend class="form__title fs-4 text-center ">
                    <b>
                        Crear Nueva Cuenta
                    </b>
                </legend>
                <x-input-text :item="[
                    'form_input_name' => 'user',
                    'form_title' => 'Usuario',
                    'type' => 'text',
                    'icon' => 'bi-person',
                    'aria_label' => 'Nombre de Usuario',
                    'placeholder' => 'Juan2024',
                    'form_input_value_default' => old('user'),
                    'additional_class' => '',
                    'attribute_a' => '',
                    'form_help_text' => '',
                ]"></x-input-text>

                <x-input-text :item="[
                    'form_input_name' => 'email',
                    'form_title' => 'Correo Electrónico',
                    'type' => 'text',
                    'icon' => 'bi-envelope',
                    'aria_label' => 'Correo Electrónico',
                    'placeholder' => 'juan.perez@example.com',
                    'form_input_value_default' => old('email'),
                    'additional_class' => '',
                    'attribute_a' => '',
                    'form_help_text' => '',
                ]"></x-input-text>

                <div class="form__item">
                    <label for="role_identification" class="form__label">Identificación de Rol </label>
                    <div class="input-group">
                        <span
                            class="form__icon input-group-text @error('role_identification') is-invalid--border @enderror">
                            <i class="bi bi-person-badge-fill "></i>
                        </span>
                        <select id="role_identification" name="role_identification"
                            class="form-control initial-decision-patterns__select @error('role_identification') is-invalid @enderror"
                            aria-label="Selección de identificación de rol">
                            <option value="lesson" selected disabled>Seleccione una opcion</option>
                            <option value="Profesional" @if (old('role_identification')) selected @endif>
                                Profesional</option>
                            <option value="Representante" @if (old('role_identification')) selected @endif>
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
                    'form_title' => 'Centro Educativo (opcional)',
                    'type' => 'text',
                    'icon' => 'bi-building-fill',
                    'aria_label' => 'Nombre del centro educativo.',
                    'placeholder' => 'Ej: Universidad Dr. José Gregorio Hernández',
                    'form_input_value_default' => old('educational_center'),
                    'additional_class' => 'd-none',
                    'attribute_a' => '',
                    'form_help_text' => '',
                ]"></x-input-text>




                <div class="form__item">
                    <label for="gender" class="form__label form__label--required">Género</label>
                    <div class="input-group">
                        <span class="form__icon input-group-text @error('gender_id') is-invalid--border @enderror"
                            id="gender-addon">
                            <i class="bi bi-gender-ambiguous"></i>
                        </span>
                        <select class="form-select @error('gender_id') is-invalid @enderror" name="gender_id"
                            id="gender" aria-label="Seleccione el género">
                            <option disabled>Seleccione una opción</option>
                            <option value="1" {{ old('gender_id') == 1 ? 'selected' : '' }}>Masculino
                            </option>
                            <option value="2" {{ old('gender_id') == 2 ? 'selected' : '' }}>Femenina
                            </option>
                        </select>
                    </div>
                    @error('gender_id')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form__item">
                    <label for="password" class="form__label form__label--required">Contraseña</label>
                    <div class="input-group ">
                        <span class="form__icon input-group-text @error('password') is-invalid--border @enderror"
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
                    <label for="password_confirmation" class="form__label form__label--required">Confirmar
                        Contraseña</label>
                    <div class="input-group ">
                        <span
                            class="form__icon input-group-text @error('password_confirmation') is-invalid--border @enderror"
                            id="password-confirm-addon">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirme su contraseña" aria-label="Confirmar Contraseña"
                            aria-describedby="password-confirm-addon" value="">
                    </div>
                    @error('password_confirmation')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>



                <button class="button button__color-purple w-100 mt-3">
                    Registrarse
                </button>
                <br>
                <br>
                <br>
                <div class="text-center">
                    <small class="text__gray">
                        ¿Ya tienes una cuenta?
                        <a href="{{ route('login.index') }}" class="text__purple">Iniciar Sesión</a></small>
                </div>
                <input type="hidden" name="country_name">
            </form>
        </section>
    </main>
    <script>
        fetch('https://ipapi.co/json/')
            .then(response => response.json())
            .then(data => {
                console.log("Tu país es: " + data.country_name);
                console.log("Código de país: " + data.country_code);
                document.querySelector('input[name="country_name"]').value = data.country_name;
            })
            .catch(error => console.error("Error al obtener la ubicación:", error));
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
