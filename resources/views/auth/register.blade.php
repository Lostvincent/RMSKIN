@extends('layout.auth')

@section('content')
<form method="POST" action="{{ url('auth/register') }}" id="account2">
  {!! csrf_field() !!}
  <div class="panel-body p25 bg-light">
  @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </div>
    @endif
    <div class="section-divider mt10 mb40">
      <span>Set up your account</span>
    </div>
    <!-- .section-divider -->

    <div class="section">
      <label for="email" class="field prepend-icon">
        <input type="email" name="email" id="email" class="gui-input" placeholder="Email address">
        <label for="email" class="field-icon">
          <i class="fa fa-envelope"></i>
        </label>
      </label>
    </div>
    <!-- end section -->

    <div class="section">
       <label for="name" class="field prepend-icon">
         <input type="text" name="name" id="name" class="gui-input" placeholder="Username">
         <label for="name" class="field-icon">
           <i class="fa fa-user"></i>
         </label>
       </label>
      <!-- end .smart-widget section -->
    </div>
    <!-- end section -->

    <div class="section">
      <label for="password" class="field prepend-icon">
        <input type="password" name="password" id="password" class="gui-input" placeholder="Create a password">
        <label for="password" class="field-icon">
          <i class="fa fa-unlock-alt"></i>
        </label>
      </label>
    </div>
    <!-- end section -->

    <div class="section">
      <label for="confirmPassword" class="field prepend-icon">
        <input type="password" name="password_confirmation" id="confirmPassword" class="gui-input" placeholder="Retype your password">
        <label for="confirmPassword" class="field-icon">
          <i class="fa fa-lock"></i>
        </label>
      </label>
    </div>
    <!-- end section -->

  </div>
  <!-- end .form-body section -->
  <div class="panel-footer clearfix">
    <button type="submit" class="button btn-primary pull-right">Create Account</button>
  </div>
  <!-- end .form-footer section -->
</form>
@endsection