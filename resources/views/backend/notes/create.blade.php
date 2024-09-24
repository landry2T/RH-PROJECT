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
          <h3><i class="bi bi-clipboard-check"></i> AJOUTER NOTE DE SERVICE</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('notes.store')}}">
          @csrf

          <br><label>Sujet de la note:*</label>
          <input type="text" name="sujet" class="form-control"><br>

          <label>contenu de la note :*</label>
          <textarea id="myTextarea" name="contenu"></textarea>

          <br>
          <button type="submit" class="btn btn-dark btn-md"><i class="bi bi-pencil"></i> Ajouter une note</button>

        </form>

      </div>
    </div>
  </div>
</main>
@endsection