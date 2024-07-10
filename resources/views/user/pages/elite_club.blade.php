@extends('user.layouts.master')


@section('user_content')
    <?php
    use App\Models\User;
    $user = User::where('id', Auth::id())->first();
    //dd($user);
    ?>
    <<div class="section-admin container-fluid">
        <div class="row admin ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="admin-content res-mg-t-15 d-flex row justify-content-between">
                    <!-- Elite Club section
                        ============================================  -->
                    <div class="elite-club-section">
                        <div class="elite-header mg-b-30">
                            <div class="elite-header-inner">
                                <h3 class="text-center">ELITE CLUB</h3>
                            </div>
                        </div>


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

                        <div class="section-title text-center mg-t-30 mg-b-30">
                            <h3>Why Become Elite Member!</h3>
                            <p>Elevate Your Blockchain Experience: Join the Mindchain Elite Club!</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 mg-t-30">
                                <div class="elite-content-card-img">
                                    <div class="elite-content-card-inner">
                                        <img class="elite-icon img-fluid"
                                            src="{{ asset('assetsnew/img/background/elite-club.png') }}" alt="">
                                        <img class="inner-image"
                                            src="{{ asset('assetsnew/img/background/transparent-inner-image.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 mg-t-30">
                                <div class="elite-content-card">
                                    <div class="elite-content-card-content">
                                        <p class="mg-b-30 welcome-content">Welcome to the future of blockchain technology
                                            with Mindchain! Our Elite Club is your exclusive gateway to unlocking the full
                                            potential of the next generation blockchain platform. When you become a member,
                                            you'll gain access to a world of cutting-edge benefits and privileges,
                                            including:</p>
                                        <div class="bullet-point-sec">
                                            <div class="bullet-point-list">
                                                <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                        fill="white" />
                                                </svg>
                                                <p class="mg-t-30 bullet-point">
                                                    <b>Early Access:</b>
                                                    Be the first to explore and utilize Mindchain's groundbreaking
                                                    blockchain innovations
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                        fill="white" />
                                                </svg>
                                                <p class="bullet-point">
                                                    <b>Early Access:</b>
                                                    Stay ahead of the curve with exclusive updates, news, and industry
                                                    trends.
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                        fill="white" />
                                                </svg>
                                                <p class="bullet-point">
                                                    <b>Premium Support:</b>
                                                    Enjoy priority assistance from our dedicated Elite support team.
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                        fill="white" />
                                                </svg>
                                                <p class="bullet-point">
                                                    <b>Networking Opportunities:</b>
                                                    Connect with like-minded blockchain enthusiasts and industry leaders.
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                        fill="white" />
                                                </svg>
                                                <p class="bullet-point">
                                                    <b>Exclusive Events:</b>
                                                    Gain entry to Elite-only webinars, seminars, and conferences.
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                        fill="white" />
                                                </svg>
                                                <p class="bullet-point">
                                                    <b>Customized Solutions:</b>
                                                    Access tailored blockchain solutions to meet your unique needs.
                                                </p>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="section-title text-center mg-t-30 mg-b-30">
                            <h3>Facilities of Elite Member</h3>
                            <p style="width: 50%; margin: auto;">You will earn exclusive access, discounts gifts, and other
                                rewards as you help us encourage the worldwide Mindchain community.</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 mg-t-30">
                                <div class="elite-content-card elite-content-card2">
                                    <div class="elite-content-card-content">

                                        <div class="bullet-point-sec">
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="mg-t-30 bullet-point">
                                                    1st year will get profit as 20% APY
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="bullet-point">
                                                    After 1st year Mindchain will transfer to CEX and get staking there (as
                                                    new APY)
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="18" height="18" viewBox="0 0 23 23" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="bullet-point">
                                                    After 1st year Mindchain will transfer to CEX and get staking there (as
                                                    new APY)
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="18" height="18" viewBox="0 0 23 23"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="bullet-point">
                                                    Income from APY can be withdrawn in USDT at any time
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="18" height="18" viewBox="0 0 23 23"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="bullet-point">
                                                    Copy trade will get the opportunity to participate in ongoing trades
                                                    with the best possible traders.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 mg-t-30">
                                <div class="elite-content-card  elite-content-card2">
                                    <div class="elite-content-card-content  mg-b-30">
                                        <div class="bullet-point-sec">
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="18" height="18" viewBox="0 0 23 23"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="mg-t-30 bullet-point">
                                                    Balance transfer to Mindchain CEX After that, you can withdraw the main
                                                    balance if you want. In that case minimum 365 more days after staking.
                                                    After withdrawing the main balance the withdrawer will be deactivated
                                                    from Elite Member. (Will be deprived of all benefits of Elite Member).
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="18" height="18" viewBox="0 0 23 23"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 20C16.5547 20 20.25 16.3047 20.25 11.75C20.25 7.19531 16.5547 3.5 12 3.5C7.44531 3.5 3.75 7.19531 3.75 11.75C3.75 11.9219 3.75 12.0938 3.75 12.2656L1.04297 13.082C1 12.6523 1 12.2227 1 11.75C1 5.69141 5.89844 0.75 12 0.75C18.0586 0.75 23 5.69141 23 11.75C23 17.8516 18.0586 22.75 12 22.75C11.5273 22.75 11.0977 22.75 10.668 22.707L11.4844 20C11.6562 20 11.8281 20 12 20ZM12.0859 17.9375L12.9453 15.0586C14.3633 14.6719 15.4375 13.3398 15.4375 11.793C15.4375 9.85938 13.8906 8.35547 12 8.35547C10.4102 8.35547 9.07812 9.38672 8.69141 10.8477L5.8125 11.6641C5.85547 8.3125 8.60547 5.5625 12 5.5625C15.3945 5.5625 18.1875 8.35547 18.1875 11.75C18.1875 15.1445 15.4375 17.8945 12.0859 17.9375ZM2.67578 14.0273L11.4414 11.4492C11.957 11.2773 12.4727 11.75 12.3008 12.3086L9.72266 21.0742C9.55078 21.6758 8.73438 21.7617 8.43359 21.2031L7.23047 18.7539C7.1875 18.668 7.14453 18.625 7.10156 18.582L3.32031 22.3633C2.80469 22.9219 1.90234 22.9219 1.38672 22.3633C0.828125 21.8477 0.828125 20.9453 1.38672 20.4297L5.16797 16.6484C5.125 16.6055 5.08203 16.5625 4.99609 16.5195L2.54688 15.3164C1.98828 15.0156 2.07422 14.1992 2.67578 14.0273Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="bullet-point">
                                                    Mindchain will receive signals and timings for traders from CEX's MM
                                                    team. (In that case, according to the condition, staking should be done
                                                    for a minimum 5 years to get the signal)
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="section-title text-center mg-t-30 mg-b-30">
                            <h3>How to Become Elite Club Member</h3>
                            <p style="width: 90%; margin: auto;">Joining the Mindchain Elite Club means becoming part of a
                                community that is shaping the future of blockchain technology. Don't miss your chance to be
                                at the forefront of innovation. Apply for Elite membership now and experience blockchain
                                like never before!</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mg-t-30 mg-b-30">
                                <div class="elite-content-card elite-content-card3">
                                    <div class="elite-content-card-content text-center mg-b-30">
                                        @if($user->elite_club == 0)
                                        <button class="elite-btn" type="button" data-toggle="modal"
                                            data-target="#depositusd" data-whatever="" class="page-button">Deposit Now
                                        </button>
                                        @else
                                        <button class="elite-btn" type="button">Already joined </button>
                                        @endif

                                        <p class="mem-join-sec" >Deposit <del class="text-danger"><i>$1500</i></del> $1250 to become a Elite Club Member</p>
                                    </div>
                                    @include('user.modals.depositusdt')
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mg-t-30">
                                <div class="">
                                    <div class="elite-content-card-content ">
                                        <svg class="right-arrow" style="width: 90px!important;" width="117"
                                            height="60" viewBox="0 0 117 60" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M115.828 32.8284C117.391 31.2663 117.391 28.7337 115.828 27.1716L90.3726 1.71573C88.8105 0.153631 86.2778 0.153631 84.7157 1.71573C83.1536 3.27783 83.1536 5.81049 84.7157 7.37258L107.343 30L84.7157 52.6274C83.1536 54.1895 83.1536 56.7222 84.7157 58.2843C86.2778 59.8464 88.8105 59.8464 90.3726 58.2843L115.828 32.8284ZM0 34H113V26H0V34Z"
                                                fill="white" />
                                        </svg>


                                        <svg class="down-arrow" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            x="0px" y="0px" viewBox="0 0 62.1 118.8"
                                            style="enable-background:new 0 0 62.1 118.8;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0 {
                                                    fill: #FFFFFF;
                                                }
                                            </style>
                                            <path class="st0"
                                                d="M28.47,116.55c1.56,1.56,4.09,1.56,5.66,0l25.46-25.46c1.56-1.56,1.56-4.09,0-5.66c-1.56-1.56-4.09-1.56-5.66,0 L31.3,108.06L8.67,85.44c-1.56-1.56-4.09-1.56-5.66,0c-1.56,1.56-1.56,4.09,0,5.66L28.47,116.55z M27.3,0.72v113h8v-113H27.3z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mg-t-30 mg-b-30">
                                <div class="elite-content-card elite-content-card3">
                                    <div class="elite-content-card-content text-center mg-b-30">
                                        @if($user->elite_club == 0)
                                        <button class="elite-btn" type="button" data-toggle="modal"
                                            data-target="#joinEliteClub" data-whatever="" class="page-button">Join Elite
                                            Club
                                        </button>
                                        @else
                                        <button class="elite-btn" type="button">Already joined </button>
                                        @endif
                                        <div class="modal withdraw-modal fade text-left" id="joinEliteClub"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Join Elite Club Member</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body ">

                                                        <form method="post" action="{{ route('join-elite') }}">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::user()->id }}">
                                                            <div class="form-group">
                                                                <label for="membershipFee"
                                                                    class="col-form-label">Membership Fee</label>
                                                                <input type="text" class="form-control"
                                                                    id="membershipFee" disabled value="1250"
                                                                    name="mem_fee">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="usdt-Aval-bal" class="col-form-label">USD
                                                                    Available Balance</label>
                                                                <input type="text" name="avl_balance" disabled
                                                                    id="wallet_id" value="{{ $data['sum_usdwallet'] }}"
                                                                    class="form-control"required />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="mem-join-sec mg-b-30">USD Balance: {{ $data['sum_usdwallet'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="section-title text-center mg-t-30 mg-b-30">
                            <h3>Terms and Conditions</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 mg-t-30">
                                <div class="elite-content-card-img">
                                    <div class="elite-content-card-inner">
                                        <img class="elite-icon img-fluid trams"
                                            src="{{ asset('assetsnew/img/background/trams-and-condition.png') }}"
                                            alt="">
                                        <!-- <img class="trams-inner" src="{{ asset('assetsnew/img/background/transparent-inner-image.png') }}" alt=""> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 mg-t-30">
                                <div class="elite-content-card elite-content-card4">
                                    <div class="elite-content-card-content">
                                        <div class="bullet-point-sec">
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="19" height="18" viewBox="0 0 24 23"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M18.6172 10.6758L17.6289 11.6641L9.07812 20.2148C8.64844 20.6875 8.08984 20.9883 7.48828 21.2031L2.28906 22.707C1.94531 22.793 1.55859 22.707 1.30078 22.4492C1 22.1914 0.914062 21.8047 1.04297 21.418L2.54688 16.2617C2.71875 15.6602 3.0625 15.1016 3.49219 14.6289L12.043 6.07812L13.0312 5.13281L13.5039 4.61719L14.9648 6.07812L17.6289 8.74219L19.0898 10.2031L18.6172 10.6758ZM7.875 17.9375H6.5C6.11328 17.9375 5.8125 17.6367 5.8125 17.25V15.875L4.82422 16.2617C4.69531 16.4336 4.56641 16.6055 4.52344 16.8203L3.53516 20.1719L6.88672 19.1836C7.10156 19.1406 7.27344 19.0547 7.44531 18.9258L7.875 17.9375ZM16.5547 1.56641C17.6289 0.492188 19.3906 0.492188 20.4648 1.56641L22.1406 3.28516C23.2148 4.35938 23.2148 6.07812 22.1406 7.15234L21.5391 7.79688L20.5508 8.74219L20.0781 9.21484L18.6172 7.79688L15.9531 5.08984L14.4922 3.67188L14.9648 3.15625L15.9531 2.21094L16.5547 1.56641ZM14.5352 8.78516C14.793 8.52734 14.793 8.09766 14.5352 7.83984C14.2773 7.53906 13.8047 7.53906 13.5469 7.83984L7.35938 14.0273C7.10156 14.2852 7.10156 14.7148 7.35938 14.9727C7.61719 15.2305 8.08984 15.2305 8.34766 14.9727L14.5352 8.78516Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="mg-t-30 bullet-point">
                                                    <b>Eligibility:</b>
                                                    To become a Mindchain Elite Club member, you must be at least 18 years
                                                    old. Membership eligibility may be subject to additional criteria set by
                                                    Mindchain.
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="19" height="18" viewBox="0 0 24 23"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M18.6172 10.6758L17.6289 11.6641L9.07812 20.2148C8.64844 20.6875 8.08984 20.9883 7.48828 21.2031L2.28906 22.707C1.94531 22.793 1.55859 22.707 1.30078 22.4492C1 22.1914 0.914062 21.8047 1.04297 21.418L2.54688 16.2617C2.71875 15.6602 3.0625 15.1016 3.49219 14.6289L12.043 6.07812L13.0312 5.13281L13.5039 4.61719L14.9648 6.07812L17.6289 8.74219L19.0898 10.2031L18.6172 10.6758ZM7.875 17.9375H6.5C6.11328 17.9375 5.8125 17.6367 5.8125 17.25V15.875L4.82422 16.2617C4.69531 16.4336 4.56641 16.6055 4.52344 16.8203L3.53516 20.1719L6.88672 19.1836C7.10156 19.1406 7.27344 19.0547 7.44531 18.9258L7.875 17.9375ZM16.5547 1.56641C17.6289 0.492188 19.3906 0.492188 20.4648 1.56641L22.1406 3.28516C23.2148 4.35938 23.2148 6.07812 22.1406 7.15234L21.5391 7.79688L20.5508 8.74219L20.0781 9.21484L18.6172 7.79688L15.9531 5.08984L14.4922 3.67188L14.9648 3.15625L15.9531 2.21094L16.5547 1.56641ZM14.5352 8.78516C14.793 8.52734 14.793 8.09766 14.5352 7.83984C14.2773 7.53906 13.8047 7.53906 13.5469 7.83984L7.35938 14.0273C7.10156 14.2852 7.10156 14.7148 7.35938 14.9727C7.61719 15.2305 8.08984 15.2305 8.34766 14.9727L14.5352 8.78516Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="mg-t-30 bullet-point">
                                                    <b> Application Process:</b>
                                                    Interested individuals can apply for Elite Club membership through the
                                                    official Mindchain website or designated channels. Mindchain reserves
                                                    the right to approve or reject membership applications at its
                                                    discretion.
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="19" height="18" viewBox="0 0 24 23"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M18.6172 10.6758L17.6289 11.6641L9.07812 20.2148C8.64844 20.6875 8.08984 20.9883 7.48828 21.2031L2.28906 22.707C1.94531 22.793 1.55859 22.707 1.30078 22.4492C1 22.1914 0.914062 21.8047 1.04297 21.418L2.54688 16.2617C2.71875 15.6602 3.0625 15.1016 3.49219 14.6289L12.043 6.07812L13.0312 5.13281L13.5039 4.61719L14.9648 6.07812L17.6289 8.74219L19.0898 10.2031L18.6172 10.6758ZM7.875 17.9375H6.5C6.11328 17.9375 5.8125 17.6367 5.8125 17.25V15.875L4.82422 16.2617C4.69531 16.4336 4.56641 16.6055 4.52344 16.8203L3.53516 20.1719L6.88672 19.1836C7.10156 19.1406 7.27344 19.0547 7.44531 18.9258L7.875 17.9375ZM16.5547 1.56641C17.6289 0.492188 19.3906 0.492188 20.4648 1.56641L22.1406 3.28516C23.2148 4.35938 23.2148 6.07812 22.1406 7.15234L21.5391 7.79688L20.5508 8.74219L20.0781 9.21484L18.6172 7.79688L15.9531 5.08984L14.4922 3.67188L14.9648 3.15625L15.9531 2.21094L16.5547 1.56641ZM14.5352 8.78516C14.793 8.52734 14.793 8.09766 14.5352 7.83984C14.2773 7.53906 13.8047 7.53906 13.5469 7.83984L7.35938 14.0273C7.10156 14.2852 7.10156 14.7148 7.35938 14.9727C7.61719 15.2305 8.08984 15.2305 8.34766 14.9727L14.5352 8.78516Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="mg-t-30 bullet-point">
                                                    <b>Membership Fees: </b>
                                                    Membership fees, if applicable, will be clearly outlined during the
                                                    application process. Fees are non-refundable, and members are
                                                    responsible for any associated charges.
                                                </p>
                                            </div>
                                            <div class="bullet-point-list">
                                                <div>
                                                    <svg width="19" height="18" viewBox="0 0 24 23"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M18.6172 10.6758L17.6289 11.6641L9.07812 20.2148C8.64844 20.6875 8.08984 20.9883 7.48828 21.2031L2.28906 22.707C1.94531 22.793 1.55859 22.707 1.30078 22.4492C1 22.1914 0.914062 21.8047 1.04297 21.418L2.54688 16.2617C2.71875 15.6602 3.0625 15.1016 3.49219 14.6289L12.043 6.07812L13.0312 5.13281L13.5039 4.61719L14.9648 6.07812L17.6289 8.74219L19.0898 10.2031L18.6172 10.6758ZM7.875 17.9375H6.5C6.11328 17.9375 5.8125 17.6367 5.8125 17.25V15.875L4.82422 16.2617C4.69531 16.4336 4.56641 16.6055 4.52344 16.8203L3.53516 20.1719L6.88672 19.1836C7.10156 19.1406 7.27344 19.0547 7.44531 18.9258L7.875 17.9375ZM16.5547 1.56641C17.6289 0.492188 19.3906 0.492188 20.4648 1.56641L22.1406 3.28516C23.2148 4.35938 23.2148 6.07812 22.1406 7.15234L21.5391 7.79688L20.5508 8.74219L20.0781 9.21484L18.6172 7.79688L15.9531 5.08984L14.4922 3.67188L14.9648 3.15625L15.9531 2.21094L16.5547 1.56641ZM14.5352 8.78516C14.793 8.52734 14.793 8.09766 14.5352 7.83984C14.2773 7.53906 13.8047 7.53906 13.5469 7.83984L7.35938 14.0273C7.10156 14.2852 7.10156 14.7148 7.35938 14.9727C7.61719 15.2305 8.08984 15.2305 8.34766 14.9727L14.5352 8.78516Z"
                                                            fill="white" />
                                                    </svg>
                                                </div>
                                                <p class="mg-t-30 bullet-point">
                                                    <b>Membership Duration:</b>
                                                    Membership duration will be specified upon acceptance into the Elite
                                                    Club. Mindchain may offer different membership terms, including annual,
                                                    biennial, or other options.
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-title text-center mg-t-30 mg-b-30">
                            <h3>Join Our Community</h3>
                        </div>
                        <div class="social-icons mg-b-30">
                            <ul>
                                <li><a href="https://www.facebook.com/mindchain.info"><i class="fab fa-facebook"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com/MindChain1"><i class="fab fa-twitter"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCogQYyfu7ista6L1X8SQluw"><i
                                            class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                <li><a href="https://t.me/mindchainMIND"><i class="fab fa-telegram-plane"
                                            aria-hidden="true"></i></a></li>

                                <li><a href="https://discord.com/channels/910149384858136587/910149385302720513"><i
                                            class="fab fa-discord" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.reddit.com/user/Mindchainswap"><i class="fab fa-reddit-alien"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="https://medium.com/@mindchain"><i class="fab fa-medium-m"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>

                    </div>

                    <!-- Elite Club End section
                        ============================================  -->
                </div>
            </div>
        </div>
        </div>
    @endsection
