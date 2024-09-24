@extends('layouts.app_user')

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
          <h3><i class="bi bi-pencil"></i> Valider mon pointage du <?php echo date('Y-m-d') ?></h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            {{ Session::get('error') }}</strong>
          </div>
          @endif

           @if (Session::has('success'))<br>
          <div class="alert alert-success mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            {{ Session::get('success') }}</strong>
          </div>
          @endif

          @if (Session::has('succes'))<br>
          <div class="alert alert-warning mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            {{ Session::get('succes') }}</strong>
          </div>
          @endif
          <?php $date=date('G');  if($date < 14) {?>

          <form method="POST" action="{{route('pointage')}}">
            @csrf
            
             <div class="row">
              <div class="form-group col-md-12">
                <label>heure d'arrivé:*</label>
                <input type="text" name="heure_arrive" class="form-control" value="<?php echo date('G:i:s'); ?>" readonly="on">
              </div>

              <div class="form-group col-md-12">
                <label>Enter le code de verification:*</label>
                <input type="number" name="code" class="form-control">
              </div>

              </div><br>
            <button type="submit" class="btn btn-primary btn-md"><i class="bi bi-pencil"></i> Valider heure d'arrivé</button>

          </form>
           <?php }else {?>
            <form method="POST" action="{{route('pointage')}}">
            @csrf
            
             <div class="row">
              <div class="form-group col-md-12">
                <label>heure de sortie:*</label>
                <input type="text" name="heure_arrive" class="form-control" value="<?php echo date('G:i:s'); ?>" readonly="on">
              </div>
              </div><br>
            <button type="submit" class="btn btn-danger btn-md"><i class="bi bi-pencil"></i> Valider heure de sortie </button>

          </form>
        <?php } ?>

        </div>
      </div>
    </div>
  </main>
  @endsection