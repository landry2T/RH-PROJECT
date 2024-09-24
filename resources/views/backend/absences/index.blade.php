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
          <h3><i class="bi bi-bell-fill"></i> ABSENCES</h3>
          <div style="float:right;"> <a href="{{route('absences.create')}}" class="btn btn-info btn-md"><i class="bi bi-plus"></i> Ajouter une absence</a></div><br><br><br>
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
                <th  class="text-center">Nom du personel</th>
                <th  class="text-center">Date depart</th>
                <th  class="text-center">Date retour</th>
                <th  class="text-center">Autorisant</th>
                <th  class="text-center">status</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($absences as $absence)
              <tr class="text-center">
                <td>{{$absence->id}}</td>
                <td>{{$absence->Fname}} {{$absence->Lname}}</td>
                <td>{{$absence->date_debut}}</td>
                <td>{{$absence->date_fin}}</td>
                <td>{{$absence->autorisant}}</td>
                <td> @if($absence->status==0)
                  <span class="me-1 badge bg-danger"> en attente</span>
                  @elseif($absence->status==1)
                  <span class="me-1 badge bg-primary">absence Validé</span>
                  @else
                  <span class="me-1 badge bg-warning">absence rejeté</span>
                  @endif</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('absences.destroy', $absence->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $absence->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $absence->id }}"> <i class="bi bi-trash"></i></a>
                  <a href="#" class="btn btn-success btn-sm" href="{{route('absences.update', $absence->id) }}" onclick="event.preventDefault(); document.getElementById('edit-form-{{ $absence->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrope{{ $absence->id }}"> <i class="bi bi-pencil"></i> lire</a>
            
                  <a href="#" class="btn btn-secondary btn-sm" href="{{route('absences.edited', $absence->id) }}" onclick="event.preventDefault(); document.getElementById('edit-form-{{ $absence->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrops{{ $absence->id }}"> <i class="bi bi-check"></i> Status</a>
                  
                  <a  class="btn btn-primary btn-sm" href="{{route('absences.print', $absence->id) }}"> <i class="bi bi-printer"></i> Imprimer</a>
                  </td>
                </tr>

                 <!-- Modal -->
                <div class="modal fade" id="staticBackdrops{{ $absence->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous changez le status de l' absence ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('absences.edited', $absence->id) }}">
                      <div class="modal-body">
                        <input type="radio" name="val" class="form-check-input" checked="on" value="1">
                        <label class="label-input-check">Accepté absence</label> &nbsp; &nbsp; &nbsp; 
                        <input type="radio" name="val" class="form-check-input"  value="2">
                        <label class="label-input-check">refusé absence</label> 
                      </div>
                      <div class="modal-footer">
                          @csrf
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                          <button type="submit" class="btn btn-success">Oui</button>
                        
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $absence->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cet absence ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('absences.destroy', $absence->id) }}">
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
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour l'absence de '{{$absence->Fname}}'</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('absences.update', $absence->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="row">
                            <div class="form-group col-md-12">
                              <label>Selectionner un employée:*</label>
                              <select class="form-select" name="user" id="select_box">
                                @foreach($users as $user)
                                <option  @selected($user->id==$absence->user_id)value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option>
                                @endforeach
                              </select>
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
                              <textarea class="form-control" name="motif" style="height:150px;">{{$absence->motif}}</textarea>
                            </div>
                    </div>
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