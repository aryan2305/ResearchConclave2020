<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();
$conn=mysqli_connect("localhost","root","","research_conclave20");

$username = $_SESSION["username"];
$EventType = 1;
$eventName = "Oral";
$eventId = "OralId";
echo $username;
$query = mysqli_query($conn,"select EventType from Reviewer where EmailId = '$username'");
try{

      $result=mysqli_fetch_assoc($query);
      echo $result['EventType'];
      $EventType = $result['EventType'];
    }
    catch(Exception $e){
      echo "error is".$e;
    }
if ($EventType==0) {
  $eventName="Poster";
  $eventId = "PosterId";
}
echo $eventName;
echo $EventType;
echo $eventId;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Dashboard Reviewer</title>

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

      if ($conn-> connect_error) {
        die("connection failed".$conn->connect_error);
        echo "connection failed!!";
      }
      $queryAbstract1 = mysqli_query($conn,"select * from $eventName where Reviewer_1_Id = '$username'");
      echo "select * from $eventName where Reviewer_1_Id = $username";
      $queryAbstract2 = mysqli_query($conn,"select * from $eventName where Reviewer_2_Id = '$username'");

      if (isset($_POST['viewDetails1']))
      {
        $Abstractid =$_POST['viewDetails1'];
        $_SESSION["AbstractId"] = $Abstractid;
        $_SESSION["EventName"] = $eventName;
        $_SESSION["EventType"] = $EventType;
        $_SESSION["Reviewer_No"] = 1;

        header("Location: ./viewDetails.php");
      }


      if (isset($_POST['viewDetails2']))
      {
        $Abstractid =$_POST['viewDetails2'];
        $_SESSION["AbstractId"] = $Abstractid;
        $_SESSION["EventName"] = $eventName;
        $_SESSION["EventType"] = $EventType;
        $_SESSION["Reviewer_No"] = 2;

        header("Location: ./viewDetails.php");
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
        <h1 class="h2">Assigned Abstracts</h1>        
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Abstract No.</th>
              <th>Title</th>
              <th>Name of Participant</th>
              <th>View Details</th>
            </tr>
          </thead>
          <tbody>
            <?php
               while ($row = mysqli_fetch_array($queryAbstract1)) {
                  $name = $row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
                   if ($row['reviewdBy1']==1) {
                   }
                   else
                   {
                   echo "<tr>";
                   echo "<td>".$row[$eventId]."</td>";
                   echo "<td>".$row['Title']."</td>";
                   echo "<td>".$name."</td>";
                   echo '<td align=center><form method=POST><button  type=submit  name=viewDetails1 value="';echo $row[$eventId]; echo '">View</button></form></td>';
                   echo "</tr>";
                  }
               }
            ?>
            <?php
               while ($row = mysqli_fetch_array($queryAbstract2)) {
                  $name = $row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
                   if ($row['reviewdBy2']==1) {
                     
                   }
                   else
                   {
                   echo "<tr>";
                   echo "<td>".$row[$eventId]."</td>";
                   echo "<td>".$row['Title']."</td>";
                   echo "<td>".$name."</td>";
                   echo '<td align=center><form method=POST><button  type=submit  name=viewDetails2 value="';echo $row[$eventId]; echo '">View</button></form></td>';
                   echo "</tr>";
                 }
               }
            ?>
          </tbody>
        </table>
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