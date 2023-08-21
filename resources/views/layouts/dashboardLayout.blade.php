<!doctype html>
<html lang="en">
  <head>
  	<title>Refferal System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
	  		<h1><a href="/dashboard" class="logo">Referral System</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="#"><span class="fa fa-home mr-3"></span> Homepage</a>
          </li>
          <li>
              <a href="/dashboard"><span class="fa fa-user mr-3"></span> Dashboard</a>
          </li>
          <!-- <li>
            <a href="#"><span class="fa fa-sticky-note mr-3"></span> Friends</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-sticky-note mr-3"></span> Subcription</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-paper-plane mr-3"></span> Settings</a>
          </li>
          <li>
            <a href="{{route('trackinformation')}}"><span class="fa fa-bar-chart mr-3"></span> Track Information</a>
          </li> -->
          <li>
            <a href="{{route('logout')}}"><span class="fa fa-sign-out mr-3"></span>Log Out</a>
          </li>
        </ul>

    	</nav>
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content-section')
        </div>
        </div>

    
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    
  </body>
</html>