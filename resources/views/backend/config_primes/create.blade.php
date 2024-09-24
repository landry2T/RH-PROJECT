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
          <h3><i class="bi bi-pencil"></i>CONFIGURER UNE PRIME</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('config_primes.store')}}">
          @csrf
          <label>Selectionner un poste:*</label>
          <select class="form-select" name="poste">
          @foreach($postes as $poste)
           <option value="{{$poste->id}}">{{$poste->name_poste}}</option> 
          @endforeach
         </select><br>
         <label>Selectionner une prime:*</label>
          <select class="form-select" name="prime">
          @foreach($primes as $prime)
           <option value="{{$prime->id}}">{{$prime->libelle_prime}}</option> 
          @endforeach
         </select><br>
         <label>Montant de la prime:*</label>
         <input type="number" name="montant" class="form-control" min="0"><br>
         <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Ajouter Configuration</button>

       </form>

     </div>
   </div>
 </div>
</main>
@endsection
@section('scripts')
<script type="text/javascript">
  $('#nature').on('change', function(){
  var nature = $(this).val();
  $( "#result").html("<h3>chargement en cours ...</h3>");
   $.ajax({
    type: "GET",
    url: "{{route('nature')}}",
    data:"id="+nature,
    dataType:"html",
    success:function(response){
      $( "#result" ).html(response);
    }
  });
 })
</script>
<script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection