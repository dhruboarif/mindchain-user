<!-- left sidebar start
  ============================================ -->
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="{{ route('home') }}"><img src="{{ asset('assetsnew/img/logo/logo.png') }}" alt=""
                    class="main-logo img-fluid" /></a>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    <li class="active click-active">
                        <a class="" href="{{ route('home') }}"><svg class="icon-wrap" width="20"
                                height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.5 1.1875C9.78125 0.96875 10.1875 0.96875 10.4688 1.1875L18.7188 8.1875C19.0312 8.46875 19.0938 8.9375 18.8125 9.25C18.5312 9.5625 18.0625 9.59375 17.75 9.34375L17 8.6875V14.5C17 15.9062 15.875 17 14.5 17H5.5C4.09375 17 3 15.9062 3 14.5V8.6875L2.21875 9.34375C1.90625 9.59375 1.4375 9.5625 1.15625 9.25C0.90625 8.9375 0.9375 8.46875 1.25 8.1875L9.5 1.1875ZM10 2.75L4.5 7.40625V14.5C4.5 15.0625 4.9375 15.5 5.5 15.5H14.5C15.0312 15.5 15.5 15.0625 15.5 14.5V7.40625L10 2.75ZM9 10H11V8H9V10ZM7.5 7.75C7.5 7.0625 8.03125 6.5 8.75 6.5H11.25C11.9375 6.5 12.5 7.0625 12.5 7.75V10.25C12.5 10.9688 11.9375 11.5 11.25 11.5H8.75C8.03125 11.5 7.5 10.9688 7.5 10.25V7.75Z"
                                    fill="white" />
                            </svg>
                            <span class="mini-click-non sidebar-title text-capitalize">Dashboard</span>
                        </a>
                    </li>
                    <li class="click-active">
                        <a class="" href="/home/elite_club/{{Auth::user()->id}}" aria-expanded="false"><svg class="icon-wrap" width="22"
                                height="22" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.65625 2.3125L9.8125 2.6875L11.4375 5.90625C11.7188 6.46875 12.4688 6.625 12.9688 6.25L15.2188 4.4375L15.75 4C15.5938 3.8125 15.5 3.53125 15.5 3.25C15.5 2.5625 16.0625 2 16.75 2C17.4375 2 18 2.5625 18 3.25C18 3.96875 17.4375 4.5 16.75 4.5C16.7188 4.5 16.7188 4.5 16.7188 4.5L16.5938 5.25L15.2812 12.375C15.125 13.3125 14.2812 14 13.3125 14H4.65625C3.6875 14 2.84375 13.3125 2.6875 12.375L1.40625 5.25L1.25 4.5C0.53125 4.5 0 3.96875 0 3.25C0 2.5625 0.53125 2 1.25 2C1.9375 2 2.5 2.5625 2.5 3.25C2.5 3.53125 2.40625 3.8125 2.25 4L2.78125 4.4375L5.03125 6.25C5.53125 6.625 6.25 6.46875 6.53125 5.90625L8.15625 2.6875L8.34375 2.3125C7.96875 2.09375 7.75 1.71875 7.75 1.25C7.75 0.5625 8.28125 0 9 0C9.6875 0 10.25 0.5625 10.25 1.25C10.25 1.71875 10 2.09375 9.65625 2.3125ZM4.15625 12.0938C4.21875 12.3438 4.40625 12.5 4.65625 12.5H13.3125C13.5625 12.5 13.75 12.3438 13.8125 12.0938L14.7812 6.6875L13.875 7.40625C12.6562 8.40625 10.8125 8 10.0938 6.5625L9 4.375L7.875 6.5625C7.15625 8 5.3125 8.40625 4.09375 7.40625L3.1875 6.6875L4.15625 12.0938Z"
                                    fill="#B4B4B4" />
                            </svg>
                            <span class="mini-click-non sidebar-title text-capitalize">Elit Member</span></a>
                    </li>
                    <li class="click-active">
                        <a class="has-arrow" href="#" aria-expanded="false"> <svg class="icon-wrap" width="22"
                                height="22" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 1.75V3H10.5V1.75C10.5 1.625 10.375 1.5 10.25 1.5H5.75C5.59375 1.5 5.5 1.625 5.5 1.75ZM4 3V1.75C4 0.8125 4.78125 0 5.75 0H10.25C11.1875 0 12 0.8125 12 1.75V3H14C15.0938 3 16 3.90625 16 5V6.03125C15.8125 6.03125 15.6562 6 15.5 6C15.1562 6 14.8125 6.03125 14.5 6.09375V5C14.5 4.75 14.25 4.5 14 4.5H11.25H4.75H2C1.71875 4.5 1.5 4.75 1.5 5V8H6H11H11.25C10.5625 8.84375 10.125 9.875 10 11H7C6.4375 11 6 10.5625 6 10V9.5H1.5V13C1.5 13.2812 1.71875 13.5 2 13.5H10.375C10.5625 14.0625 10.875 14.5625 11.25 15H2C0.875 15 0 14.125 0 13V8.75V5C0 3.90625 0.875 3 2 3H4ZM11 11.5C11 9.90625 11.8438 8.4375 13.25 7.625C14.625 6.8125 16.3438 6.8125 17.75 7.625C19.125 8.4375 20 9.90625 20 11.5C20 13.125 19.125 14.5938 17.75 15.4062C16.3438 16.2188 14.625 16.2188 13.25 15.4062C11.8438 14.5938 11 13.125 11 11.5ZM15.5 9C15.2188 9 15 9.25 15 9.5V11.5C15 11.7812 15.2188 12 15.5 12H17C17.25 12 17.5 11.7812 17.5 11.5C17.5 11.25 17.25 11 17 11H16V9.5C16 9.25 15.75 9 15.5 9Z"
                                    fill="#B4B4B4" />
                            </svg>
                            <span class="mini-click-non text-capitalize sidebar-title">community Token</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="" href="/home/buy-bmind/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Buy Bmind</span></a></li>
                            <li><a title="" href="/home/bmind-staking-history/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Bmind Staking History</span></a></li>
                            <li><a title=""
                                    href="/home/bmind-sponsor-bonus-history/{{ Auth::user()->id }}{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Bmind Sponsor Bonus History</span></a></li>
                            <li><a title=""
                                    href="/home/bmind-daily-bonus-history/{{ Auth::user()->id }}{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Bmind Daily Bonus History</span></a></li>
                            <li><a title=""
                                    href="/home/bmind-level-bonus-history/{{ Auth::user()->id }}{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Bmind Level Bonus History</span></a></li>

                        </ul>
                    </li>


                    <li class="click-active">
                        <a class="has-arrow" href="#" aria-expanded="false"> <svg class="icon-wrap" width="22"
                                height="22" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 1.75V3H10.5V1.75C10.5 1.625 10.375 1.5 10.25 1.5H5.75C5.59375 1.5 5.5 1.625 5.5 1.75ZM4 3V1.75C4 0.8125 4.78125 0 5.75 0H10.25C11.1875 0 12 0.8125 12 1.75V3H14C15.0938 3 16 3.90625 16 5V6.03125C15.8125 6.03125 15.6562 6 15.5 6C15.1562 6 14.8125 6.03125 14.5 6.09375V5C14.5 4.75 14.25 4.5 14 4.5H11.25H4.75H2C1.71875 4.5 1.5 4.75 1.5 5V8H6H11H11.25C10.5625 8.84375 10.125 9.875 10 11H7C6.4375 11 6 10.5625 6 10V9.5H1.5V13C1.5 13.2812 1.71875 13.5 2 13.5H10.375C10.5625 14.0625 10.875 14.5625 11.25 15H2C0.875 15 0 14.125 0 13V8.75V5C0 3.90625 0.875 3 2 3H4ZM11 11.5C11 9.90625 11.8438 8.4375 13.25 7.625C14.625 6.8125 16.3438 6.8125 17.75 7.625C19.125 8.4375 20 9.90625 20 11.5C20 13.125 19.125 14.5938 17.75 15.4062C16.3438 16.2188 14.625 16.2188 13.25 15.4062C11.8438 14.5938 11 13.125 11 11.5ZM15.5 9C15.2188 9 15 9.25 15 9.5V11.5C15 11.7812 15.2188 12 15.5 12H17C17.25 12 17.5 11.7812 17.5 11.5C17.5 11.25 17.25 11 17 11H16V9.5C16 9.25 15.75 9 15.5 9Z"
                                    fill="#B4B4B4" />
                            </svg>
                            <span class="mini-click-non text-capitalize sidebar-title">Farming</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="" href="/home/buy_package/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Buy Farming</span></a></li>
                            <li><a title="" href="/home/my_asset/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">My Assets</span></a></li>

                        </ul>
                    </li>


                    <li class="click-active">
                        <a class="has-arrow" href="#" aria-expanded="false"> <svg class="icon-wrap" width="22"
                                height="22" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 1.75V3H10.5V1.75C10.5 1.625 10.375 1.5 10.25 1.5H5.75C5.59375 1.5 5.5 1.625 5.5 1.75ZM4 3V1.75C4 0.8125 4.78125 0 5.75 0H10.25C11.1875 0 12 0.8125 12 1.75V3H14C15.0938 3 16 3.90625 16 5V6.03125C15.8125 6.03125 15.6562 6 15.5 6C15.1562 6 14.8125 6.03125 14.5 6.09375V5C14.5 4.75 14.25 4.5 14 4.5H11.25H4.75H2C1.71875 4.5 1.5 4.75 1.5 5V8H6H11H11.25C10.5625 8.84375 10.125 9.875 10 11H7C6.4375 11 6 10.5625 6 10V9.5H1.5V13C1.5 13.2812 1.71875 13.5 2 13.5H10.375C10.5625 14.0625 10.875 14.5625 11.25 15H2C0.875 15 0 14.125 0 13V8.75V5C0 3.90625 0.875 3 2 3H4ZM11 11.5C11 9.90625 11.8438 8.4375 13.25 7.625C14.625 6.8125 16.3438 6.8125 17.75 7.625C19.125 8.4375 20 9.90625 20 11.5C20 13.125 19.125 14.5938 17.75 15.4062C16.3438 16.2188 14.625 16.2188 13.25 15.4062C11.8438 14.5938 11 13.125 11 11.5ZM15.5 9C15.2188 9 15 9.25 15 9.5V11.5C15 11.7812 15.2188 12 15.5 12H17C17.25 12 17.5 11.7812 17.5 11.5C17.5 11.25 17.25 11 17 11H16V9.5C16 9.25 15.75 9 15.5 9Z"
                                    fill="#B4B4B4" />
                            </svg>
                            <span class="mini-click-non text-capitalize sidebar-title">Earn Mind</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="" href="/home/buy_staking/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Mind Staking</span></a></li>
                            <li><a title="" href="/home/staking-history/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Mind Staking History</span></a></li>


                        </ul>
                    </li>


                    <li class="click-active">
                        <a class="has-arrow" href="#" aria-expanded="false"> <svg class="icon-wrap"
                                width="22" height="22" viewBox="0 0 20 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 1.75V3H10.5V1.75C10.5 1.625 10.375 1.5 10.25 1.5H5.75C5.59375 1.5 5.5 1.625 5.5 1.75ZM4 3V1.75C4 0.8125 4.78125 0 5.75 0H10.25C11.1875 0 12 0.8125 12 1.75V3H14C15.0938 3 16 3.90625 16 5V6.03125C15.8125 6.03125 15.6562 6 15.5 6C15.1562 6 14.8125 6.03125 14.5 6.09375V5C14.5 4.75 14.25 4.5 14 4.5H11.25H4.75H2C1.71875 4.5 1.5 4.75 1.5 5V8H6H11H11.25C10.5625 8.84375 10.125 9.875 10 11H7C6.4375 11 6 10.5625 6 10V9.5H1.5V13C1.5 13.2812 1.71875 13.5 2 13.5H10.375C10.5625 14.0625 10.875 14.5625 11.25 15H2C0.875 15 0 14.125 0 13V8.75V5C0 3.90625 0.875 3 2 3H4ZM11 11.5C11 9.90625 11.8438 8.4375 13.25 7.625C14.625 6.8125 16.3438 6.8125 17.75 7.625C19.125 8.4375 20 9.90625 20 11.5C20 13.125 19.125 14.5938 17.75 15.4062C16.3438 16.2188 14.625 16.2188 13.25 15.4062C11.8438 14.5938 11 13.125 11 11.5ZM15.5 9C15.2188 9 15 9.25 15 9.5V11.5C15 11.7812 15.2188 12 15.5 12H17C17.25 12 17.5 11.7812 17.5 11.5C17.5 11.25 17.25 11 17 11H16V9.5C16 9.25 15.75 9 15.5 9Z"
                                    fill="#B4B4B4" />
                            </svg>
                            <span class="mini-click-non text-capitalize sidebar-title">Earn MUSD</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title=""
                                    href="/home/buy_mstaking/{{ Auth::user()->id }}{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">MUSD Staking</span></a></li>
                            <li><a title="" href="/home/mstaking-history/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">MUSD Staking History</span></a></li>


                        </ul>
                    </li>


                    <li class="click-active">
                        <a class="" href="/home/become-merchant/{{Auth::user()->id}}" aria-expanded="false">
                            <svg class="icon-wrap" width="20" height="20" viewBox="0 0 20 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.0312 2.71875L12.6875 2.9375C12.9688 2.96875 13.0938 3.34375 12.875 3.5625L11.6875 4.6875L11.9688 6.34375C12 6.625 11.7188 6.84375 11.4375 6.71875L10 5.9375L8.53125 6.71875C8.25 6.84375 7.9375 6.625 8 6.34375L8.28125 4.71875L7.09375 3.5625C6.875 3.34375 7 3 7.28125 2.9375L8.9375 2.71875L9.65625 1.21875C9.8125 0.9375 10.1875 0.9375 10.3125 1.21875L11.0312 2.71875ZM8.5 10.5V15.5H11.5V10.5H8.5ZM7 10.5C7 9.6875 7.65625 9 8.5 9H11.5C12.3125 9 13 9.6875 13 10.5V15.5C13 16.3438 12.3125 17 11.5 17H8.5C7.65625 17 7 16.3438 7 15.5V10.5ZM1.5 12.5V15.5H4.5V12.5H1.5ZM0 12.5C0 11.6875 0.65625 11 1.5 11H4.5C5.3125 11 6 11.6875 6 12.5V15.5C6 16.3438 5.3125 17 4.5 17H1.5C0.65625 17 0 16.3438 0 15.5V12.5ZM18.5 13.5H15.5V15.5H18.5V13.5ZM15.5 12H18.5C19.3125 12 20 12.6875 20 13.5V15.5C20 16.3438 19.3125 17 18.5 17H15.5C14.6562 17 14 16.3438 14 15.5V13.5C14 12.6875 14.6562 12 15.5 12Z"
                                    fill="#B4B4B4" />
                            </svg>

                            <span class="mini-click-non sidebar-titel text-capitalize">become a marchent</span></a>
                    </li>
                    <li class="click-active">
                        <a class="" href="#" aria-expanded="false"><svg class="icon-wrap"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_5596_76)">
                                    <path
                                        d="M2.10936 1.1172C1.96874 1.14454 1.68749 1.25392 1.48436 1.35157C1.18358 1.50001 1.05467 1.59376 0.796862 1.85548C0.531237 2.1172 0.445299 2.23829 0.300768 2.54298C-0.0195446 3.20313 -1.33839e-05 2.69923 -1.33839e-05 10C-1.33839e-05 17.3008 -0.0195446 16.7969 0.300768 17.457C0.445299 17.7617 0.531237 17.8828 0.796862 18.1445C1.05467 18.4063 1.18358 18.5 1.48436 18.6484C2.1328 18.9649 1.48436 18.9453 9.99999 18.9453C18.5156 18.9453 17.8672 18.9649 18.5156 18.6484C18.8164 18.5 18.9453 18.4063 19.1992 18.1484C19.457 17.8906 19.5508 17.7617 19.6992 17.4609C20.0195 16.8008 20.0039 17.1758 19.9922 11.0547L19.9805 5.64454L19.875 5.33204C19.6094 4.54689 19.043 3.93751 18.3008 3.63673L18.0273 3.52735L18 3.32423C17.875 2.46486 17.2812 1.6836 16.4648 1.3086C15.8867 1.03907 16.3398 1.0547 8.99608 1.0586C3.48436 1.0586 2.3203 1.07032 2.10936 1.1172ZM15.8789 2.41798C16.039 2.48438 16.1797 2.58204 16.3281 2.73048C16.5312 2.9336 16.7187 3.2461 16.7187 3.37892C16.7187 3.4297 15.8672 3.43751 9.46483 3.44532L2.20702 3.45704L1.93358 3.55079C1.78514 3.60157 1.57811 3.6836 1.47655 3.73439C1.37499 3.78517 1.28124 3.82814 1.26561 3.82814C1.24999 3.82814 1.24999 3.73829 1.26561 3.62892C1.34764 3.00392 1.78124 2.50001 2.35936 2.35938C2.51561 2.32032 3.98436 2.31251 9.10155 2.31642L15.6445 2.32423L15.8789 2.41798ZM17.832 4.80079C18.1523 4.9297 18.5078 5.28517 18.6367 5.60548C18.7265 5.83595 18.7305 5.86329 18.7305 7.08985V8.33985L16.4258 8.35938L14.1211 8.37892L13.793 8.4922C13.3437 8.65235 12.8203 9.00782 12.5273 9.35548C12.2461 9.69142 11.9726 10.2383 11.8906 10.625C11.7969 11.0625 11.832 11.7227 11.9687 12.1289C12.289 13.0781 13.0273 13.7656 14.0234 14.0469C14.25 14.1094 14.5039 14.1172 16.5156 14.1289L18.7539 14.1445L18.7422 15.3438C18.7265 16.7266 18.707 16.8164 18.3594 17.1992C18.1328 17.4492 17.875 17.5938 17.5586 17.6563C17.3867 17.6875 15.3047 17.6953 9.86327 17.6875L2.40233 17.6758L2.16796 17.582C1.84764 17.4531 1.49217 17.0977 1.36327 16.7774L1.26952 16.543V11.1914V5.83985L1.36327 5.60548C1.53514 5.1836 2.00389 4.8047 2.44921 4.72657C2.55467 4.71095 6.00389 4.69923 10.1172 4.70314L17.5976 4.70704L17.832 4.80079ZM18.75 11.2305V12.8516H16.6094C14.7656 12.8516 14.4375 12.8438 14.2539 12.7891C13.582 12.5938 13.0898 11.9336 13.0859 11.2227C13.0859 10.9844 13.1914 10.6172 13.332 10.3789C13.5234 10.0547 13.9531 9.73829 14.3242 9.65235C14.4062 9.63282 15.4336 9.6172 16.6133 9.61329L18.75 9.60938V11.2305Z"
                                        fill="#B4B4B4" />
                                    <path
                                        d="M14.6484 10.7109C14.2383 10.918 14.1758 11.4727 14.5273 11.7695C14.957 12.1328 15.5859 11.8516 15.5937 11.2969C15.5976 10.7734 15.1133 10.4766 14.6484 10.7109Z"
                                        fill="#B4B4B4" />
                                    <path
                                        d="M2.79901 6.72727H4.13068L6.44602 12.3807H6.53125L8.84659 6.72727H10.1783V14H9.13423V8.73722H9.06676L6.92188 13.9893H6.0554L3.91051 8.73366H3.84304V14H2.79901V6.72727Z"
                                        fill="#B4B4B4" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_5596_76">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="mini-click-non sidebar-titel text-capitalize">marchent wallet</span></a>
                    </li>

                    <li class="click-active">
                        <a class="has-arrow" href="#" aria-expanded="false"> <svg class="icon-wrap"
                                width="22" height="22" viewBox="0 0 20 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 1.75V3H10.5V1.75C10.5 1.625 10.375 1.5 10.25 1.5H5.75C5.59375 1.5 5.5 1.625 5.5 1.75ZM4 3V1.75C4 0.8125 4.78125 0 5.75 0H10.25C11.1875 0 12 0.8125 12 1.75V3H14C15.0938 3 16 3.90625 16 5V6.03125C15.8125 6.03125 15.6562 6 15.5 6C15.1562 6 14.8125 6.03125 14.5 6.09375V5C14.5 4.75 14.25 4.5 14 4.5H11.25H4.75H2C1.71875 4.5 1.5 4.75 1.5 5V8H6H11H11.25C10.5625 8.84375 10.125 9.875 10 11H7C6.4375 11 6 10.5625 6 10V9.5H1.5V13C1.5 13.2812 1.71875 13.5 2 13.5H10.375C10.5625 14.0625 10.875 14.5625 11.25 15H2C0.875 15 0 14.125 0 13V8.75V5C0 3.90625 0.875 3 2 3H4ZM11 11.5C11 9.90625 11.8438 8.4375 13.25 7.625C14.625 6.8125 16.3438 6.8125 17.75 7.625C19.125 8.4375 20 9.90625 20 11.5C20 13.125 19.125 14.5938 17.75 15.4062C16.3438 16.2188 14.625 16.2188 13.25 15.4062C11.8438 14.5938 11 13.125 11 11.5ZM15.5 9C15.2188 9 15 9.25 15 9.5V11.5C15 11.7812 15.2188 12 15.5 12H17C17.25 12 17.5 11.7812 17.5 11.5C17.5 11.25 17.25 11 17 11H16V9.5C16 9.25 15.75 9 15.5 9Z"
                                    fill="#B4B4B4" />
                            </svg>
                            <span class="mini-click-non text-capitalize sidebar-title">Affiliate</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="" href="/home/my-affilate/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">My Affiliate</span></a></li>
                            <li><a title="" href="/home/add-affilate/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Add Affiliate</span></a></li>


                        </ul>
                    </li>

                    <li class="click-active">
                        <a class="has-arrow" href="#" aria-expanded="false"><svg class="icon-wrap"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_5605_117)">
                                    <path
                                        d="M2.10936 1.1172C1.96874 1.14454 1.68749 1.25392 1.48436 1.35157C1.18358 1.50001 1.05467 1.59376 0.796862 1.85548C0.531237 2.1172 0.445299 2.23829 0.300768 2.54298C-0.0195446 3.20313 -1.33839e-05 2.69923 -1.33839e-05 10C-1.33839e-05 17.3008 -0.0195446 16.7969 0.300768 17.457C0.445299 17.7617 0.531237 17.8828 0.796862 18.1445C1.05467 18.4063 1.18358 18.5 1.48436 18.6484C2.1328 18.9649 1.48436 18.9453 9.99999 18.9453C18.5156 18.9453 17.8672 18.9649 18.5156 18.6484C18.8164 18.5 18.9453 18.4063 19.1992 18.1484C19.457 17.8906 19.5508 17.7617 19.6992 17.4609C20.0195 16.8008 20.0039 17.1758 19.9922 11.0547L19.9805 5.64454L19.875 5.33204C19.6094 4.54689 19.043 3.93751 18.3008 3.63673L18.0273 3.52735L18 3.32423C17.875 2.46486 17.2812 1.6836 16.4648 1.3086C15.8867 1.03907 16.3398 1.0547 8.99608 1.0586C3.48436 1.0586 2.3203 1.07032 2.10936 1.1172ZM15.8789 2.41798C16.039 2.48438 16.1797 2.58204 16.3281 2.73048C16.5312 2.9336 16.7187 3.2461 16.7187 3.37892C16.7187 3.4297 15.8672 3.43751 9.46483 3.44532L2.20702 3.45704L1.93358 3.55079C1.78514 3.60157 1.57811 3.6836 1.47655 3.73439C1.37499 3.78517 1.28124 3.82814 1.26561 3.82814C1.24999 3.82814 1.24999 3.73829 1.26561 3.62892C1.34764 3.00392 1.78124 2.50001 2.35936 2.35938C2.51561 2.32032 3.98436 2.31251 9.10155 2.31642L15.6445 2.32423L15.8789 2.41798ZM17.832 4.80079C18.1523 4.9297 18.5078 5.28517 18.6367 5.60548C18.7265 5.83595 18.7305 5.86329 18.7305 7.08985V8.33985L16.4258 8.35938L14.1211 8.37892L13.793 8.4922C13.3437 8.65235 12.8203 9.00782 12.5273 9.35548C12.2461 9.69142 11.9726 10.2383 11.8906 10.625C11.7969 11.0625 11.832 11.7227 11.9687 12.1289C12.289 13.0781 13.0273 13.7656 14.0234 14.0469C14.25 14.1094 14.5039 14.1172 16.5156 14.1289L18.7539 14.1445L18.7422 15.3438C18.7265 16.7266 18.707 16.8164 18.3594 17.1992C18.1328 17.4492 17.875 17.5938 17.5586 17.6563C17.3867 17.6875 15.3047 17.6953 9.86327 17.6875L2.40233 17.6758L2.16796 17.582C1.84764 17.4531 1.49217 17.0977 1.36327 16.7774L1.26952 16.543V11.1914V5.83985L1.36327 5.60548C1.53514 5.1836 2.00389 4.8047 2.44921 4.72657C2.55467 4.71095 6.00389 4.69923 10.1172 4.70314L17.5976 4.70704L17.832 4.80079ZM18.75 11.2305V12.8516H16.6094C14.7656 12.8516 14.4375 12.8438 14.2539 12.7891C13.582 12.5938 13.0898 11.9336 13.0859 11.2227C13.0859 10.9844 13.1914 10.6172 13.332 10.3789C13.5234 10.0547 13.9531 9.73829 14.3242 9.65235C14.4062 9.63282 15.4336 9.6172 16.6133 9.61329L18.75 9.60938V11.2305Z"
                                        fill="#B4B4B4" />
                                    <path
                                        d="M14.6484 10.7109C14.2383 10.918 14.1758 11.4727 14.5273 11.7695C14.957 12.1328 15.5859 11.8516 15.5937 11.2969C15.5976 10.7734 15.1133 10.4766 14.6484 10.7109Z"
                                        fill="#B4B4B4" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_5605_117">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="mini-click-non text-capitalize sidebar-title">wallet</span></a>
                        <ul class="submenu-angle dp-submenu-angle" aria-expanded="false">
                            <li class="click-active"><a class="has-arrow" title="" href="#"
                                    aria-expanded="false"><span class="mini-sub-pro ">Deposit</span></a>
                                <ul class="dp-submenu-angle" aria-expanded="false">
                                    <li class="click-active"><a title="" href="/home/elite-deposit-history/{{Auth::user()->id}}"><span
                                                class="mini-sub-pro">Deposit USDT</span></a></li>
                                    <li class="click-active"><a title="" href="/home/add-fund/{{Auth::user()->id}}"><span
                                                class="mini-sub-pro">Deposit MUSD</span></a></li>
                                    <li class="click-active"><a title="" href="/home/add-mind/{{Auth::user()->id}}"><span
                                                class="mini-sub-pro">Deposit MIND</span></a></li>
                                </ul>
                            </li>
                            <li class="click-active"><a class="has-arrow" title="" href=""
                                    aria-expanded="false"><span class="mini-sub-pro">Withdraw</span></a>
                                <ul class="dp-submenu-angle" aria-expanded="false">
                                    <li class="click-active"><a title=""
                                            href="/home/withdraw-usd/{{ Auth::user()->id }}"><span
                                                class="mini-sub-pro">Withdraw USDT</span></a></li>
                                    <li class="click-active"><a title=""
                                            href="/home/withdraw/{{ Auth::user()->id }}"><span
                                                class="mini-sub-pro">Withdraw MUSD</span></a></li>
                                    <li class="click-active"><a title=""
                                            href="/home/withdraw-bonus/{{ Auth::user()->id }}"><span
                                                class="mini-sub-pro">Withdraw MIND</span></a></li>
                                </ul>
                            </li>
                            <li class="click-active"><a title=""
                                    href="/home/fund-transfer/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Transfer Fund</span></a></li>
                            <li class="click-active"><a title=""
                                    href="/home/send-bonus/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Transfer Coin</span></a></li>
                            <li class="click-active"><a title=""
                                    href="/home/send-usdt/{{ Auth::user()->id }}"><span class="mini-sub-pro">Transfer
                                        USDT</span></a></li>
                            <li class="click-active"><a title=""
                                    href="home/transactions/{{ Auth::user()->id }}"><span
                                        class="mini-sub-pro">Transactions Report</span></a></li>
                        </ul>
                    </li>
                    <li class="click-active">
                    <a class="has-arrow" href="#" aria-expanded="false"> <svg class="icon-wrap"
                            width="22" height="22" viewBox="0 0 20 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.5 1.75V3H10.5V1.75C10.5 1.625 10.375 1.5 10.25 1.5H5.75C5.59375 1.5 5.5 1.625 5.5 1.75ZM4 3V1.75C4 0.8125 4.78125 0 5.75 0H10.25C11.1875 0 12 0.8125 12 1.75V3H14C15.0938 3 16 3.90625 16 5V6.03125C15.8125 6.03125 15.6562 6 15.5 6C15.1562 6 14.8125 6.03125 14.5 6.09375V5C14.5 4.75 14.25 4.5 14 4.5H11.25H4.75H2C1.71875 4.5 1.5 4.75 1.5 5V8H6H11H11.25C10.5625 8.84375 10.125 9.875 10 11H7C6.4375 11 6 10.5625 6 10V9.5H1.5V13C1.5 13.2812 1.71875 13.5 2 13.5H10.375C10.5625 14.0625 10.875 14.5625 11.25 15H2C0.875 15 0 14.125 0 13V8.75V5C0 3.90625 0.875 3 2 3H4ZM11 11.5C11 9.90625 11.8438 8.4375 13.25 7.625C14.625 6.8125 16.3438 6.8125 17.75 7.625C19.125 8.4375 20 9.90625 20 11.5C20 13.125 19.125 14.5938 17.75 15.4062C16.3438 16.2188 14.625 16.2188 13.25 15.4062C11.8438 14.5938 11 13.125 11 11.5ZM15.5 9C15.2188 9 15 9.25 15 9.5V11.5C15 11.7812 15.2188 12 15.5 12H17C17.25 12 17.5 11.7812 17.5 11.5C17.5 11.25 17.25 11 17 11H16V9.5C16 9.25 15.75 9 15.5 9Z"
                                fill="#B4B4B4" />
                        </svg>
                        <span class="mini-click-non text-capitalize sidebar-title">B.W Trans. history</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                        <li><a title="" href="/home/elite-deposit-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">USDT Deposit History</span></a></li>
                        <li><a title="" href="/home/elite-sponsor-bonus-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Elite Sponsor Bonus History</span></a></li>
                        <li><a title="" href="/home/usd-staking-bonus-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Elite Daily Bonus History</span></a></li>
                        <li><a title="" href="/home/affilate-bonus-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Affiliate Bonus History</span></a></li>
                        <li><a title="" href="/home/refferer-bonus-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Daily Seller Bonus History</span></a></li>
                        <li><a title="" href="/home/daily-bonus-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Daily Bonus History</span></a></li>
                        <li><a title="" href="/home/staking-bonus-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Staking Bonus History</span></a></li>
                        <li><a title="" href="/home/level-bonus-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Level Bonus History</span></a></li>

                        <li><a title=""
                                href="/home/token-settlement-bonus-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Token Sett. History</span></a></li>
                        <li><a title="" href="/home/transfer-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Transfer History</span></a></li>
                        <li><a title="" href="/home/withdraw-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Withdraw History</span></a></li>
                        <li><a title="" href="/home/other-transaction-history/{{ Auth::user()->id }}"><span
                                    class="mini-sub-pro">Other Transaction</span></a></li>
                    
                </ul>
                </li>

                <li class="click-active">
                    <a class="" href="#" aria-expanded="false"><svg class="icon-wrap" width="20"
                            height="20" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.75 1C12.75 1 16 4.25 16 8.25C16 8.6875 15.6562 9 15.25 9C14.8125 9 14.5 8.6875 14.5 8.25C14.5 5.09375 11.9062 2.5 8.75 2.5C8.3125 2.5 8 2.1875 8 1.75C8 1.34375 8.3125 1 8.75 1ZM9 7C9.53125 7 10 7.46875 10 8C10 8.5625 9.53125 9 9 9C8.4375 9 8 8.5625 8 8C8 7.46875 8.4375 7 9 7ZM8 4.75C8 4.34375 8.3125 4 8.75 4C11.0938 4 13 5.90625 13 8.25C13 8.6875 12.6562 9 12.25 9C11.8125 9 11.5 8.6875 11.5 8.25C11.5 6.75 10.25 5.5 8.75 5.5C8.3125 5.5 8 5.1875 8 4.75ZM10.2812 9.96875C10.625 9.53125 11.2188 9.40625 11.7188 9.625L15.2188 11.125C15.7812 11.3438 16.0938 11.9375 15.9688 12.5312L15.2188 16.0312C15.0938 16.5938 14.5625 17 14 17C13.7812 17 13.5938 17 13.4062 17C13.0938 17 12.7812 16.9688 12.5 16.9375C5.46875 16.1875 0 10.25 0 3C0 2.4375 0.40625 1.90625 0.96875 1.78125L4.46875 1.03125C5.0625 0.90625 5.65625 1.21875 5.875 1.78125L7.375 5.28125C7.59375 5.78125 7.46875 6.375 7.03125 6.71875L5.75 7.78125C6.59375 9.21875 7.78125 10.4062 9.21875 11.25L10.2812 9.96875ZM14.4375 12.4062L11.3125 11.0625L10.4062 12.1875C9.9375 12.75 9.125 12.9062 8.46875 12.5312C6.8125 11.5625 5.4375 10.1875 4.46875 8.53125C4.09375 7.875 4.25 7.0625 4.8125 6.59375L5.9375 5.6875L4.59375 2.5625L1.5 3.21875C1.59375 9.96875 7.03125 15.4062 13.7812 15.5L14.4375 12.4062Z"
                                fill="#B4B4B4" />
                        </svg>
                        <span class="mini-click-non sidebar-titel text-capitalize">Contact Us</span></a>
                </li>
                <li class="click-active">
                    <a class="" href="#" aria-expanded="false"><svg class="icon-wrap" width="20"
                            height="20" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.9375 4.875C2.75 5.25 2.3125 5.40625 1.9375 5.25C1.5625 5.09375 1.375 4.65625 1.53125 4.28125C2.59375 1.78125 5.09375 0 8 0C9.625 0 11.1875 0.65625 12.3438 1.8125L14 3.46875V1.75C14 1.34375 14.3125 1 14.75 1C15.1562 1 15.5 1.34375 15.5 1.75V5.25C15.5 5.6875 15.1562 6 14.75 6H11.25C10.8125 6 10.5 5.6875 10.5 5.25C10.5 4.84375 10.8125 4.5 11.25 4.5H12.9375L11.2812 2.875C10.4062 2 9.21875 1.5 8 1.5C5.71875 1.5 3.75 2.90625 2.9375 4.875ZM14.4375 9.78125C13.3438 12.25 10.875 14 8 14C6.34375 14 4.78125 13.375 3.625 12.1875L2 10.5625V12.25C2 12.6875 1.65625 13 1.25 13C0.8125 13 0.5 12.6875 0.5 12.25V8.75C0.5 8.34375 0.8125 8 1.25 8H4.75C5.15625 8 5.5 8.34375 5.5 8.75C5.5 9.1875 5.15625 9.5 4.75 9.5H3.03125L4.6875 11.1562C5.5625 12.0312 6.75 12.5 8 12.5C10.25 12.5 12.2188 11.1562 13.0312 9.1875C13.2188 8.78125 13.6562 8.625 14.0312 8.78125C14.4062 8.9375 14.5938 9.375 14.4375 9.78125Z"
                                fill="#B4B4B4" />
                        </svg>
                        <span class="mini-click-non sidebar-titel text-capitalize">Swap</span></a>
                </li>
                </ul>
            </nav>
        </div>
    </nav>
</div>
<!-- sidebar end
  ============================================ -->
