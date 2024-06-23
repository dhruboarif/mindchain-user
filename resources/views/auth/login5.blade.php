 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Log In / Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css">
     <!-- Fontawsome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('new-login/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetalert2-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{asset('pop-up/style.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
  </head>
  <body>
      @include('sweetalert::alert')
    <!-- partial Start-->
    <div class="section">
      <div class="container">
          @if(session('user_added'))
    <div class="alert alert-success">
        {{ session('user_added') }}
    </div>
@endif
        <div id="video-background">
        <!-- Video Library -->
      <video onload="this.play();" autoplay loop muted>
        <source src="{{asset('assets/images/bg-video.mp4')}}" type="video/mp4"  codecs="avc1.4D401E, mp4.40.2">
      </video>
    </div>
        <div class="row full-height justify-content-center">
          <div class="col-12 text-center align-self-center py-5">
              <img class="logo-mind mb-2" src="{{asset('new-login/Mindchain.png')}}" alt="Mindchain"> <br>
               <button type="submit" class="btn btn-success mt-2 mb-4"><a href="https://www.mindchainwallet.com">GO HOME</a></button>
            <div class="section pb-5 pt-5 pt-sm-2 text-center">
                <form id="stripe-login" method="POST" action="{{ route('login') }}">
                @csrf
                     
              <h6 class="mb-0 pb-3">
                <span>Log In </span><span>Sign Up</span>
              </h6>
              
              <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
              <label for="reg-log"></label>
              <div class="card-3d-wrap mx-auto">
                <div class="card-3d-wrapper">
                  <div class="card-front">
                    <div class="center-wrap">
                      <div class="section text-center">
                           @if (session('error'))
                           <div style="color:green;">
                                {!! session('error') !!}
                           </div>
                        @endif
                       
                        <h4 class="mb-4 pb-3">Log In</h4>
                        
                        <p>Please input your valid username and password to login your Mindchain Wallet. </p>
                       
                        <div class="form-group">
                          <input type="text" name="user_name" class="form-style @error('user_name') is-invalid @enderror" placeholder="Your Username" id="loginname" autocomplete="off" />
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group d-flex mt-2">
                          <input class="form-style @error('password') is-invalid @enderror" type="password" name="password" placeholder="Your Password" autocomplete="current-password" required="" id="id_password"><i class="far fa-eye" id="togglePassword"></i>
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                         @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" class="btn mt-4">submit</button>
                        </form>
                        <p class="mb-0 mt-4 text-center">
                            @if (Route::has('password.request'))
                          <a href="{{ route('password.request') }}" class="link">Forgot your password?</a>
                          @endif
                          <!--<a href="reset.html" class="link">Forgot your password?</a>-->
                        </p>
                      </div>
                    </div>
                  </div>
                  
                  <div class="card-back">
                    <div class="center-wrap">
                      <div class="section text-center">
                          <form method="POST" action="{{route('registration')}}">
                    @csrf
                        <h4 class="mb-4 pb-2">Sign Up</h4>
                        <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>

                        <div class="form-group">
                          <input type="text" name="user_name" class="form-style @error('user_name') is-invalid @enderror" placeholder="User Name" id="logname" autocomplete="off" />
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        @error('user_name')
                                           <span class="alert alert-danger" role="alert">
                                               {{ $message }}
                                           </span>
                                       @enderror
                        <div class="form-group mt-2">
                          <input type="email" name="email" class="form-style @error('email') is-invalid @enderror" placeholder="Your Email" id="logemail" autocomplete="off" />
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        @error('email')
                                           <span class="alert alert-danger" role="alert">
                                              {{ $message }}
                                           </span>
                                       @enderror
                                       
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
                        <div class="form-group d-flex mt-2">
                          <input type="text" value="{{$key_id}}" name="sponsor" id="sponsor" class="form-style" placeholder="Sponsor"  autocomplete="off" />
                          <i class="input-icon uil uil-game-structure"></i>
                          
                        </div>
                         <div id="suggestUser"></div>
                        
                        @else 
                        <div class="form-group d-flex mt-2">
                          <input type="text" name="sponsor" id="sponsor" class="form-style" placeholder="Sponsor"  autocomplete="off" />
                          <i class="input-icon uil uil-game-structure"></i>
                           
                        </div>
                        <div id="suggestUser"></div>
                        
                        
                        
                        
                        @endif
                        <div class="form-group mt-2">
                          <input type="password" name="password" class="form-style @error('password') is-invalid @enderror" placeholder="Your Password" id="logpass" autocomplete="off" />
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                         @error('password')
                                           <span class="alert alert-danger" role="alert">
                                               {{ $message }}
                                           </span>
                                       @enderror
                      <div class="form-group mt-2">
                          <input type="password" id="password-confirm" type="password" name="password_confirmation" class="form-style" placeholder="Password Confirm" autocomplete="off" />
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <button type="submit" class="btn mt-4">submit</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="social-container mt-4">
            <ul>
            <li><a href="https://www.facebook.com/mindchain.info"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="https://twitter.com/MindChain1"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="https://www.youtube.com/channel/UCogQYyfu7ista6L1X8SQluw"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
            <li><a href="https://t.me/mindchainMIND"><i class="fab fa-telegram-plane" aria-hidden="true"></i></a></li>
            {{-- <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li> --}}
            <li><a href="https://discord.com/channels/910149384858136587/910149385302720513"><i class="fab fa-discord" aria-hidden="true"></i></a></li>
            <li><a href="https://www.reddit.com/user/Mindchainswap"><i class="fab fa-reddit-alien" aria-hidden="true"></i></a></li>
            <li><a href="https://medium.com/@mindchain"><i class="fab fa-medium-m" aria-hidden="true"></i></a></li>
          </ul>
        </div>
            
        </div>
      </div>
    </div>
    
    <!-- pop up start -->
    
  
<!-- pop-up end -->
    {{-- @error('user_name')
                                           <span class="alert alert-danger" role="alert">
                                               {{ $message }}
                                           </span>
                                       @enderror
                                       <br>
                                        @error('email')
                                           <span class="alert alert-danger" role="alert">
                                               {{ $message }}
                                           </span>
                                       @enderror
                                       <br>
                                        @error('password')
                                           <span class="alert alert-danger" role="alert">
                                               {{ $message }}
                                           </span>
                                       @enderror --}}
    <!-- partial -->
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


//Check from frontend your name and email is already taken or not
$(document).ready(function() {
    $('#logname, #logemail').on('blur', function() {
        var username = $('#logname').val();
        var email = $('#logemail').val();

        $.ajax({
            url: '{{ route('checkDuplicate') }}', // Replace with your route to check duplicates
            method: 'POST',
            data: {
                username: username,
                email: email,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response.username_taken); // Log the response to the browser console
                if (response.username_taken) {
                    $('#errorMessages').html('Username already taken.').show();
                } else if (response.email_taken) {
                    $('#errorMessages').html('Email already taken.').show();
                } else {
                    $('#errorMessages').hide().empty();
                }
            },
            error: function() {
                $('#errorMessages').html('Error occurred. Please try again.').show();
            }
        });
    });
});




   </script>
   <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
 
  </body>
</html>
