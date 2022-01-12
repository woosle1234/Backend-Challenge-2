<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Search Page</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
	<!-- MDB -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.css" rel="stylesheet" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.js"></script>
</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<h1>Search Page</h1>
		</header>

		<!-- Main -->
		<div id="main">

			<!-- Content -->
			<section id="content" class="main">
				<span class="image main"><img src="images/pic04.jpg" alt="" /></span>
				<form method="post">
					<div class="d-flex flex-row p-3 input-group align-items-center border rounded" style="width:100%">
						<div class="p-1 form-outline" style="width:80%">
							<input id="search-input" name="search-input" type="search" id="form1" class="form-control border rounded" style="width:100%" />
							<label class="form-label" for="form1">Search for location, id, name...</label>
						</div>
						<button id="search-button" name="search-button" type="submit" class="p-1 btn btn-primary" style="width:20%">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</form>
				<div style="width:100%;height:600px;overflow-Y:auto;">
					<h2>Table of Listings</h2>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Id</th>
								<th scope="col">Name</th>
								<th scope="col">Neighbourhood</th>
								<th scope="col">Host Id</th>
								<th scope="col">Host Name</th>
								<th scope="col">Price</th>
							</tr>
						</thead>
						<tbody>

							<?php


							if (array_key_exists('search-button', $_POST)) {
								search();
							};



							function search()
							{
								$servername = "localhost";
								$username = "root";
								$password = "Gurpsd&d1";
								$dbname = "prepr";

								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								};

								$searchval = $_POST["search-input"];
								$res = null;
								

								if (is_numeric($searchval)) {

									$sql = "select * from listings where id like '%" . $searchval . "%' or neighbourhood like '%" . $searchval . "%' or host_id like '%" .  $searchval . "%'";
									$res = $conn->query($sql);
								} else {

									$sql = "select * from listings where name like '%" . $searchval . "%' or neighbourhood like '%" . $searchval . "%' or host_name like '%" . $searchval . "%'";
									$res = $conn->query($sql);
								}
								$rows = $res->num_rows;
								while ($row = $res->fetch_assoc()) {
									echo "<tr><th scope='row'>" . $row["id"] . "</th><td>" . $row["name"] . "</td><td>" . $row["neighbourhood"] . "</td><td>" . $row["host_id"] . "</td><td>" . $row["host_name"] . "</td><td>" . $row["price"] . "</td></tr>";
								}
								echo "<h2>".$rows." Search Results</h2>";
								$conn->close();

							};

							?>
						</tbody>
					</table>

				</div>
				<footer class="major">
					<ul class="actions special">
						<li><a href="index.php" class="button">Go Back</a></li>
					</ul>
				</footer>
			</section>
		</div>
		<!-- Footer -->
		<footer id="footer">
			<section>
				<h2>Aliquam sed mauris</h2>
				<p>Sed lorem ipsum dolor sit amet et nullam consequat feugiat consequat magna adipiscing tempus etiam dolore veroeros. eget dapibus mauris. Cras aliquet, nisl ut viverra sollicitudin, ligula erat egestas velit, vitae tincidunt odio.</p>
				<ul class="actions">
					<li><a href="#" class="button">Learn More</a></li>
				</ul>
			</section>
			<section>
				<h2>Etiam feugiat</h2>
				<dl class="alt">
					<dt>Address</dt>
					<dd>1234 Somewhere Road &bull; Nashville, TN 00000 &bull; USA</dd>
					<dt>Phone</dt>
					<dd>(000) 000-0000 x 0000</dd>
					<dt>Email</dt>
					<dd><a href="#">information@untitled.tld</a></dd>
				</dl>
				<ul class="icons">
					<li><a href="#" class="icon brands fa-twitter alt"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands fa-facebook-f alt"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands fa-instagram alt"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon brands fa-github alt"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon brands fa-dribbble alt"><span class="label">Dribbble</span></a></li>
				</ul>
			</section>
			<p class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
		</footer>

	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>