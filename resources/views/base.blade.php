<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Vypok - @yield('title')</title>
	<!-- JS & CSS (bootstrap, jQuery included) -->
	<script src="{{ asset('js/app.js') }}"></script>
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	@yield('head')
</head>
<body>
	<header id="page-header" class="container">
		<h1><a href="/">Vypok.ru</a></h1>
	</header>
	<nav id="page-nav" class="container">
		<ul>
			@guest
				<li>
					<a href="{{ route('login') }}">Login</a>
				</li>
				<li>
					<a href="{{ route('register') }}">Register</a>
				</li>
			@else
				<li>
					{{ Auth::user()->name }}
				</li>
				<li>
					<a href="{{ route('logout') }}"
					   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						Logout
					</a>
				</li>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			@endguest
			<li><a href="{{ route('frontpage') }}">Frontpage</a></li>
			<li><a href="{{ route('microblog') }}">Microblog</a></li>
			<li><a href="">Link 3</a></li>
		</ul>
	</nav>
	<div class="container">
		@yield('content')
	</div>
	<footer id="page-footer" class="container">
		Vypok;
	</footer>
	@yield('footer')
</body>
</html>
