<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>DnSoft | Administration System Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
  <meta content="Coderthemes" name="author">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('vendor/dnsoft/v1/admin/') }}/assets/images/favicon.ico">

  <!-- App css -->
  <link href="{{ asset('vendor/dnsoft/v1/admin/') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/dnsoft/v1/admin/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/dnsoft/v1/admin/') }}/assets/css/app.min.css" rel="stylesheet" type="text/css">

</head>

<body>

  <div class="account-pages mt-5 mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card">

            <div class="card-body p-4">

              <div class="text-center w-75 m-auto">
                <a href="#">
                  <span><img src="{{ asset('vendor/dnsoft/v1/admin/img/dnsoft.png') }}" alt=""></span>
                </a>
                <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
              </div>

              <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                  <label for="emailaddress">Email address</label>
                  <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" name="email" required="" placeholder="Enter your email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                  </div>
                </div>

                <div class="form-group mb-0 text-center">
                  <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                </div>

              </form>

            </div> <!-- end card-body -->
          </div>
          <!-- end card -->

        </div> <!-- end col -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </div>
  <!-- end page -->


  <footer class="footer footer-alt">
    2020 - 2023 &copy; Nguyen Van Dong <a href="" class="text-muted"></a>
  </footer>

  <!-- Vendor js -->
  <script src="{{ asset('vendor/dnsoft/v1/admin/') }}/assets/js/vendor.min.js"></script>

  <!-- App js -->
  <script src="{{ asset('vendor/dnsoft/v1/admin/') }}/assets/js/app.min.js"></script>

</body>

</html>