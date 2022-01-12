<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Login Page</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<h1>Login Page</h1>
		</header>

		<!-- Main -->
		<div id="main">

			<!-- Content -->
			<section id="content" class="main">
				<?php


				if (array_key_exists('Login', $_POST)) {
					login($_POST["email"],$_POST["password"]);
				}else if(isset($_COOKIE['email'])){
					login($_COOKIE['email'],$_COOKIE['password']);
				}
				function login($email,$pwd)
				{
					$servername = "localhost";
					$username = "root";
					$password = "Gurpsd&d1";
					$dbname = "prepr";

					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					$sql = "select * from users where password='" . $pwd . "' and email='" . $email . "'";
					$res = $conn->query($sql);

					if($res->num_rows>0){
						while($row = $res->fetch_assoc()){
							echo "Logged In - Display Name: ".$row["display_name"];
							setcookie("email",$email);
							setcookie("password",$pwd);
						}
					}else{
						echo "Error: Invalid Email or Password";
					}

					$conn->close();
				}

				?>

				<form method="post">
					<div class="mb-3 form-group">
						<label for="email">Email address</label>
						<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
					</div>
					<div class="mb-3 form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
					</div>
					<button type="submit" id="Login" name="Login" class="btn btn-primary">Login</button>
				</form>




				<footer class="major">
					<ul class="actions special">
						<li><a href="index.php" class="button primary">Go Back</a></li>
						<li><a href="Sign Up.php" class="button">Sign Up</a></li>
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

</body>

</html>