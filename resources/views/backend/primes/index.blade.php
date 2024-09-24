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

          <h3><i class="bi bi-laptop"></i> Les primes</h3>
          <div style="float:right;"> <a href="{{route('primes.create')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Ajouter une prime</a></div><br><br><br>
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
                <th  class="text-center">Nom de la prime</th>
                <th  class="text-center">Nature de la prime</th>
                <th  class="text-center">Taux de la prime</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($primes as $prime)
              <tr class="text-center">
                <td>{{$prime->id}}</td>
                <td>{{$prime->nature_prime}}</td>
                <td>{{$prime->libelle_prime}}</td>
                @if($prime->taux_prime!=null)
                <td>{{$prime->taux_prime}} %</td>
                @else
                 <td>{{$prime->taux_prime}} %</td> 
                @endif
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('primes.destroy', $prime->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $prime->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $prime->id }}"> <i class="bi bi-trash"></i></a>
                  <a  href="{{route('primes.update', $prime->id) }}" class="btn btn-success btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $prime->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdropes{{ $prime->id }}"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $prime->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette prime ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('primes.destroy', $prime->id) }}">
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
                <div class="modal fade" id="staticBackdropes{{ $prime->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour "{{$prime->libelle_prime}}"</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('primes.update', $prime->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <label>Nature de la prime:*</label>
                          <select class="form-select" name="nature">
                           @if($prime->nature_prime =="imposable")  
                           <option @selected($prime->nature_prime =="imposable") value="imposable">prime impossable</option>
                           <option value="taxable et cotisable">prime taxable et cotisable</option> 
                           <option value="taxable et cotisable">prime taxable et pas cotisable</option> 
                           <option value="idemnité">Indemnité</option>
                           @elseif($prime->nature_prime =="taxable et cotisable")
                           <option value="imposable">prime impossable</option>
                           <option @selected($prime->nature_prime =="taxable et cotisable") value="taxable et cotisable">prime taxable et cotisable</option> 
                           <option value="taxable et cotisable">prime taxable et pas cotisable</option> 
                           <option value="idemnité">Indemnité</option>
                           @elseif($prime->nature_prime =="taxable et pas cotisable")
                           <option value="imposable">prime impossable</option>
                           <option value="taxable et cotisable">prime taxable et cotisable</option> 
                           <option @selected($prime->nature_prime =="taxable et pas cotisable") value="taxable et cotisable">prime taxable et pas cotisable</option> 
                           <option value="idemnité">Indemnité</option>
                           @else
                            <option value="imposable">prime impossable</option>
                           <option value="taxable et cotisable">prime taxable et cotisable</option> 
                           <option  value="taxable et cotisable">prime taxable et pas cotisable</option> 
                           <option  @selected($prime->nature_prime =="idemnité") value="idemnité">Indemnité</option>
                           @endif
                            
                          </select>
                          <br>
                          <label>nom de la prime:*</label>
                          <input type="text" name="name" class="form-control" value="{{$prime->libelle_prime}}"><br>

                          <label>Taux de prime:*</label>
                          <input type="number" name="taux" class="form-control" value="{{$prime->taux_prime}}" min="1"><br>
                        </div>
                        <div class="modal-footer">
                         <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Modifier La Prime</button>

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