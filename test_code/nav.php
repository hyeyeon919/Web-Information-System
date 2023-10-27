<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min/js"></script>
    </head>
<body>
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