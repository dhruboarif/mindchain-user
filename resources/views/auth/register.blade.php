<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Sign Up</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetalert2-bootstrap-4.min.css') }}">
</head>
<body>
    @include('sweetalert::alert')
            <div id="video-background">
        <!-- Video Library -->
      <video onload="this.play();" autoplay loop muted>
        <source src="{{asset('assets/images/hero.mp4')}}" type="video/mp4"  codecs="avc1.4D401E, mp4.40.2">
      </video>
    </div>
    <div class="login-root">
        <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
          <div class="loginbackground box-background--white padding-top--64">
            <div class="loginbackground-gridContainer">
              <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
                <div class="box-root" style="background-image: linear-gradient(rgb(12, 3, 29) 0%, rgb(11, 8, 27) 33%); flex-grow: 1;">
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
              <div class="sign-up-formbg">
                <div class="formbg-inner padding-horizontal--48">
                    <div class="box-root  flex-flex flex-justifyContent--center">
                        <a href="https://www.mindchainwallet.com" rel="dofollow"><img src="assets/Mindchain.png" alt="MINDCHAIN"></a>

                      </div>
                      <h2 class="text-center text-white mb-4">Sign Up</h2>
                  <form method="POST" action="{{route('registration')}}">
                    @csrf
                     <p class="text-white">Register here to join Mindchain Community</p>
                    <div class="row">
                    
                    <div class="col-md-6 mb-4">
                    <div class="form-floating mb-3">
                    <label for="lastName">Username</label>
                    <input id="user_name" type="text" class="reg-form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                    </div>
                    @error('user_name')
                                           <span class="alert alert-danger" role="alert">
                                               {{ $message }}
                                           </span>
                                       @enderror
                    </div>
                       @if(isset($_GET['ref']))
                    @php 
                    $key= App\Models\User::where('key_id',$_GET['ref'])->first();
                    if($key == null)
                    {
                    $key_id= $_GET['ref'];
                    }else
                    {
                    $key_id= $key->user_name;
                    }
                    
                    @endphp
                    <div class="col-md-6 mb-4">
                    <div class="form-floating mb-3">
                      <label for="sponsor">Sponsor</label>
                    <input type="text" class="reg-form-control" value="{{$key_id}}" name="sponsor" id="sponsor">
                    </div>
                    <div id="suggestUser"></div>
                    </div>
                    @else

                    <div class="col-md-6 mb-4">
                    <div class="form-floating mb-3">
                      <label for="sponsor">Sponsor</label>
                    <input type="text" class="reg-form-control" name="sponsor" id="sponsor">
                    </div>
                    <div id="suggestUser"></div>
                    </div>
                    @endif

                    
                    
                    </div>
                    <div class="row">
                    <div class="col-md-12 mb-4">
                    <div class="form-floating mb-3">
                      <label for="floatingInput">Email</label>
                    <input id="email" type="email" class="reg-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    @error('email')
                                           <span class="alert alert-danger" role="alert">
                                              {{ $message }}
                                           </span>
                                       @enderror
                    </div>

                 




                     </div>
                    <div class="row">
                    <div class="col-md-6 mb-4">
                    <div class="form-floating mb-2">
                      <label for="Password">Password</label>
                    <input id="password" type="password" class="reg-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                    @error('password')
                                           <span class="alert alert-danger" role="alert">
                                               {{ $message }}
                                           </span>
                                       @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                    <div class="form-floating mb-2">
                      <label for="confirmpassword">Confirm-password</label>
                    <input id="password-confirm" type="password" class="reg-form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    </div>
                    </div>
                    
                    
                    <div class="form-check d-flex  mb-2">
                    <input type="checkbox" class="form-check-input" id="agree" style="margin-top: -15px;">
                    <label class="ms-1 form-check-label text-white" for="agree">I agree with the terms of
                    use</label>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn text-dark" style="background-color: rgb(236, 153, 0);">Sign Up</button>
                    </div>
                    </form>
                    <div class="new-account mt-3 text-center text-white">
                      <p>Already have an Account <a class="" style="color: rgb(255, 192, 20); " href="{{route('login')}}">Sign in</a>
                      </p>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Backend Bundle JavaScript -->
    <script src="{{asset('assets/js/libs.min.js')}}"></script>
    <!-- widgetchart JavaScript -->
    <script src="{{asset('assets/js/charts/widgetcharts.js')}}"></script>
    <!-- fslightbox JavaScript -->
    <script src="{{asset('assets/js/fslightbox.js')}}"></script>
    <!-- app JavaScript -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <!-- apexchart JavaScript -->
    <script src="{{asset('assets/js/charts/apexcharts.js')}}"></script>
      <script>
   $("body").on("keyup", "#sponsor", function () {
   //alert('success');
       let searchData = $("#sponsor").val();
       if (searchData.length > 0) {
           $.ajax({
               type: 'POST',
               url: '{{route("get-sponsor")}}',
               data: {search: searchData},
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (result) {
                   $('#suggestUser').html(result.success)
                   console.log(result.data)
                   // if (result.data) {
                   //     $("#position").val("");
                   //     $("#placement_id").val("");
                   //     $("#position").removeAttr('disabled');
                   // } else {
                   //     $("#position").val("");
                   //     $("#placement_id").val("");
                   //     $('#position').prop('disabled', true);
                   // }
               }
           });
       }
       if (searchData.length < 1) $('#suggestUser').html("")
   })


   </script>

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
      <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
</body>
</html>
