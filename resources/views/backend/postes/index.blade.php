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
          <h3><i class="bi bi-laptop"></i> POSTES</h3>
          <div style="float:right;"> <a href="{{route('postes.create')}}" class="btn btn-dark btn-md"><i class="bi bi-plus"></i> Ajouter un poste</a></div><br><br><br>
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
                <th  class="text-center">intitulé des postes</th>
                <th  class="text-center">département</th>
                <th  class="text-center">classe</th>
                <th  class="text-center">salaire base</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($postes as $poste)
              <tr class="text-center">
                <td>{{$poste->id}}</td>
                <td>{{$poste->name_poste}}</td>
                <td>{{$poste->name_departement}}</td>
                <td>{{$poste->name_categorie}}{{$poste->echellon}}</td>
                <td><?php echo number_format(($poste->montant_heure*$poste->nombre_heure),2,',','.'); ?> XAF</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('postes.destroy', $poste->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $poste->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $poste->id }}"> <i class="bi bi-trash"></i></a>
                  <a href="#" class="btn btn-success btn-sm" href="{{route('postes.update', $poste->id) }}" onclick="event.preventDefault(); document.getElementById('edit-form-{{ $poste->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrope{{ $poste->id }}"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $poste->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer ce poste ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('postes.destroy', $poste->id) }}">
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
                <div class="modal fade" id="staticBackdrope{{ $poste->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour le poste "{{$poste->name_poste}}"</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('postes.update', $poste->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <label>selectionner un departement:*</label>
                          <select class="form-select" name="dep">
                           @foreach($departements as $depart)
                           <option @selected($depart->id==$poste->dep_id) value="{{$depart->id}}">{{$depart->name_departement}}</option>
                           @endforeach
                          </select><br>
                          <label>selectionner un departement:*</label>
                          <select class="form-select" aria-label="Default select example" name="class">
                            @foreach($classifications as $class)
                            <option @selected($class->id==$poste->class_id) value="{{$class->id}}">{{$class->echellon}}{{$class->name_categorie}}-[<?php echo ($class->nombre_heure*$class->montant_heure) ?> XAF]</option>
                            @endforeach
                          </select><br>
                          <label>intitulé du poste:*</label>
                          <input type="text" name="name" class="form-control" value="{{$poste->name_poste}}">
                        </div>
                        <div class="modal-footer">
                         <button type="submit" class="btn btn-dark"><i class="bi bi-pencil"></i> Modifier Le Poste</button>

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