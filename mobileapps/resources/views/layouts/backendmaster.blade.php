<html>
    <head>
        <title>App Name - @yield('title')</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        {!!Rapyd::head()!!}
    </head>
    <body>
    <div class="container">
        <ul class="nav nav-pills">
              <li role="presentation" class="active"><a href="/index.php/buildinginfo">楼盘</a></li>
              <li role="presentation"><a href="/index.php/propertycompany">物业公司</a></li>
              <li role="presentation"><a href="/index.php/developer">开发商</a></li>
        </ul>
        @section('sidebar')
            
        @show

        <div class="container">
            @yield('content')
        </div>
    </div>
        
    </body>
</html>