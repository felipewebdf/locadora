<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Locadora online</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Felipe Moura">
        <link href="{{ asset('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') }}"
              rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
    @include('layouts.header')
    <div class="container">
        @yield('content')
      <hr>
      @include('layouts.footer')
    </div> <!-- /container -->
        <script src="{{ asset('vendor/components/jquery/jquery.min.js') }}"
            type="text/javascript"></script>
            <script src="{{ asset('vendor/twbs/bootstrap/dist/js/bootstrap.min.js') }}"
            type="text/javascript"></script>
            <script src="{{ asset('js/app.js') }}"></script>
            @yield('page-js-files')
    </body>
</html>