
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Blog List</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta_tags')
	<link rel="icon" href="/images/site/{{ settings()->site_favicon }}">
	<link rel="stylesheet" href="/front/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="/front/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/front/css/fonts.css">
	<link rel="stylesheet" href="/front/css/styles.css">
    <link rel="stylesheet" href="/themify-icons/themify-icons.css">
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
							<img src="/images/site/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}" alt="Logo" class="rounded">
						</a>
						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
				          <span class="navbar-toggler-icon"></span>
				        </button>
				        <div id="navbarMain" class="collapse navbar-collapse">
				        	<ul class="navbar-nav mr-auto">
				        		<li class="nav-item">
				        			<a href="/" class="nav-link">Home</a>
				        		</li>
				        		{!! navigations() !!}
				        		<li class="nav-item">
				        			<a href="about.html" class="nav-link">About</a>
				        		</li>
				        		<li class="nav-item">
				        			<a href="contact.html" class="nav-link">Contact</a>
				        		</li>
				        	</ul>
				        	<form action="{{ route('search_posts') }}" method="GET" class="form-inline" role="search" >
                                <input type="search" id="search-query" class="form-control rounded-0" placeholder="Search" value="{{ request('q') ? request('q') : '' }}" name="q">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
				            </form>
				            <ul class="navbar-nav navbar-social">
				        		<li class="nav-item">
				        			<a href="#" class="nav-link">
				        				<i class="fab fa-github"></i>
				        			</a>
				        		</li>
				        		<li class="nav-item">
				        			<a href="#" class="nav-link">
				        				<i class="fab fa-linkedin"></i>
				        			</a>
				        		</li>
				        	</ul>
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
	
	<!-- footer-main -->
	<footer class="footer-main">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
                            <a href="../" class="footer-brand">
                                <img src="/images/site/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}"
                                    alt="Logo" class="rounded">
                            </a>
						</li>
                        <li class="list-group-item">
                            <p>{{ settings()->site_meta_description }}</p>
                            <p>&copy; I Putu Darma Putra {{ date('Y') }}</p>
                        </li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<h4>Most Commented</h4>
						</li>
						<li class="list-group-item">
							<a href="blog-post.html">Lorem ipsum dolor sit amet</a>
							<small>Jan 25, 2018</small>
						</li>
						<li class="list-group-item">
							<a href="blog-post.html">Lorem ipsum dolor sit amet</a>
							<small>Jan 25, 2018</small>
						</li>
						<li class="list-group-item">
							<a href="blog-post.html">Lorem ipsum dolor sit amet</a>
							<small>Jan 25, 2018</small>
						</li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<h4>Best Rated</h4>
						</li>
						<li class="list-group-item">
							<a href="blog-post.html">Lorem ipsum dolor sit amet</a>
							<small>Jan 25, 2018</small>
						</li>
						<li class="list-group-item">
							<a href="blog-post.html">Lorem ipsum dolor sit amet</a>
							<small>Jan 25, 2018</small>
						</li>
						<li class="list-group-item">
							<a href="blog-post.html">Lorem ipsum dolor sit amet</a>
							<small>Jan 25, 2018</small>
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
								<a href="#" data-toggle="modal" data-target="#exampleModalLong">Terms &amp; Conditions</a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#exampleModalLong">Privacy policy</a>
							</li>
							<li>
								<a href="contact.html">Contact us</a>
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
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- end footer-main -->

	<!-- modal -->
	<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
					</button>
				</div>
				<div class="modal-body">
					<!-- main-post -->
					<div class="main-post">
						<div class="post-content">
							<h2>Donec ac orci lorem. Aenean venenatis molestie</h2>
							<p>
								Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipisicing elit. Mollitia eos sint at. Minima tempore inventore ducimus corrupti harum ex, expedita optio est obcaecati necessitatibus fugit aut, quibusdam repellat recusandae alias.
							</p>
							<p>
								<em>Lorem ipsum</em> dolor sit amet, consectetur adipiscing elit. Donec ac orci lorem. Aenean venenatis molestie dignissim. Praesent et arcu non risus ullamcorper consequat id at felis. Vestibulum vel ullamcorper tellus. Fusce eleifend fringilla blandit. Maecenas cursus enim viverra laoreet lacinia. Nullam id leo ipsum. Cras in lorem urna. Phasellus ac ornare dolor.
							</p>
							<h2>Donec ac orci lorem. Aenean venenatis molestie</h2>
							<p>
								Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipisicing elit. Mollitia eos sint at. Minima tempore inventore ducimus corrupti harum ex, expedita optio est obcaecati necessitatibus fugit aut, quibusdam repellat recusandae alias.
							</p>
							<figure class="figure-img">
								<img src="/front/assets/images/post-4.jpg" alt="">
							</figure>
							<p>
								<em>Lorem ipsum</em> dolor sit amet, consectetur adipiscing elit. Donec ac orci lorem. Aenean venenatis molestie dignissim. Praesent et arcu non risus ullamcorper consequat id at felis. Vestibulum vel ullamcorper tellus. Fusce eleifend fringilla blandit. Maecenas cursus enim viverra laoreet lacinia. Nullam id leo ipsum. Cras in lorem urna. Phasellus ac ornare dolor.
							</p>
							<p>
								<em>Lorem ipsum</em> dolor sit amet, consectetur adipiscing elit. Donec ac orci lorem. Aenean venenatis molestie dignissim. Praesent et arcu non risus ullamcorper consequat id at felis. Vestibulum vel ullamcorper tellus. Fusce eleifend fringilla blandit. Maecenas cursus enim viverra laoreet lacinia. Nullam id leo ipsum. Cras in lorem urna. Phasellus ac ornare dolor.
							</p>
							<figure class="figure-img center-img" style="max-width: 300px;">
								<img src="/front/assets/images/post-11.jpg" alt="">
								<figcaption>So Lorem Ipsum is bad (not necessarily)</figcaption>
							</figure>
							<p>
								<em>Lorem ipsum</em> dolor sit amet, consectetur adipiscing elit. Donec ac orci lorem. Aenean venenatis molestie dignissim. Praesent et arcu non risus ullamcorper consequat id at felis. Vestibulum vel ullamcorper tellus. Fusce eleifend fringilla blandit. Maecenas cursus enim viverra laoreet lacinia. Nullam id leo ipsum. Cras in lorem urna. Phasellus ac ornare dolor.
							</p>
							<ul>
								<li>Nullam id leo ipsum</li>
								<li>Lorem ipsum dolor sit amet</li>
								<li>Maecenas cursus enim viverra</li>
								<li>Phasellus ac ornare</li>
							</ul>
							<p>
								Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipisicing elit. Mollitia eos sint at. Minima tempore inventore ducimus corrupti harum ex, expedita optio est obcaecati necessitatibus fugit aut, quibusdam repellat recusandae alias.
							</p>
							<h3>Donec ac orci lorem. Aenean venenatis molestie dignissim.</h3>
							<p>
								Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipisicing elit. Mollitia eos sint at. Minima tempore inventore ducimus corrupti harum ex, expedita optio est obcaecati necessitatibus fugit aut, quibusdam repellat recusandae alias.
							</p>
							<blockquote>
								I have heard the argument that lorem ipsum is effective in wireframing or design because it helps people focus on the actual layout, or color scheme, or whatever. What kills me here is that we’re talking about creating a user experience that will (whether we like it or not) be DRIVEN by words. The entire structure of the page or app flow is FOR THE WORDS.
							</blockquote>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac orci lorem. Aenean venenatis molestie dignissim. Praesent et arcu non risus ullamcorper <a href="#">consequat id at felis</a>. Vestibulum vel ullamcorper tellus. Fusce eleifend fringilla blandit. Maecenas cursus enim viverra laoreet lacinia. Nullam id leo ipsum. Cras in lorem urna. Phasellus ac ornare dolor.
							</p>
							<figure class="figure-img left-img" style="max-width: 300px;">
								<img src="/front/assets/images/post-9.jpg" alt="">
								<figcaption>So Lorem Ipsum is bad (not necessarily)</figcaption>
							</figure>
							<p>
								Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipisicing elit. Mollitia eos sint at. Minima tempore inventore ducimus corrupti harum ex, expedita optio est obcaecati necessitatibus fugit aut, quibusdam repellat recusandae alias.
							</p>
							<p>
								Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipisicing elit. Mollitia eos sint at. Minima tempore inventore ducimus corrupti harum ex, expedita optio est obcaecati necessitatibus fugit aut, quibusdam repellat recusandae alias.
							</p>
							<ol>
								<li>Nullam id leo ipsum</li>
								<li>Lorem ipsum dolor sit amet</li>
								<li>Maecenas cursus enim viverra</li>
								<li>Phasellus ac ornare</li>
							</ol>
							<h4>Vestibulum vel ullamcorper tellus</h4>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia eos sint at. Minima tempore inventore ducimus corrupti harum ex, expedita optio est <del>obcaecati necessitatibus</del> fugit aut, quibusdam repellat recusandae alias.
							</p>
							<h5>Vestibulum vel ullamcorper tellus</h5>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac orci lorem. Aenean venenatis molestie dignissim. Praesent et arcu non risus ullamcorper consequat id at felis. Vestibulum vel ullamcorper tellus. Fusce eleifend fringilla blandit. Maecenas cursus enim viverra laoreet lacinia. Nullam id leo ipsum. Cras in lorem urna. Phasellus ac ornare dolor.
							</p>
							<figure class="figure-img right-img" style="max-width: 300px;">
								<img src="/front/assets/images/post-9.jpg" alt="">
								<figcaption>So Lorem Ipsum is bad (not necessarily)</figcaption>
							</figure>
							<p>
								Lorem ipsum dolor sit amet, <mark>consectetur</mark> adipisicing elit. Mollitia eos sint at. Minima tempore inventore ducimus corrupti harum ex, expedita optio est obcaecati necessitatibus fugit aut, quibusdam repellat recusandae alias.
							</p>
							<table class="table table-dark">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">First</th>
										<th scope="col">Last</th>
										<th scope="col">Handle</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Mark</td>
										<td>Otto</td>
										<td>@mdo</td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Jacob</td>
										<td>Thornton</td>
										<td>@fat</td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td>Larry</td>
										<td>the Bird</td>
										<td>@twitter</td>
									</tr>
								</tbody>
							</table>
							<h6>Donec ac orci lorem. Aenean venenatis molestie dignissim.</h6>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac orci lorem. Aenean venenatis molestie dignissim. Praesent et arcu non risus ullamcorper consequat id at felis. Vestibulum vel ullamcorper tellus. Fusce eleifend fringilla blandit. Maecenas cursus enim viverra laoreet lacinia. Nullam id leo ipsum. Cras in lorem urna. Phasellus ac ornare dolor.
							</p>
						</div>
					</div>
					<!-- end main-post -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal -->

	<script src="/front/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="/front/node_modules/popper.js/dist/umd/popper.min.js"></script>
	<script src="/front/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/front/js/app.js"></script>
</body>
</html>