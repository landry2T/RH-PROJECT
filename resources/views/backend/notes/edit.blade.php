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
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h3 class="page-header"><img src="/uploads/{{$admin->logo}}" class="rounded" style="height:50px; width:70px;"> {{$admin->name}}</h3>
            </div>
            <div class="col-6">
              <h3 class="text-end" style="text-decoration:underline;">Douala le , <?php echo date('d-m-Y') ?></h3>
            </div>
          </div><br>
          <div class="row invoice-info">
            <div class="col-12">
              <h2 class="text-center">Note de service N° <?php echo date('Y') ?>/00{{$notes->id}}</h2>
            </div><br><br><br>
            <div class="row invoice-info">
              <div class="col-4">
                <address><strong style="font-size:1.3em; text-decoration-line:underline;">Objet note : &nbsp;</strong> <em style="font-size:1.3em;"> {{$notes
                  ->subject}}</em>
                </div>
              </div><br><br>
              <div class="row">
                <div class="col-12 table-responsive" style="margin-left:15px;">
                 &nbsp;&nbsp;<?php echo $notes->contenu; ?>
               </div>
             </div>
             <div class="row">
                <div class="col-12 table-responsive" style="margin-left:900px;">
                 <h6>La direction générale</h6>
               </div>
             </div>
             <div class="row d-print-none mt-2">
              <div class="col-12 text-end"><a class="btn btn-primary" href="javascript:window.print();"><i class="bi bi-printer me-2"></i> Imprimer</a></div>
            </div>
          </section>
        </div>
      </div>
    </main>
    @endsection