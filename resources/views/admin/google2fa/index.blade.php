
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

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
        <a href="{{ url('/') }}"><b>{{ config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="card">
        <div class="card-body login-card-body">
            
        <div class="container">
    <div class="row justify-content-center align-items-center " style="height: 35vh;S">
        <div class="col-md-12 col-md-offset-6">
            <div class="panel panel-default">
                
               
                @if($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                          <strong>{{$errors->first()}}</strong>
                        </div>
                    </div>
                @endif

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <p>Please enter the  <strong>OTP</strong> generated on your Authenticator App. <br> Ensure you submit the current one because it refreshes every 30 seconds.</p>
                            <label for="one_time_password" class="col-md-6 control-label">One Time Password</label>


                            <div class="col-md-8">
                                <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                
                            </div>
                        
                        </div>
                    </form>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" value="Back" class="btn btn-warning">
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>

            
           
        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ asset('public/js/app.js') }}" defer></script>

</body>
</html>

