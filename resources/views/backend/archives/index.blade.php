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
          <h3><i class="bi bi-archive-fill"></i> ARCHIVES</h3>
          <div style="float:right;"> <a href="{{route('archives.create')}}" class="btn btn-info
           btn-md"><i class="bi bi-plus"></i> Ajouter une nouvelle archive</a></div><br><br><br>
          @if (Session::has('success'))<br>
          <div class="alert alert-success mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('success') }}</strong>
         </div>
         @endif

           @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <div class="table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th  class="text-center">type du document</th>
                <th  class="text-center">Nom du document</th>
                <th class="text-center">description du document</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($archives as $heure)
              <tr class="text-center">
                <td>{{$heure->id}}</td>
                <td>{{$heure->name_type}}</td>
                <td>{{$heure->name_doc}}</td>
                <td>{{$heure->description_doc}}</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('archives.destroy', $heure->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $heure->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $heure->id }}"> <i class="bi bi-trash"></i></a>

                  <a  href="/uploads/{{$heure->name_file}}" class="btn btn-primary btn-sm" target="_blank"> <i class="bi bi-cloud-download-fill"></i> Télécharger document</a></td>
                </tr>
                <div class="modal fade" id="staticBackdrop{{ $heure->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer ce document ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('archives.destroy', $heure->id) }}">
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
       </div></div>
     </div>
   </div>
 </div>
</main>
@endsection