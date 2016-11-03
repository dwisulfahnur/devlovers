<html>
    <head>
        <title>DevLovers - @yield('title')</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            .container{
                width: 80%;

            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid" style="width:1050.800; margin:0 auto; padding:0">
            <div class="navbar-header">
              <a class="navbar-brand" href="/">DevLovers</a>
            </div>
            @if (session('username'))
            <ul class="nav navbar-nav">
              <li class="active"><a href="/browse_user">Browse</a></li>
              <li><a href="/">Like User</a></li>
              <li><a href="/">Match User</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle glyphicon glyphicon-bell" data-toggle="dropdown" href="#"></a>
                    <ul class="dropdown-menu">
                      <li>satu</li>
                      <li>dua</li>
                    </ul>
                 </li>

                <li><a href=""><span class="glyphicon glyphicon-user"></span>  {{ $user_self->full_name }}</a></li>
                <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
            @else
            <ul class="nav navbar-nav navbar-right">
              <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
              <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
            @endif
          </div>
        </nav>
        <div class="container" style="margin-top:60px;">

            @yield('content')
        </div>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
