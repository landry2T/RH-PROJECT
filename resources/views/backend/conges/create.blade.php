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
          <h3><i class="bi bi-clipboard-check"></i> Ajouter un type congé</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('conges.store')}}">
          @csrf

          <label>Nom du congé:*</label>
          <input type="text" name="name" class="form-control"><br>

          <label>Durée du congé (en jour) :*</label>
          <input type="number" name="duree" class="form-control" min="1">

          <br>
          <button type="submit" class="btn btn-warning btn-md"><i class="bi bi-pencil"></i> Ajouter type de congé</button>

        </form>

      </div>
    </div>
  </div>
</main>
@endsection