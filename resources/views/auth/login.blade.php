<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Klinik Pratama Hegar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
  
<body>

  <style>
    .divider:after,
.divider:before {
  content: "";
  flex: 1;
  height: 1px;
  background: #eee;
}
.h-custom {
  height: calc(100% - 73px);
}
@media (max-width: 450px) {
  .h-custom {
    height: 100%;
  }
}
  </style>

  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="{{asset('images/login.jpg')}}" class="img-fluid"
            alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <div class="card shadow-sm" style="border-radius: 15px;">
            <div class="p-4">
              <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <img src="{{asset('images/logo-hegar.png')}}" style="width: 70px;" alt="">
                <p class="mb-0 ms-3" style="font-weight: bold; font-size: 30px;">Klinik Pratama Hegar</p>
              </div>
              
              <div class="divider d-flex align-items-center my-4">
              </div>
              
              <form method="POST" action="{{ route('login') }}">
                @csrf
        
                <label for="" class="mb-1">Username</label>
                <div class="input-group mb-2">
                  <input id="username" type="text"
                    class="form-control @error('username') is-invalid @enderror"
                    name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                  
                  @error('username')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
        
                <input type="hidden" id="level" name="level" value="admin">
        
                <label for="" class="mb-1">Password</label>
                <div class="input-group mb-4">
                  <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="Password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
        
                <div class="row">
                  <div class="col-12">
                      <button type="submit" class="btn btn-primary btn-lg " style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ __('Login') }}</button>
                  </div>
                </div>      
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

{{-- <div class="login-box">
  <div class="login-logo">
    <a href="{{ route('login') }}"><b>Klinik</b> Pratama Hegar</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <h3 class="login-box-msg">{{ __('LOGIN') }}</h3>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-3">
          <input id="username" type="text"
            class="form-control @error('username') is-invalid @enderror"
            name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <input type="hidden" id="level" name="level" value="admin">

        <div class="input-group mb-3">
          <input id="password" type="password"
            class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
            <div class="input-group-text">
              <span class="fas fa-eye" id="toggle-password" style="cursor: pointer;"></span>
            </div>
          </div>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="row">
          <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block btn-raised">{{ __('Login') }}</button>
          </div>
        </div>      
      </form>

    </div>
  </div>
</div> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
