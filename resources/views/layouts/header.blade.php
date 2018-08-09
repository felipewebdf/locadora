<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Locadora online</a>
        </div>
        <div id="navbar" >
            <form id="form-login" class="row" method="POST">
                <div class="form-group col-5">
                    <input type="text" placeholder="Email" name="email" class="form-control">
                </div>
                <div class="form-group col-5">
                    <input type="password" placeholder="Password" name="password" class="form-control">
                </div>
                <div class="form-group col-2">
                <button type="submit" class="btn btn-success">Sign in</button>
                </div>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h1>Hello, world!</h1>
    <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
  </div>
</div>
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/login/login-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/login/login-controller.js') }}"></script>
@endsection
