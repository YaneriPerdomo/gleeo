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

        .login__form{
                width: clamp(230px, 60vw, 400px);
        }
    </style>
</head>

<body class="h-100">
    <main class="row login h-100 login login__row">
        <div class="col-6 login__imgs login__column"></div>
        <div class="col-6 login__content login__column flex-and-direction-row flex-center-full">
            <form action="{{ route('login.auth') }}" class="form login__form" method="POST">
                @csrf
                @method('POST')
                <legend class="form__title fs-3">
                    <b>
                        ¡Bienvenido a Gleeo!
                    </b>
                </legend>
                <div class="form__item">
                    <label for="" class="form__label ">Usuario:</label>
                    <div class="input-group ">
                        <span class="form__icon input-group-text @error('user') is-invalid--border @enderror"
                            id="basic-addon1">
                        <i class="bi bi-person-fill"></i>
                        </span>
                        <input type="text" name="user" class="form-control @error('user') is-invalid @enderror"
                            placeholder="*******" aria-label="Username" aria-describedby="basic-addon1" value="">
                    </div>
                    @error('user')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="" class="form__label ">Contraseña:</label>
                    <div class="input-group ">
                        <span class="form__icon input-group-text @error('password') is-invalid--border @enderror"
                            id="basic-addon1"><i class="bi bi-key"></i></span>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="*******"
                            aria-label="Username" aria-describedby="basic-addon1" value="">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="button button__color-purple w-100 mt-3">
                    Entrar
                </button>
                <small><a href="">
                    Tiene cuenta?</a></small>
            </form>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
