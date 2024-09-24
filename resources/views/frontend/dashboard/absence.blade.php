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
          <h3><i class="bi bi-bell-fill"></i> Mes absences</h3>
          <div style="float:right;"> <a href="{{route('absence.create')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Demander une absence</a></div><br><br><br>
          @if (Session::has('success'))<br>
          <div class="alert alert-success mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('success') }}</strong>
         </div>
         @endif
         <div class="table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th  class="text-center" style="width:350px;">Motif</th>
                <th  class="text-center">Date depart</th>
                <th  class="text-center">Date retour</th>
                <th  class="text-center">Autorisant</th>
                <th class="text-center">Status</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($absences as $absence)
              <tr class="text-center">
                <td>{{$absence->id}}</td>
                <td>{{$absence->motif}}</td>
                <td>{{$absence->date_debut}}</td>
                <td>{{$absence->date_fin}}</td>
                <td>{{$absence->autorisant}}</td>
                <td>
                  @if($absence->status==0)
                  <span class="me-1 badge bg-danger"> en attente</span>
                  @elseif($absence->status==1)
                  <span class="me-1 badge bg-primary">absence validé</span>
                  @else
                  <span class="me-1 badge bg-warning">absence rejeté</span>
                  @endif
                </td>
                <td>
                  @if($absence->status==0)
                  <a href="#" class="btn btn-danger btn-sm" href="{{route('absence.delete', $absence->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $absence->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $absence->id }}"> <i class="bi bi-trash"></i></a>
                  @endif
                  <a href="#" class="btn btn-success btn-sm" href="{{route('absence.update', $absence->id) }}" onclick="event.preventDefault(); document.getElementById('edit-form-{{ $absence->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrope{{ $absence->id }}"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $absence->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cet absence ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('absence.delete', $absence->id) }}">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                          <button type="submit" class="btn btn-primary">Oui</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!--Edit-Modal -->
                <div class="modal fade" id="staticBackdrope{{ $absence->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour l'absence </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('absence.update', $absence->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="row">
                            <div class="form-group col-md-12">
                              <label>Nom de l'autorisant:</label>
                              <input type="text" name="autorisant" class="form-control" value="{{$absence->autorisant}}">
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-12">
                              <label>Date de depart:*</label>
                              <input type="date" name="date_depart" class="form-control" value="{{$absence->date_debut}}">
                            </div>

                            <div class="form-group col-md-12">
                              <label>Date de retour:*</label>
                              <input type="date" name="date_retour" class="form-control" value="{{$absence->date_fin}}">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-12">
                              <label>Motif de l'absence:</label>
                              <textarea class="form-control" style="height:120px;" name="motif">{{$absence->motif}}</textarea>
                            </div>
                    </div><br>
                        </div>
                        <div class="modal-footer">
                         <button type="submit" class="btn btn-info"><i class="bi bi-pencil"></i> Modifier L'absence</button>

                       </div>
                     </form>
                   </div>
                 </div>
               </div>
               @endforeach
             </tbody>
           </table>
         </div></div>
       </div>
     </div>
   </div>
 </main>
 @endsection