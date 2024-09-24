@extends('layouts.app_user')

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
      <div class="widget-small primary coloured-icon"><i class="icon bi bi-layout-text-window-reverse"></i>
        <div class="info">
          <h4>Absence(s)</h4>
          <p><b>{{$absences}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small info coloured-icon"><i class="icon bi bi-briefcase-fill fs-1"></i>
        <div class="info">
          <h4>Congé(s)</h4>
          <p><b>{{$conges}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small danger coloured-icon"><i class="icon bi bi-building-fill-check"></i>
        <div class="info">
          <h4>pointage(s)</h4>
          <p><b>{{$pointages}} / 24</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small primary coloured-icon"><i class="icon bi bi-file-earmark-pdf-fill fs-1"></i>
        <div class="info">
          <h4>Feuiile de paie</h4>
          <p><b>{{$bulletins}}</b></p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="tile">
      <div class="tile-body">
       <h3><i class="bi bi-person-fill"></i> Mon pointage</h3>
    <div class="col-lg-12">
      <div class="table-responsive">
      <table class="table table-hover table-bordered" id="sampleTable">
        <thead>
          <tr>

            @php
            $today = today();
            $dates = [];

            for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
              $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
            }

            @endphp

            <th>Nom du salarié</th>

            @foreach ($dates as $date)

            <th>
              {{ $date }}
            </th>

            @endforeach

          </tr>
        </thead>
          <tbody>


              <input type="hidden" name="emp_id" value="{{ $users->id }}">

              <tr>
                <td>
                  {{ $users->Fname }} {{ $users->Lname }}
                </td>

                @for ($i = 1; $i < $today->daysInMonth + 1; ++$i)

                @php

                $date_picker = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');

                $check_attd = \App\Models\pointages::query()
                ->where('users_id', $users->id)
                ->whereDate('created_at', $date_picker)
                ->first();

                @endphp

                <td>

                  @if (isset($check_attd))

                  @if ($check_attd->status==1)

                  <i class="bi bi-check bg-success text-white" style="font-size:1.2em;"></i>

                  @else

                  <i class="bi bi-x bg-danger text-white" style="font-size:1.2em;"></i> 

                  @endif

                  @else

                  <i class="bi bi-x bg-warning text-white" style="font-size:1.2em;"></i>

                  @endif

                </td>


                @endfor
              </tr>
            </tbody>
        </table>
        </div></div>
      </div>
      </div>
    </div>
  </main>
  @endsection