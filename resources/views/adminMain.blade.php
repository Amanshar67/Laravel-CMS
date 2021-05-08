<!DOCTYPE html>
<html lang="en">
@include('partials._head')
@yield('stylesheets')
</head>
<body>

  @include('partials._nav')

  <div class="container logged-in">

    @include('partials._messages')
    <div class="row">
      <div class="col-md-3">
        @include('partials._dashSide')
      </div>
      <div class="col-md-9">
        @yield('content')
      </div>
    </div>


    @include('partials._footer')

  </div><!--end of container-->

  @include('partials._javascripts')
@yield('scripts')
</body>
</html>
