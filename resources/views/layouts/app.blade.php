<html>
    <head>
        <title>App Name - @yield('title')</title>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="Felipe Moura">

    </head>
    <body>
        <div class="container">
            <header class="row">
                @include('layouts.header')
            </header>
            <div id="main" class="row">
                <div class='col-3'>
                    <nav>
                        @include('layouts.sidebar')
                    </nav>
                </div>
                <div class='col-9'>
                    @yield('content')
                </div>
            </div>

            <footer class="row">
                @include('layouts.footer')
            </footer>
        </div>
    </body>
</html>