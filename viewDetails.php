<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();

$Abstractid = $_SESSION["AbstractId"];
$eventName = $_SESSION["EventName"];
$EventType = $_SESSION["EventType"] ;
$Reviewer_No =  $_SESSION["Reviewer_No"];


echo $Abstractid;
echo $eventName;
echo $EventType;
echo $Reviewer_No;

$eventId = "OralId";

if ($EventType==0) {
  $eventId = "PosterId";
}
else
{
  $eventId = "OralId";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>s

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard-Faculty</title>

    <!-- Custom fonts for this template-->
    <link href="../css/Participant/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../css/Participant/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/Participant/sb-admin.css" rel="stylesheet">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.3/examples/dashboard/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <style>
    input[type=text], select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[id=desText]{
      width: 100%;
      height: 200px;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=submit] {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=date] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

    div {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
    }
    </style>

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

<body id="page-top">
<?php

if (isset($_POST['submitGrade']))
{

   
    $review = $_POST['review'];
    $grade = $_POST['grade'];
    $conn = new mysqli("localhost","root","","research_conclave20");
    $reportName = "Report_1";
    $gradeName = "Grade_1";
    $reviewedByflag = "reviewdBy1";
    if ($Reviewer_No==2) {
      $reportName = "Report_2";
    $gradeName = "Grade_2";
    $reviewedByflag = "reviewdBy2";

    }





    if ($review=="") {
      
      echo "<script type='text/javascript'>alert('Fill the review text box.');</script>";
    }
    else if ($grade==null) {
      echo "<script type='text/javascript'>alert('Fill the grade.');</script>";
    }
    else if ($grade>10) {
      echo "<script type='text/javascript'>alert('Fill the grade out of 10');</script>";
    }
    else
    {
      
      $conn = new mysqli("localhost","root","","research_conclave20");
      $posterapprovequery = mysqli_query($conn,"UPDATE $eventName SET $reportName='$review',$gradeName=$grade, $reviewedByflag=1 WHERE $eventId='$Abstractid'");
      echo "<script type='text/javascript'>alert('Report has been submitted for".$Abstractid."');</script>";

      header("Location: ./dashboardReviewer.php");
    }


}

?>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Research Conclave</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="index.php">Sign out</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="dashboardReviewer.php">
              <span data-feather="home"></span>
              Assigned Abstracts <span class="sr-only">(current)</span>
            </a>
          </li>
          
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Details of Abstract</h1>        
      </div>

      <div>
        <?php
//            TODO apply and reviewer1 and reviewer2 is not null condition
      $conn = new mysqli("localhost","root","","research_conclave20");

            $abstractquery = mysqli_query($conn,"select * from $eventName where $eventId = '$Abstractid'");



            while($row=mysqli_fetch_assoc($abstractquery))
            {

                $participant = $row['Email_Id'];
                $conn = new mysqli("localhost","root","","research_conclave20");

                $participantquery = mysqli_query($conn,"select * from ParticipantDetail where userEmailId = '$participant'");

                $Namep = "";
                $Instituep = "";
                $Addressp = "";
                $Cityp = "";
                $Statep = "";
                $PinCodep = "";
                $Programmep = "";
                $Branchp = "";
                $GraduatingYearp = "";

                while($p = mysqli_fetch_array($participantquery))
                {
                    $Namep = $p['FirstName']." ".$p['MiddleName']." ".$p['LastName'];
                    $Instituep = $p['Institue'];
                    $Addressp = $p['Address'];
                    $Cityp = $p['City'];
                    $Statep = $p['State'];
                    $PinCodep = $p['PinCode'];
                    $Programmep = $p['Programme'];
                    $Branchp = $p['Branch'];
                    $GraduatingYearp = $p['GraduatingYear'];
                }

                echo '<div class="card mb-5">
                    <div class="card-header"><h4>';
                echo $Abstractid." : ".$row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
                echo '</h4></div><div class="card-body"><h5 class="card-title">';
                echo $row['Title'];
                echo '</h5>';
                echo '<p class="card-text">';
                echo $row['Description'];
                echo '</p><h6 class="card-title"> Participant Details:</h6>';
                echo '<p class="card-text">';
                echo $Namep.'<br>';
                echo $Programmep.'<br>';
                echo $Branchp.',<br>';
                echo $Instituep.'<br>';
                echo $Addressp.', '.$Cityp.'<br>';
                echo $Statep.'-'.$PinCodep.'<br>';
                echo 'Graduating Year:'.$GraduatingYearp;
                echo '<br>email : '.$row['Email_Id'];
                echo '</p><form method="post"><button class="btn btn-danger" type="submit" name="downloadFile" value="';echo $Abstractid; echo '">Download Abstract</button>
                        </form>';
                echo '</p><form method="post"><textarea type="text" name="review" placeholder="Review"></textarea>
                        <br><label for="grade">Grade(Out of 10)</label>
                        <input type="number" id="grade" name="grade" placeholder="0">
                        <br><button class="btn btn-danger" type="submit" name="submitGrade" value="';echo $Abstractid; echo '">Submit Grade</button>
                        </form></div></div>';
//                echo '</p><a href="#" class="btn btn-primary">File</a>
//                        </div>
//                    </div>';
            }
            ?>
            
      </div>

      
    </main>
  </div>
</div>


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