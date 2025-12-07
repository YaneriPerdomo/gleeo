<!doctype html>
<html lang="es" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesion | <x-system-name name="Gleeo"></x-system-name> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root {
            --green: rgb(86, 153, 44);
            --blue: rgb(18, 63, 100);
            --black: rgb(47, 47, 47);
            --red: rgb(244, 67, 67);
            --gray: rgb(104, 104, 104);
            --gold: rgb(176, 131, 22);
            --light-blue: rgb(21, 79, 128);
            --purple: #7859cf;
            --orange: #ff7f48;

        }

        body {
            background: rgb(226, 226, 226);
        }

        header {
            background: var(--purple);
            padding-top: 1rem;
        }

        .flex-and-direction-column {
            display: flex;
            flex-direction: column;
        }

        .flex-and-direction-row {
            display: flex;
            flex-direction: row;
        }

        .flex-center-full {
            justify-content: center;
            align-items: center;
        }

        .height-full {
            height: 100%;
        }

        .flex-grow-2 {
            flex-grow: 2;
        }

        footer {
            background: var(--black);
            padding: 1.5rem;
            color: white;
        }

        .footer__paragraph {
            margin: 0rem;
        }

        .flex-content-space-between {
            justify-content: space-between;
            align-items: center;
        }

        .header__navigation-bar__list-item {
            list-style: none;

        }

        .header__navigation-bar__link {
            color: white;
            text-decoration: none
        }

        .header__navigation-bar__list {
            gap: 1rem;
        }

        .header__logo-figure {
            margin: 0rem !important;
        }

        .header__top-bar {
            margin-bottom: 1rem;
        }

        .dropdown-toggle {
            background: none;
            border: 0rem;
        }

        .header__logo-img {
            width: 60px;
        }

        .header__logo-text {
            background: #7859CF;
           background: linear-gradient(90deg,rgba(120, 89, 207, 1) 29%, rgba(255, 127, 72, 1) 100%);
            border-radius: 1rem;
            padding-right: .5rem;
        }
    </style>
</head>

<body class="flex-and-direction-column height-full">
    <header class="header">
        <div class="header__content container-xl">
            <section class="header__top-bar flex-and-direction-row flex-content-space-between">
                <div class="header__logo">
                    <section class="header__logo-section flex-and-direction-row">
                        <span class="header__logo-text text-white fs-4">
                            <strong>

                                    Gleeo

                            </strong>
                        </span>
                    </section>
                </div>
                <div class="header__profile-container flex-and-direction-row flex-center-full ">
                    <div class="notification">
                        <i class="bi bi-bell-fill text-white"></i>
                    </div>
                    <div class="profile">
                        <div class="profile__greeting dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                ¡Hola, {{ Auth::user()->user }}!
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item active" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </section>
            <section class="header__navigation-bar">
                <nav class="header__navigation-bar__nav">
                    <ul class="header__navigation-bar__list flex-and-direction-row">
                        <li class="header__navigation-bar__list-item">
                            <a href="#" class="header__navigation-bar__link">Inicio</a>
                        </li>
                        <li class="header__navigation-bar__list-item">
                            <a href="#" class="header__navigation-bar__link">Configuración del Tutor</a>
                        </li>
                        <li class="header__navigation-bar__list-item">
                            <a href="#" class="header__navigation-bar__link">Gestión de Cuentas</a>
                        </li>

                    </ul>
                </nav>
            </section>
        </div>
    </header>
    <main class="flex-grow-2 ">

    </main>
    <footer class="footer">
        <p class="footer__paragraph flex-and-direction-row flex-center-full">
            © {{ Date('Y') }} <x-system-name name="Gleeo"></x-system-name> | Todos los derechos reservados |
            Política de
            privacidad | Aviso legal | Política de cookies | Contacto {{ Date('Y') }}
        </p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
