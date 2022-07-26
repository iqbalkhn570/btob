<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
   <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('admin/home') }}"><b>{{ config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ __('messages.'.Session::get('message')) }}.</p>
            @endif
            <form method="post" action="{{ url('admin/login') }}" id="form_sub">
                @csrf

                <div class="input-group mb-3">
                    <input type="text"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           placeholder="User ID"
                           class="form-control @error('email') is-invalid @enderror" maxlength="30" minlength="3" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           placeholder="Password"
                           class="form-control @error('password') is-invalid @enderror" id="id_password" maxlength="30" minlength="3">
                           
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <i class="far fa-eye" id="togglePassword"></i>&nbsp;
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="login_sub">Sign In</button>
                        
                    </div>

                </div>
            </form>
           
            <p class="mb-1">
                <!-- <a href="{{ route('password.request') }}">I forgot my password</a>-->
            </p>
            <p class="mb-0">
               <!-- <a href="{{ route('register') }}" class="text-center">Register a new membership</a>-->
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ asset('public/js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
window.onload = () => {
 const id_password = document.getElementById('id_password');
 id_password.onpaste = e => e.preventDefault();
}
$(function() {
        $('#email').on('keypress', function(e) {
            if (e.which == 32){
                return false;
            }
        });
});

$(document).ready(function () { $('#form_sub').submit(function (validator) { $('#login_sub').attr('disabled', 'disabled');
});
});

</script>
</body>
</html>
