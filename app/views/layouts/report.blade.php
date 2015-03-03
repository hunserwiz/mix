<html lang="en"><head>
    <meta charset="utf-8" >
    <title>Report Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.js"></script>
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;

      }

    </style>
    {{ HTML::style('bootstrap/css/bootstrap-responsive.css') }}
</head>
<body>
    <div class="container">
        @yield('content')
    </div> <!-- /container -->
</body></html>