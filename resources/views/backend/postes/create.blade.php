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
          <h3><i class="bi bi-pencil"></i> AJOUTER UN POSTE</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            {{ Session::get('error') }}</strong>
          </div>
          @endif
          <form method="POST" action="{{route('postes.store')}}">
            @csrf
             <label>Selectionner un departement:*</label>
            <select class="form-select" aria-label="Default select example" name="dep">
              @foreach($departements as $depart)
              <option value="{{$depart->id}}">{{$depart->name_departement}}</option>
              @endforeach
            </select>
             <label>Selectionner une classe:*</label>
            <select class="form-select" aria-label="Default select example" name="class">
              @foreach($classifications as $class)
              <option value="{{$class->id}}">{{$class->echellon}}{{$class->name_categorie}} - [<?php echo ($class->nombre_heure*$class->montant_heure) ?> XAF]</option>
              @endforeach
            </select>
            <label>Intitulé du poste:*</label>
            <input type="text" name="name" class="form-control" >
            <br>
            <button type="submit" class="btn btn-dark"><i class="bi bi-pencil"></i> Ajouter Un poste</button>

          </form>

        </div>
      </div>
    </div>
  </main>
  @endsection