@extends('layouts.app')

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
          <h3><i class="bi bi-laptop"></i> STATISTIQUE FISCALE PAR MOIS</h3>
         <div class="table-responsive">
          <table class="table table-hover table-bordered table-info">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th  class="text-center">Mois</th>
                <th  class="text-center">Montant</th>
              </tr>
            </thead>
            <tbody>
              @php $i=0; $total=0; @endphp
              @foreach($fiscales as $heure)
               @php $i++; @endphp
               @php $total+=$heure->montant; @endphp
              <tr class="text-center">
                <td>{{$i}}</td>
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
                <td><?php echo number_format($heure->montant,2,'.','') ?> Fcfa</td>
              </tr>
              @endforeach
              <tr class="text-center"><th colspan="2">Montant total</th> <th><?php echo number_format($total,2,'.','') ?> Fcfa</th></tr>
           </tbody>
     </table>
   </div></div>
 </div>
</div>
</div>
</main>
@endsection