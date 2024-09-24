   <!-- Navbar-->
   <header class="app-header"><a class="app-header__logo" href="#">OUTIL-RH</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <li class="app-search">
        <input class="app-search__input" type="search" placeholder="Search">
        <button class="app-search__button"><i class="bi bi-search"></i></button>
      </li>
      <!--Notification Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Show notifications"><i class="bi bi-bell fs-5"></i></a>
      </li>
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2 fs-5"></i> Profile</a></li>
          <li>
           <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
           document.getElementById('admin-logout-form').submit();"><i class="bi bi-box-arrow-right me-2 fs-5"></i>
           <span class="app-menu__label">Se Deconnecter</span>
           <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </a>
      </ul>
    </li>
  </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{asset('assets/img/images.png')}}" alt="User Image">       
    <div>
      <p class="app-sidebar__user-name">WELCOME</p>
      <p class="app-sidebar__user-designation">{{Auth::user()->Fname}}</p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item active" href="{{route('bord')}}"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Tableau de bord</span></a></li>

    <li><a class="app-menu__item" href="{{route('pointage')}}"><i class="app-menu__icon bi bi-building-fill-check"></i><span class="app-menu__label">pointage jounalier</span></a></li>

    <li><a class="app-menu__item" href="{{route('conge')}}"><i class="app-menu__icon bi bi bi-briefcase-fill"></i><span class="app-menu__label">congés</span></a></li>

     <li><a class="app-menu__item" href="{{route('absence')}}"><i class="app-menu__icon bi bi-layout-text-window-reverse"></i><span class="app-menu__label">absences</span></a></li>

     <li><a class="app-menu__item" href="{{route('bulletin')}}"><i class="app-menu__icon bi bi-file-earmark-pdf-fill"></i><span class="app-menu__label">bulletin de paie</span></a></li>

     

    <li>
      <a class="app-menu__item" href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('admin-logout-form').submit();"><i class="app-menu__icon bi bi-box-arrow-right me-2 fs-5"></i>
      <span class="app-menu__label">Se Deconnecter</span>
      <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </a>
  </li>
</ul>
</aside>