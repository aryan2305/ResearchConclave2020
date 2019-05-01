<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $firstname=$_POST["fName"];
    $middlename=$_POST["mName"];
    $lastname=$_POST["lName"];
    $email=$_POST["eMail"];
    $designation=$_POST["Designation"];
    $department=$_POST["Department"];
    $institute=$_POST["Institute"];
    $address=$_POST["Address"];
    $city=$_POST["City"];
    $state=$_POST["State"];
    $pincode=$_POST["pinCode"];
    $event=$_POST["eventType"];
    $eventtype=0;
    $host="localhost";
    if($event=="oral")
    {
      $eventtype=1;
    }
    else
    {
      $eventtype=0;
    }
    $uType="2";
    $password=$_POST["password"];
    $hashPassword = md5($password);
    $confirm_password = $_POST["confirm_password"];
    // $length=rand(5,10);
    // $char='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // $charLength=strlen($char);
    // for($i=0;$i<$length;$i++)
    // {
    //   $password .=$char[rand(0,$charLength-1)];
    // }
    $db="research_conclave20";
    $dsn= "mysql:host=$host;dbname=$db";
    $conn=new mysqli($host,"root","",$db);
    // $subject = "Research Conclave IITG - reviewer selection";
    // $txt = "Congratulations sir! we are very to inform you that you are selected as one of our reviewer panel for this Research Conclave .";
    // $headers = 'From: facultyconvener@gmail.com'; //Conclave2020
    // require 'PHPMailer/src/Exception.php';
    // require 'PHPMailer/src/PHPMailer.php';
    // require 'PHPMailer/src/SMTP.php';
    // $mail=new PHPMailer(true);
    // try{
    //     $mail->isSMTP();
    //     $mail->SMTPAuth=true;
    //     $mail->SMTPSecure='ssl';
    //     $mail->Host='smtp.gmail.com';
    //     $mail->Port='465';
    //     $mail->isHTML(true);
    //     $mail->Username='facultyconvener@gmail.com';
    //     $mail->Password='Conclave2020';
    //     $mail->SetFrom('facultyconvener@gmail.com');
    //     $mail->Subject='Research Conclave IITG - reviewer selection';
    //     $mail->Body='Congratulations sir! we are very to inform you that you are selected as one of our reviewer panel for this Research Conclave ';
    //     $mail->AddAddress($email);
    //     $mail->send();
    //     echo 'Mail sent!';
    //   }
    //   catch(Exception $e)
    //   {
    //     echo "Mail could not be sent.Mailer error :{$mail->ErrorInfo}";
    //   }
    // if(mail($email,$subject,$txt,$headers))
    // {
    //   echo "Mail sent!!";
    // }
    // else
    // {
    //   echo "Not able to send mail!!";
    // }
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
      echo "failed";
    }

    if ($confirm_password == $password) {
      
    
    $query="INSERT INTO Reviewer (EventType,FirstName,MiddleName,LastName,EmailId,Designation,Department,Institute,Address,City,State,PinCode) VALUES ('$eventtype','$firstname','$middlename','$lastname','$email','$designation','$department','$institute','$address','$city','$state','$pincode')";
    $query1="INSERT INTO UserLoginDetails (userEmail_Id,password,userType) VALUES ('$email','$hashPassword','$uType')";



    try{

      $result=$conn->query($query);
      $result1=$conn->query($query1);
    }
    catch(Exception $e){
      echo "error is".$e;
    }
    }
    else
    {
      echo "<script type='text/javascript'>alert('Confirm Password and Password does not match ');</script>";
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
    <title>Dashboard Faculty</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.3/examples/dashboard/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <style>
    input[type=text], select ,input[type=email],input[type=number],input[id=password],input[id=confirm_password]{
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
            <a class="nav-link " href="dashboardFaculty.php">
              <span data-feather="layers"></span>
              Add Notice
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="addReviewer.php">
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
            <a class="nav-link" href="facultyChangeDates.php">
              <span data-feather="file-text"></span>
                Change Date
            </a>
          </li>           
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Reviewer</h1>        
      </div>
      <div>
        <form action="addReviewer.php" method="POST">
          <label for="fname">First Name</label>
          <input type="text" id="fname" name="fName" placeholder="First Name.." required>
          <label for="mname">Middle Name</label>
          <input type="text" id="mname" name="mName" placeholder="Middle Name..">
          <label for="lname">Last Name</label>
          <input type="text" id="lname" name="lName" placeholder="Last Name.." required>
          <label for="email">Email Id</label>
          <input type="email" id="email" name="eMail" placeholder="eMail.." required>
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="" required onkeyup='check();'>
          <label for="confirm_password">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="" required onkeyup='check();'>
          <span id='message'></span>
          <script type="text/javascript">
              var check = function() {
                    if (document.getElementById('password').value ==
                        document.getElementById('confirm_password').value) {
                        document.getElementById('message').style.color = 'green';
                        document.getElementById('message').innerHTML = 'matching';
                        document.getElementById('submit').disabled = false;
                    } else {
                        document.getElementById('message').style.color = 'red';
                        document.getElementById('message').innerHTML = 'not matching';
                        document.getElementById('submit').disabled = true;
                    }
                }
                              </script>
                              <br>
          <label for="designation">Designation</label>
          <input type="text" id="designation" name="Designation" placeholder="Designation.." required>
          <label for="department">Department</label>
          <select id="department" name="Department" required>
            <option value="Computer Science">Computer Science</option>
            <option value="Mathematics and Computing">Mathematics and Computing</option>
            <option value="Electrical">Electrical</option>
            <option value="Electronics">Electronics</option>
            <option value="Chemical">Chemical</option>
            <option value="Civil">Civil</option>
            <option value="Mechanical">Mechanical</option>
            <option value="other">Other</option>
          </select>
          <label for="institute">Institute</label>
          <input type="text" id="institute" name="Institute" placeholder="Institute.." required>
          <label for="address">Address</label>
          <input type="text" id="address" name="Address" placeholder="Address.." required>
          <label for="city">City</label>
          <input type="text" id="city" name="City" placeholder="City.." required>
          <label for="state">State</label>
          <input type="text" id="state" name="State" placeholder="State.." required>
          <label for="pincode">Pin Code</label>
          <input type="number" id="pincode" name="pinCode" placeholder="Pin Code .." required>
          <label for="eType">Event Type</label>
          <select id="eType" name="eventType" required>
            <option value="oral">Oral</option>
            <option value="poster">Poster</option>
          </select>
          <input type="submit" id="submit" value="Submit">
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