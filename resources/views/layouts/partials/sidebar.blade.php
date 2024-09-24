   <!-- Navbar-->
   <header class="app-header"><a class="app-header__logo" href="#"   style="font-family: var(--bs-body-font-family); font-size:1.5em;"><i class="bi bi-database"></i> ONEPAYWAVE</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <li class="app-search">
        <span style="font-family: var(--bs-body-font-family);" class="text-white">{{Auth::guard('admin')->user()->name}}</span>
      </li>
      <!--Notification Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Show notifications"><i class="bi bi-bell fs-5"></i></a>
      </li>
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="{{route('showing')}}"><i class="bi bi-person me-2 fs-5"></i> Profile</a></li>
          <li>
           <a class="dropdown-item" href="{{ route('admin.logout.submit') }}" onclick="event.preventDefault();
           document.getElementById('admin-logout-form').submit();"><i class="bi bi-box-arrow-right me-2 fs-5"></i>
           <span class="app-menu__label">Se Deconnecter</span>
           <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
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
  <div class="app-sidebar__user">
    @php
    $img=Auth::guard('admin')->user()->logo;
    @endphp
    @if(Auth::guard('admin')->user()->logo == null)
    <img class="app-sidebar__user-avatar" src="{{asset('assets/img/images.png')}}" alt="User Image">
    @else 
    <img class="app-sidebar__user-avatar" src="{{asset('uploads/'.$img)}}" alt="User Image" style="height:60px; width:100px;">
    @endif       
    <div>
      <p class="app-sidebar__user-name">BIENVENUE</p>
      <p class="app-sidebar__user-designation">SUPERADMIN</p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item active" href="{{route('dashboard.index')}}"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Tableau de bord</span></a></li>
    <li><a class="app-menu__item" href="{{route('departements.index')}}"><i class="app-menu__icon bi bi-table"></i><span class="app-menu__label">Départements</span></a></li>
    <li><a class="app-menu__item" href="{{route('classifications.index')}}"><i class="app-menu__icon bi bi-bookmark-check-fill"></i><span class="app-menu__label">Classifications</span></a></li>
    <li><a class="app-menu__item" href="{{route('postes.index')}}"><i class="app-menu__icon bi bi-briefcase-fill"></i><span class="app-menu__label">Postes</span></a></li>

    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-bookmark-fill"></i><span class="app-menu__label">Primes et Idemnités</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{route('primes.index')}}"><i class="icon bi bi-circle-fill"></i>Ajouter une prime</a></li>
        <li><a class="treeview-item" href="{{route('config_primes.index')}}"><i class="icon bi bi-circle-fill"></i>Configurer une prime</a></li>
      </ul>
    </li>
     <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-person"></i><span class="app-menu__label">Personnel</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{route('users.index')}}"><i class="icon bi bi-circle-fill"></i>Ajouter un salarié</a></li>
        <li><a class="treeview-item" href="{{route('list_users')}}"><i class="icon bi bi-circle-fill"></i> Liste du personnel</a></li>
      </ul>
    </li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-clipboard-check"></i><span class="app-menu__label">Ressource humaine</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{route('conges.index')}}"><i class="icon bi bi-circle-fill"></i>Confgurer un type de congé</a></li>
        <li><a class="treeview-item" href="{{route('config_conges.index')}}"><i class="icon bi bi-circle-fill"></i>demander un congé</a></li>
        <li><a class="treeview-item" href="{{route('absences.index')}}"><i class="icon bi bi-circle-fill"></i>demander une absence</a></li>
         <li><a class="treeview-item" href="{{route('notes.index')}}"><i class="icon bi bi-circle-fill"></i>ajouter note de service</a></li>
          <li><a class="treeview-item" href="{{route('missions.index')}}"><i class="icon bi bi-circle-fill"></i>ajouter une mission</a></li>
      </ul>
    </li>
      <li><a class="app-menu__item" href="{{route('pointages.index')}}"><i class="app-menu__icon bi bi-building-check"></i><span class="app-menu__label">Pointages</span></a></li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-bookmark-check"></i><span class="app-menu__label">Bulletin de paie</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{route('heures.index')}}"><i class="icon bi bi-circle-fill"></i>Ajouter heure supplementaire</a></li>
        <li><a class="treeview-item" href="{{route('avances.index')}}"><i class="icon bi bi-circle-fill"></i>Ajouter avance salariale</a></li>
        <li><a class="treeview-item" href="{{route('bulletins.index')}}"><i class="icon bi bi-circle-fill"></i>generer bulletin de paie</a></li>
        <li><a class="treeview-item" href="{{route('bulletins.create')}}"><i class="icon bi bi-circle-fill"></i>imprimer bulletin de paie</a></li>
      </ul>
    </li>

    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-archive-fill"></i><span class="app-menu__label">Archivages documents</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{route('typedocs.index')}}"><i class="icon bi bi-circle-fill"></i>Ajouter categorie Archive</a></li>
        <li><a class="treeview-item" href="{{route('archives.index')}}"><i class="icon bi bi-circle-fill"></i>Ajouter une nouvelle archive</a></li>
      </ul>
    </li>

      <li><a class="app-menu__item" href="{{route('declarations.index')}}"><i class="app-menu__icon bi bi-book"></i><span class="app-menu__label">Declarations d'impots</span></a></li>
  
     <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-bar-chart-line-fill"></i><span class="app-menu__label">Statistiques</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{route('evaluations.index')}}"><i class="icon bi bi-circle-fill"></i>Evaluation d'un personnel</a></li>
        <li><a class="treeview-item" href="{{route('statistiques.index')}}"><i class="icon bi bi-circle-fill"></i>Statistique globale</a></li>
      </ul>
    </li>
      <a class="app-menu__item" href="{{ route('admin.logout.submit') }}" onclick="event.preventDefault();
      document.getElementById('admin-logout-form').submit();"><i class="app-menu__icon bi bi-box-arrow-right me-2 fs-5"></i>
      <span class="app-menu__label">Se Deconnecter</span>
      <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </a>
  </li>
</ul>
</aside>