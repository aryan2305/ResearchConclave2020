<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();

echo $_SESSION["username"];
$host="localhost";
$db="research_conclave20";
$dsn= "mysql:host=$host;dbname=$db";
$conn=new mysqli($host,"root","",$db);

$posterStartDate = date("Y-m-d");
$posterEndDate = date("Y-m-d");
$oralStartDate = date("Y-m-d");
$oralEndDate = date("Y-m-d");

$queryPosterDate = mysqli_query($conn,"SELECT * FROM Events WHERE Type = '0' ");

while ($row = mysqli_fetch_array($queryPosterDate)) {
  $posterStartDate = $row['StartDate'];
  $posterEndDate = $row['EndDate'];
}

$queryOralDate = mysqli_query($conn,"SELECT * FROM Events WHERE Type = '1' ");

while ($row = mysqli_fetch_array($queryOralDate)) {
  $oralStartDate = $row['StartDate'];
  $oralEndDate = $row['EndDate'];
}

echo $posterStartDate;
echo $posterEndDate;
echo $oralStartDate;
echo $oralEndDate;


  
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    // $noticetitle=$_POST["noticeTitle"]; 
    // $Description=$_POST["description"];
    // $postingdate=date("Y/m/d"); 
    // $event=$_POST["eventType"];
    // $eventtype=0;
    // $postedBy = "FacultyConvener";
    // if($event=="oral")
    // {
    //   $eventtype=1;
    // }
    // else
    // {
    //   $eventtype=0;
    // }
    $startDo=$_POST["sDateOral"];
    $endDo=$_POST["eDateOral"];
    $startDp=$_POST["sDatePoster"];
    $endDp=$_POST["eDatePoster"];
    
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
      echo "failed";
    }
  //  echo $username."  ".$pwd;
  //  echo $conn;
    $query="UPDATE Events SET StartDate='$startDo' ,EndDate='$endDo' WHERE Type=1";
    $query1="UPDATE Events SET StartDate='$startDp' ,EndDate='$endDp' WHERE Type=0";


    try{
      $result=$conn->query($query1);
      $result=$conn->query($query);
    }
    catch(Exception $e){
      echo "error is".$e;
    }
    header("Location: ./facultyChangeDates.php");


    $conn->close();


  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Dashboard Faculty</title>

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
  <body>
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
            <a class="nav-link" href="dashboardFaculty.php">
              <span data-feather="layers"></span>
              Add Notice
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addReviewer.php">
              <span data-feather="layers"></span>
              Add Reviewer
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="facultyApproveReviewer.php">
              <span data-feather="file-text"></span>
              Approve Reviewers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reportFaculty.php">
              <span data-feather="file-text"></span>
              See all Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="facultyChangeDates.php">
              <span data-feather="file-text"></span>
                Change Date
            </a>
          </li>           
        </ul>
      </div>
    </nav>

    <main id="main" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Change Dates</h1>        
      </div>

      <div>
        <form action="facultyChangeDates.php" method="POST">
          <h2>Oral:</h2>
          <br>
          <br>
          <?php 
            echo '<label for="sDateO">Start Date: '.$oralStartDate.'</label>';
          ?>
          <input type="date" id="sDateO" name="sDateOral" placeholder="" required>
          <?php 
            echo '<label for="eDateO">End Date: '.$oralEndDate.'</label>';
          ?>
          <input type="date" id="eDateO" name="eDateOral" placeholder="End Date.." required>
          <h2>Poster:</h2>
          <br>
          <br>
          <?php 
            echo '<label for="sDateP">Start Date: '.$posterStartDate.'</label>';
          ?>
          <input type="date" id="sDateP" name="sDatePoster" placeholder="Start Date.." required>
          <?php 
            echo '<label for="eDateP">End Date: '.$posterEndDate.'</label>';
          ?>
          <input type="date" id="eDateP" name="eDatePoster" placeholder="End Date.." required>
          <input type="submit" value="Submit">
        </form>
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