<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}"/>
      <?php
      $company =App\Models\Company::first();
       ?>
         @if($company->company_name != null)
           <title>{{$company->company_name}}</title>
           @else
    <title>Company Name</title>
    @endif
    <!-- Favicon -->
    @include('user.layouts.partials.styles')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
