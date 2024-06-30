@extends('user.layouts.master')


@section('user_content')



   <div class="section-admin container-fluid">
    <div class="row admin text-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="admin-content res-mg-t-15 d-flex row justify-content-between">

                <div class="row page-top-section">
                        <!-- breadcome title Section  -->
                    <div class="col-sm-6 breadcome-heading">
                        <h3>Profile Settings</h3>
                    </div>
                </div>

                @if(Session::has('profile_updated'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('profile_updated')}}
           </div>
       </div>
       @elseif(Session::has('ambassador_updated'))
       <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24">
        <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
        {{Session::get('ambassador_updated')}}
        </div>
        </div>


       @endif
       
       
        @error('file')
        <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24">
        <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
        {{ $message }}
        </div>
        </div>
        @enderror
                         <!-- Profile section 
 ============================================  -->
                <div class="profile-staus mg-t-30  mg-b-30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="profile-status-wrap">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 mg-t-30">
                                            <div class="profile-data  profile-sec analysis-progrebar-ctn">
                                                <div class="profile-data-warp d-flex text-left">
                                                    <div class="dp-img">
                                                        @if(Auth::user()->image == null)

                                                        <img class="img-fluid" src="{{asset('assetsnew/img/img-icon/profile-icon.jpg')}}" alt="" height="100px" width="80px">
                                                        @else
                                                        <img class="img-fluid" src="{{ Storage::url('public/User/' . Auth::user()->image) }}" alt="" height="100px" width="80px">
                                                        @endif

                                                    </div>
                                                    <div class="profile-details">
                                                        <h4>Mr. Aditya</h4>
                                                        <p class="kyc-cont">KYC <span class="text-red">Unverified</span> </p>
                                                        <div class="copy-container prof-url">
                                                            <p class="cp-url mg-t-15">Invite: <span class="invt text-lowercase" id="urlText"> my.mindchainwallet....r/ref?FERFWE3</span></p>
                                                            <button class="copy-button" onclick="copyURL()">
                                                            <i class="fa-solid fa-copy copy-icon"></i>
                                                                <i class="fa-solid fa-clipboard clipboard-icon text-warning"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" id="hiddenInput" class="hidden-input" value="my.mindchainwallet.com/register">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mg-t-30">
                                            <div class="profile-sec analysis-progrebar-ctn role">
                                                <h4 class="text-left">Role</h4>
                                                <div class="rank-icon d-flex">
                                                    @if(Auth::user()->ambassador == 1)

                                                    <div class=" rank-ico ">
                                                        <img class="" src="{{asset('assetsnew/img/img-icon/ambassador.png')}}" alt="">
                                                    </div>
                                                    @endif

                                                    @if(Auth::user()->consultant == 2)
                                                    <div class="rank-ico">
                                                        <img class="" src="{{asset('assetsnew/img/img-icon/CONSULTANT-01.png')}}" alt="">
                                                    </div>
                                                    @endif

                                                    @if(Auth::user()->elite_club == 1)
                                                    <div class=" rank-ico">
                                                        <img class="" src="{{asset('assetsnew/img/img-icon/elite.png')}}" alt="">
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 mg-t-30">
                                            <form  method="post" action="{{route('update-profile')}}" enctype="multipart/form-data"" class="text-left">
                                            @csrf                                
                                        <input type="hidden" name="id" value="{{Auth::user()->id}}">

                                            <div class="profile-sec profile-settings analysis-progrebar-ctn">
                                                <div class="profile-info">
                                                    <div class="name-title">
                                                        Name:
                                                    </div>
                                                    <div class="name form-group">
                                                        <input name="name" placeholder="Enter Your Name" type="text" value="{{Auth::user()->name}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="email-title">
                                                        Email:
                                                    </div>
                                                    <div class="email-address form-group">
                                                        <input type="email" disabled value="{{Auth::user()->email}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="contact">
                                                        Contact No:
                                                    </div>
                                                    <div class="contact-no form-group">
                                                        <input type="number" name="contact" placeholder="Enter Contact No" value="{{Auth::user()->contact}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="nidorpassid">
                                                        NID/Passport:
                                                    </div>
                                                    <div class="nidOrPassport form-group">
                                                        <input type="text" name="nid_passport" placeholder="Enter NID Number/ Passport Number" value="{{Auth::user()->nid_passport}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="address-title">
                                                        Address:
                                                    </div>
                                                    <div class="address form-group">
                                                        <input type="text" name="address" placeholder="Address" value="{{Auth::user()->address}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="city-title">
                                                        City:
                                                    </div>
                                                    <div class="city-name form-group">
                                                        <input type="text" name="city" placeholder="Enter City" value="Khagrachhari" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="post-title">
                                                        Postal Code:
                                                    </div>
                                                    <div class="postal-code form-group">
                                                        <input type="number" name="postal_code" placeholder="Enter Postal Code" value="{{Auth::user()->postal_code}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="country-title">
                                                        Country:
                                                    </div>
                                                    <div class="country-name form-group">
                                                        <input type="text" name="country" id="country" value="{{Auth::user()->country}}" placeholder="Choose Country" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="dob-title">
                                                        Date of Birth:
                                                    </div>
                                                    <div class="date-of-birth form-group">
                                                        <input type="date" name="date_of_birth" placeholder="Date of Birth" value="{{Auth::user()->date_of_birth}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="gender-title">
                                                        Gender:
                                                    </div>
                                                    <div class="gender form-group">
                                                        <select name="gender" class="form-control" aria-label="Default select example" required>


                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                        
                                                          </select>
                                                    </div>
                                                </div>
                                                <div class="profile-info">
                                                    <div class="refferal-title">
                                                        My Refferal Id:
                                                    </div>
                                                    <div class="refferal-id form-group">
                                                        <input type="text" disabled value="{{Auth::user()->referral_link}}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="profile-info">
                                                    <div class="refferal-title">
                                                        Profile Photo:
                                                    </div>
                                                    <div class="profileimage form-group">
                                                        <input type="file" id="image" name="file" value="" class="form-control">
                                                    </div>
                                                </div>
                                                <button type="submit">Profile Update</button>

                                                @if(Auth::user()->kyc == 0)
                                                    <button type="submit">Profile Update</button>
                                                @endif

                                            </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mg-t-30">
                                            <div class="profile-sec password-update analysis-progrebar-ctn">
                                                <div class="mg-t-30">
                                                    <h5 class="text-left">Update Password</h5>
                                                </div>
                                                <form action="{{route('change-password-store')}}" method="POST" class="text-left">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                                    <div class="form-group">
                                                        <label for="email" class="col-form-label">Email</label>
                                                        <input type="text" disabled class="form-control" value="{{Auth::user()->email}}" id="email">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="oldPassword" class="col-form-label">Old Password</label>
                                                        <input type="password" name="old_password"class="form-control" id="oldPassword">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="newPassword" class="col-form-label">New Password</label>
                                                        <input type="password"  class="form-control" name="new_password" id="new_password">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="confirmPassword" class="col-form-label">Re Type Password</label>
                                                        <input type="password"  class="form-control" name="password_confirmation" id="password_confirmation">
                                                      </div>
                                                      <button type="submit">Update Password</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Profile end section 
            ============================================  -->
            </div>
        </div>           
    </div>
</div>




@endsection
