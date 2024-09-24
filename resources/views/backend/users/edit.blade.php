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

            <h3><i class="bi bi-pencil"></i>Editer le profil de l'employée <span class="text-primary">{{$user->Fname}} {{$user->Lname}}</span></h3>
            <p><a class="btn btn-danger icon-btn" href="{{route('users.index')}}"><i class="bi bi-box-arrow-in-right"></i>Revenir  </a></p>
          </div>

           <form method="POST" action="{{route('users.update', $user->id)}}">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="form-group col-md-4">
                <label>Nom:*</label>
                <input type="" name="name" class="form-control" value="{{$user->Fname}}">
              </div>

              <div class="form-group col-md-4">
                <label>Prenom:*</label>
                <input type="" name="fname" class="form-control" value="{{$user->Lname}}">
              </div>

              <div class="form-group col-md-4">
                <label>Sexe:*</label>
                <select class="form-select" name="sexe">
                  @if($user->sexe=='M')
                  <option @selected($user->sexe=='M') value="M">Masculin</option>
                  <option value="F">Féminin</option>
                  @else
                  <option value="M">Masculin</option>
                  <option @selected($user->sexe=='F') value="F">Féminin</option>
                  @endif
                </select>
              </div>
            </div><br>
             <div class="row">
              <div class="form-group col-md-4">
                <label>Adresse Localisation:</label>
                <input type="text" name="adresse" class="form-control" value="{{$user->adresse}}">
              </div>
              <div class="form-group col-md-4">
                <label>Date debut du contrat:*</label>
                <input type="date" name="debut_contrat" class="form-control" value="{{$user->date_contrat}}">
              </div>

              <div class="form-group col-md-4">
                <label>Poste occupeé:*</label>
                <select class="form-select selectpicker" name="poste" data-live-search="true">
                  @foreach($postes as $poste)
                  <option @selected($user->poste_id==$poste->id) value="{{$poste->id}}">{{$poste->name_poste}}</option>
                  @endforeach
                </select>
              </div>
            </div><br>
             <div class="row">
              <div class="form-group col-md-4">
                <label>Numéro cnps:</label>
                <input type="text" name="cnps" class="form-control" value="{{$user->numero_cnps}}">
              </div>

              <div class="form-group col-md-4">
                <label>Numéro de compte:</label>
                <input type="text" name="compte" class="form-control" value="{{$user->numero_compte}}">
              </div>
              <div class="form-group col-md-4">
                <label>Situation matrimoniale:</label>
                <select class="form-select" name="sm">
                  @if($user->sm=='célibataire')
                  <option @selected($user->sm=='célibataire') value="célibataire">célibataire</option>
                  <option value="divorce">divorce</option>
                  <option value="mariée">Mariée</option>
                  @elseif($user->sm=='divorce')
                  <option  value="célibataire">célibataire</option>
                  <option @selected($user->sm=='divorce') value="divorce">divorce</option>
                  <option value="mariée">Mariée</option>
                  @else
                   <option value="célibataire">célibataire</option>
                  <option value="divorce">divorce</option>
                  <option  @selected($user->sm=='mariée') value="mariée">Mariée</option>
                  @endif
                </select>

              </div>

              </div><br>

              <div class="row">
              <div class="form-group col-md-4">
                <label>Nombre d'enfant:</label>
                <input type="text" name="nbre_enfant" class="form-control" min="1" value="{{$user->nbre_enfant}}">
              </div>

              <div class="form-group col-md-4">
                <label>Email:*</label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}">
              </div>
             
              <div class="form-group col-md-4">
                <label>Phone:*</label>
                <input type="number" name="phone" class="form-control" min="0" value="{{$user->phone}}">
              </div>

              </div><br>

              <div class="form-group col-md-12">
                <label>Mot de passe:*</label>
                <input type="text" name="identifiant" class="form-control"  value="{{$user->identifiant}}"  readonly>
              </div>

            </div>
      
            <br>
            <button type="submit" class="btn btn-primary btn-md"><i class="bi bi-pencil"></i>Modifier Un Employée</button>

          </form>

      </div>
    </div>
  </div>

  @endforeach
</main>
@endsection