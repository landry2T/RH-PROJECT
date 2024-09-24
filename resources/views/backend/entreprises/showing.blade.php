@extends('layouts.app')

@section('content')
<main class="app-content">
  <div class="row user">
    <div class="col-md-12">
      <div class="profile">
        <div class="info">
          @if(@isset(Auth::guard('admin')->user()->logo))
          <img class="user-img" src="uploads/{{Auth::guard('admin')->user()->logo}}" style="height:70px;">
          @else
          <img class="user-img" src="{{asset('assets/img/digitalrh.jpg')}}" style="height:70px;">
          @endif
          <h4>{{Auth::guard('admin')->user()->name}}</h4>
        </div>
        <div class="cover-image"></div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="tile p-0">
        <ul class="nav flex-column nav-tabs user-tabs">
          <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-bs-toggle="tab"><i class="bi bi-person-x"></i> Mes informations</a></li>
          <li class="nav-item"><a class="nav-link" href="#user-settings" data-bs-toggle="tab"><i class="bi bi-pencil"></i> Editer mes informations</a></li>
          <li class="nav-item"><a class="nav-link" href="#user-password" data-bs-toggle="tab"><i class="bi bi-lock"></i> Changer mot de passe</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane active" id="user-timeline">
          <div class="timeline-post">
            <div class="post-media">
              <div class="content">
                <h3><i class="bi bi-house"></i> NOS INFORMATIONS</h3>

                @if (Session::has('success'))<br>
                <div class="alert alert-success mb-4" role="alert" class="text-white">
                 <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                 {{ Session::get('success') }}</strong>
               </div>
               @endif
             </div>
           </div>
           <div class="post-content">
            <div class="table-responsive">
              <table class="table table-hover table-striped">
               <tr><th>Email:</th> <th>{{Auth::guard('admin')->user()->email}}</th></tr> 
               <tr><th>Adresse:</th> <th>{{Auth::guard('admin')->user()->adresse}}</th></tr> 
               <tr><th>Secteur d'activité:</th> <th>{{Auth::guard('admin')->user()->secteur}}</th></tr> 
               <tr><th>Niveau de risque:</th> <th>{{Auth::guard('admin')->user()->niveau_risque}}</th></tr> 
               <tr><th>Numéro du contribuable:</th> <th>{{Auth::guard('admin')->user()->contribuable}}</th></tr> 
               <tr><th>Numéro de cnps:</th> <th>{{Auth::guard('admin')->user()->numero_cnps}}</th></tr> 
               <tr><th>Slogan:</th> <th>{{Auth::guard('admin')->user()->slogan}}</th></tr> 
               <tr><th>url du site web:</th> <th>{{Auth::guard('admin')->user()->urlsiteweb}}</th></tr> 
             </table>
           </div>
         </div>
       </div>
     </div>
     <div class="tab-pane fade" id="user-settings">
      <div class="tile user-settings">
        <h3 class="line-head"><i class="bi bi-pencil"></i> EDITER NOS INFORMATIONS</h3>
        <form method="POST" action="{{route('edit_admins', Auth::guard('admin')->user()->id)}}" enctype="multipart/form-data">
          @csrf
         <div class="row mb-4">
            <div class="col-md-12">
              <label>Nom de l'entreprise:*</label>
              <input class="form-control" type="text" name="name" value="{{Auth::guard('admin')->user()->name}}"><br>
              @if($errors->has('name'))
              <div class="text-danger">{{ $errors->first('name') }}</div>
              @endif
          </div>
          <div class="row mb-4">
            <div class="col-md-4">
              <label>Adresse email:*</label>
              <input class="form-control" type="email" name="email" value="{{Auth::guard('admin')->user()->email}}">
              @if($errors->has('email'))
              <div class="text-danger">{{ $errors->first('email') }}</div>
              @endif
            </div>
            <div class="col-md-4">
              <label>Localisation</label>
              <input class="form-control" type="text" name="localisation" value="{{Auth::guard('admin')->user()->adresse}}">
              @if($errors->has('localisation'))
              <div class="text-danger">{{ $errors->first('localisation') }}</div>
              @endif
            </div>
            <div class="col-md-4">
              <label>Secteur d'activité:*</label>
              <select class="form-select" name="secteur">
                <option value="agro-industrielles">entreprise agro-industrielles</option>
                <option value="PME">PME(cabinets,immobiliers,etablissements financiers,profession liberale)</option>
                <option  value="industrie">entreprise industrielle</option>
                <option  value="transport">entreprise transport urbain et fluvial</option>
                <option  value="transit et logistic">entreprise de transit</option>
                <option  value="forestier">entreprise forestière</option>
                <option  value="energetique">entreprise energetique</option>
                <option  value="genie civil">entreprise contruction et genie civil</option>
              </select>
            </div>
          </div>
          <div class="row mb-4">

            <div class="col-md-4">
              <label>Niveau de risque:*</label>
              <select class="form-select" name="niveau">
                @if(Auth::guard('admin')->user()->niveau_risque == "niveau risque faible")
                <option  @selected(Auth::guard('admin')->user()->niveau_risque == "niveau risque faible") value="niveau risque faible" >niveau risque faible</option>
                <option value="niveau risque moyen">niveau risque moyen</option>
                <option value="niveau risque élévé">niveau risque élévé</option>
                @elseif(Auth::guard('admin')->user()->niveau_risque == "niveau risque moyen")
                <option value="niveau risque faible" >niveau risque faible</option>
                <option  @selected(Auth::guard('admin')->user()->niveau_risque == "niveau risque moyen")  value="niveau risque moyen">niveau risque moyen</option>
                <option value="niveau risque élévé">niveau risque élévé</option>
                @else
                  <option value="niveau risque faible" >niveau risque faible</option>
                <option   value="niveau risque moyen">niveau risque moyen</option>
                <option  @selected(Auth::guard('admin')->user()->niveau_risque == "niveau risque élévé") value="niveau risque élévé">niveau risque élévé</option>
                @endif
              </select>
            </div>
            <div class="col-md-4">
              <label>Numéro du contribuable:*</label>
              <input class="form-control" type="text" name="contribuable" value="{{Auth::guard('admin')->user()->contribuable}}">
              @if($errors->has('contribuable'))
              <div class="text-danger">{{ $errors->first('contribuable') }}</div>
              @endif
            </div>
            <div class="col-md-4">
              <label>Registre Commercial :*</label>
              <input class="form-control" type="text" name="cnps" value="{{Auth::guard('admin')->user()->numero_cnps}}">
              @if($errors->has('cnps'))
              <div class="text-danger">{{ $errors->first('cnps') }}</div>
              @endif
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-4">
              <label>slogan:*</label>
              <input class="form-control" type="text" name="slogan" value="{{Auth::guard('admin')->user()->slogan}}">
              @if($errors->has('slogan'))
              <div class="text-danger">{{ $errors->first('slogan') }}</div>
              @endif
            </div>
            <div class="col-md-4">
              <label>url du site web </label>
              <input class="form-control" type="url" name="url" value="{{Auth::guard('admin')->user()->urlsiteweb}}">
            </div>
            <div class="col-md-4">
              <label>logo:*</label>
              <input class="form-control" type="file" name="logo" value="{{Auth::guard('admin')->user()->logo}}">
              @if($errors->has('logo'))
              <div class="text-danger">{{ $errors->first('logo') }}</div>
              @endif
            </div>
          </div>
          <div class="row mb-10">
            <div class="col-md-12">
              <button class="btn btn-primary" type="submit"><i class="bi bi-check-circle-fill me-2"></i> Mettre a jour</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="tab-pane fade" id="user-password">
      <div class="tile user-settings">
        <h3 class="line-head"><i class="bi bi-lock-fill"></i> Modifier le mot de passe</h3>
        <form>
          <div class="row mb-4">
            <div class="col-md-12">
              <label>Ancier mot de passe:*</label>
              <input class="form-control" type="password" name="p">
            </div>
            <div class="col-md-12">
              <label>Nouveau mot de passe:*</label>
              <input class="form-control" type="text" name="p1">
            </div>
            <div class="col-md-12">
              <label>Confirmez nouveau mot de passe:*</label>
              <input class="form-control" type="text" name="p2">
            </div>
          </div>
          <div class="row mb-10">
            <div class="col-md-12">
              <button class="btn btn-primary" type="button"><i class="bi bi-check-circle-fill me-2"></i> Valider</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</main>
@endsection 