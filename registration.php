<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $firstName=$_POST["first_name"];
    $middleName=$_POST["middle_name"];
    $lastName=$_POST["last_name"];
    $email=$_POST["eMail"];
    $branch=$_POST["bRanch"];
    $graduatingYear=$_POST["graduting_year"];
    $institute=$_POST["iNstitute"];
    $address=$_POST["aDdress"];
    $city=$_POST["cIty"];
    $state=$_POST["sTate"];
    $pincode=$_POST["pIncode"];
    $password=$_POST["pAssword"];

    $hashPassword = md5($password);

    $Confirmpassword=$_POST["confirm_password"];
    $programme=$_POST["pRogramme"];
    $host="localhost";
    $db="research_conclave20";
    $dsn= "mysql:host=$host;dbname=$db";
    $conn=new mysqli($host,"root","",$db);
    $conn1=new mysqli($host,"root","",$db);
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
      echo "failed";
    }
    if ($Confirmpassword == $password) {
    	
    $query="INSERT INTO ParticipantDetail (FirstName,MiddleName,LastName,userEmailId,Institue,Address,City,State,PinCode,Programme,Branch,GraduatingYear) VALUES ('$firstName','$middleName','$lastName','$email','$institute','$address','$city','$state','$pincode','$programme','$branch','$graduatingYear');";
    $query2="INSERT INTO UserLoginDetails (userEmail_Id,password,userType) VALUES ('$email','$hashPassword','3');";


    try{

      $result=$conn->query($query);
      $result1=$conn1->query($query2);
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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Registration</title>

    <!-- Icons font CSS-->
    <link href="./vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="./vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="./vendor/select2/select2.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="./css/main.css" rel="stylesheet" media="all">
</head>

<body>
	    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
	        <div class="wrapper wrapper--w680">
	            <div class="card card-4">
	                <div class="card-body">
	                    <h2 class="title">Registration Form</h2>
	                    <form method="POST" action="registration.php">
	                        <div class="row row-space">
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">first name</label>
	                                    <input class="input--style-4" type="text" name="first_name"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">
	                                    middle name</label>
	                                    <input class="input--style-4" type="text" name="middle_name">
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">last name</label>
	                                    <input class="input--style-4" type="text" name="last_name"  required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row row-space">
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">Email</label>
	                                    <input class="input--style-4" type="email" name="eMail"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">Branch</label>
	                                    <input class="input--style-4" type="text" name="bRanch"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">
	                                        Graduating Year
	                                    </label>
	                                    <input class="input--style-4" type="text" name="graduting_year"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">
	                                    Institute
	                                    </label>
	                                    <input class="input--style-4" type="text" name="iNstitute"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">Address</label>
	                                    <input class="input--style-4" type="text" name="aDdress"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">City</label>
	                                    <input class="input--style-4" type="text" name="cIty"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">State</label>
	                                    <input class="input--style-4" type="text" name="sTate"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">Pincode</label>
	                                    <input class="input--style-4" type="text" name="pIncode"  required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">Password</label>
	                                    <input class="input--style-4" type="password" name="pAssword" id="pass" onkeyup='check();' required>
	                                </div>
	                            </div>
	                            <div class="col-2">
	                                <div class="input-group">
	                                    <label class="label">Confirm Password</label>
	                                    <input class="input--style-4" type="password" name="confirm_password" id="cpass" onkeyup='check();' required>
	                                    <span id='message'></span>
	                              	</div>
	                            </div>
	                            <script type="text/javascript">
	                            	var check = function() {
									      if (document.getElementById('pass').value ==
									          document.getElementById('cpass').value) {
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
	                        </div>
	                        <div class="input-group">
	                            <label class="label">Programme</label>
	                            <div class="rs-select2 js-select-simple select--no-search">
	                                <select name="pRogramme"  required>
	                                    <option disabled="disabled" selected="selected">Choose option</option>
	                                    <option>BTech</option>
	                                    <option>MTech</option>
	                                    <option>Phd</option>
	                                </select>
	                                <div class="select-dropdown"></div>
	                            </div>
	                        </div>
	               
	                        <div class="p-t-15">
	                            <button class="btn btn--radius-2 btn--blue" id="submit" type="submit">Submit</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- Jquery JS-->
	    <script src="./vendor/jquery/jquery.min.js"></script>
	    <!-- Vendor JS-->
	    <script src="./vendor/select2/select2.min.js"></script>
	    <!-- Main JS-->
	    <script src="./js/global.js"></script>

</body>

</html>
<!-- end document-->