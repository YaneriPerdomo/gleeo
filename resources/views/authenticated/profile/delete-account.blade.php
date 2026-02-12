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
                <form action="{{ route('account.delete') }}" class="form" method="POST" id="deleteAccountForm">
                    @csrf
                    @method('DELETE')
                    <div class="alert alert-danger mt-2 form__description" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <strong>¡Atención!</strong> Esta acción es irreversible. Al eliminar tu cuenta, también se
                        borrarán permanentemente todos tus <b>jugadores</b> y su progreso en la plataforma educativa.
                        <hr>
                        Para confirmar, escribe la palabra <b>ELIMINAR</b> en el campo de abajo.
                    </div>
                    <legend class="form__title mb-0">
                        <b>Eliminar Cuenta</b>
                    </legend>

                    @if (session('alert-danger'))
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-octagon-fill"></i>
                            {{ session('alert-danger') }}
                        </div>
                    @endif

                    <x-input-text :item="[
                        'form_input_name' => 'confirm_delete',
                        'form_title' => 'Confirmación:',
                        'type' => 'text',
                        'icon' => 'bi-trash-fill',
                        'aria_label' => 'Escribe ELIMINAR para confirmar.',
                        'placeholder' => 'Escribe ELIMINAR aquí',
                        'form_input_value_default' => '',
                        'attribute_a' => 'id=confirmInput autocomplete=off',
                        'form_help_text' => '',
                    ]"></x-input-text>

                    <hr>

                    <div class="flex-and-direction-row flex-content-end form-actions mt-4">
                        <button type="submit" id="deleteButton" class="button button__color-red" disabled style="opacity: 0.5;">
                            <i class="bi bi-person-fill-x"></i> Eliminar Cuenta Permanentemente
                        </button>
                    </div>
                </form>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const input = document.getElementById('confirm_delete');
                    const button = document.getElementById('deleteButton');
                    const keyword = "ELIMINAR";
                    input.addEventListener('input', function() {
                        if (input.value.trim().toUpperCase() === keyword) {
                            button.disabled = false;
                            button.style.opacity = "1";
                        } else {
                            button.disabled = true;
                            button.style.opacity = "0.5";
                        }
                    });
                });
            </script>
        </article>
        <script src="{{ asset('js/components/header.js') }}" type="module"></script>
    </main>
    <x-footer name="Gleeo"></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
