@extends('user.layouts.master')


@section('user_content')

<?php
                    use App\Models\User; 
                    $user = User::where('id', Auth::id())->first(); 
                    //dd($user);
                    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELITE CLUB</title>
    <!-- bootstrap css -->
    {{-- <link rel="stylesheet" href="{{ asset('elite-club/assets/css/bootstrap.min.css') }}"> --}}
    <!-- Fontawesome Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('elite-club/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('elite-club/assets/css/responsive.css') }}">
</head>
<body class="text-white " id="bg-img" style="background-image: url('{{ asset('elite-club/assets/image/tecture.png') }}');">
    <!-- breadcumb- area start-->
    <section class="breadcumb-area" id="ambassador-breadcumb">
        <div class="container text-center pt-4 pb-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb ">
                        <h2>ELITE CLUB</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcumb- area start-->

    <section class="become-ambassdor mt-0"  >
        <div class="container">
            <div class="col-xl-12">
             
                    @if(Session::has('join_success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>
                            {{Session::get('join_success')}}
                            </div>
                    </div>
                    @elseif(Session::has('join_error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>
                        {{Session::get('join_error')}}
                        </div>
                    </div>
                    @endif
                    @if(Session::has('deposit_success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>
                            {{Session::get('deposit_success')}}
                            </div>
                    </div>
                    @elseif(Session::has('deposit_error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>
                        {{Session::get('deposit_error')}}
                        </div>
                    </div>
                    @endif
     
                </div>
            
            <div class="col-xl-12 ambassdor-sec-1 text-center pt-4 text-purple">
                 <h4 class="fw-bolder text-purple">Why Become Elite Member!</h4>
                 <p>Elevate Your Blockchain Experience: Join the Mindchain Elite Club! </p>
            </div>
            <div class="row section1 mt-4 ml-4  gx-3">
                <div class="col-sm-5 mt-4 mb-4  pt-2 image-area ">
                    <img class="col-xl-12 img-fluid" style="max-width:100%; max-height:100%" src="{{ asset('elite-club/assets/image/Elite-club.png') }}" alt="image">
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-5 pt-4 mt-4 mb-4  pb-0 content-area text-white">
                    <p class="text-white pb-3 ml-2">Welcome to the future of blockchain technology with Mindchain! Our Elite Club is your exclusive gateway to unlocking the full potential of the next generation blockchain platform. When you become a member, you'll gain access to a world of cutting-edge benefits and privileges, including:</p>
                    <ul class="text-white" id="icon-img">
                        <li>&#9883; <b>Early Access:</b> Be the first to explore and utilize Mindchain's groundbreaking blockchain innovations</li>
                        <li>&#9883; <b>Insider Insights:</b> Stay ahead of the curve with exclusive updates, news, and industry trends. </li>
                        <li>&#9883; <b>Premium Support:</b>Enjoy priority assistance from our dedicated Elite support team. </li>
                        <li>&#9883; <b>Networking Opportunities:</b> Connect with like-minded blockchain enthusiasts and industry leaders.</li>
                        <li>&#9883; <b>Exclusive Events: </b>Gain entry to Elite-only webinars, seminars, and conferences.</li>
                        <li>&#9883; <b>Customized Solutions:</b> Access tailored blockchain solutions to meet your unique needs.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="ambassador-benefit">
        <div class="container">
            <div class="col-lg-12 ambassdor-sec-2 text-center pt-4 text-purple">
                <h4 class="fw-bolder text-purple">Facilities of Elite Member</h4>
                <p>You will earn exclusive access, discounts gifts, and other rewards as you help us encourage the worldwide Mindchain community.</p>
            </div>
            <div class="row section2 mt-4 gx-3 text-white">
                <div class="col-xl-5 m-4 p-4 listing-area">
                    <ul>
                        <li>&#9672; 1st year will get profit as 20% APY </li>
                        <li>&#9672; After 1st year Mindchain will transfer to CEX and get staking there (as new APY) </li>
                        <li>&#9672; They will get 5% profit revenue from Mindchain CEX</li>
                        <li>&#9672; Income from APY can be withdrawn in USDT at any time</li>
                        <li>&#9672; Copy trade will get the opportunity to participate in ongoing trades with the best possible traders.</li>
                    </ul>
                </div>
                <div class="col-xl-5 m-4 p-4 listing-area ">
                    <ul>
                        <li>&#9672; Balance transfer to Mindchain CEX After that, you can withdraw the main balance if you want. In that case minimum 365 more days after staking. After withdrawing the main balance the withdrawer will be deactivated from Elite Member. (Will be deprived of all benefits of Elite Member).</li>
                        <li>&#9672; Mindchain will receive signals and timings for traders from CEX's MM team. (In that case, according to the condition, staking should be done for a minimum 5 years to get the signal)</li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('user.modals.add_fund_elite')
    @include('user.modals.joinElite')
    <section class="htb-ambassador pb-4">
        <div class="container text-left">
            <div class="col-lg-12 ambassador-sec-3 text-center pt-4 text-purple">
                <h4 class="fw-bolder text-purple">How to Become Elite Club Member</h4>
                <p>Joining the Mindchain Elite Club means becoming part of a community that is shaping the future of blockchain technology. Don't miss your chance to be at the forefront of innovation. Apply for Elite membership now and experience blockchain like never before!</p>
            </div>
            <div class="row section-3 pt-4 ">
                <div class="col-xl-5  pt-4 condition-area card-body text-center ">
  <!--<a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#addfund24">Deposit Now</a>-->
                  @if($user->elite_club == 1)
    <a class=" button sell float-right" href="#" data-bs-toggle="modal" data-bs-target="#">Already Elite Member</a>
    @else
        <a class=" button sell float-right" href="#" data-bs-toggle="modal" data-bs-target="#addfundelite">Deposit Now</a>
@endif

                    <h5 class="mt-3"> <span>Deposit <del style="color:red;">$1500</del> $1250 to become a Elite Club Member</span></h5>
                </div>
                <div class="or text-center col-lg-2 fw-bolder"><i class="fa-solid fa-right-long"></i></div>
                <div class="col-xl-5 p-4 condition-area card-body text-center">
                    
                @if($user->elite_club == 1)
                <a class=" button sell float-right" href="#" data-bs-toggle="modal" data-bs-target="#"><span>Already Elite Member</span></a>
                @else
                <a class=" button sell float-right" href="#" data-bs-toggle="modal" data-bs-target="#joinelite"><span>Join Elite Club</span></a>
                @endif
                    <h5 class="mt-3"><span> USD Balance: {{$data['sum_usdwallet']}} USD. </span></h5>
                </div>
            </div>
            </div>
        </div>
    </section>
        <section class="become-ambassdor mt-0"  >
        <div class="container">
            <div class="col-xl-12 ambassdor-sec-1 text-center pt-4 text-purple">
                 <h4 class="fw-bolder text-purple">Terms and Conditions </h4>
                 <!-- <p>Ambassadors are passionate members of the crypto world who help connect as an Ambassador.</p> -->
            </div>
            <div class="row section1 mt-4 gx-3">
                <div class="col-xl-5 mt-4 mb-4 image-area ">
                    <img class="col-xl-12 mt-2 img-fluid" style="max-width:100%; max-height:100%" src="{{ asset('elite-club/assets/image/Terms-and-condition.png') }}" alt="image">
                </div>
                <div class="col-sm-1 m-0"></div>
                <div class="col-xl-5 mt-4 mb-4 pt-4 pb-0 content-area text-white">
                    <!-- <h6 class="pb-3">The ambassador's are to promote, represent, and expand the network of the project they are connected with.</h6> -->
                    <ul>
                        <li>&#9998; <b>Eligibility:</b> To become a Mindchain Elite Club member, you must be at least 18 years old.
                            Membership eligibility may be subject to additional criteria set by Mindchain.</li>
                        <li>&#9998; <b>Application Process:</b> Interested individuals can apply for Elite Club membership through the official Mindchain website or designated channels.
                            Mindchain reserves the right to approve or reject membership applications at its discretion. </li>
                        <li>&#9998; <b>Membership Fees:</b> Membership fees, if applicable, will be clearly outlined during the application process.
                            Fees are non-refundable, and members are responsible for any associated charges. </li>
                        <li>&#9998; <b>Membership Duration:</b> Membership duration will be specified upon acceptance into the Elite Club.
                            Mindchain may offer different membership terms, including annual, biennial, or other options.</li>
                        <!-- <li>&#9998; <b>Benefits and Privileges:</b> Elite Club benefits, privileges, and offerings may vary and are subject to change at Mindchain's discretion.
                            Members will be informed of any changes in benefits and privileges through official communication channels.</li>
                        <li>&#9998; <b>Code of Conduct:</b> Elite Club members are expected to conduct themselves with professionalism and respect toward Mindchain, its staff, and fellow members.
                            Any inappropriate or disruptive behavior may result in membership suspension or termination.</li>
                        <li>&#9998; <b>Confidentiality:</b> Mindchain reserves the right to terminate a Elite Club membership for violations of these terms and conditions or any other reasons deemed appropriate.
                            Termination may result in the forfeiture of membership fees or benefits. </li>
                        <li>&#9998; <b>Termination:</b>Public places should work in coordination with all projects of the Ecosystem</li>
                        <li>&#9998; <b>Privacy:</b> Member data and personal information will be handled in accordance with Mindchain's privacy policy.
                            By becoming a Elite Club member, you consent to the collection and use of your data as described in the privacy policy.</li>
                        <li>&#9998; <b>Amendments:</b> Mindchain may update or modify these terms and conditions at any time. <br>- Members will be notified of any changes through official communication channels.</li> -->
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="join-cmnty pt4 pb-4">
        <div class="container">
            <div class="col-lg-12 ambassador-sec-4 text-center text-purple  pt-4">
                <h4 class="fw-bolder text-purple">Join Our Community</h4>
                <div class="col-lg-12 text-center ml-0 p-3">
                    <a class="btn btn-primary m-1" style="background-color: #3b5998;" href="https://www.facebook.com/mindchain.info" role="button"><i class="fab fa-facebook-f me-2"></i>Facebook</a>
                    <a class="btn btn-primary m-1" style="background-color: #55acee;" href="https://twitter.com/MindChain1" role="button"><i class="fab fa-twitter me-2"></i>Twitter</a>
                    <a class="btn btn-primary m-1" style="background-color: #ed302f; " href="https://www.youtube.com/channel/UCogQYyfu7ista6L1X8SQluw" role="button"><i class="fab fa-youtube me-2"></i>YouTube</a>
                    <a class="btn btn-primary m-1" style="background-color: #28A8E9" href="https://t.me/mindchainMIND" role="button"><i class="fa-brands fa-telegram me-2"></i>Telegram</a>
                    <a class="btn btn-primary m-1" style="background-color: #111111;" href="https://medium.com/@mindchain" role="button"><i class="fa-brands fa-medium me-2"></i>Medium</a>
                    <a class="btn btn-primary m-1" style="background-color: #5562EA;" href="https://discord.com/channels/910149384858136587/910149385302720513" role="button"><i class="fa-brands fa-discord me-2"></i>Discord</a>
                    <a class="btn btn-primary m-1" style="background-color: #FF4705;" href="https://www.reddit.com/user/Mindchainswap" role="button"><i class="fa-brands fa-reddit-alien me-2"></i>Reddit</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>



@endsection
