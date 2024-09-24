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
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <h3><i class="bi bi-pencil"></i> Ajouter un employée</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('users.store')}}">
          @csrf
          <div class="row">
            <div class="form-group col-md-4">
              <label>Nom:*</label>
              <input type="" name="name" class="form-control">
              @if($errors->has('name'))
              <div class="text-danger">{{ $errors->first('name') }}</div>
              @endif
              
            </div>


            <div class="form-group col-md-4">
              <label>Prenom:*</label>
              <input type="" name="fname" class="form-control">
              @if($errors->has('fname'))
              <div class="text-danger">{{ $errors->first('fname') }}</div>
              @endif
            </div>

            <div class="form-group col-md-4">
              <label>Sexe:*</label>
              <select class="form-select" name="sexe">
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
              </select>

            </div>

          </div><br>
          <div class="row">

            <div class="form-group col-md-4">
              <label>Adresse Localisation:</label>
              <input type="text" name="adresse" class="form-control">
            </div>

              <div class="form-group col-md-4">
                <label>Date debut du contrat:*</label>
                <input type="date" name="debut_contrat" class="form-control" value="<?php echo date('Y-m-d'); ?>">
              </div>
               <div class="form-group col-md-4">
                <label>Poste occupeé:*</label>
                <select class="form-select selectpicker" name="poste" data-live-search="true">
                  @foreach($postes as $poste)
                  <option value="{{$poste->id}}">{{$poste->name_poste}}</option>
                  @endforeach
                </select>
                @if($errors->has('poste'))
                <div class="text-danger">{{ $errors->first('poste') }}</div>
                @endif
              </div>

            </div><br>

            <div class="row">
             
              <div class="form-group col-md-4">
                <label>Numéro cnps:</label>
                <input type="text" name="cnps" class="form-control">
                @if($errors->has('cnps'))
                <div class="text-danger">{{ $errors->first('cnps') }}</div>
                @endif
              </div>

              <div class="form-group col-md-4">
                <label>Numéro de compte:</label>
                <input type="text" name="compte" class="form-control">

              </div>
              <div class="form-group col-md-4">
                <label>Situation matrimoniale:</label>
                <select class="form-select" name="sm">
                  <option value="célibataire">célibataire</option>
                  <option value="divorce">divorce</option>
                  <option value="mariée">Mariée</option>
                </select>

              </div>

            </div><br>

            <div class="row">

              
              <div class="form-group col-md-4">
                <label>Nombre d'enfant:</label>
                <input type="text" name="nbre_enfant" class="form-control" min="1">
              </div>
              <div class="form-group col-md-4">
                <label>Email:*</label>
                <input type="email" name="email" class="form-control">
                @if($errors->has('email'))
                <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
              </div>
               <div class="form-group col-md-4">
                <label>Phone:*</label>
                <input type="number" name="phone" class="form-control" min="0">
                @if($errors->has('phone'))
                <div class="text-danger">{{ $errors->first('phone') }}</div>
                @endif
              </div>
              
               </div><br>
               <div class="row">
              

              <div class="form-group col-md-12">
                <label>Mot de passe:*</label>
                <input type="text" name="password" class="form-control" min="0" value="{{$mot}}" readonly>
              </div>

            </div></div>
            
            <br>
            <button type="submit" class="btn btn-primary btn-md"><i class="bi bi-pencil"></i> Ajouter Un Employée</button>

          </form>

        </div>
      </div>
    </div>
  </main>
  @endsectio