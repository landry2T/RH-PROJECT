@extends('layouts.app')

@section('content')

 <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Tableau de bord</h1>
          <p>Bienvenue sur DIGITAL-RH</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon bi bi-people fs-1"></i>
            <div class="info">
              <h4>Employé(s)</h4>
              <p><b>{{$users}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon bi bi-briefcase-fill fs-1"></i>
            <div class="info">
              <h4>POSTES</h4>
              <p><b>{{$postes}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon bi bi-folder2 fs-1"></i>
            <div class="info">
              <h4>Departements</h4>
              <p><b>{{$departements}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon bi bi-file-earmark-pdf-fill fs-1"></i>
            <div class="info">
              <h4>Feuiile de paie</h4>
              <p><b><?php echo ($bulletins + 2); ?></b></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">

            <div class="col-lg-12">
            <div class="bs-component">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start"><a href="{{route('absences.index')}}" style="text-decoration:none; font-size:1.2em;"> Demande d'absence d'aujourd'hui</a> <span class="badge bg-primary rounded-pill" style="font-size:1.0em;">{{$absences}}</span></li>
                <li class="list-group-item d-flex justify-content-between align-items-start"><a href="{{route('config_conges.index')}}" style="text-decoration:none; font-size:1.2em;"> Nombre de salarié en congé</a> <span class="badge bg-primary rounded-pill"  style="font-size:1.0em;">{{$conges}}</span></li>
                <li class="list-group-item d-flex justify-content-between align-items-start"><a href="{{route('missions.index')}}" style="text-decoration:none; font-size:1.2em;"> Nombre de salarié  en mission</a> <span class="badge bg-primary rounded-pill"  style="font-size:1.0em;">{{$missions}}</span></li>
              </ul>
            </div>
            </div>
      </div><br>

      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title"><i class="bi bi-bar-chart-line-fill"></i> Statistique Fiscale / mois</h3>
            <span style="color:blue; font-size:1.2em;">Charges Fiscale</span>&nbsp;&nbsp;
            <span style="color:green; font-size:1.2em;">Charges sociale</span>
            <div class="ratio ratio-16x9">
              <div id="salesChart"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
         
          <div class="tile">
            <h3 class="tile-title"><i class="bi bi-bar-chart-line-fill"></i> Statistique masse salariale / profil</h3>
            <div class="ratio ratio-16x9">
              <div id="supportRequestChart"></div>
            </div>
          </div>
        </div>
      </div>
    </main>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
 <script type="text/javascript">
      const salesData = {
        xAxis: {
          type: 'category',
          data: <?php echo json_encode($newmonth); ?>,
        },
        yAxis: {
          type: 'value',
          axisLabel: {
            formatter: '{value}'
          }
        },
        series: [
          {
            data: <?php echo json_encode($charges); ?>,
            type: 'line',
            smooth: true
          },
          {
            data: <?php echo json_encode($chargesp); ?>,
            type: 'line',
            smooth: true
          }
        ],
        tooltip: {
          trigger: 'axis',
          formatter: "<b>{b0}:</b>{c0}"
        }
      }
      
      const supportRequests = {
        tooltip: {
          trigger: 'item'
        },
        legend: {
          orient: 'vertical',
          left: 'left'
        },
        series: [
          {
            name: 'Total masse',
            type: 'pie',
            radius: '50%',
            data: [
                 <?php for($i=0; $i < count($salaire); $i++){ ?>
                 { value: <?php echo json_encode($salaire[$i]); ?>, name:  <?php echo json_encode($profil[$i]); ?>},
               <?php }  ?>
            ],
            emphasis: {
              itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
              }
            }
          }
        ]
      };
      
      const salesChartElement = document.getElementById('salesChart');
      const salesChart = echarts.init(salesChartElement, null, { renderer: 'svg' });
      salesChart.setOption(salesData);
      new ResizeObserver(() => salesChart.resize()).observe(salesChartElement);
      
      const supportChartElement = document.getElementById("supportRequestChart")
      const supportChart = echarts.init(supportChartElement, null, { renderer: 'svg' });
      supportChart.setOption(supportRequests);
      new ResizeObserver(() => supportChart.resize()).observe(supportChartElement);
    </script>
@endsection
@endsection