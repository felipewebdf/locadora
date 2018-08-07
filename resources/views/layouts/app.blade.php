<html>
    <head>
        <title>Locadora online</title>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="Felipe Moura">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <header class="row">
                @include('layouts.header')
            </header>
            <div id="main" class="row">
                <div class='col-3'>
                    @include('layouts.sidebar')
                </div>
                <div class='col-9'>
                    @yield('content')
                </div>
            </div>

            <footer class="row">
                @include('layouts.footer')
            </footer>
            <script src="{{ asset('js/app.js') }}"></script>
            @yield('page-js-files')
        </div>
    </body>
</html>