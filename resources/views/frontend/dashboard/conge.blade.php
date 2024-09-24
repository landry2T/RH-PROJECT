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
          <h3><i class="bi bi-briefcase-fill"></i> Listes des congés</h3>

          <div style="float:right;"> <a href="{{route('addconge')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Ajouter un conge</a></div><br><br><br>

         <div class="table-responsive">
          <table class="table table-hover table-bordered bg-primary" id="sampleTable">
            <thead>
              <tr class=" text-white">
                <th  class="text-center">Type de congé</th>
                <th  class="text-center">Date depart</th>
                <th  class="text-center">Date retour</th>
                <th  class="text-center">Nombre de jour</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($conges as $conge)
              <tr class="text-center">
                <td>{{$conge->libelle_conge}}</td>
                <td>{{$conge->date_depart}}</td>
                <td>{{$conge->date_retour}}</td>
                <td>{{$conge->jour_conge}} jr(s)</td>
                @if($conge->status==0)
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('conge.destroyconge', $conge->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $conge->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $conge->id }}"> <i class="bi bi-trash"></i></a>
                 <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $conge->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimez ce conge ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('conge.destroyconge', $conge->id) }}">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                          <button type="submit" class="btn btn-primary">Oui</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                </td>
                @else
                <td><span class="badge badge-primary"> Congé confirmé</span></td>
                @endif
               @endforeach
             </tbody>
           </table>
         </div></div>
       </div>
     </div>
   </div>
 </main>
 @endsection