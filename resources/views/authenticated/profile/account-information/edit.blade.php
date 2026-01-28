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
    <x-header notificationIsActiveCount="{{ $notificationIsActiveCount }}"></x-header>
    <main class="flex-grow-2 w-100 flex-and-direction-column flex-center-full flex-center-full-start">
        <article class="row main__article container-xl w-100">
            @php
                $sidebarItems = [];
                if (Auth::user()->rol_id == 2) {
                    $sidebarItems[] = [
                        'title' => 'Información Personal',
                        'route' => 'personal-profile.index',
                        'icon' => 'bi bi-person-lines-fill',
                    ];
                }
                $sidebarItems[] = [
                    'title' => 'Información de la Cuenta',
                    'route' => 'account-profile.index',
                    'icon' => 'bi bi-person-fill',
                ];

                $sidebarItems[] = [
                    'title' => 'Cambiar Contraseña',
                    'route' => 'change-password.edit',
                    'icon' => 'bi bi-person-lock',
                ];
            @endphp
            <x-aside-admin :items="$sidebarItems"></x-aside-admin>
            <div class="col-lg-10 col-12 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('account-profile.index') }}" class="text__gray"> Perfil
                        > </a>
                    <a href="{{ route('account-profile.index') }}" class="text__gray"> Información de la Cuenta</a> >
                    <a href="{{ route('account-profile.edit') }}" class="text__gray"> Editar</a>
                </small>
                <form action="{{ route('account-profile.update') }}" class="form" method="POST">
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
                    <x-input-text :item="[
                        'form_input_name' => 'user_name',
                        'form_title' => 'Nombre de usuario:',
                        'type' => 'text',
                        'icon' => 'bi-person-fill',
                        'aria_label' => 'Introduce tu nombre de usuario.',
                        'placeholder' => 'ej. MiUsuario123',
                        'form_input_value_default' => $data->user ?? '',
                        'attribute_a' => '',
                        'form_help_text' => '',
                    ]"></x-input-text>


                    <x-input-text :item="[
                        'form_input_name' => 'email',
                        'form_title' => 'Correo Electrónico:',
                        'type' => 'email',
                        'icon' => 'bi-envelope-fill',
                        'aria_label' => 'Introduce tu dirección de correo electrónico.',
                        'placeholder' => 'ej. tu.correo@dominio.com',
                        'form_input_value_default' => $data->email ?? '',
                        'attribute_a' => '',
                        'form_help_text' => '',
                    ]"></x-input-text>
                    <hr>
                    <div class="flex-and-direction-row flex-content-space-between  form-actions mt-4">
                        <a href="{{ route('account-profile.index') }}">
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
