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
          <h3><i class="bi bi-pencil"></i> Ajouter une prime</h3>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('primes.store')}}">
          @csrf
          <label>Nature de la prime:*</label>
          <select class="form-select" name="nature" id="nature">
           <option value="imposable">prime impossable</option>
           <option value="taxable et cotisable">prime taxable et cotisable</option> 
           <option value="taxable et pas cotisable">prime taxable et pas cotisable</option> 
           <option value="idemnité">Indemnité</option> 
         </select><br>
         <div id="result"></div>
         <label>Nom de la prime:*</label>
         <input type="text" name="name" class="form-control"><br>
         <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Ajouter Prime</button>

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