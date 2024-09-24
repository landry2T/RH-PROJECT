@extends('layouts.app')

@section('content')
 <main class="app-content">
      <div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="{{asset('assets/img/digitalrh.jpg')}}">
              <h4>DIGITAL RH</h4>
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
                    <h3><a href="#"><i class="bi bi-person"></i> Nos informations</a></h3>
                  </div>
                </div>
                <div class="post-content">
                  <div class="table-responsive">
                    <table class="table table-hover table-striped">
                     <tr><th>Email:</th> <th>landrymelachio@gmail.com</th></tr> 
                     <tr><th>Adresse:</th> <th></th></tr> 
                     <tr><th>Secteur d'activité:</th> <th></th></tr> 
                     <tr><th>Niveau de risque:</th> <th></th></tr> 
                     <tr><th>Numéro du contribuable:</th> <th></th></tr> 
                     <tr><th>Numéro de cnps:</th> <th></th></tr> 
                     <tr><th>Slogan:</th> <th></th></tr> 
                     <tr><th>url du site web:</th> <th></th></tr> 
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="user-settings">
              <div class="tile user-settings">
                <h3 class="line-head"><i class="bi bi-pencil"></i> Editer mes informations</h3>
                <form>
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <label>Adresse email:*</label>
                      <input class="form-control" type="email" name="email">
                    </div>
                    <div class="col-md-4">
                      <label>Localisation</label>
                      <input class="form-control" type="text" name="localisation">
                    </div>
                    <div class="col-md-4">
                      <label>Secteur d'activité:*</label>
                      <select class="form-select"></select>
                    </div>
                  </div>
                  <div class="row mb-4">
                    
                    <div class="col-md-4">
                      <label>Niveau de risque:*</label>
                      <input class="form-control" type="text" name="localisation">
                    </div>
                    <div class="col-md-4">
                      <label>Numéro du contribuable:*</label>
                      <input class="form-control" type="text" name="contribuable">
                    </div>
                    <div class="col-md-4">
                      <label>Registre Commercial</label>
                      <input class="form-control" type="text" name="cnps">
                    </div>
                  </div>

                  <div class="row mb-4">
                    <div class="col-md-4">
                      <label>slogan:*</label>
                      <input class="form-control" type="text" name="slogan">
                    </div>
                    <div class="col-md-4">
                      <label>url du site web</label>
                      <input class="form-control" type="url" name="url">
                    </div>
                    <div class="col-md-4">
                      <label>logo:*</label>
                      <input class="form-control" type="file" name="logo">
                    </div>
                  </div>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="button"><i class="bi bi-check-circle-fill me-2"></i> Mettre a jour</button>
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