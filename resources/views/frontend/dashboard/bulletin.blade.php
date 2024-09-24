@extends('layouts.app_user')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Tableau de bord</h1>
      <p>Vous ètes dans votre session</p>
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
          <h3><i class="bi bi-file-earmark-pdf-fill"></i> Mes bulletins de paie</h3>

         <div class="table-responsive">
          <table class="table table-hover table-bordered bg-primary" id="sampleTable">
            <thead>
              <tr class=" text-white">
                <th  class="text-center">#</th>
                <th  class="text-center">Mois</th>
                <th  class="text-center">created_at</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bulletins as $bul)
              <tr class="text-center">
                <td>{{$bul->id}}</td>
                <td>
                <?php $mois=date("m",strtotime($bul->created_at)); ?>
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
                  @endif</td>
                <td>{{$bul->created_at}}</td>
                <td><a href="{{route('bulletins.edited', [$bul->id, $bul->user_id]) }}" class="btn btn-primary btn-md" target="_blank"> <i class="bi bi-printer"></i> Imprimer</a></td>
               
               @endforeach
             </tbody>
           </table>
         </div></div>
       </div>
     </div>
   </div>
 </main>
 @endsection