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
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Locadora online</a>
            </div>

        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-9">
                <div id="alert-app" class="alert alert-dismissible fade hide" role="alert">
                    <span id="alert-message"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @yield('content')
            </div>
        </div>
      <hr>
      @include('layouts.footer')
    </div> <!-- /container -->
        <script src="{{ asset('vendor/components/jquery/jquery.min.js') }}"
            type="text/javascript"></script>
        <script src="{{ asset('vendor/twbs/bootstrap/dist/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
        <script src="{{ asset('js/app.js') }}"
        type="text/javascript"></script>
        @yield('page-js-files')
    </body>
</html>