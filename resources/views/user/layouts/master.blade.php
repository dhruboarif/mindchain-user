
<!doctype html>
<html lang="en">
@include('user.layouts.partials.header')

  <body>

      @include('user.layouts.partials.sidebar')
  

      <div class="all-content-wrapper">
      @include('user.layouts.partials.navbar')
        @yield('user_content')
      </div>
      @include('user.layouts.partials.footer')

    @include('user.layouts.partials.scripts')

  </body>


</html>
