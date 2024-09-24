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
          <h3><i class="bi bi-laptop"></i> CLASSIFICATIONS</h3>
          <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropes"><i class="bi bi-upload"></i> Importer Les Données</button><br>
          <div style="float:right;"> <a href="{{route('classifications.create')}}" class="btn btn-success btn-md"><i class="bi bi-plus"></i> Ajouter une classification</a></div><br><br><br>
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
                <th  class="text-center">Type de profil</th>
                <th  class="text-center">Classe</th>
                <th  class="text-center">Heure Mensuel</th>
                <th  class="text-center">Montant Heure</th>
                <th  class="text-center">Salaire de base</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($classifications as $class)
              <tr class="text-center">
                <td>{{$class->id}}</td>
                <td>{{$class->profil}}</td>
                <td>{{$class->name_categorie}} {{$class->echellon}}</td>
                <td>{{$class->nombre_heure}}</td>
                <td>{{$class->montant_heure}} XAF</td>
                <td><?php echo number_format(($class->montant_heure*$class->nombre_heure),2,',','.') ?> XAF</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('classifications.destroy', $class->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $class->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $class->id }}"> <i class="bi bi-trash"></i></a>
                  <a href="#" class="btn btn-success btn-sm" href="{{route('classifications.update', $class->id) }}" onclick="event.preventDefault(); document.getElementById('edit-form-{{ $class->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrope{{ $class->id }}"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $class->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette question ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('classifications.destroy', $class->id) }}">
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
                <div class="modal fade" id="staticBackdrope{{ $class->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour la classe  {{$class->name_categorie}}{{$class->echellon}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('classifications.update', $class->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">

                          <div class="row">

                            <div class="form-group col-md-12">
                             <label> Selectionner l'échellon:*</label>
                             <select class="form-select" name="echellon">
                               <?php 

                               $array = array('A' ,'B','C','D','E','F');

                               for ($i=0; $i<count($array) ; $i++) { ?>

                                <option @selected($array[$i]==$class->echellon) value="<?php echo $array[$i] ?>"><?php echo $array[$i] ?></option>


                              <?php }?> 
                            </select>
                          </div>

                          <div class="form-group col-md-12">
                           <label> Selectionner une catégorie:*</label>
                           <select class="form-select" name="cat">
                             <?php for ($i=1; $i<16 ; $i++) {?>
                              <option @selected($i==$class->cat) value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        <div class="form-group col-md-12">
                         <label> Selectionner un profil:*</label>
                         <select class="form-select" name="profil">
                           <?php 
                           $array1 = array("Employés ouvriers (EO)","Agents de Maitrise (AM)" ,'Cadre (CA)','Vacataire/Stagiaire (S)');

                           for ($i=0; $i<count($array1) ; $i++) { ?>

                            <option @selected($array1[$i]==$class->profil) value="<?php echo $array1[$i] ?>"><?php echo $array1[$i] ?></option>

                          <?php }?>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                       <label>Nombre heure mensuel:*</label>
                       <input type="int" name="heure" class="form-control" min="1" value="{{$class->nombre_heure}}">
                     </div>

                     <div class="form-group col-md-12">
                       <label>Montant heure mensuel:*</label>
                       <input type="float" name="montant" class="form-control" min="100" placeholder="example:1000.20" value="{{$class->montant_heure}}">
                     </div>


                   </div> 

                 </div>
                 <div class="modal-footer">
                   <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Modifier Classification</button>

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


<div class="modal fade" id="staticBackdropes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">importer les données des salariés</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ url('customer/import') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="file" name="import_file"  class="form-control">
          </div>
        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-upload-fill"></i> Importer Fichier</button>

        </div>
      </form>
    </div>
  </div>
</div>
</div></div>
</main>
@endsection