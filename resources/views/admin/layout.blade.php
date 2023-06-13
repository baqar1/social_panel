<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>UMT StudentCentralHub</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href=" {{asset('css/animate.css')}}">
<link rel="stylesheet" type="text/css" href=" {{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/line-awesome.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/line-awesome-font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lib/slick/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lib/slick/slick-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
</head>
<body>
	<div class="wrapper">
		<header>
			<div class="container">
				<div class="header-data">
					<div class="logo">
						<a href="" title=""><img src="{{asset('images/umtt.png')}}" alt="" width="50" height="50"></a>
					</div><!--logo end-->
					<div class="search-bar">
						<form id="search-form" method="GET" action="{{ route('search') }}">
							<input type="text" name="search" placeholder="Search...">
							<button type="submit"><i class="la la-search"></i></button>
						</form>
					</div><!--search-bar end-->
					<nav>
						<ul>
							<li>
								<a href="{{url('dashboard')}}" title="">
									<span><img src="{{ asset('images/icon1.png') }}" alt=""></span>
									Home
								</a>
							</li><li> </li>
							<li>
								<a href="{{url('admin/students')}}" title="">
									<span><img src="{{ asset('images/icon4.png') }}" alt=""></span>
									Profiles
								</a>
							</li><li> </li>
							<li>
								<a href="{{url('chatify')}}" title="" class="not-box-open">
									<span><img src="{{ asset('images/icon6.png') }}" alt=""></span>
									Messages
								</a>
							</li><li> </li>
							{{-- <li>
								<a href="#" title="" class="not-box-open">
									<span><img src="images/icon7.png" alt=""></span>
									Notification
								</a>
								<div class="notification-box">
									<div class="nt-title">
										<h4>Setting</h4>
										<a href="#" title="">Clear all</a>
									</div>
									<div class="nott-list">
										<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img1.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img2.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img3.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img2.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="view-all-nots">
						  					<a href="#" title="">View All Notification</a>
						  				</div>
									</div><!--nott-list end-->
								</div><!--notification-box end-->
							</li> --}}
						</ul>
					</nav><!--nav end-->

					<div class="menu-btn">
						<a href="#" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
					<div class="user-account">
						<div class="user-info">
							<img src="{{asset('uploads')}}/{{auth()->user()->user_image}}" alt="" width="30" height="30">
							<a href="#" title=""><h3> {{ auth()->user()->name }}</h3></a>
							<i class="la la-sort-down"></i>
						</div>
						<div class="user-account-settingss">
							<ul class="us-links">
								<li><a href="{{ route('account_edit', [auth()->user()->id]) }}" title="">Edit Profile Setting</a>
                                </li>
							</ul>
							<form method="POST" action="{{ route('logout') }}">
								@csrf

								<x-dropdown-link :href="route('logout')"
										onclick="event.preventDefault();
													this.closest('form').submit();">
									{{ __('Logout') }}
								</x-dropdown-link>
							</form><br>
						</div><!--user-account-settingss end-->
					</div>
				</div><!--header-data end-->
			</div>
		</header><!--header end-->
        <main>
			@yield('umt')

		</main>
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.js') }}"></script>
		<script type="text/javascript" src="{{ asset('lib/slick/slick.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/scrollbar.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
	</div>
</body>
</html>
