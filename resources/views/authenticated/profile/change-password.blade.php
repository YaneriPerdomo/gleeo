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
                if (Auth::user()->rol_id == 2) {
                    $sidebarItems[] = [
                        'title' => 'Eliminar Cuenta',
                        'route' => 'account.delete',
                        'icon' => 'bi bi-person-fill-x',
                    ];
                }
            @endphp

            <x-aside-admin :items="$sidebarItems"></x-aside-admin>
            <div class="col-lg-10 col-12 main__content bg-white-border">
                <small class="text__gray">
                    <a href="{{ route('account-profile.index') }}" class="text__gray"> Perfil
                        > </a>
                    <a href="{{ route('change-password.edit') }}" class="text__gray">
                        Cambiar Contraseña</a>
                </small>
                <form action="{{ route('change-password.update') }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="alert alert-dark mt-2  form__description" role="alert">
                        <i class="bi bi-info-circle-fill"></i>
                        La nueva contraseña debe tener un mínimo de 8 caracteres.
                    </div>
                    <legend class="form__title mb-0">
                        <b>
                            Cambiar Contraseña
                        </b>
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
                        'form_input_name' => 'password',
                        'form_title' => 'Nueva Contraseña:',
                        'type' => 'password',
                        'icon' => 'bi-key-fill',
                        'aria_label' => 'Introduce tu nueva contraseña.',
                        'placeholder' => '••••••••',
                        'form_input_value_default' => '',
                        'attribute_a' => '',
                        'form_help_text' => '',
                    ]"></x-input-text>
                    <x-input-text :item="[
                        'form_input_name' => 'password_confirmation',
                        'form_title' => 'Confirmar Contraseña:',
                        'type' => 'password',
                        'icon' => 'bi-key-fill',
                        'aria_label' => 'Confirma tu nueva contraseña.',
                        'placeholder' => '••••••••',
                        'form_input_value_default' => '',
                        'attribute_a' => '',
                        'form_help_text' => '',
                    ]"></x-input-text>
                    <hr>
                    <div class="flex-and-direction-row flex-content-end  form-actions mt-4">

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
