@extends('layouts.login_app')

@section('content')

<section class="material-half-bg">
  <div class="cover"></div>
</section>
<section class="login-content">
  <div class="logo">
    <h2 style="font-family: var(--bs-body-font-family);"><i class="bi bi-database"></i> ONEPAYWAVE-SOLUTION</h2>
</div>
@if (Session::has('error'))<br>
<div class="alert alert-danger mb-4" role="alert" class="text-white">
 <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
 {{ Session::get('error') }}</strong>
</div>
@endif
<div class="login-box">
 @isset($route)
  <form class="login-form" method="POST" action="{{ route('admin.login') }}">
    @else
    <form  class="login-form" method="POST" action="{{ route('login') }}">
        @endisset
        @csrf
        <h3 class="login-head"><i class="bi bi-person me-2"></i>SE CONNECTER</h3>
        <div class="mb-3">
          <label class="form-label">ADRESSE EMAIL:*</label>
          <input class="form-control" type="email"  name="email" placeholder="Adresse Email" >
          @if($errors->has('email'))
          <div class="text-danger">{{ $errors->first('email') }}</div>
          @endif
      </div>
      <div class="mb-3">
          <label class="form-label">MOT DE PASSE :*</label>
          <input class="form-control" type="password" name="password" placeholder="Mot de passe"> 
          @if($errors->has('password'))
          <div class="text-danger">{{ $errors->first('password') }}</div>
          @endif
      </div>
      <div class="mb-3">
          <div class="utility">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" checked="on"><span class="label-text">Rester connecté</span>
            </label>
        </div>
        <p class="semibold-text mb-2"><a href="{{route('admin.register')}}" >Creér un compte ?</a></p>
    </div>
</div>
<div class="mb-3 btn-container d-grid">
  <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i> SE CONNECTER</button>
</div>
</form>
</div>
</section>
@endsection