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

          <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropes"><i class="bi bi-cloud-upload-fill"></i> Importer Les Données</button><br>
          <h3><i class="bi bi-laptop"></i> Les salariés</h3>
          <div style="float:right;"> <a href="{{route('users.create')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Ajouter un employé</a></div><br><br><br>
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
                <th  class="text-center">Nom</th>
                <th  class="text-center">Poste occupé</th>
                <th  class="text-center">Debut du contrat</th>
                <th  class="text-center">Téléphone</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr class="text-center">
                <td>{{$user->id}}</td>
                <td>{{$user->Fname}} {{$user->Lname}}</td>
                <td>{{$user->name_poste}}</td>
                <td>{{$user->date_contrat}}</td>
                <td>{{$user->phone}}</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('users.destroy', $user->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $user->id }}"> <i class="bi bi-trash"></i></a>
                  <a  href="{{route('users.show', $user->id) }}" class="btn btn-secondary btn-sm"> <i class="bi bi-eye"></i></a>
                  <a  href="{{route('users.edit', $user->id) }}" class="btn btn-success btn-sm"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette entrée ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('users.destroy', $user->id) }}">
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

            <div class="modal fade" id="staticBackdropes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">importer les données</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{url('cust/import')}}" enctype="multipart/form-data">
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
        </div>
      </div>
    </div>
  </main>
  @endsection