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
          <h3><i class="bi bi-archive"></i> AJOUTER ARCHIVE</h3><br>

          @if (Session::has('error'))<br>
          <div class="alert alert-danger mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('error') }}</strong>
         </div>
         @endif
         <form method="POST" action="{{route('archives.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">

            <div class="form-group col-md-6">
              <label>Type du document:*</label>
              <select class="form-select" name="categorie">
                @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->name_type}}</option>
                @endforeach
              </select>
              @if($errors->has('name_doc'))
              <div class="text-danger">{{ $errors->first('name_doc') }}</div>
              @endif
            </div>

            <div class="form-group col-md-6">
              <label>nom du document:*</label>
              <input type="" name="namedoc" class="form-control">
              @if($errors->has('name_doc'))
              <div class="text-danger">{{ $errors->first('name_doc') }}</div>
              @endif
            </div>
            
            <div class="form-group col-md-6">
              <label>description du document:</label>
              <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="form-group col-md-6">
              <label>téléverser le document:</label>
              <input type="file" name="fichier" class="form-control">
              @if($errors->has('fichier'))
              <div class="text-danger">{{ $errors->first('fichier') }}</div>
              @endif
            </div>
          </div><br>
          <button type="submit" class="btn btn-info btn-md"><i class="bi bi-pencil"></i> Ajouter Une archive</button>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection