<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Information Page</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	</noscript>
</head>

<body class="is-preload">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<h1>Information Page</h1>
		</header>

		<!-- Main -->
		<div id="main">

			<?php
			$servername = "localhost";
			$username = "root";
			$password = "Gurpsd&d1";
			$dbname = "prepr";

			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql1 = "select neighbourhood from listings group by neighbourhood";
			$result1 = $conn->query($sql1);


			?>

			<!-- Content -->
			<section id="content" class="main">
				<span class="image main"><img src="images/pic04.jpg" alt="" /></span>
				<!-- Steal Listings -->
				<h2>Steal listings</h2>
				<div style="width:100%;height:600px;overflow-Y:auto;">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Id</th>
								<th scope="col">Name</th>
								<th scope="col">Neighbourhood</th>
								<th scope="col">Price</th>
								<th scope="col">Average Price</th>
							</tr>
						</thead>
						<tbody>
							<?php

							if ($result1->num_rows > 0) {
								// output data of each row
								while ($row1 = $result1->fetch_assoc()) {
									$sql2 = 'select AVG(price), neighbourhood from listings where neighbourhood="' . $row1["neighbourhood"] . '" group by neighbourhood';
									$result2 = $conn->query($sql2);
									while ($row2 = $result2->fetch_assoc()) {
										$avgvalue = 0.9 * $row2["AVG(price)"];
										$sql3 = 'select * from listings where price<=' . $avgvalue . ' and neighbourhood="' . $row2["neighbourhood"] . '"';
										$result3 = $conn->query($sql3);
										while ($row3 = $result3->fetch_assoc()) {
											echo "<tr><th scope='row'>" . $row3["id"] . "</th><td>" . $row3["name"] . "</td><td>" . $row3["neighbourhood"] . "</td><td>" . $row3["price"] . "</td><td>" . $row2["AVG(price)"] . "</td></tr>";
										}
									}
								}
							} else {
								echo "0 results";
							}




							?>
						</tbody>
					</table>
				</div>
				<!-- Popular Listing -->
				<h2>Popular Listing - Top 10</h2>
				<div style="width:100%;height:600px;overflow-Y:auto;">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Id</th>
								<th scope="col">Name</th>
								<th scope="col">Neighbourhood</th>
								<th scope="col">Price</th>
								<th scope="col">Reviews Per Month</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql4 = "select * from listings order by reviews_per_month DESC, calculated_host_listings_count DESC limit 0, 10";
							$result4 = $conn->query($sql4);
							while ($row4 = $result4->fetch_assoc()) {
								echo "<tr><th scope='row'>" . $row4["id"] . "</th><td>" . $row4["name"] . "</td><td>" . $row4["neighbourhood"] . "</td><td>" . $row4["price"] . "</td><td>" . $row4["reviews_per_month"] . "</td></tr>";
							}
							?>
						</tbody>
					</table>
				</div>

				<!-- Neighbourhood Rankings -->
				<h2>Neighbourhood Rankings - </h2>
				<div style="width:100%;height:600px;overflow-Y:auto;">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Neighbourhood</th>
								<th scope="col">Average Price</th>
								<th scope="col">Max Price</th>
								<th scope="col">Minimum Price</th>
								<th scope="col">Number of Reviews</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql5 = "select neighbourhood, AVG(price), MAX(price), MIN(price), SUM(number_of_reviews) from listings where price!=0 and price is not null group by neighbourhood order by SUM(number_of_reviews) DESC limit 0,10";
								$result5 = $conn->query($sql5);
								while ($row5 = $result5->fetch_assoc()) {
									echo "<tr><th scope='row'>".$row5["neighbourhood"]."</th><td>".$row5["AVG(price)"]."</td><td>".$row5["MAX(price)"]."</td><td>".$row5["MIN(price)"]."</td><td>".$row5["SUM(number_of_reviews)"]."</td></tr>";
								}
								$conn->close();
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

</body>

</html>