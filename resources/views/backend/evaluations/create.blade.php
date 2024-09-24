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
          <h3><i class="bi bi-clipboard-check"></i> Ajouter une évaluation</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('evaluations.store')}}">
          @csrf
          
          <div class="row">

            <div class="form-group col-md-6">
             <label>selectionner un salarié:*</label>
             <select class="form-select selectpicker" name="user_id" data-live-search="true">
              @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option>
              @endforeach
            </select>
          </div>

          <div  class="form-group col-md-6">
           <label>selectionner un mois:*</label>
           <select class="form-select selectpicker" name="mois" data-live-search="true">
            <option value="01">Janvier</option>
            <option value="02">Fevrier</option>
            <option value="03">Mars</option>
            <option value="04">Avril</option>
            <option value="05">Mai</option>
            <option value="06">Juin</option>
            <option value="07">Juillet</option>
            <option value="08">Aout</option>
            <option value="09">Setptembre</option>
            <option value="10">octobre</option>
            <option value="11">novembre</option>
            <option value="12">decembre</option>
          </select>
        </div>

        <div class="form-group col-md-6">

          <label>Note sur le savoir etre (/10) :*</label>
          <input type="number" name="savoir_etre" class="form-control" min="0" value="0" max="10">
        </div>

        <div class="form-group col-md-6">
          <label>Note sur le savoir faire (/10) :*</label>
          <input type="number" name="savoir_faire" class="form-control" min="1" value="0" max="10">
        </div>

      </div>


      <br>
      <button type="submit" class="btn btn-primary btn-md"><i class="bi bi-pencil"></i> Ajouter Evaluation</button>

    </form>

  </div>
</div>
</div>
</main>
@endsection