
@extends('user.layouts.master')


@section('user_content')

<!DOCTYPE html>
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Mindchain Consultant Program</title>-->
    <!-- bootstrap css -->
    <!--<link rel="stylesheet" href="{{asset('career/assets/css/bootstrap.min.css') }}">-->
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('career/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('career/assets/css/responsive.css') }}">
    <!-- fontawesome css-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->

<!--</head>-->
<!--<body>-->
    <div style="background-image: url('{{ asset('career/assets/image/tecture.png') }}');">
        <div class="container">
        <!-- Breadcrumb section start  -->
        <section>
            <div class="row">
                <div class="col-sm-5 mt--90 mb-4">
                    <h1 class="text-purple fw-bolder">Welcome to the Mindchain Consultant Program</h1>
                    <p class="text-purple">Unlock Your Earning Potential through Social Media</p>
                        <a href="#requirments"><button class="rounded-pill p-2 text-center" id="">Check Requirments <i class="fa-solid fa-arrow-down-long"></i></button></a>
    
                </div>
                <div class="col-sm-7">
                    <img class="img-fluid" src="{{asset('career/assets/image/consultent.png') }}" alt="">
                </div>
            </div>
        </section>
        <!-- Breadcrumb section end  -->

        <!-- requerments section start -->
        <section>
            <div class="mt--60" id="requirments">
                <div class="r-title text-center ">
                    <h1 class="text-purple">Why Choose Mindchain Consultant Program?</h1>
                    <p class="text-purple mb--40">Are you passionate about social media? Do you love connecting with people and sharing your ideas online? If so, the Mindchain Consultant Program is your gateway to turning your social media activities into a source of income.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb--20">
                        <div class="r-card primary-bg text-white">
                            <div class="img-card">
                                <img class="img-fluid" src="{{asset('career/assets/image/number-one.png') }}" alt="">
                            </div>
                            <div class="card-body text-left ">
                                <h4 class="card-title">Earn While You Post</h4>
                                <p class="card-text">
                                    Transform your everyday social media posts into a revenue stream. Share your thoughts, interests, and experiences, and get rewarded for it.
                                </p>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6 mb--20">
                          <div class="r-card primary-bg text-white">
                              <div class="img-card">
                                  <img class="img-fluid" src="{{asset('career/assets/image/number-two.png') }}" alt="">
                              </div>
                              <div class="card-body text-left">
                                  <h4 class="card-title">Flexible Schedule</h4>
                                  <p class="card-text">Work on your terms. There are no fixed hours or commitments. You decide when and how much you want to engage.
                                  </p>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-6 mb--20">
                            <div class="r-card primary-bg text-white">
                                <div class="img-card">
                                    <img class="img-fluid" src="{{asset('career/assets/image/number-three.png') }}" alt="">
                                </div>
                                <div class="card-body text-left">
                                    <h4 class="card-title">Unlimited Potential</h4>
                                    <p class="card-text mb-2">
                                        Your earnings are limited only by your creativity and engagement. The more you share, the more you can earn.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb--20">
                            <div class="r-card primary-bg text-white">
                                <div class="img-card">
                                      <img class="img-fluid" src="{{asset('career/assets/image/number-four.png') }}" alt="">
                                </div>
                                <div class="card-body text-left">
                                    <h4 class="card-title">Community and Support</h4>
                                    <p class="card-text ">Join a vibrant community of like-minded individuals. Get support, guidance, and tips from experienced Mindchain consultants.
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
         <!-- requerments section end -->

         <!-- facilities section start  -->
         <section>
            <div class="facilities mt--60 mb--120">
                <div class="r-title text-center">
                    <h1 class="text-purple">How Does It Work?</h1>
                    <p class="text-purple mb--40">While passion for Fuse Network is a given, we're particularly keen on individuals who:</p>
                </div>
                <div class="row text-center text-white">
                    <div class="col-sm-3 mb--20">
                        <div class="card primary-bg1 text-center">
                            <div class="icon mt--20  f-size-40">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <div class="text-center mt--20 my-4 mx-3 pb--45">
                              <h4 class="card-title mb-2 fw-bold">Sign Up</h4>
                              <p class="card-text mb-1">Register for the Mindchain Consultant Program with a few simple steps.</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-sm-3 mb--20">
                        <div class="card text-center primary-bg1">
                            <div class="icon mt--20  f-size-40">
                                <i class="fa-solid fa-link"></i>
                            </div>
                            <div class="text-center mt--20 my-4 mx-3 pb--45">
                              <h4 class="card-title mb-2 fw-bold">Connect Your Social Media</h4>
                              <p class="card-text mb-1">Link your social media profiles to our platform securely.</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-sm-3 mb--20">
                        <div class="card text-center primary-bg1">
                            <div class="icon mt--20  f-size-40">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                            <div class="text-center mt--20 my-4 mx-3">
                              <h4 class="card-title mb-2 fw-bold">Share and Earn</h4>
                              <p class="card-text mb-1">Start sharing posts, stories, or content related to Mindchain. Earn rewards for every engagement and referral you generate.</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-sm-3 mb--20">
                        <div class="card text-center primary-bg1">
                            <div class="icon mt--20  f-size-40">
                                <i class="fa-solid fa-money-check-dollar"></i>
                            </div>
                            <div class="text-center mt--20 my-4 mx-3 pb--50">
                              <h4 class="card-title mb-2 fw-bold">Get Paid</h4>
                              <p class="card-text ">Receive your earnings through a convenient payment method of your choice.</p>
                            </div>
                          </div>
                    </div>
                </div>
             </div>
         </section>
         <!-- facilities section end  -->

         <!-- consultent work start  -->
         <section>
            <div class="consultant mt--60 mb--120">
                <div class=" text-center">
                    <h1 class="text-purple">Choose Your Path: Junior or Senior Consultant</h1>
                    <p class="text-purple m-4 mb--40">At Mindchain, we value your commitment and experience. Our program offers two distinct consultant levels to match your skills and engagement. Whether you're starting fresh or bringing years of social media expertise, there's a path for you.</p>
                </div>
                <div class="row  text-white">
                    <div class="col-sm-6 mb--20">
                        <div class="card primary-bg1 ">
                            <div class="mt--20 my-4 mx-3">
                              <h4 class="card-title text-center mb-4 fw-bold">Junior Consultant</h4>
                              <p class="card-text m-2"><span>Starting Point: </span>Ideal for beginners looking to explore the world of social media monetization.</p>
                              <p class="card-text m-2"><span>Guidance: </span>Receive mentorship and guidance from experienced senior consultants.</p>
                              <p class="card-text m-2"><span>Earning Potential: </span>Build your presence and start earning from your posts.</p>
                              <p class="card-text m-2"><span>Progression: </span>Opportunity to advance to the Senior Consultant level as you gain experience.</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-sm-6 mb--20">
                        <div class="card primary-bg1">
                            <div class="mt--20 my-4 mx-3">
                              <h4 class="card-title text-center mb-4 fw-bold">Senior Consultant</h4>
                              <p class="card-text m-2"><span>Recognition: </span>Recognizes your expertise and influence in the social media space.</p>
                              <p class="card-text m-2"><span>Higher Earnings: </span>Unlock higher earning potential with your established follower base.</p>
                              <p class="card-text m-2"><span>Independence: </span>Work independently with the freedom to set your posting schedule.</p>
                              <p class="card-text m-2"><span>Leadership: </span>Mentor junior consultants and contribute to our community's growth.</p>
                            </div>
                          </div>
                    </div>
                </div>
             </div>
         </section>
         <!-- consultent work end -->

         <!-- call to action start-->
         <section>
            <div class="newsletter mb--60 primary-bg1">
                <div class="row">
                    <div class=" nl-title col-sm-7 ml mt-3">
                        <h2 class="text-purple">JOIN THE PROGRAM</h2>
                        <p class="text-purple">Empower Your Passion. Be the Change. Join the Mindchain Revolution!</p>
                    </div>
                    <div class="col-sm-5 ">
                        <button class="rounded-pill p-2" id="openButton">APPLY NOW <span> <i class="fa-solid fa-arrow-up-right-from-square px-1"></i></span></button>
                        <!-- The popup container -->
                        <div id="popup" class="popup">
                            <!-- Popup content -->
                            <div class="popup-content">
                                <span class="close fs-4" id="closeButton">&times;</span>
                                <!-- <h2>Popup Form</h2> -->
                                <iframe class="mt-4 col-sm-12" src="https://docs.google.com/forms/d/e/1FAIpQLSdlds0-RuUE1LtyWDyEzFIaBEazRxp2yMBa2hsV0ukeDfw49g/viewform?embedded=true" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </section>
         <!-- call to action start-->
    </div>
    <!-- social media section  -->
    <section class="join-cmnty pt4 pb-4">
        <div class="container-fluid">
            <div class="col-lg-12 ambassador-sec-4 text-center text-purple  pt-4">
                <h4 class="fw-bolder text-purple">Join Our Community</h4>
                <div class="col-lg-12 text-center p-3">
                    <a class="btn btn-primary m-2" style="background-color: #3b5998;" href="https://www.facebook.com/mindchain.info" role="button"><i class="fab fa-facebook-f me-2"></i>Facebook</a>
                    <a class="btn btn-primary m-2" style="background-color: #55acee;" href="https://twitter.com/MindChain1" role="button"><i class="fab fa-twitter me-2"></i>Twitter</a>
                    <a class="btn btn-primary m-2" style="background-color: #ed302f; " href="https://www.youtube.com/channel/UCogQYyfu7ista6L1X8SQluw" role="button"><i class="fab fa-youtube me-2"></i>YouTube</a>
                    <a class="btn btn-primary m-2" style="background-color: #28A8E9" href="https://t.me/mindchainMIND" role="button"><i class="fa-brands fa-telegram me-2"></i>Telegram</a>
                    <a class="btn btn-primary m-2" style="background-color: #111111;" href="https://medium.com/@mindchain" role="button"><i class="fa-brands fa-medium me-2"></i>Medium</a>
                    <a class="btn btn-primary m-2" style="background-color: #5562EA;" href="https://discord.com/channels/910149384858136587/910149385302720513" role="button"><i class="fa-brands fa-discord me-2"></i>Discord</a>
                    <a class="btn btn-primary m-2" style="background-color: #FF4705;" href="https://www.reddit.com/user/Mindchainswap" role="button"><i class="fa-brands fa-reddit-alien me-2"></i>Reddit</a>
                </div>
            </div>
        </div>
    </section>
    </div>

@push('scripts')
    <script>
        // Get references to the popup and buttons
        var popup = document.getElementById("popup");
        var openButton = document.getElementById("openButton");
        var closeButton = document.getElementById("closeButton");
        function openPopup() {
            popup.style.display = "block";
        }
        function closePopup() {
            popup.style.display = "none";
        }
        openButton.addEventListener("click", openPopup);
        closeButton.addEventListener("click", closePopup);
    </script>

@endpush
@endsection
<!--</body>-->
<!--</html>-->

