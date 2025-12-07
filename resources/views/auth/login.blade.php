<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesion | <x-system-name name="Gleeo"></x-system-name> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>
    <div class="row">
        <div class="col-6">

        </div>
        <div class="col-6">
            <div>
                <form action="{{ route('login.auth') }}" class="form" method="POST">
                    @csrf
                    @method('POST')
                    <legend class="form__title">Inicia Sesion</legend>
                     <div class="form__item">
                        <label for="" class="form__label ">Usuario</label>
                        <div class="input-group ">
                            <span class="form__icon input-group-text @error('user') is-invalid--border @enderror"
                                id="basic-addon1"><i class="bi bi-key"></i></span>
                            <input type="text" name="user"
                                class="form-control @error('user') is-invalid @enderror" placeholder="*******"
                                aria-label="Username" aria-describedby="basic-addon1" value="">
                        </div>
                        @error('user')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form__item">
                        <label for="" class="form__label ">Contraseña</label>
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
                    <button>
                        Inicia sesion
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
