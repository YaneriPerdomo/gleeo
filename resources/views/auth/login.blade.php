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

        .login__form {
            width: clamp(230px, 60vw, 400px);
        }

        .carousel-item>img {
            height: 100vh
        }

        .border-top-purple {
            border-top: 2px solid var(--purple);
        }

        .form__item {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="h-100">

    <main class="row border-top-purple login h-100 login login__row p-0 m-0 flex-and-direction-row  flex-center-full">
        <section class="flex-and-direction-column  flex-center-full">

            <form action="{{ route('login.auth') }}" class="form login__form" method="POST">
                <figure class="text-center"> <img src="{{ asset('img/logo.png') }}" alt="Imagen de inicio de sesion"
                        class=" img-fluid" style="width: 100px;" draggable="false">
                </figure>@csrf
                @method('POST')
                <legend class="form__title fs-4 text-center ">
                    <b>
                         Iniciar Sesión
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
                <x-input-text :item="[
                    'form_input_name' => 'user',
                    'form_title' => 'Usuario',
                    'type' => 'text',
                    'icon' => 'bi-person-fill',
                    'aria_label' => 'Nombre de Usuario',
                    'placeholder' => 'Juan2024',
                    'form_input_value_default' => old('user'),
                    'additional_class' => '',
                    'attribute_a' => '',
                    'form_help_text' => '',
                ]"></x-input-text>
                <x-input-text :item="[
                        'form_input_name' => 'password',
                        'form_title' => 'Contraseña',
                        'type' => 'password',
                        'icon' => 'bi-key-fill',
                        'aria_label' => 'Contraseña',
                        'placeholder' => '*******',
                        'form_input_value_default' => old('password'),
                        'additional_class' => '',
                        'attribute_a' => '',
                        'form_help_text' => '',
                    ]"></x-input-text>

                <button class="button button__color-purple w-100 mt-3">
                    Entrar
                </button>
                <br>
                <br>
                <br>
                <div class="text-center">
                    <small class="text__gray">
                        ¿Aún no tienes una cuenta?
                        <a href="{{ route('create-account.index') }}" class="text__purple">Registrarte</a></small>
                </div>
            </form>
        </section>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
