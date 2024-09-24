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
          <h3><i class="bi bi-table"></i> Evaluation du personel</h3>
          <div style="float:right;"> <a href="{{route('evaluations.create')}}" class="btn btn-primary btn-md"><i class="bi bi-plus"></i> Ajouter une evaluation</a></div><br><br><br>
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
                <th  class="text-center">Nom du salarié</th>
                <th  class="text-center">Mois</th>
                <th  class="text-center">Note retenu</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($evaluations as $eval)
              <tr class="text-center">
                <td>{{$eval->id}}</td>
                <td>{{$eval->Fname}} {{$eval->Lname}}</td>
                <td>
                  @if($eval->mois==1)
                  janvier
                  @elseif($eval->mois==2)
                  fevrier
                  @elseif($eval->mois==3)
                  mars
                  @elseif($eval->mois==4)
                  avril
                  @elseif($eval->mois==5)
                  mai
                  @elseif($eval->mois==6)
                  juin
                  @elseif($eval->mois==7)
                  juillet
                  @elseif($eval->mois==8)
                  Aout
                  @elseif($eval->mois==9)
                  Septembre
                  @elseif($eval->mois==10)
                  Octobre
                  @elseif($eval->mois==11)
                  Novembre
                  @else
                  Decembre
                  @endif
                </td>

                <td>{{($eval->savoir_etre + $eval->savoir_faire) }} / 20</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('evaluations.destroy', $eval->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $eval->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $eval->id }}"> <i class="bi bi-trash"></i></a>

                  <a  href="{{route('evaluations.update', $eval->id) }}" class="btn btn-success btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $eval->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdropes{{ $eval->id }}"> <i class="bi bi-pencil"></i></a></td>
                </tr>
                <div class="modal fade" id="staticBackdrop{{ $eval->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette entrée ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('evaluations.destroy', $eval->id) }}">
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
                <div class="modal fade" id="staticBackdropes{{ $eval->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour l'evaluation de "{{$eval->Fname}}"</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('evaluations.update', $eval->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                         <label>selectionner un salarié:*</label>
                         <select class="form-select" name="user_id">
                          @foreach($users as $user)
                          <option @selected($eval->users_id == $user->id) value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option>
                          @endforeach
                        </select>
                        <label>Selectionner un mois:*</label>
                        <select class="form-select" name="mois">
                         @if($eval->mois =="01")  
                         <option @selected($eval->mois =="01") value="01">Janvier</option>
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
                         @elseif($eval->mois =="02")  
                         <option value="01">Janvier</option>
                         <option @selected($eval->mois =="02") value="02">Fevrier</option>
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
                         @elseif($eval->mois =="03")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option @selected($eval->mois =="03") value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($eval->mois =="04")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option @selected($eval->mois =="04")  value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($eval->mois =="05")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option @selected($eval->mois =="05") value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($eval->mois =="06")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option @selected($eval->mois =="06") value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($eval->mois =="07")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option @selected($eval->mois =="07") value="07">Juillet</option>
                         <option value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
                         <option value="12">decembre</option>
                         @elseif($eval->mois =="08")  
                         <option value="01">Janvier</option>
                         <option value="02">Fevrier</option>
                         <option value="03">Mars</option>
                         <option value="04">Avril</option>
                         <option value="05">Mai</option>
                         <option value="06">Juin</option>
                         <option value="07">Juillet</option>
                         <option @selected($eval->mois =="08") value="08">Aout</option>
                         <option value="09">Setptembre</option>
                         <option value="10">octobre</option>
                         <option value="11">novembre</option>
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

                       <label>Note sur le savoir etre:*</label>
                       <input type="number" name="etre" class="form-control" value="{{$eval->savoir_etre}}" min="0" max="10">

                       <label>Note sur le savoir faire:*</label>
                       <input type="number" name="faire" class="form-control" value="{{$eval->savoir_faire}}" min="0" max="10"><br>
                     </div>
                     <div class="modal-footer">
                       <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Modifier Evaluation</button>

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