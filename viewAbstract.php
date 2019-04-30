<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.3/examples/dashboard/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>
  <body>

  	<?php
  			$conn=mysqli_connect("localhost","root","","research_conclave20");

              if ($conn-> connect_error) {
                die("connection failed".$conn->connect_error);
                echo "connection failed!!";
              }
            $queryPoster = mysqli_query($conn,"select * from Poster where IsUnderReview = 0 ");
            $queryOral = mysqli_query($conn,"select * from Oral where IsUnderReview = 0 ");
            $queryReviewerPoster = mysqli_query($conn,"select * from Reviewer where EventType = 0 ");
            $queryReviewerOral = mysqli_query($conn,"select * from Reviewer where EventType = 1 ");
            $queryEndDatePoster = mysqli_query($conn,"select * from Events where Type = 0 ");
            $queryEndDateOral = mysqli_query($conn,"select * from Events where Type = 1 ");

            $posterEndDate = "";
            $oralEndDate = "";

            while($poster = mysqli_fetch_array($queryEndDatePoster))
            {
            	$posterEndDate = $poster['EndDate'];
            }

            while($oral = mysqli_fetch_array($queryEndDateOral))
            {
            	$oralEndDate = $oral['EndDate'];
            }


        if (isset($_POST['assign_buttonP']))
		{
		    $Posterid =$_POST['assign_buttonP'];
		    $Reviewer1 = $_POST['Previewer1_select'];
		    $Reviewer2 = $_POST['Previewer2_select'];

		    if ($Reviewer1=="Choose...") {
		    	echo "<script type='text/javascript'>alert('Select Reviewer1');</script>";
		    }
		    else if ($Reviewer2=="Choose...")
		    {
		    	echo "<script type='text/javascript'>alert('Select Reviewer2');</script>";
		    }
		    else if($Reviewer1==$Reviewer2)
		    {
		    	echo "<script type='text/javascript'>alert('Choose different Reviewer1 and Reviewer2');</script>";

		    }
		    else
		    {
		    $conn = new mysqli("localhost","root","","research_conclave20");
		    $posterdisapprovequery = mysqli_query($conn,"UPDATE Poster SET Reviewer_1_Id='$Reviewer1', Reviewer_2_Id='$Reviewer2', IsUnderReview=1 WHERE PosterId='$Posterid'");
		    echo "<script type='text/javascript'>alert('reviewer assigned for'".$Posterid.");</script>";

			}


		}
		if (isset($_POST['assign_buttonO']))
		{
		    $Oralid =$_POST['assign_buttonO'];
		    $Reviewer1 = $_POST['Oreviewer1_select'];
		    $Reviewer2 = $_POST['Oreviewer2_select'];
		    if ($Reviewer1=="Choose...") {
		    	echo "<script type='text/javascript'>alert('Select Reviewer1');</script>";
		    }
		    else if ($Reviewer2=="Choose...")
		    {
		    	echo "<script type='text/javascript'>alert('Select Reviewer2');</script>";
		    }
		    else if($Reviewer1==$Reviewer2)
		    {
		    	echo "<script type='text/javascript'>alert('Choose different Reviewer1 and Reviewer2');</script>";

		    }
		    else
		    {
		    $conn = new mysqli("localhost","root","","research_conclave20");
		    $posterdisapprovequery = mysqli_query($conn,"UPDATE Oral SET Reviewer_1_Id='$Reviewer1', Reviewer_2_Id='$Reviewer2', IsUnderReview=1 WHERE OralId='$Oralid'");
		    echo "<script type='text/javascript'>alert('reviewer assigned for'".$Oralid.");</script>";
			}
		}

    ?>
        
            
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


      <h2>Poster Presentation</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Abstract No.</th>
              <th>Title</th>
              <th>Name of Participant</th>
              <th>username</th>
              <th>Date of Submission</th>
              <th>Reviewer1</th>
              <th>Reviewer2</th>
              <th>Assign Reviewer</th>
            </tr>
          </thead>
          <tbody>
            <?php
            	$selectOption = "";
               	while($reviewer = mysqli_fetch_array($queryReviewerPoster))
               	{
               		$name = $reviewer['FirstName']." ".$reviewer['MiddleName']." ".$reviewer['LastName'];
               		$selectOption = $selectOption.'<option value="'.$reviewer['EmailId'].'">'.$name.'</option>';
               	}
               while ($row = mysqli_fetch_array($queryPoster)) {
               		$name = $row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
                   
                   echo "<tr>";
                   echo "<td>".$row['PosterId']."</td>";
                   echo "<td>".$row['Title']."</td>";
                   echo "<td>".$name."</td>";
                   echo "<td>".$row['Email_Id']."</td>";
                   echo "<td>".$row['DateOfSubmission']."</td>";
                   echo "<td><form method=POST><select name= Previewer1_select><option>Choose...</option>".$selectOption."</select></td>";
                   echo "<td><select name = Previewer2_select><option>Choose...</option>".$selectOption."</select></td>";
                   echo '<td align=center><button  type=submit  name=assign_buttonP value="';echo $row['PosterId']; echo '">Assign</button></form></td>';

               	   echo "</tr>";
               }
            ?>
          </tbody>
        </table>
      </div>
      <h2>Oral Presentation</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Abstract No.</th>
              <th>Title</th>
              <th>Name of Participant</th>
              <th>username</th>
              <th>Date of Submission</th>
              <th>Reviewer1</th>
              <th>Reviewer2</th>
              <th>Assign Reviewer</th>
            </tr>
          </thead>
          <tbody>
            <?php
            	$selectOption = "";
               	while($reviewer = mysqli_fetch_array($queryReviewerOral) )
               	{
               		$name = $reviewer['FirstName']." ".$reviewer['MiddleName']." ".$reviewer['LastName'];
               		$selectOption = $selectOption.'<option value="'.$reviewer['EmailId'].'">'.$name.'</option>';
               	}
               while ($row = mysqli_fetch_array($queryOral)) {
               		$name = $row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
                   echo "<tr>";
                   echo "<td>".$row['OralId']."</td>";
                   echo "<td>".$row['Title']."</td>";
                   echo "<td>".$name."</td>";
                   echo "<td>".$row['Email_Id']."</td>";
                   echo "<td>".$row['DateOfSubmission']."</td>";
                   echo "<td><form method=POST><select name = Oreviewer1_select><option>Choose...</option>".$selectOption."</select></td>";
                   echo "<td><select name = Oreviewer2_select><option>Choose...</option>".$selectOption."</select></td>";
                    echo '<td align=center><button  type=submit  name=assign_buttonO value="';echo $row['OralId']; echo '">Assign</button></form></td>';
               	   echo "</tr>";
               }
            ?>
              
          </tbody>
        </table>
      </div>
    </main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="https://getbootstrap.com/docs/4.3/examples/dashboard/dashboard.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
