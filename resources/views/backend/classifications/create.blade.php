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
          <h3><i class="bi bi-pencil"></i> AJOUTER CLASSIFICATION</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            {{ Session::get('error') }}</strong>
          </div>
          @endif
          <form method="POST" action="{{route('classifications.store')}}">
            @csrf

            <div class="row">

              <div class="form-group col-md-6">
               <label> Selectionner l'échellon:*</label>
               <select class="form-select" name="echellon">
               <?php 

               $array = array('A' ,'B','C','D','E','F');
           
               for ($i=0; $i<count($array) ; $i++) { ?>

                <option value="<?php echo $array[$i] ?>"><?php echo $array[$i] ?></option>


              <?php }?> 
             </select>
            </div>

             <div class="form-group col-md-6">
               <label> Selectionner une catégorie:*</label>
               <select class="form-select" name="cat">
               <?php for ($i=1; $i<16 ; $i++) {?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php } ?>
              </select>
            </div>

             <div class="form-group col-md-6">
               <label> Selectionner un profil:*</label>
               <select class="form-select" name="profil">
               <?php 
               $array1 = array("Employés ouvriers (EO)","Agents de Maitrise (AM)" ,'Cadre (CA)','Vacataire/Stagiaire (S)');

               for ($i=0; $i<count($array1) ; $i++) { ?>

                <option value="<?php echo $array1[$i] ?>"><?php echo $array1[$i] ?></option>

              <?php }?>
             </select>
            </div>

             <div class="form-group col-md-6">
               <label>Nombre heure mensuel:*</label>
               <input type="int" name="heure" class="form-control" min="1">
            </div>

            <div class="form-group col-md-12">
               <label>Montant heure mensuel:*</label>
               <input type="float" name="montant" class="form-control" min="100" placeholder="example:1000.20">
            </div>

              
            </div> 
            <br>
            <button type="submit" class="btn btn-success btn-block"><i class="bi bi-pencil"></i> Ajouter Une Classification</button>

          </form>

        </div>
      </div>
    </div>
  </main>
  @endsection