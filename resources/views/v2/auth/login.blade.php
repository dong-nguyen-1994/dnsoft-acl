<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login | Administration</title>

  <!-- Bootstrap -->
  <link href="{{ asset('vendor/dnsoft/v2/admin/libs/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('vendor/dnsoft/v2/admin/libs/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('vendor/dnsoft/v2/admin/libs/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
  <!-- Animate.css -->
  <link href="{{ asset('vendor/dnsoft/v2/admin/libs/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ asset('vendor/dnsoft/v2/admin/libs/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login" style="background-image: url('https://img.freepik.com/premium-vector/padlock-security-cyber-digital-concept_42421-738.jpg?w=2000');">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form action="{{ route('admin.login') }}" method="post">
            @csrf
            <h1>Login Adminstration</h1>
            <div>
              <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter the email" required=""
                style="height: 2.7em"              
              />
              @error('email')
              <span class="invalid-feedback text-left" style="margin-top: -18px; margin-bottom: 20px; font-size: 13px;" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div>
              <input
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Password" required=""
                style="height: 2.7em"
              />
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div>
              <!-- <a class="btn btn-default submit" href="index.html">Log in</a> -->
              <div class="form-group mb-0 text-center">
                <button class="btn btn-primary btn-block" type="submit"> Log In </button>
              </div>
              <a class="reset_pass" href="#">Forgot your password?</a>
            </div>

            <div class="clearfix"></div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>

</html>