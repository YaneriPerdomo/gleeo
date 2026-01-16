 <header class="header">
     <div class="header__content
     {{ $isPlayer == '1' ? 'header__content--rol-player' : 'container-xl ' }}
     ">
         <section class="header__top-bar flex-and-direction-row flex-content-space-between"
             style="{{ $splashScreen == 'true' ? 'margin-bottom: 0rem; !important' : '' }}">
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
                     @if (Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3)
                         <div class="notification">
                             <i class="bi bi-bell-fill text-white"></i>
                         </div>
                     @endif
                     <div class="profile">
                         <div class="profile__greeting dropdown flex-and-direction-row">

                             @if ($img != 'null')
                                 <img src="{{ asset('img/avatars/' . $img) }}" class="profile__avatar" alt="">
                             @endif <button class="btn btn-secondary dropdown-toggle" type="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 ¡Hola, {{ ucfirst(Auth::user()->user) }}!
                             </button>

                             <ul class="dropdown-menu dropdown-menu-dark">
                                 @if ($splashScreen != 'true')
                                     @if (Auth::user()->rol_id == 3)
                                         <li><a class="dropdown-item "
                                                 href="
                                        {{ route(Auth::user()->rol_id == 2 ? 'account-profile.index' : 'children.general-progress') }}">Resumen
                                                 General</a>
                                         </li>
                                         <li><a class="dropdown-item " href="{{ route('ranking.global') }}">Ranking
                                                 Global</a>
                                         </li>
                                     @else
                                         <li><a class="dropdown-item "
                                                 href="
                                        {{ route(Auth::user()->rol_id == 2 ? 'account-profile.index' : 'children.general-progress') }}">Perfil</a>
                                         </li>
                                     @endif
                                 @endif
                                 @if (Auth::user()->rol_id == 3)
                                 @else
                                     <li><a class="dropdown-item" href="{{ route('change-password.edit') }}">Cambiar
                                             Contraseña</a></li>
                                     <li>
                                         <hr class="dropdown-divider">
                                     </li>
                                 @endif
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
                     @if (Auth::user()->rol_id == 3 && $splashScreen != 'true')
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('educational-platform.index', ['slugCurrentLevel' => Auth::user()->player->current_level->slug]) }}"
                                 class="header__navigation-bar__link">
                                 <i class="bi bi-house-door-fill"></i> Inicio
                             </a>
                         </li>
                         <!--
                         <li class="header__navigation-bar__list-item">
                             <a href="#" class="header__navigation-bar__link">
                                 <i class="bi bi-layers-fill"></i> Mis Niveles
                             </a>
                         </li>
                        -->
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('ranking-global.index', ['slugCurrentLevel' => Auth::user()->player->current_level->slug]) }}"
                                 class="header__navigation-bar__link">
                                 <i class="bi bi-award-fill"></i> Ranking por Nivel
                             </a>
                         </li>
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('progress.index', ['slugCurrentLevel' => Auth::user()->player->current_level->slug]) }}"
                                 class="header__navigation-bar__link">
                                 <i class="bi bi-graph-up-arrow"></i> Progreso por Nivel
                             </a>
                         </li>
                     @endif

                     @if (Auth::user()->rol_id == 1)
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('welcome') }}" class="header__navigation-bar__link">
                                 <i class="bi bi-house-door-fill"></i> Inicio
                             </a>
                         </li>
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('initial-decision-patterns.index') }}"
                                 class="header__navigation-bar__link"><i class="bi bi-robot"></i>
                                 Configuración del Tutor</a>
                         </li>
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('study-plan.index') }}" class="header__navigation-bar__link">
                                 <i class="bi bi-journals"></i>
                                 Plataforma Educativa
                             </a>
                         </li>
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('representative.index') }}" class="header__navigation-bar__link"><i
                                     class="bi bi-people-fill"></i>
                                 Gestión de Cuentas </a>
                         </li>
                     @endif
                     @if (Auth::user()->rol_id == 2)
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('welcome') }}" class="header__navigation-bar__link">
                                 <i class="bi bi-house-door-fill"></i> Inicio
                             </a>
                         </li>
                         <li class="header__navigation-bar__list-item">
                             <a href="{{ route('children.index') }}" class="header__navigation-bar__link"><i
                                     class="bi bi-person-video3"></i>
                                 Gestión de Cuentas </a>
                         </li>
                     @endif
                 </ul>
             </nav>
         </section>
     </div>
 </header>
