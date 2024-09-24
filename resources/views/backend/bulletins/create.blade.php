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
          <h3><i class="bi bi-printer"></i> IMPRIMER BULLETIN DE PAI</h3>
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
                <th  class="text-center">mois de paie</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bulletins as $bulletin)
              <tr class="text-center">
                <td>{{$bulletin->id}}</td>
                <td>{{$bulletin->Fname}} {{$bulletin->Lname}}</td>
                <?php  $mois=date('m',strtotime($bulletin->mois)); ?>
                <td>
                  @if($mois==1)
                  janvier
                  @elseif($mois==2)
                  fevrier
                  @elseif($mois==3)
                  mars
                  @elseif($mois==4)
                  avril
                  @elseif($mois==5)
                  mai
                  @elseif($mois==6)
                  juin
                  @elseif($mois==7)
                  juillet
                  @elseif($mois==8)
                  Aout
                  @elseif($mois==9)
                  Septembre
                  @elseif($mois==10)
                  Octobre
                  @elseif($mois==11)
                  Novembre
                  @else
                  Decembre
                  @endif
                </td>
                <td><a  class="btn btn-danger btn-md" href="{{route('bulletins.edited', [$bulletin->id, $bulletin->user_id]) }}" target="_blank"> <i class="bi bi-printer"></i> Imprimer</a>
                </tr>
             
         @endforeach
       </tbody>
     </table>
   </div></div>
 </div>
</div>
</div>
</main>
@endsection