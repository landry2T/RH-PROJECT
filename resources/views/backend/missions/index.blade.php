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

          <h3><i class="bi bi-table"></i> MISSIONS</h3>
          <div style="float:right;"> <a href="{{route('missions.create')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Ajouter nouvelle mission</a></div><br><br><br>
          @if (Session::has('success'))<br>
          <div class="alert alert-success mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('success') }}</strong>
         </div>
         @endif

         @foreach ($errors->all() as $error)
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ $error }}</strong>
         </div>
         @endforeach
         <?php $date=date('Y-m-d'); ?>
         <div class="table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th >salarié</th>
                <th>date de debut</th>
                <th>date de fin</th>
                <th>ville de depart</th>
                <th>Ville de retour</th>
                <th>Status</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($missions as $m)
                
                <tr>
                  <td>{{$m->Fname}} {{$m->Lname}}</td>
                  <td>{{$m->date_depart}}</td>
                  <td>{{$m->date_retour}}</td>
                  <td>{{$m->ville_depart}}</td>
                  <td>{{$m->ville_retour}}</td>
                  <td>
                  @if($date>$m->date_retour)
                  <span class="badge bg-success">Mission Terminer</span>
                  @else
                  <span class="badge bg-danger">Mission en cours d'execution ....</span>
                  @endif
                  </td>
                  <td><a href="#" class="btn btn-danger btn-sm" href="{{route('missions.destroy', $m->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $m->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $m->id }}"> <i class="bi bi-trash"></i></a>
                  <a  href="{{route('missions.show', $m->id) }}" class="btn btn-secondary btn-sm"> <i class="bi bi-eye"></i></a>
                  <a  href="{{route('missions.edit', $m->id) }}" class="btn btn-success btn-sm"> <i class="bi bi-pencil"></i></a></td>
                </tr>

                <div class="modal fade" id="staticBackdrop{{ $m->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette entrée ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('missions.destroy', $m->id) }}">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                          <button type="submit" class="btn btn-primary">Oui</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
              
              </tbody>
            </table>

        </div>
      </div>
    </div>
  </main>
  @endsection