<?php
error_reporting(E_ALL ^ E_NOTICE );
error_reporting(E_ERROR | E_PARSE);
//session based login system
session_start();

echo $_SESSION["username"];
$username = $_SESSION["username"];

$FirstName = "";
$MiddleName = "";
$LastName = "";


$conn=mysqli_connect("localhost","root","","research_conclave20");
if ($conn-> connect_error){
  die("connection failed".$conn->connect_error);
  echo "connection failed!!";
}
$query = mysqli_query($conn,"SELECT * FROM ParticipantDetail WHERE userEmailId='$username' ");

while ($row =mysqli_fetch_array($query)) {
  $FirstName = $row['FirstName'];
  $MiddleName = $row['MiddleName'];
  $LastName = $row['LastName'];
}

echo $FirstName;
echo "\n";
echo $MiddleName;
echo "\n";
echo $LastName;

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
?>



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

    <style type="text/css">
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
    table.hovertable {
      font-family: verdana,arial,sans-serif;
      font-size:11px;
      color:#333333;
      border-width: 1px;
      border-color: #999999;
      border-collapse: collapse;
    }
    table.hovertable th {
      background-color:#c3dde0;
      border-width: 1px;
      padding: 8px;
      border-style: solid;
      border-color: #a9c6c9;
    }
    table.hovertable tr {
      background-color:#d4e3e5;
    }
    table.hovertable td {
      border-width: 1px;
      padding: 8px;
      border-style: solid;
      border-color: #a9c6c9;
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
            <a class="nav-link " href="dashboardParticipant.php">
              <span data-feather="home"></span>
              View Submitted Abstracts  <span class="sr-only">(current)</span>
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link active" href="abstractSubmission.php">
              <span data-feather="layers"></span>
              Submit Abstract
            </a>
          </li>
        </ul>
      </div>
    </nav>

     

   

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Submit Abstract</h1>

      </div>
  <?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $Description = $_POST["description"];
    $AbstractTitle = $_POST["abstract_title"];
    $EventType = $_POST['event_type'];
    $tableName="";
    $todaysDate = date("Y-m-d");
    $IsUnderReview = 0;
    $name       = $_FILES['inputFile']['name']; 
    $file = addslashes($_FILES['inputFile']['tmp_name']);
    $file = file_get_contents($file);
    $file = base64_encode($file);
    $data = $file; 



    if ($EventType == "Poster Presentation" ) {
      $tableName = "Poster";
    }
    else
    {
      $tableName = "Oral";
    }

    $flag = "valid";
    if ($tableName == "Poster" ) {
      if ($posterEndDate < date("Y-m-d") || $posterStartDate > date("Y-m-d")) {
        $flag = "invalid";
      }
    }
    if ($tableName == "Oral" ) {
      if ($oralEndDate < date("Y-m-d") || $oralStartDate > date("Y-m-d")) {
        $flag = "invalid";
      }
    }

  $host="localhost";
  $db="research_conclave20";
  $dsn= "mysql:host=$host;dbname=$db";
  $conn=new mysqli($host,"root","",$db);
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
    echo "failed";
  }

  if($flag == "valid")
  {
    
    if(isset($name)){
        if(!empty($name)){      
            $query="INSERT INTO $tableName (Title, Description,Email_Id,FirstName,MiddleName,LastName, Attachment,DateOfSubmission,IsUnderReview) VALUES ('$AbstractTitle','$Description','$username','$FirstName','$MiddleName','$LastName','$data','$todaysDate','$IsUnderReview')";
        try{

          if ($conn->query($query) === TRUE) {
            $insertedId = mysqli_insert_id($conn);
            $newValue = "";
            $tableNameId = "";
            if ($EventType == "Poster Presentation") {
               $tableNameId = "PosterId";
              $newValue ="Poster".strval($insertedId);
            }
            else
            {
              $tableNameId = "OralId";
              $newValue ="Oral".strval($insertedId);
            }
            $query2 = "UPDATE $tableName SET $tableNameId = '$newValue' WHERE Id = '$insertedId';";
            $conn->query($query2);
    
          } else {
            echo "<script type='text/javascript'>alert('Failed!!!');</script>";    
          }
          }

        catch(Exception $e){
           echo '<script type="text/javascript">alert("error is"'.$e.');</script>';
          }
        }
      }       
     else {
        echo '<script type="text/javascript">alert("You should select a file to upload !!");</script>';
    }

    



   }
   else
   {
      echo '<script type="text/javascript">alert("You are out of submission period");</script>';
   }

    $conn->close();


  }
  
 ?>

 <div class="py-5 text-center">
      <p class="lead">Choose the event type and submit the abstract and fill the fields appropriately.</p>
      <?php
      
      if($posterStartDate <= date("Y-m-d") && $posterEndDate >= date("Y-m-d"))
      {
        echo '<p class="lead">Submission of Abstract for "POSTER" is started. Last date of submission is '.$posterEndDate.' </p>';
      }
      else if($posterStartDate > date("Y-m-d") )
      {
        echo '<p class="lead">Submission of Abstract for "POSTER" not started yet . Starting date of submission is '.$posterStartDate.' </p>';
      }
      else if($posterEndDate < date("Y-m-d"))
      {
        echo '<p class="lead">Last date of Submission of Abstract for "POSTER" is over.</p>';
      }

      if($oralStartDate <= date("Y-m-d") && $oralEndDate >= date("Y-m-d"))
      {
        echo '<p class="lead">Submission of Abstract for "Oral" is started. Last date of submission is '.$oralEndDate.' </p>';
      }
      else if($oralStartDate > date("Y-m-d") )
      {
        echo '<p class="lead">Submission of Abstract for "Oral" not started yet . Starting date of submission is '.$oralStartDate.' </p>';
      }
      else if($oralEndDate < date("Y-m-d"))
      {
        echo '<p class="lead">Last date of Submission of Abstract for "Oral" is over.</p>';
      }


      ?>
  </div>

    
    <div class="col-md-8 order-md-2">
      <form class="needs-validation" action="abstractSubmission.php" method="POST" enctype="multipart/form-data" novalidate>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="firstName">First name</label>
            <?php
            echo '<input type="text" class="form-control" id="firstName" placeholder="'.$FirstName.'" value="" disabled required>';
            ?>
            
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="middleName">Middle name</label>
            <?php
            echo '<input type="text" class="form-control" id="middleName" placeholder="'.$MiddleName.'" value="" disabled required>';
            ?>
            <div class="invalid-feedback">
              Valid middle name is required.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="lastName">Last name</label>
            <?php
            echo '<input type="text" class="form-control" id="lastName" placeholder="'.$LastName.'" value="" disabled required>';
            ?>
            
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

          <div class="mb-3">
            <label for="abstract_title">Title of Abstract</label>
            <input type="text" class="form-control" id="abstract_title" name="abstract_title"  placeholder="Title.." value="" required>
            <div class="invalid-feedback">
              Valid title of the event is required.
            </div>
          </div>
          <div class="mb-3">
            <label for="desText">Description</label>
          <input type="text" class="form-control" id="desText" name="description" placeholder="description.." required>
            <div class="invalid-feedback">
              Valid title of the event is required.
            </div>
          </div>
          

        <div class="mb-3">
               <label for="Event_type">Event Type</label>
            <select class="custom-select d-block w-100" id="event_type" name="event_type" required>
              <option value="">Choose...</option>
              <option>Poster Presentation</option>
              <option>Oral Presentation</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid event type.
            </div>
        </div>
        <div class="mb-3">
        <!-- <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputFile" name="inputFile">
            </div>
        </div> -->
        <div class="input-group mb-3">
            <input type="file"  id="inputFile" name="inputFile">
              
        </div>

      </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit Abstract</button>
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
