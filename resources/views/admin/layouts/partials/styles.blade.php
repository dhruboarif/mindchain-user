<!-- <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" /> -->
<?php
$company =App\Models\Company::first();
 ?>
<link rel="shortcut icon" src="{{asset("storage/Company/$company->company_icon")}}"/>
<link rel="stylesheet" href="{{asset('assets/css/libs.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/coinex.css?v=1.0.0')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<!--//Css for wallet page -->
    <link rel="stylesheet" href="{{asset('wallet/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('wallet/assets/css/responsive.css') }}">
    <!-- google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    
@stack('style')