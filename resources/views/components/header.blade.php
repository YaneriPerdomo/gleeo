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
             @auth
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
                                 <li><a class="dropdown-item active" href="{{ route('account-profile.index') }}">Perfil</a>
                                 </li>
                                 <li><a class="dropdown-item" href="{{ route('change-password.edit') }}">Cambiar
                                         Contraseña</a></li>
                                 <li>
                                     <hr class="dropdown-divider">
                                 </li>
                                 <li>
                                     <form action="{{ route('login.logout') }}" method="POST" class="dropdown-menu__form">
                                         @csrf
                                         @method('POST')
                                         <button class="button dropdown-menu__button p-0 mx-2"
                                             style="margin-left: 1rem !important;">
                                             Cerrar Sesion
                                         </button>
                                     </form>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             @endauth
         </section>
         <section class="header__navigation-bar">
             <nav class="header__navigation-bar__nav">
                 <ul class="header__navigation-bar__list flex-and-direction-row">
                     <li class="header__navigation-bar__list-item">
                         <a href="{{ route('welcome') }}" class="header__navigation-bar__link"><i
                                 class="bi bi-house-door-fill"></i>
                             Inicio</a>
                     </li>
                     <li class="header__navigation-bar__list-item">
                         <a href="{{ route('initial-decision-patterns.index') }}"
                             class="header__navigation-bar__link"><i class="bi bi-robot"></i>
                             Configuración del Tutor</a>
                     </li>
                     <li class="header__navigation-bar__list-item">
                         <a href="{{ route('study-plan.index') }}" class="header__navigation-bar__link">
                             <i class="bi bi-journals"></i>
                             Gestión de Contenido
                         </a>
                     </li>
                     <li class="header__navigation-bar__list-item">
                         <a href="{{ route('representative.index') }}" class="header__navigation-bar__link"><i class="bi bi-people-fill"></i>
                             Gestión de Cuentas</a>
                     </li>

                 </ul>
             </nav>
         </section>
     </div>
 </header>
