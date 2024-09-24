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

          <h3><i class="bi bi-table"></i> CONGES</h3>
          <div style="float:right;"> <a href="{{route('config_conges.create')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Configurer un congé</a></div><br><br><br>
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

         <div class="table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th  class="text-center">Nom de l'employé</th>
                <th  class="text-center">Type de congé</th>
                <th  class="text-center">Date depart</th>
                <th  class="text-center">Date retour</th>
                <th  class="text-center">Status</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $date=date('Y-m-d'); ?>
              @foreach($configs as $config)
              <tr class="text-center">
                <td>{{$config->id}}</td>
                <td>{{$config->Fname}} {{$config->Lname}}</td>
                <td>{{$config->libelle_conge}}</td>
                <td>{{$config->date_depart}}</td>
                <td>{{$config->date_retour}}</td>
                @if($date>$config->date_retour)
                <td><span class='badge rounded-pill bg-success'>Congé Terminé</span></td>
                @elseif($date < $config->date_depart)
                <td><span class='badge rounded-pill bg-info'>Non-débuter</span></td>
                @else
                <td><span class="badge rounded-pill bg-danger">Congé en cours</span></td>
                @endif
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('config_conges.destroy', $config->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $config->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $config->id }}"> <i class="bi bi-trash"></i></a>
                  <a  href="{{route('config_conges.update', $config->id) }}" class="btn btn-success btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $config->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdropes{{ $config->id }}"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $config->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette configuration ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('config_conges.destroy', $config->id) }}">
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
                <div class="modal fade" id="staticBackdropes{{ $config->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour Configuration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('config_conges.update', $config->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">

                          <div class="form-group">
                            <label>Selectionner un employé:*</label>
                            <select class="form-select" name="user">
                              @foreach($users as $user)
                              <option @selected($user->id==$config->user_id) value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option> 
                              @endforeach
                            </select>
                          </div>
                          <br>
                          <div class="form-group">
                           <label>Selectionner une type de congé:*</label>
                           <select class="form-select" name="conge">
                            @foreach($conges as $conge)
                            <option @selected($conge->id==$config->type_id) value="{{$conge->id}}">{{$conge->libelle_conge}}</option> 
                            @endforeach
                          </select></div><br>
                          <label>date de depart:*</label>
                          <input type="date" name="depart" class="form-control" value="{{$config->date_depart}}"><br>
                          <label>date de retour:*</label>
                          <input type="date" name="retour" class="form-control" value="{{$config->date_retour}}"><br>

                        </div>
                        <div class="modal-footer">
                         <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Modifier La configuration</button>
                       </div>
                     </form>
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