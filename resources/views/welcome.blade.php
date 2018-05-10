<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>{{env('APP_NAME')}}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="themes/dimension/assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="themes/dimension/assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="themes/dimension/assets/css/noscript.css" /></noscript>
		<link rel="manifest" href="manifest.json">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{url()->current()}}">
    <meta name="twitter:title" content="@yield('title','Parker POS')">
    <meta name="twitter:description" content="@yield('description',"Parker POS is an progressive web app point of sales system powered by Stripe!")">
    <meta name="twitter:image" content="@yield('image',url('/images/icons/icon-384x384.png'))">
    <meta name="twitter:creator" content="@mastashake08">
    <meta name="twitter:site" content="@mastashake08">
    <!-- Facebook OG -->
    <meta property="og:title" content="@yield('title','Parker POS')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:image" content="@yield('image',url('/images/icons/icon-384x384.png'))" />
    <meta name="og:description" content="@yield('description',"Parker POS is an progressive web app point of sales system powered by Stripe!")">
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-credit-card"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>{{env('APP_NAME')}}</h1>
								<p>An open source <a href="https://stripe.com">Stripe powered</a> progressive point of sales web app designed by <a href="https://jyroneparker.com">Jyrone Parker</a> and released<br />
								for free under the <a href="https://github.com/mastashake08/laravel-vue-pos">MIT</a> license.</p>
								<a href="{{url('/login/stripe')}}"><img src="{{url('/images/blue-on-light.png')}}"></a>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#intro">Intro</a></li>
								<li><a href="#work">Use Cases</a></li>
								<li><a href="#about">About</a></li>
								<li><a href="#contact">Contact</a></li>
								<!--<li><a href="#elements">Elements</a></li>-->
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Intro -->
							<article id="intro">
								<h2 class="major">Intro</h2>
								<span class="image main"><img src="{{url('/images/owner.jpg')}}" alt="" /></span>
								<p>When starting a new business or endeavor accepting payments should be the last thing on your mind! {{env('APP_NAME')}} was created to easily allow you to start taking payments and managing customers. <a href="#work">awesome work</a>.</p>
								</article>

						<!-- Work -->
							<article id="work">
								<h2 class="major">Use Cases</h2>
								<span class="image main"><img src="images/card.jpg" alt="" /></span>
								<p>
									<ul>
										<li>Sole proprietors who need a simple charging/tipping system</li>
										<li>Businesses who need to manage recurring billing</li>
										<li>Businesses that need to manage and pay employees</li>
									</ul>
								</p>
							</article>

						<!-- About -->
							<article id="about">
								<h2 class="major">About</h2>
								<span class="image main"><img src="{{url('/images/about.jpg')}}" alt="" /></span>
								<p>{{env('APP_NAME')}} is a <a href="https://stripe.com">Stripe powered</a> progressive point of sales web app that allows anyone anywhere to accept payments, manage recurring billing, send invoices and more!</p>

						<!-- Contact -->
							<article id="contact">
								<h2 class="major">Contact</h2>
								<form method="post" action="{{url('/send-message')}}">
									@csrf
									<div class="field half first">
										<label for="name">Name</label>
										<input type="text" name="name" id="name" />
									</div>
									<div class="field half">
										<label for="email">Email</label>
										<input type="text" name="email" id="email" />
									</div>
									<div class="field">
										<label for="message">Message</label>
										<textarea name="message" id="message" rows="4"></textarea>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send Message" class="special" /></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</form>
								<ul class="icons">
									<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
								</ul>
							</article>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; {{env('APP_NAME')}}. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="themes/dimension/assets/js/jquery.min.js"></script>
			<script src="themes/dimension/assets/js/skel.min.js"></script>
			<script src="themes/dimension/assets/js/util.js"></script>
			<script src="themes/dimension/assets/js/main.js"></script>

	</body>
</html>
