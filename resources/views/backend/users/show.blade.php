@extends('layouts.app')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Tableau de bord</h1>
      <p>Vous ètes dans votre session</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
    </ul>
  </div>
  @foreach($users as $user)
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="tile-title-w-btn">

            <h3><i class="bi bi-person-lock"></i> Profil de l'employée <span class="text-primary">{{$user->Fname}} {{$user->Lname}}</span></h3>
            <p><a class="btn btn-danger icon-btn" href="{{route('users.index')}}"><i class="bi bi-box-arrow-in-right"></i>Revenir  </a></p>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
             <tbody>
               <tr><th>Poste occupée:</th> <th>{{$user->name_poste}}</th></tr>
               <tr><th>Début du contrat:</th> <th>{{$user->date_contrat}}</th></tr>
               <tr><th>Adresse Localisation:</th> <th>{{$user->adresse}}</th></tr>
               <tr><th>Statut Matrimoniale:</th> <th>{{$user->sm}}</th></tr>
               <tr><th>Nombre d'enfant:</th> <th>0{{$user->nbre_enfant}} enfant(s)</th></tr>
               <tr><th>Numero de cnps:</th> 
                @if($user->numero_cnps!=null)
                <th>{{$user->numero_cnps}} </th>
                @else
                <td>champs vide(s)</td>
              @endif</tr>
              <tr><th>Numero du compte:</th> 
                @if($user->numero_compte!=null)
                <th>{{$user->numero_compte}} </th>
                @else
                <td>champs vide(s)</td>
              @endif</tr>
              <tr><th>Téléphone:</th> <th>{{$user->phone}} </th></tr>
              <tr><th>Email:</th> <th>{{$user->email}} </th></tr>
              <tr><th>Sexe:</th> <th>{{$user->sexe}} </th></tr>
              <tr><th>Matricule:</th> <th>{{$user->identifiant}} </th></tr>
            </tbody>
          </table>
        </div></div>
      </div>
    </div>
  </div>

  @endforeach
</main>
@endsection