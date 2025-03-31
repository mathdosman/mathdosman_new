
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Blog List</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta_tags')

    <link rel="icon" href="/images/site/{{ settings()->site_favicon ?? 'default.png' }}">

	<link rel="stylesheet" href="{{ asset('/front/node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/front/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/front/css/fonts.css') }}">
	<link rel="stylesheet" href="{{ asset('/front/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/themify-icons/themify-icons.css') }}">

	<style type="text/css">
		body{
			-moz-opacity: 0.00;
			-khtml-opacity: 0.00;
			opacity: 0.00;
		}

</style>


</head>
<body class="page-blog-list">

	<!-- header-main -->
	<header class="header-main">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-dark navbar-expand-md">
						<a href="/" class="navbar-brand">
							<a href="/" class="navbar-brand">
                                <img src="/images/site/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}" alt="Logo" class="rounded" width="40">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="true" aria-label="Toggle navigation">
				          <span class="navbar-toggler-icon"></span>
				        </button>
				        <div id="navbarMain" class="navbar-collapse collapse show" style="">
				        	<ul class="navbar-nav mr-auto">
				        		<li class="nav-item">
				        			<a href="/" class="nav-link">Home</a>
				        		</li>
                                {!! navigations() !!}

				        		<li class="nav-item">
				        			<a href="about.html" class="nav-link">About</a>
				        		</li>
				        		<li class="nav-item">
				        			<a href="{{ route('contact') }}" class="nav-link">Contact</a>
				        		</li>
				        	</ul>
                            <form action="{{ route('search_posts') }}" method="GET" class="form-inline" role="search" >
                                <input type="search" id="search-query" class="form-control rounded-0" placeholder="Search" value="{{ request('q') ? request('q') : '' }}" name="q">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
				            </form>
                            @auth
				            <ul class="navbar-nav mr-0">
                                <li class="nav-item dropdown">
                                    <a class="dropdown-toggle nav-link d-flex align-items-center" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ auth()->user()->picture }}" alt="User Avatar" width="35" class="rounded-circle">
                                        <span class="d-none d-md-inline ml-2"></span> <!-- Teks hanya muncul di layar besar -->
                                    </a>
                                    <div class="dropdown-menu rounded-0 border-0" aria-labelledby="dropdown01">
                                        <a class="dropdown-item" href="{{ route('admindashboard') }}"> <i class="ti-dashboard mr-1"></i> Dashboard</a>
                                        <a class="dropdown-item" href="{{ route('adminprofile') }}"><i class="ti-user mr-1"></i>Profile</a>
                                        <a class="dropdown-item" href="{{ route('adminsettings') }}"><i class="ti-settings mr-1"></i>Settings</a>
                                        <a class="dropdown-item" href="javascript:;" onclick="event.preventDefault(); document.getElementById('front-logout-form').submit();"><i class="ti-power-off mr-1"></i>Logout</a>
                                        <form action="{{ route('adminlogout_handler',['source'=>'front']) }}"  id="front-logout-form" method="POST" style="display: none" >
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                            @endauth
				        </div>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- end header-main -->

	<aside class="single-header">
		<div class="container">
			<div class="row">

			</div>
		</div>
	</aside>

	<!-- main -->
	<main class="main">
		<div class="container">
			<div class="row">


                    @yield('content')


			</div>
		</div>
	</main>
	<!-- end main -->

    <footer class="footer-main">
        <div class="container">
            <div class="row">
                <!-- Tentang Blog -->
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="/" class="footer-brand">
                                <img src="/images/site/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}" width="128" alt="Logo" class="rounded">
                            </a>
                        </li>
                        <li class="list-group-item">
                            <p>
                                Selamat datang di Blog Matematika! Kami berbagi pengetahuan, tips, dan trik seputar dunia matematika untuk membantu Anda memahami konsep-konsep yang kompleks dengan cara yang sederhana dan menyenangkan.
                            </p>
                            <p>&copy; {{ date('Y') }} Blog Matematika. Semua hak dilindungi.</p>
                        </li>
                    </ul>
                </div>

                <!-- Postingan Terpopuler -->
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h4>Postingan Terpopuler</h4>
                        </li>
                        @foreach (popularPostsFooter() as $post)
                            <li class="list-group-item">
                                <a href="{{ route('read_post', $post->slug) }}">{{ $post->title }}</a>
                                <small>{{ $post->views }} views</small>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Hubungi Kami -->
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h4>Hubungi Kami</h4>
                        </li>
                        <li class="list-group-item">
                            <p>
                                Jika Anda memiliki pertanyaan, saran, atau ingin berbagi ide, jangan ragu untuk menghubungi kami melalui:
                            </p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope"></i> <a href="mailto:info@blogmatematika.com">info@blogmatematika.com</a></li>
                                <li><i class="fas fa-phone"></i> +62 812 3456 7890</li>
                                <li><i class="fas fa-map-marker-alt"></i> Denpasar, Bali, Indonesia</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="dark-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <ul class="nav-footer">
                            <li>
                                <a href="#" data-toggle="modal" data-target="#exampleModalLong">Syarat & Ketentuan</a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#exampleModalLong">Kebijakan Privasi</a>
                            </li>
                            <li>
                                <a href="contact.html">Hubungi Kami</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul class="nav-footer text-right">
                            <li>
                                <a href="#">
                                    <i class="fab fa-github"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type='text/x-mathjax-config'>MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
	<script src="{{ asset('/front/node_modules/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('/front/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
	<script src="{{ asset('/front/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/front/js/app.js') }}"></script>

</body>
</html>
