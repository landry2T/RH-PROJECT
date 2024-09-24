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
    @foreach($users as $user)
    <div class="col-md-12">
      <div class="tile">
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-12">

                <table class="table table-bordered" style="border:2px solid black;">
                  <tr><th><img src="/uploads/{{$admin->logo}}" class="rounded" style="height:90px; width:120px;"></th> <th class="text-center">FICHE D’AUTORISATION D’ABSENCE</th> <th class="text-center">IIT-ENR-RH-00<?php echo strtoupper($user->id); ?></th> <th rowspan="2">Rev. 0<?php echo strtoupper($user->id); ?></th></tr>
                </table>

            </div>
            <div class="col-12">
              <table> 
                <tr><th>NOM:</th> <th></th> <th><?php echo strtoupper($user->Fname); ?> </th></tr>
                <tr><th>PRENOM:</th> <th></th> <th><?php echo strtoupper($user->Lname); ?></th></tr>
                <tr><th>DEPARTEMENT:</th></tr>
                <tr><th>FONTION:</th> <th></th><th><?php echo strtoupper($user->name_poste); ?></th></tr>
                <tr><th>NOM N+1:</th> <th></th> <th><?php echo strtoupper($user->autorisant); ?></th></tr>
                <tr><th>PERIODE D'ABSENCE DU: </th> <th></th> <th>&nbsp;&nbsp;<?php echo strtoupper($user->date_debut); ?> &nbsp;&nbsp;&nbsp; AU &nbsp;&nbsp;<?php echo strtoupper($user->date_fin); ?></th></tr>
                <tr><th>MOTIF DE L'ABSENCE</th> <th></th> <th><?php echo strtolower($user->motif); ?></th></tr>
              </table>
            </div>
          </div><br> 
          <div class="col-12">

                <table class="table table-bordered" style="border:2px solid black; height:150px;">
                  <tr><th>OBSERVATIONS</th></tr>
                </table>

            </div>
             <div class="col-12">

                <table class="table table-bordered" style="border:2px solid black; height:150px;">
                  <tr><th>CONCERNE(E) </th> <th> SUPERIEUR HIERACHIQUE</th> <th> RESSOURCES HUMAINES</th> <th> DIRECTION GENERALE</th></tr>
                  <tr> <th> Nom: &nbsp; <?php echo strtoupper($user->Fname); ?>  <br><br><br>      Visa:      <br><br>   <br>  Date</th> <th> Nom: : &nbsp; <?php echo strtoupper($user->autorisant); ?>  <br><br><br>      Visa:      <br><br>   <br>  Date</th> <th> Nom:  <br><br><br>      Visa:      <br><br>   <br>  Date</th> <th> Nom:  <br><br><br>      Visa:      <br><br>   <br>  Date</th></tr>
                </table>

            </div>
          <div class="row invoice-info">
             <div class="row d-print-none mt-2">
              <div class="col-12 text-end"><a class="btn btn-primary" href="javascript:window.print();"><i class="bi bi-printer me-2"></i> Imprimer</a></div>
            </div>
          </section>
        </div>
      </div>
      @endforeach
    </main>
    @endsection