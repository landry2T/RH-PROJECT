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
          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif

         @if (Session::has('success'))<br>
         <div class="alert alert-success mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('success') }}</strong>
         </div>
         @endif
         <h3><i class="bi bi-building-fill-check"></i> POINTAGES</h3>
         <div class="table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Les salariés</th>

                @php
                $today = today();
                $dates = [];

                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                  $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('y-m-d');
                }

                @endphp

                @foreach ($dates as $date)

                <th>
                  {{ $date }}
                </th>

                @endforeach

              </tr>
            </thead>
            <tbody>


              @foreach ($users as $user)

              <input type="hidden" name="emp_id" value="{{ $user->id }}">

              <tr>
                <td>
                  {{ $user->Fname }} {{ $user->Lname }}
                </td>

                @for ($i = 1; $i < $today->daysInMonth + 1; ++$i)

                @php

                $date_picker = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('y-m-d');

                $check_attd = \App\Models\pointages::query()
                ->where('users_id', $user->id)
                ->whereDate('created_at', $date_picker)
                ->first();

                @endphp

                <td>

                  @if (isset($check_attd))

                  @if ($check_attd->status==1)

                  <i class="bi bi-check bg-success text-white" style="font-size:1.2em;"></i>

                  @else

                  <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $check_attd->users_id }}"><i class="bi bi-x bg-warning text-white" style="font-size:1.2em;"></i></a>

                  <div class="modal fade" id="staticBackdrop{{ $check_attd->users_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour le pointage du {{ $check_attd->created_at }}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{route('pointag')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $check_attd->users_id }}">
                            <input type="hidden" name="create" value="{{ $check_attd->created_at }}">
                            <label>heure d'arrivé:*</label>
                            <input type="text" name="heure_arrive" class="form-control" value="{{ $check_attd->time_in }}">
                            <label>heure de depart:*</label>
                            <input type="text" name="heure_depart" class="form-control" value="{{ $check_attd->time_out }}"><br>
                            <button class="btn btn-primary" type="submit"><i class="bi bi-check"></i> Mettre a jour pointage</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div> 

                  @endif

                  @else

                  <i class="bi bi-x bg-danger text-white" style="font-size:1.2em;"></i>

                  @endif

                </td>


                @endfor
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</main>
@endsection