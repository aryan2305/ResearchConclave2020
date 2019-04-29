<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();


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

if (isset($_POST['posterapprove']))
{
    $comment = $_POST['comment'];
    $posterid = $_POST['posterapprove'];
    $conn = new mysqli("localhost","root","","research_conclave20");
    $posterapprovequery = mysqli_query($conn,"UPDATE Poster SET IsUnderReview=2, comment='$comment' WHERE PosterId='$posterid'");
    echo "<script type='text/javascript'>alert('reviewer approved for'".$posterid.");</script>";

}
if (isset($_POST['posterdisapprove']))
{
    $comment = $_POST['comment'];
    $posterid = $_POST['posterdisapprove'];
    $conn = new mysqli("localhost","root","","research_conclave20");
    $posterapprovequery = mysqli_query($conn,"UPDATE Poster SET IsUnderReview=3, comment='$comment' WHERE PosterId='$posterid'");
    echo "<script type='text/javascript'>alert('reviewer disapproved for'".$posterid.");</script>";

}
if (isset($_POST['oralapprove']))
{
    $comment = $_POST['comment'];
    $oralid = $_POST['oralapprove'];
    $conn = new mysqli("localhost","root","","research_conclave20");
    $posterapprovequery = mysqli_query($conn,"UPDATE Oral SET IsUnderReview=2, comment='$comment' WHERE OralId='$oralid'");
    echo "<script type='text/javascript'>alert('reviewer approved for'".$oralid.");</script>";
}
if (isset($_POST['oraldisapprove']))
{
    $comment = $_POST['comment'];
    $oralid = $_POST['oraldisapprove'];
    $conn = new mysqli("localhost","root","","research_conclave20");
    $posterapprovequery = mysqli_query($conn,"UPDATE Oral SET IsUnderReview=3, comment='$comment' WHERE OralId='$oralid'");
    echo "<script type='text/javascript'>alert('reviewer disapproved for'".$oralid.");</script>";
}
?>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Research Conclave</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="home"></span>
              Reviewed Application <span class="sr-only">(current)</span>
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Submit Abstract

            </a>
          </li>
        </ul>

       
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link active" href="facultyApproveReviewer.php">
              <span data-feather="file-text"></span>
              Approve Reviewer
            </a>
          </li>
          
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Abstract to Approve</h1>        
      </div>

      <div>
      <h2>Poster Presentations</h2>

        <?php
            $conn = new mysqli("localhost","root","","research_conclave20");
//            TODO apply and reviewer1 and reviewer2 is not null condition
            $posterquery = mysqli_query($conn,"select * from Poster where IsUnderReview = 1");

            $posteridarray = array();
            $posterindex=0;

            while($row=mysqli_fetch_assoc($posterquery))
            {

                $posteridarray[$posterindex]=$row['PosterId'];

//                echo $posteridarray[$posterindex];
                echo '<div class="card mb-5">
                    <h5 class="card-header">';
                echo $row['PosterId']." : ".$row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
                echo '</h5><div class="card-body"><h5 class="card-title">';
                echo $row['Title'];
                echo '</h5>';
                echo '<p class="card-text">';
                echo $row['Description'];
                echo '</div><h5 class="card-header"> Reviewer1:';
                echo $row['Reviewer_1_Id'];
                echo '<br>Reviewer2:';
                echo $row['Reviewer_2_Id'];
                echo '</h5>';
                echo '<form method="post"><textarea type="text" name="comment" placeholder="comment"></textarea>
                        <button class="btn btn-danger" type="submit" name="posterdisapprove" value="';echo $posteridarray[$posterindex]; echo '">Disapprove</button>
                        <button class="btn btn-primary" type="submit"  name="posterapprove" value="';echo $posteridarray[$posterindex]; echo '">Approve</button></form></div>';
//                echo '</p><a href="#" class="btn btn-primary">File</a>
//                        </div>
//                    </div>';
                $posterindex++;
            }
            ?>
            <h2>Oral Presentations</h2>
            <?php
            $oralquery = mysqli_query($conn,"select * from Oral where IsUnderReview = 1");
            $oralidarray=array();
            $oralindex=0;
            while($row=mysqli_fetch_assoc($oralquery))
            {
                $oralidarray[$oralindex]=$row['OralId'];

                echo '<div class="card mb-5">
                    <h5 class="card-header">';
                echo $row['OralId']." : ".$row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
                echo '</h5><div class="card-body"><h5 class="card-title">';
                echo $row['Title'];
                echo '</h5>';
                echo '<p class="card-text">';
                echo $row['Description'];
                echo '</div><h5 class="card-header"> Reviewer1:';
                echo $row['Reviewer_1_Id'];
                echo '<br>Reviewer2:';
                echo $row['Reviewer_2_Id'];
                echo '</h5>';
                echo '<form method="post"><textarea type="text" name="comment" placeholder="comment"></textarea>
                        <button class="btn btn-danger" type="submit" name="oraldisapprove" value="';
                        echo $oralidarray[$oralindex];
                        echo '">Disapprove</button>
                        <button class="btn btn-primary" name="oralapprove" value="';
                        echo $oralidarray[$oralindex];
                        echo '">Approve</button></form></div>';
                $oralindex++;
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