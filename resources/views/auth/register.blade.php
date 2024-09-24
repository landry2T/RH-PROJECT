@extends('layouts.login_app')

@section('content')
<section class="material-half-bg">
  <div class="cover"></div>
</section>
<section class="login-content">
  <div class="logo"><br>
     <h2 style="font-family: var(--bs-body-font-family);"><i class="bi bi-database"></i> ONEPAYWAVE-SOLUTION</h2>
</div>

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
<div class="login-box" style="width:650px; height:487px;">
 @isset($route)
 <form class="login-form" method="POST" action="{{ $route }}">
    @else
    <form class="login-form" method="POST" action="{{ route('register') }}">
        @endisset
        @csrf
        @csrf
        <h3 class="login-head"><i class="bi bi-person-plus me-2"></i> CREER COMPTE ENTREPRISE</h3>
       
        <div class="row">
           <div class="col-md-6">
              <label class="form-label">NOM DE L'ENTREPRISE :*</label>
              <input class="form-control" type="text" name="name" placeholder="Example: DIGITALSOFT SARL" autofocus>
              @if($errors->has('name'))
              <div class="text-danger">{{ $errors->first('name') }}</div>
              @endif
          </div>
          <div class="col-md-6">
              <label class="form-label">EMAIL DE L'ENTREPRISE :*</label>
              <input class="form-control" type="email" name="email" autofocus>
              @if($errors->has('email'))
              <div class="text-danger">{{ $errors->first('email') }}</div>
              @endif
          </div> 
      </div>
      <div class="mb-3"></div>
      <div class="mb-3">
        <label class="form-label">MOT DE PASSE :*</label>
        <input class="form-control" type="password" name="password" autofocus>
        @if($errors->has('password'))
        <div class="text-danger">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="mb-3">
        <label class="form-label">CONFIRMEZ MOT DE PASSE :*</label>
        <input class="form-control" type="password" name="current-password">
        @if($errors->has('password'))
        <div class="text-danger">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="mb-3">
        <div class="utility">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" checked='on'><span class="label-text">J'ai lu et j'accepte les conditions générales de confidentialité</span>
          </label>
      </div>            </div>
  </div>
  <div class="mb-3 btn-container d-grid">
      <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-left me-2 fs-5"></i> S'ENREGISTRER</button>
  </div>
</form>
</div>
@endsection
