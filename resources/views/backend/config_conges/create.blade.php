@extends('layouts.app')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Tableau de bord</h1>
      <p>vous êtes dans votre session</p>
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
          <h3><i class="bi bi-pencil"></i> CONFIGURER UN CONGE</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('config_conges.store')}}">
          @csrf
          <div class="form-group">
              <label>Selectionner un employé:*</label>
          <select class="form-select selectpicker" name="user" data-live-search="true">
          @foreach($users as $user)
           <option value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option> 
          @endforeach
         </select>
          </div>
        <br>
        <div class="form-group">
         <label>Selectionner une type de congé:*</label>
          <select class="form-select selectpicker" name="conge" data-live-search="true">
          @foreach($conges as $conge)
           <option value="{{$conge->id}}">{{$conge->libelle_conge}}</option> 
          @endforeach
         </select></div><br>
         <label>date de depart:*</label>
         <input type="date" name="depart" class="form-control" value="<?php echo date("Y-m-d") ?>"><br>
         <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Ajouter Configuration</button>

       </form>

     </div>
   </div>
 </div>
</main>
@endsection
