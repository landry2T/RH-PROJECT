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
  @foreach($missions as $m)
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="tile-title-w-btn">

            <h3><i class="bi bi-person-lock"></i> Detail de la mission de  <span class="text-primary">{{$m->Fname}} {{$m->Lname}}</span></h3>
            <p><a class="btn btn-info icon-btn" href="{{route('missions.index')}}"><i class="bi bi-box-arrow-in-right"></i>Revenir  </a></p>
          </div>
          <?php $date=date('Y-m-d'); ?>
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
             <tbody>
               <tr><th>Ville de depart:</th> <th>{{$m->ville_depart}}</th></tr>
               <tr><th>Ville de retour:</th> <th>{{$m->ville_retour}}</th></tr>
               <tr><th>date de depart:</th> <th>{{$m->date_depart}}</th></tr>
               <tr><th>date de retour:</th> <th>{{$m->date_retour}}</th></tr>
               <tr><th>nombre de jour:</th> <th><?php echo ((strtotime($m->date_retour)-strtotime($m->date_depart))/86400) ?> jr(s)</th></tr>
               <tr><th>Montant de la mission:</th> <th>{{$m->total_mission}}</th></tr>
               <tr><th>Motif de la mission:</th> <th>{{$m->motif}}</th></tr>
               <tr><th>Status de la mission:</th>
                <th>
                  @if($date>$m->date_retour)

                  <span class="badge bg-success">Mission Terminer</span>
                  @else
                  <span class="badge bg-danger">Mission en cours d'execution ....</span>
                  @endif
               </th></tr>
            </tbody>
          </table>
        </div></div>
      </div>
    </div>
  </div>

  @endforeach
</main>
@endsection