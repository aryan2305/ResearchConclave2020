<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>IITG Research Conclave</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700,900" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
	<link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
</head>
<body>

	<!-- Header -->
	<header id="header" class="transparent-navbar">
		<!-- container -->
		<div class="container">
			<!-- navbar header -->
			<div class="navbar-header">
				<!-- Logo -->
				<div class="navbar-brand">
					<a class="logo" href="index.html">
						<img class="logo-img" src="./img/iitg_sab.png" alt="logo">
						<img class="logo-alt-img" src="./img/iitg_sab.png" alt="logo">
					</a>
				</div>
				<!-- /Logo -->

				<!-- Mobile toggle -->
				<button class="navbar-toggle">
						<i class="fa fa-bars"></i>
					</button>
				<!-- /Mobile toggle -->
			</div>
			<!-- /navbar header -->

			<!-- Navigation -->
			<nav id="nav">
				<ul class="main-nav nav navbar-nav navbar-right">
					<li><a href="#home">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#schedule">Notices</a></li>
					<li><a href="#contact">Contact</a></li>
					<li><a href="generalDisplay.php">Reviewed Abstracts</a></li>
					<li><a href="login.php">Login</a></li>

				</ul>
			</nav>
			<!-- /Navigation -->
		</div>
		<!-- /container -->
	</header>
	<!-- /Header -->

	<!-- Home -->
	<div id="home">
		<!-- background image -->
		<div class="section-bg" style="background-image:url(./img/0001.jpg)" data-stellar-background-ratio="0.5"></div>
		<!-- /background image -->

		<!-- home wrapper -->
		<div class="home-wrapper">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- home content -->
					<div class="col-md-8 col-md-offset-2">
						<div class="home-content">
							<h1>Research Conclave</h1>
							<h4 class="lead">An Amalgamation of Academia, Industry & Start-ups</h4>
							<a href="registration.php" class="main-btn">Register</a>
						</div>
					</div>
					<!-- /home content -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /home wrapper -->
	</div>
	<!-- /Home -->

	<!-- About -->
	<div id="about" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="section-title">
					<h3 class="title"><span>About</span> <span style="color: #dd0a37;">Event</span></h3>
				</div>
				<!-- /section title -->

				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- about content -->
					<div class="about-content">
						<p>Research Conclave is organized under the banner of Students' Academic Board (SAB) of Indian Institute of Technology Guwahati (IITG). It is a staunch platform to nurture the young minds towards research, innovation and entrepreneurship, which intends to bring the integrity of the students towards both industries and academia to redress the academic research challenges, concerns of the entire student community and upcoming entrepreneurs around the globe. It is a forum to harness innovative mind to level-up the economic strata of current society from research to industries. The Research Conclave work as catalyst for building leaders through holistic, transformable and innovative ideas. It has started in 2015 with great rhythm and passion, and this year with the same enthusiasm we are conducting this event in a broader spectrum.</p>
					</div>
					<!-- /about content -->

					
				</div>
			</div>
			<!-- row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /About -->

	<!-- Galery -->
	<div id="galery">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- galery owl -->
				<div id="galery-owl" class="owl-carousel owl-theme">
					
					<!-- galery item -->
					<div class="galery-item">
						<img src="./img/0002.jpg" alt="">
					</div>
					<!-- /galery item -->

					<!-- galery item -->
					<div class="galery-item">
						<img src="./img/0012.jpg" alt="">
					</div>
					<!-- /galery item -->
					<!-- galery item -->
					<div class="galery-item">
						<img src="./img/0014.jpg" alt="">
					</div>
					<!-- /galery item -->
					<!-- galery item -->
					<div class="galery-item">
						<img src="./img/0018.jpg" alt="">
					</div>
					<!-- /galery item -->

				</div>
				<!-- /galery owl -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /Galery -->

	

	<!-- Event Schedule -->
	<div id="schedule" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="section-title">
					<h3 class="title"><span>Event</span> <span style="color: #dd0a37;">Updates</span></h3>
				</div>
				<!-- /section title -->
				<?php
						$conn=mysqli_connect("localhost","root","","research_conclave20");
						if($conn->connect_error)
						{
							die("connection failed".$conn->connect_error);
							echo "Connection Failed!!";
						}
						$query=mysqli_query($conn,"select * from Notice");
				?>
				<div class="col-md-8 col-md-offset-2">

					<div class="events-wrapper">
						<!-- event -->
						<?php
							while ($row = mysqli_fetch_array($query)) {
								echo"<div class=event>
									<div class=event-day>
									<div>
									<span class=year>".$row["PostingDate"]."</span>
									</div>
									</div>";
							echo"<div class=event-content><h3 class=event-title>"
								.$row["NoticeTitle"].
								"</h3><p>"
								.$row["Description"].
								"</p><p> By<a href='#'>"
								.$row["PostedBy"].
								"</a></p>
								</div>
								</div>";
						
							}
						?>
					</div>

					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /Event Schedule -->

	

	

	

	<!-- Contact -->
	<div id="contact" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="section-title">
					<h3 class="title"><span>Contact</span> <span style="color: #dd0a37;">Info</span></h3>
				</div>
				<!-- /section title -->

				<!-- contact -->
				<div class="col-sm-4">
					<div class="contact">
						<h3>Address</h3>
						<p>IIT Guwahati, Guwahati, Assam</p>
					</div>
				</div>
				<!-- /contact -->

				<!-- contact -->
				<div class="col-sm-4">
					<div class="contact">
						<h3>Phone</h3>
						<h4>Faculty Convener</h4>
						<p>Dr. Akshai Kumar A.S.</p>
						<p>+91-8133036890</p>
						<h4>Student Convener</h4>
						<p>Mr. Rupak Bhowmik</p>
						<p>+91-9436747353</p>
					</div>
				</div>
				<!-- /contact -->

				<!-- contact -->
				<div class="col-sm-4">
					<div class="contact">
						<h3>Email</h3>
						<a href="#">research_conclave@iitg.ac.in</a>
						<a href="#">researchconclave.iitg@gmail.com</a>
					</div>
				</div>
				<!-- /contact -->

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->

		
	</div>
	<!-- /Contact -->



	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/jquery.countTo.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
