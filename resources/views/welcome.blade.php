<!DOCTYPE HTML>
<!--
	Aerial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Jyrone Parker POS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="themes/assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="themes/assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="themes/assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="themes/assets/css/ie9.css" /><![endif]-->
	</head>
	<body class="loading">
		<div id="wrapper">
			<div id="bg"></div>
			<div id="overlay"></div>
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1>Parker POS</h1>
						<p>Accept Payments Anywhere on YOUR terms.</p>
						<br>
						<a href="{{url('/about')}}">What Is It?</a>
						<br>
						@if(Auth::guest())
						<a href="{{url('/login/stripe')}}"><img src="{{url('/images/blue-on-light.png')}}"></a>
						@else
						<a href="{{url('/home')}}">Home</a>
						@endif
						<nav>
							<ul>
								<li><a href="https://twitter.com/mastashake08" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
								<li><a href="https://facebook.com/jyroneparker" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
								<li><a href="https://github.com/mastashake08" class="icon fa-github"><span class="label">Github</span></a></li>
								<li><a href="mailto:inquiries@jyroneparker.com" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
							</ul>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
						<span class="copyright">&copy; {{env('APP_NAME')}}. Design: <a href="http://html5up.net">HTML5 UP</a>.</span>
					</footer>

			</div>
		</div>
		<!--[if lte IE 8]><script src="themes/assets/js/ie/respond.min.js"></script><![endif]-->
		<script>
			window.onload = function() { document.body.className = ''; }
			window.ontouchmove = function() { return false; }
			window.onorientationchange = function() { document.body.scrollTop = 0; }
		</script>
	</body>
</html>
