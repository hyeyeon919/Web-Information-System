<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min/js"></script>
    </head>
<body>
	<!-- containers and grids -->
    <div class = "container">
        <div class = "bg-success">
            <h2> Hello world - fixed width</h2>
        </div>
    </div>
    <div class = "container-fluid">
        <div class ="row">
            <div class="col-8 bg-danger">
                <h3> Hello world - span 8</h3>
            </div>
            <div class = "col-4 bg-warning">
                <h3> Hello world - span 4</h3>
            </div>
        </div>
    </div>

	<!-- forms -->
	<div class="container">
		<div class="col-4 offset-2">
			<h2>Please sigh in</h2>
			<form id="form-login">
				<input type="email" placeholder="Email address" class="form-contorl" require autofocus>
				<input type="password" placeholder="Password" class="form-control" required>
				<input type="checkbox"> Remember me
				<button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
			</form>
		</div>
	</div>

	<!-- images -->
	<div class="col-6 offset-2">
		<h2>Images</h2>
		<img src = "https://icatcare.org/app/uploads/2018/07/Thinking-of-getting-a-cat.png"
		alt="cannot find" class="rounded-circle img-fluid">
	</div>
	<!-- navbars -->
	<nav class="navbar navbar-expand-sm bg-light">
		<ul class="navbar-nav">
			<!-- standard link -->
			<li class="nav-item">
				<a class="nav-link" href="#">Link 1</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Link 2</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Link 3</a>
			</li>

			<!-- dropdown -->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
					dropdown link
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">Dlink 1</a>
					<a class="dropdown-item" href="#">Dlink 2</a>
					<a class="dropdown-item" href="#">Dlink 3</a>
				</div>
			</li>
		</ul>
		<!-- inline form -->
		<form class="form-inline" action="/action_page.php">
			<input class="form-control mr-sm-2" type="text" placeholder="Search">
			<button class="btn btn-success" type="submit">Search</button>
		</form>
	</nav>
</body>