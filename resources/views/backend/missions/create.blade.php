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
          <h3><i class="bi bi-pencil"></i> AJOUTER UNE MISSION</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('missions.store')}}">
          @csrf
          <div class="row">
            <div class="form-group col-md-4">
              <label>Nom:*</label>
              <select class="form-select selectpicker" name="user" data-live-search="true">
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option>
                @endforeach
              </select>
              @if($errors->has('user'))
              <div class="text-danger">{{ $errors->first('user') }}</div>
              @endif
              
            </div>


            <div class="form-group col-md-4">
              <label>Date de depart:*</label>
              <input type="date" name="date_depart" class="form-control" value="<?php echo date('Y-m-d') ?>">
              @if($errors->has('date_depart'))
              <div class="text-danger">{{ $errors->first('date_depart') }}</div>
              @endif
            </div>

            <div class="form-group col-md-4">
              <label>Date de retour:*</label>
              <input type="date" name="date_retour" class="form-control">
              @if($errors->has('date_retour'))
              <div class="text-danger">{{ $errors->first('date_retour') }}</div>
              @endif
            </div>

          </div><br>
          <div class="row">
            <div class="form-group col-md-4">
              <label>Ville de depart:*</label>
              <input type="text" name="ville_depart" class="form-control">
              </div>

              <div class="form-group col-md-4">
                <label>Ville de retour:</label>
                <input type="text" name="ville_retour" class="form-control">
              </div>

              <div class="form-group col-md-4">
                <label>Frais de la mission:*</label>
               <input type="number" name="frais" class="form-control" min="0">
              </div>

            </div>

            <div class="row">

              <div class="form-group col-md-12">
                <label>motif de la mission:*</label>
                <textarea class="form-control" name="motif" style="height:150px;"></textarea>
              </div>

            </div><br>
            <button type="submit" class="btn btn-success btn-md"><i class="bi bi-check-circle"></i> Ajouter une mission</button>

          </form>

        </div>
      </div>
    </div>
  </main>
  @endsectio