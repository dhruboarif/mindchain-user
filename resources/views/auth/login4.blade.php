<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets3/css/bootstrap.min.css')}}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('assets3/css/style.css')}}">
    
    <!-- Fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
    <div class="login-root">
        <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
          <div class="loginbackground box-background--gradient padding-top--64">
            <div class="loginbackground-gridContainer">
              <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
                <div class="box-root" style="flex-grow: 1;">
                </div>
              </div>
              <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
                <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
              </div>
              <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
                <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
              </div>
              <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
                <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
              </div>
              <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
                <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
              </div>
              <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
                <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
              </div>
              <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
                <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
              </div>
              <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
                <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
              </div>
              <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
                <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
              </div>
            </div>
          </div>
          <div class="box-root padding-top--72 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
              
            
            <div class="formbg-outer">
              <div class="sign-in-formbg">
                <div class="formbg-inner padding-horizontal--48">
                    <div class="box-root padding-bottom--24 flex-flex flex-justifyContent--center">
                        <a href="{{route('home')}}" rel="dofollow"><img src="{{asset('assets3/Mindchain.png')}}" alt="MINDCHAIN"></a>
                      </div>
                      <h3 class="text-center text-white mb-4" style="font-weight: 600; margin-top: -10px;">Sign In</h3>
                       @if(Session::has('user_added'))
                 <div class="alert alert-success d-flex align-items-center" role="alert">
                 <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                 <use xlink:href="#check-circle-fill" />
                 </svg>
                 <div>
                 {{Session::get('user_added')}}
                 </div>
                 </div>
                 @endif
                   <form id="stripe-login" method="POST" action="{{ route('login') }}">
                    @csrf
                      @if (session('error'))
                           <div style="color:red;">
                                {!! session('error') !!}
                           </div>
                        @endif
                    <p class="log-subtitle">Member, sign in to continue</p>
                    <div class="field padding-bottom--24">
                      <label for="email">User Name</label>
                      <input type="text" name="user_name" class="@error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                    </div>
                    @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <div class="field padding-bottom--24">
                      <div class="grid--50-50">
                        <label for="password">Password</label>
                      </div>
                      <div class="">
                        <input type="password" name="password" class="form-control2 @error('password') is-invalid @enderror" autocomplete="current-password" required="" id="id_password"><i class="far fa-eye" id="togglePassword" style="margin-left: -32px; font-size: 14px; color: rgb(31, 30, 30); cursor: pointer;"></i>
                     </div>
                     @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     <div class="reset-pass">
                       @if (Route::has('password.request'))
                          <a href="{{ route('password.request') }}">Forgot your password?</a>
                          @endif
                    </div>
                     
                    </div>
                    <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                      <label for="checkbox">
                        <input type="checkbox" name="checkbox"> Remember Me
                      </label>
                    </div>
                    <div class="field padding-bottom--24">
                      <input type="submit" name="submit" value="Sign In">
                    </div>
                    <div class="footer-link"><span>Don't have an account? <a class="signup-link" href="{{route('register')}}">Sign up</a></span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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
      </script>
</body>
</html>