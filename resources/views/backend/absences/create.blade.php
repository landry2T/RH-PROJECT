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
          <h3><i class="bi bi-bell"></i> AJOUTER ABSENCE</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            {{ Session::get('error') }}</strong>
          </div>
          @endif
          <form method="POST" action="{{route('absences.store')}}">
            @csrf
            
             <div class="row">
              <div class="form-group col-md-6">
                <label>Selectionner un employée:*</label>
                <select class="form-select selectpicker" name="user" data-live-search="true">
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Nom de l'autorisant:</label>
                <input type="text" name="autorisant" class="form-control">
              </div>
            </div><br>

             <div class="row">
              <div class="form-group col-md-6">
                <label>Date de depart:*</label>
                <input type="date" name="date_depart" class="form-control" value="<?php echo date('Y-m-d'); ?>">
              </div>

              <div class="form-group col-md-6">
                <label>Date de retour:*</label>
                <input type="date" name="date_retour" class="form-control" value="">
              </div>

              </div><br>

              <div class="row">
              <div class="form-group col-md-12">
                <label>Motif de l'absence:</label>
                <input type="text" name="motif" class="form-control">
              </div>
              </div><br>

      
            <br>
            <button type="submit" class="btn btn-info btn-md"><i class="bi bi-pencil"></i> Ajouter un absence</button>

          </form>

        </div>
      </div>
    </div>
  </main>
  @endsection