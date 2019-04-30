<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reviewed Abstracts</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images1/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts1/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css1/util.css">
	<link rel="stylesheet" type="text/css" href="css1/main.css">
<!--===============================================================================================-->
</head>
<body>
	<?php
  			$conn=mysqli_connect("localhost","root","","research_conclave20");

              if ($conn-> connect_error) {
                die("connection failed".$conn->connect_error);
                echo "connection failed!!";
              }
            $queryPoster = mysqli_query($conn,"select * from Poster where reviewdBy1 = 1 AND reviewdBy2=1 ");
            $queryOral = mysqli_query($conn,"select * from Oral where reviewdBy1 = 1 AND reviewdBy2=1");

    ?>
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<h2>Poster Presentation</h2>
				<hr>

				<div class="table100 ver1 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">PosterId</th>
									<th class="cell100 column2">Title</th>
									<th class="cell100 column3">Name of Participant</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody>
								<?php
						        	
						           while ($row = mysqli_fetch_array($queryPoster)) {
						           		$name = $row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
						               
						               echo "<tr>";
						               echo "<td class='cell10 column1'>".$row['PosterId']."</td>";
						               echo "<td class='cell10 column1'>".$row['Title']."</td>";
						               echo "<td class='cell10 column1'>".$name."</td>";
						               echo "</tr>";
						           }
						        ?>
							</tbody>
						</table>
					</div>
				</div>
				<h2>Oral Presentation</h2>
				<hr>
				<div class="table100 ver1 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell10 column1">OralId</th>
									<th class="cell10 column2">Title</th>
									<th class="cell10 column3">Name of Participant</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody>
								<?php
						        	
						           while ($row = mysqli_fetch_array($queryOral)) {
						           		$name = $row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
						               
						               echo "<tr>";
						               echo "<td class='cell10 column1'>".$row['OralId']."</td>";
						               echo "<td class='cell10 column1'>".$row['Title']."</td>";
						               echo "<td class='cell10 column1'>".$name."</td>";
						               echo "</tr>";
						           }
						        ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


<!--===============================================================================================-->	
	<script src="vendor1/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/bootstrap/js/popper.js"></script>
	<script src="vendor1/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
			
		
	</script>
<!--===============================================================================================-->
	<script src="js1/main.js"></script>

</body>
</html>