<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Reset</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css"
    />
    <link rel="stylesheet" href="{{asset('new-login/style.css')}}" />
  </head>
  <body>
    <!-- partial Start-->
    <div class="section">
      <div class="container">
        <div class="row full-height justify-content-center">
          <div class="col-12 text-center align-self-center py-5">
              <img class="logo-mind" src="{{asset('new-login/Mindchain.png')}}" alt="Mindchain">
              <div class="card-3d-wrap mx-auto">
                <div class="card-3d-wrapper">
                  <div class="card-reset">
                    <div class="center-wrap">
                      <div class="section text-center">
                           

                        <form method="POST" action="{{ route('password.email') }}">
                          @csrf
                        <h4 class="mb-4 pb-1">Reset Password</h4>
                        @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                        <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>
                        <div class="form-group mt-2">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-style @error('email') is-invalid @enderror" placeholder="Your Email" id="logemail" autocomplete="off" />
                           
                            <i class="input-icon uil uil-at"></i>
                          </div>
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <button type="submit" class="btn mt-4">submit</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- partial -->
  </body>
</html>
