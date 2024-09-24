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
          <h3><i class="bi bi-table"></i> AVANCE SALARIALE</h3>
          <div style="float:right;"> <a href="{{route('avances.create')}}" class="btn btn-success
           btn-md"><i class="bi bi-plus"></i> Ajouter une avance salaire</a></div><br><br><br>
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
                <th  class="text-center">Nom du salarié</th>

                <th class="text-center">Montant</th>
                <th  class="text-center">Mois de l'avance</th>
                <th  class="text-center">created_at</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($avances as $heure)
              <tr class="text-center">
                <td>{{$heure->id}}</td>
                <td>{{$heure->Fname}} {{$heure->Lname}}</td>
                <td><?php echo number_format($heure->montant_avance,2,'.',''); ?> Fcfa</td>
                <td>
                  @if($heure->mois==1)
                  janvier
                  @elseif($heure->mois==2)
                  fevrier
                  @elseif($heure->mois==3)
                  mars
                  @elseif($heure->mois==4)
                  avril
                  @elseif($heure->mois==5)
                  mai
                  @elseif($heure->mois==6)
                  juin
                  @elseif($heure->mois==7)
                  juillet
                  @elseif($heure->mois==8)
                  Aout
                  @elseif($heure->mois==9)
                  Septembre
                  @elseif($heure->mois==10)
                  Octobre
                  @elseif($heure->mois==11)
                  Novembre
                  @else
                  Decembre
                  @endif
                </td>
                <td>{{$heure->create}}</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('avances.destroy', $heure->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $heure->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $heure->id }}"> <i class="bi bi-trash"></i></a>

                  <a  href="{{route('avances.update', $heure->id) }}" class="btn btn-primary btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $heure->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdropes{{ $heure->id }}"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <div class="modal fade" id="staticBackdrop{{ $heure->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette entrée ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('avances.destroy', $heure->id) }}">
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
                <div class="modal fade" id="staticBackdropes{{ $heure->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour l'avance de salaire de "{{$heure->Fname}}"</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('avances.update', $heure->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                         <label>selectionner un salarié:*</label>
                         <select class="form-select" name="user_id">
                          @foreach($users as $user)
                          <option @selected($heure->users_id == $user->id) value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option>
                          @endforeach
                        </select>
                        <label>Selectionner un mois:*</label>
                        <select class="form-select" name="mois">
                         @if($heure->mois =="01")  
                         <option @selected($heure->mois =="01") value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($heure->mois =="02")  
                         <option value="01">Janvier</option>
                         <option @selected($heure->mois =="02") value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($heure->mois =="03")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option @selected($heure->mois =="03") value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($heure->mois =="04")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option @selected($heure->mois =="04")  value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($heure->mois =="05")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option @selected($heure->mois =="05") value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($heure->mois =="06")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option @selected($heure->mois =="06") value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($heure->mois =="07")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option @selected($heure->mois =="07") value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($heure->mois =="08")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option @selected($heure->mois =="08") value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                          @elseif($heure->mois =="09")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option @selected($heure->mois =="09") value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($heure->mois =="10")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option @selected($heure->mois =="10") value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                          @elseif($heure->mois =="11")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option @selected($heure->mois =="11") value="11">novembre</option>
                         <option value="12">decembre</option>
                         @else
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @endif
                       </select>

                       <label>Montant:*</label>
                       <input type="number" name="montant" class="form-control" value="{{$heure->montant_avance}}">
                     </div>
                     <div class="modal-footer">
                       <button type="submit" class="btn btn-success"><i class="bi bi-pencil"></i> Modifier Avance</button>

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