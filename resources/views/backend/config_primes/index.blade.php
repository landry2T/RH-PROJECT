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

          <h3><i class="bi bi-table"></i>PRIMES</h3>
          <div style="float:right;"> <a href="{{route('config_primes.create')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Configuer une prime</a></div><br><br><br>
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
                <th  class="text-center">Nom du poste</th>
                <th  class="text-center">Nom de la prime</th>
                <th  class="text-center">Montant prime</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($configs as $config)
              <tr class="text-center">
                <td>{{$config->id}}</td>
                <td>{{$config->name_poste}}</td>
                <td>{{$config->libelle_prime}}</td>
                <td><?php echo number_format($config->montant_prime,2,'.','') ?> Xaf</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('config_primes.destroy', $config->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $config->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $config->id }}"> <i class="bi bi-trash"></i></a>
                  <a  href="{{route('config_primes.update', $config->id) }}" class="btn btn-success btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $config->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdropes{{ $config->id }}"> <i class="bi bi-pencil"></i></a></td>
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
                        <form method="POST" action="{{route('config_primes.destroy', $config->id) }}">
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
                      <form method="POST" action="{{route('config_primes.update', $config->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <label>Selectionner un poste:*</label>
                          <select class="form-select" name="poste">
                            @foreach($postes as $poste)
                            <option @selected($poste->id==$config->poste) value="{{$poste->id}}">{{$poste->name_poste}}</option> 
                            @endforeach
                          </select><br>
                          <label>Selectionner une prime:*</label>
                          <select class="form-select" name="prime">
                            @foreach($primes as $prime)
                            <option @selected($prime->id==$config->prime) value="{{$prime->id}}">{{$prime->libelle_prime}}</option> 
                            @endforeach
                          </select><br>
                          <label>Montant de la prime:*</label>
                          <input type="number" name="montant" class="form-control" min="0" value="{{$config->montant_prime}}">

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