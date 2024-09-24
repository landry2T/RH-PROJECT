 @extends('layouts.app')

 @section('content')
 
 <main class="app-content" id="result">
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
 					<h3><i class="bi bi-bar-chart-line-fill"></i> Statistique de chaque salarié</h3>

 					@if (Session::has('error'))<br>
 					<div class="alert alert-danger mb-4" role="alert" class="text-white">
 						<strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
 						{{ Session::get('error') }}</strong>
 					</div>
 					@endif
 					@csrf
 					<label>Selectionner un salarié:*</label>
 					<select class="form-select selectpicker" name="mois" data-live-search="true" id="emp">
 						<option value="">Selectionner un salarié</option>
 						@foreach($users as $user)
 						<option value="{{$user->id}}">{{$user->Fname}} {{$user->Lname}}</option>
 						@endforeach
 					</select>
           <br>
         </div>
       </div>

       @isset($avances)
       <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-title"><i class="bi bi-printer"></i> mes bulletins</div>
            <div class="tile-body">
              <table class="table table-bordered">
               <tr><th>Salarié</th><th>actions</th></tr>
               @if($paies->count() > 0)
               @foreach($paies as $paie)
               <tr><td>{{$paie->Fname}} {{$paie->Lname}}</td>
                <td><a href="{{route('bulletins.edited', [$paie->idbul, $paie->id]) }}" class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i> imprimer</a></td>
              </tr>
              @endforeach
              @else
              <tr><td colspan="2"> donnée(s) vide(s)</td></tr>
              @endif
            </table>

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <div class="tile-title"><i class="bi bi-printer"></i> mes avances salariales</div>
          <div class="tile-body">
            <table class="table table-bordered">
             <tr><th>Mois</th><th>
               Montant
             </th>

           </tr>
           @if($avances->count() > 0)
           @foreach($avances as $avance)
           <tr>
            <td>@if($avance->mois==1)
              janvier
              @elseif($avance->mois==2)
              fevrier
              @elseif($avance->mois==3)
              mars
              @elseif($avance->mois==4)
              avril
              @elseif($avance->mois==5)
              mai
              @elseif($avance->mois==6)
              juin
              @elseif($avance->mois==7)
              juillet
              @elseif($avance->mois==8)
              Aout
              @elseif($avance->mois==9)
              Septembre
              @elseif($avance->mois==10)
              Octobre
              @elseif($avance->mois==11)
              Novembre
              @else
              Decembre
            @endif</td>
            <td>{{$avance->montant_avance}} XAF</td>
          </tr>

          @endforeach
          @else
          <tr><td colspan="2">donnée(s) vide(s)</td></tr>
          @endif
        </table>

      </div>
    </div></div>

    <div class="col-md-12">
      <div class="tile">
        <div class="tile-title"><i class="bi bi-table"></i> mes heures supplementaires</div>
        <div class="tile-body">
          <table class="table table-bordered">
           <tr>
            <th>Mois</th>
            <th>Nombre heure</th>
            <th>
             Montant heure
           </th>
           <th>Montant</th>

         </tr>
         @if($heures->count() > 0)
         @foreach($heures as $heure)
         <tr>
          <td>@if($heure->mois==1)
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
          @endif</td>
          <td>{{$heure->nbre_heure}} </td>
          <td>{{$heure->montant_heure}} XAF</td>
          <td><?php echo $heure->montant_heure*$heure->nbre_heure; ?> XAF</td>
        </tr>

        @endforeach
        @else
        <tr><td colspan="4">donnée(s) vide(s)</td></tr>
        @endif
      </table>

    </div>
  </div>
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-title"><i class="bi bi-table"></i> mes demandes d'absence</div>
      <div class="tile-body">
        <table class="table table-bordered">
         <tr>
          <th>Motif</th>
          <th>Date debut</th>
          <th>Date fin</th>
          <th>autorisant</th>
          <th>Status</th>
        </tr>
        @if($absences->count() > 0)
        @foreach($absences as $absence)
        <tr>
          <td>{{$absence->motif}} </td>
          <td>{{$absence->date_debut}} </td>
          <td>{{$absence->date_fin}} </td>
          <td>{{$absence->autorisant}} </td>
          <td> @if($absence->status==0)
            <span class="me-1 badge bg-danger"> en attente</span>
            @elseif($absence->status==1)
            <span class="me-1 badge bg-primary">absence Validé</span>
            @else
            <span class="me-1 badge bg-warning">absence rejeté</span>
          @endif</td>
        </tr>

        @endforeach
        @else
        <tr><td colspan="5">donnée(s) vide(s)</td></tr>
        @endif
      </table>

    </div>
  </div>

  <div class="col-md-12">
    <div class="tile">
      <div class="tile-title"><i class="bi bi-building-check"></i> mes missions</div>
      <div class="tile-body">
        <table class="table table-bordered">
         <tr>
          <th>Motif</th>
          <th>Date debut</th>
          <th>Date fin</th>
          <th>Salarié</th>
          <th>Status</th>
        </tr>
        @if($missions->count() > 0)
        @foreach($missions as $mission)
        <tr>
          <td>{{$mission->motif}} </td>
          <td>{{$mission->date_depart}} </td>
          <td>{{$mission->date_retour}} </td>
          <td>{{$mission->Fname}} {{$mission->Lname}} </td>
          <td><a href="{{route('missions.show', $mission->id)}}" class="btn btn-danger" target="_blank"><i class="bi bi-eye"></i> Voir details</a></td>
        </tr>
        
        @endforeach
        @else
        <tr><td colspan="5">donnée(s) vide(s)</td></tr>
        @endif
      </table>

    </div>
  </div>
</div>
</div>
<div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Histogramme d'évaluation personnel mensuel</h3>
            <div class="ratio ratio-16x9">
              <div id="salesChart"></div>
            </div>
          </div>
        </div>
@endisset
</div>
</main>
@section('scripts')                                                                       

<script type="text/javascript">
  $('#emp').on('change', function(){
   var emp = $(this).val();
   $( "#result").html("<h3>traitement des donnees en cours ...</h3>");
   $.ajax({
    type: "GET",
    url: "{{route('search')}}",
    data:"id="+emp,
    dataType:"html",
    success:function(reponses){
     $( "#result" ).html(reponses);
     
      const salesData = {
        xAxis: {
          type: 'category',
          data: ['juin', 'juillet'],
        },
        yAxis: {
          type: 'value',
          axisLabel: {
            formatter: '${value}'
          }
        },
        series: [
          {
            data: [15, 11], 
            type: 'line',
            smooth: true
          }
        ],
        tooltip: {
          trigger: 'axis',
          formatter: "<b>{b0}:</b> ${c0}"
        }
      }

      const salesChartElement = document.getElementById('salesChart');
      const salesChart = echarts.init(salesChartElement, null, { renderer: 'svg' });
      salesChart.setOption(salesData);
      new ResizeObserver(() => salesChart.resize()).observe(salesChartElement);
     
   }
 });
 })
</script>

<script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
@endsection