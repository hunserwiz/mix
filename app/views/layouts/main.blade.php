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
    <div class="row-fluid">
      <div class="span12" style="padding-top: 2%;">
        @yield('navigate')  
      </div>
    </div>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><img src="images/immage3.png" alt=""></a>
          <div class="nav-collapse collapse">
            <ul class="nav nav-tabs">
              <li class="dropdown" ><a href="{{ url('/') }}">ใบวางบิล</a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('order-report') }}">รายงาน ใบวางบิล</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">บัญชี <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('finance') }}">บัญชีรายรับ - รายจ่าย</a></li>
                  <li><a href="{{ url('debtor') }}">ลูกหนี้</a></li>
                  <li><a href="{{ url('sell') }}">sell</a></li>
              </ul>
              </li>
          <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">คืนสินค้า <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('product-return') }}">รายการคืนสินค้า</a></li>
            </ul> 
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">ลูกค้า <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('commition') }}">ค่า Commition</a></li>
                  <li><a href="{{ url('deposit') }}">รายการฝากลูกค้า</a></li>
              </ul>
              </li>
              @if(ThaiHelper::CheckRight())
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">สินค้า <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('manage-product') }}">จัดการสินค้า</a></li>
              </ul>
              </li>
              @endif
            </ul>
            <div class="navbar-form pull-right">
                <a href="{{ url('account/sign-out') }}" class="navbar-link"> ออกจากระบบ</a>
            </div>
            @if(Auth::check())
            <div class="navbar-form">
                {{ Auth::user()->name }}
            </div>
            @endif
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
			 @yield('content')     
    </div> <!-- /container -->
     
			
	</div><!-- navbar navbar-inverse navbar-fixed-top -->	 

</body>
</html>