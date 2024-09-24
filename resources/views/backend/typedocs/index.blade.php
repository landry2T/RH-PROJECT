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
          <h3><i class="bi bi-table"></i> CATEGORIE DOCUMENT</h3>
          <div style="float:right;"> <a href="{{route('typedocs.create')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Ajouter une catégorie document</a></div><br><br><br>
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
                <th  class="text-center">Nom catégorie</th>
                <th  class="text-center">Date et heure création</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($types as $type)
              <tr class="text-center">
                <td>{{$type->id}}</td>
                <td>{{$type->name_type}}</td>
                <td>{{$type->created_at}}</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('typedocs.destroy', $type->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $type->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $type->id }}"> <i class="bi bi-trash"></i></a>
                  <a href="#" class="btn btn-success btn-sm" href="{{route('typedocs.update', $type->id) }}" onclick="event.preventDefault(); document.getElementById('edit-form-{{ $type->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrope{{ $type->id }}"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $type->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette categorie ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('typedocs.destroy', $type->id) }}">
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
                <div class="modal fade" id="staticBackdrope{{ $type->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour la Catégorie {{$type->name_type}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('typedocs.update', $type->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <label>Nom du departement:*</label>
                          <input type="text" name="name" class="form-control" value="{{$type->name_type}}">
                        </div>
                        <div class="modal-footer">
                         <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Modifier Categorie</button>

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