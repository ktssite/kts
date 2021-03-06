<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kraite Trading School</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
     <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"> -->
    <!-- NProgress -->
    <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
              <h1>{{ __('Login') }}</h1>
              <!-- <div>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('E-Mail Address') }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div> -->
              @if ($errors->has('login'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('login') }}</strong>
                  </span>
              @endif
              <div>
                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="{{ __('Username') }}">
              </div>
              <div>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('Password') }}">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
              <div>
                <button type="submit" class="btn btn-primary">  {{ __('Login') }} </button>
                <a class="btn btn-link" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }} </a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="/register" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <a href="/"><img src="{{ asset('images/logotext.png') }}" alt="{{ config('app.name', 'Laravel') }}" style="width: 100%"></a>
                  <p>©2018 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>