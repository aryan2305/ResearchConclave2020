
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
            <a class="nav-link active" href="#">
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
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              View Submitted Abstracts
            </a>
          </li>
          
        </ul>
      </div>
    </nav>

     

   

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Reviewed Application</h1>

      </div>
      <?php
        $conn=mysqli_connect("localhost","root","","research_conclave20");
        if ($conn-> connect_error){
          die("connection failed".$conn->connect_error);
          echo "connection failed!!";
        }
        //todo emailid below is hardcoded
        $query = mysqli_query($conn,"SELECT * FROM Oral WHERE Email_Id='aryanpranshu@gmail.com' ");
        $query1 = mysqli_query($conn,"SELECT * FROM Poster WHERE Email_Id='aryanpranshu@gmail.com' ");
      ?>  
      <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th>Oral ID</th>
              <th>Title</th>
              <th>Date of Submission</th>
              <th>Is Under Review</th>
            </tr>
          </thead>
        <tbody>
            <?php
               while ($row = mysqli_fetch_array($query)) {
                   echo "<tr>";
                   echo "<td>".$row["OralId"]."</td>";
                   echo "<td>".$row["Title"]."</td>";
                   echo "<td>".$row["DateOfSubmission"]."</td>";
                   echo "<td>".$row["IsUnderReview"]."</td>";
                   echo "</tr>";
               }

            ?>
          </tbody>
      </table>
         </div>
      <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th>Poster ID</th>
              <th>Title</th>
              <th>Date of Submission</th>
            </tr>
          </thead>
        <tbody>
            <?php
               while ($row = mysqli_fetch_array($query1)) {
                   echo "<tr>";
                   echo "<td>".$row["PosterId"]."</td>";
                   echo "<td>".$row["Title"]."</td>";
                   echo "<td>".$row["DateOfSubmission"]."</td>";
                   echo "<td>".$row["IsUnderReview"]."</td>";
                   echo "</tr>";
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