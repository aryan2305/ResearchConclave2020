<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $AbstractTitle = $_POST["abstract_title"];
    $username=$_POST["username"];
    $EventType = $_POST['event_type'];
    $tableName="";
    $todaysDate = date("Y/m/d");
    $IsUnderReview = 0;
    $name       = $_FILES['inputFile']['name'];  
    $data = file_get_contents($_FILES['inputFile']['tmp_name']);

    if ($EventType == "Poster Presentation" ) {
      $tableName = "Poster";
    }
    else
    {
      $tableName = "Oral";
    }

    $host="localhost";
    $db="research_conclave20";
    $dsn= "mysql:host=$host;dbname=$db";
    $conn=new mysqli($host,"root","",$db);
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
      echo "failed";
    }
  //  echo $username."  ".$pwd;
  //  echo $conn;

    if(isset($name)){
        if(!empty($name)){      
            $query="INSERT INTO $tableName (Title, Email_Id, Attachment,DateOfSubmission,IsUnderReview) VALUES ('$AbstractTitle','$username','$data','$todaysDate','$IsUnderReview');";
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
          echo "error is".$e;
          }
        }
      }       
     else {
        echo 'You should select a file to upload !!';
    }

    



   

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
    <title>Abstract Submission</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/checkout/">

    <!-- Bootstrap core CSS -->
   
  <link href="https://getbootstrap.com/docs/4.3/examples/checkout/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <link href="https://getbootstrap.com/docs/4.3/examples/checkout/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
  <div class="container">
    <div class="py-5 text-center">
      <h2>Submit Abstract</h2>
      <p class="lead">Choose the event type and submit the abstract and fill the fields appropriately.</p>
    </div>

    
    <div class="col-md-8 order-md-2">
      <form class="needs-validation" action="abstractSubmission.php" method="POST" enctype="multipart/form-data" novalidate>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="middleName">Middle name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid middle name is required.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

          <div class="mb-3">
            <label for="abstract_title">Title of Abstract</label>
            <input type="text" class="form-control" id="abstract_title" name="abstract_title"  placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid title of the event is required.
            </div>
          </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            <div class="invalid-feedback" style="width: 100%;">
              Your username is required.
            </div>
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

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; Research Conclave 2020, IIT-Guwahati</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Home</a></li>
        <li class="list-inline-item"><a href="#">Contact Us</a></li>
      </ul>
    </footer>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
  <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
  <script src="form-validation.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

        
</html>
