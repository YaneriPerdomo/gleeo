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
            <div class="col-10 main__content bg-white-border profile">
                <small class="text__gray">
                    <a href="{{ route('account-profile.index') }}" class="text__gray"> Perfil > </a>
                    <a href="{{ route('account-profile.index') }}" class="text__gray">
                        Información Personal
                    </a>
                </small>
                <div class="flex-and-direction-row flex-content-space-between profile__header">
                    <span class="fs-4 profile__title-text">
                        <strong>
                            Información Personal
                        </strong>
                    </span>
                    <a href="{{ route('personal-profile.edit') }}">
                        <button class="button button__color-purple profile__config-button">
                            <i class="bi bi-save"></i> Editar
                        </button>
                    </a>
                </div>
                <section class="profile__data">
                    <div>
                        <b>Identificación de Rol: </b>
                        <span>
                            {{ $data->type }}
                        </span>
                    </div>
                    @if ($data->type == 'Profesional')
                        <div>
                            <b>Centro Educativo: </b>
                            <span>
                                {{ $data->educational_center }}
                            </span>
                        </div>
                    @endif
                    <div>
                        <b>Género: </b>
                        <span>
                            {{ $data->gender->name }}
                        </span>
                    </div>
                </section>
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
