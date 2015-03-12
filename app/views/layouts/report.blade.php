<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Betagen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Aor">

    <!-- Le styles -->
   <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
  <!-- Java Script -->
      {{ HTML::style('bootstrap/css/bootstrap-responsive.css') }}
      {{ HTML::style('bootstrap/css/bootstrap.css') }}
      {{ HTML::style('bootstrap/css/datepicker.css') }}
      

      {{ HTML::script('js/jquery-1.10.2.js') }}     
      {{ HTML::script('js/jquery-ui-1.10.4.custom.js') }}     
      {{ HTML::script('js/bootstrap-transition.js') }}     
      {{ HTML::script('js/bootstrap-alert.js') }}     
      {{ HTML::script('js/bootstrap-modal.js') }}     
      {{ HTML::script('js/bootstrap-dropdown.js') }}     
      {{ HTML::script('js/bootstrap-scrollspy.js') }}     
      {{ HTML::script('js/bootstrap-tab.js') }}     
      {{ HTML::script('js/bootstrap-tooltip.js') }}     
      {{ HTML::script('js/bootstrap-popover.js') }}     
      {{ HTML::script('js/bootstrap-button.js') }}     
      {{ HTML::script('js/bootstrap-collapse.js') }}     
      {{ HTML::script('js/bootstrap-carousel.js') }}     
      {{ HTML::script('js/bootstrap-typeahead.js') }}    
      {{ HTML::script('js/bootstrap-datepicker.js') }}    
</head>
<body>
    <div class="container">
        @yield('content')
    </div> <!-- /container -->
</body></html>