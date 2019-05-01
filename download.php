<html>
    <head>
        <title>Download File From MySQL Database</title>
        <meta http-equiv="Content-Type" content="text/html;
              charset=iso-8859-1">
    </head>
    <body>
        <?php

        $host="localhost";
        $db="research_conclave20";
        $dsn= "mysql:host=$host;dbname=$db";
        $conn=new mysqli();
        $conn=new mysqli($host,"root","",$db);
        if($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
          echo "failed";
        }


        $query = "SELECT id, name FROM upload";
        $query = "SELECT Id,fileName FROM Poster WHERE PosterId = 'Poster16'";
        $result = mysqli_query($conn,$query) or die('Error, query failed');
        if (mysqli_num_rows($result) == 0) {
            echo "Database is empty <br>";
        } else {
            while (list($Id, $fileName) = mysqli_fetch_array($result)) {
                ?>
                <a href="download.php?id=<?php echo urlencode($Id); ?>"
                   ><?php echo urlencode($fileName); ?></a> <br>
                <?php
            }
        }
        $conn->close();
        ?>
    </body>
</html>
           <?php
           if (isset($_GET['Id'])) {

             $host="localhost";
             $db="research_conclave20";
             $dsn= "mysql:host=$host;dbname=$db";
             $conn=new mysqli();
             $conn=new mysqli($host,"root","",$db);
             if($conn->connect_error){
               die("Connection failed: " . $conn->connect_error);
               echo "failed";
             }


               $id = $_GET['Id'];
               // $query = "SELECT name, type, size, content FROM upload WHERE id = '$id'";
               $query = "SELECT fileName, fileType, fileSize, Attachment FROM Poster WHERE Posterid = '$id'";
               $result = mysqli_query($conn,$query) or die('Error, query failed');
               list($fileName, $fileType, $fileSize, $Attachment) = mysqli_fetch_array($result);
               header("Content-length: $fileSize");
               header("Content-type: $fileType");
               header("Content-Disposition: attachment; filename=$fileName");
               ob_clean();
               flush();
               echo $Attachment;
               mysql_close();
               exit;
           }
           ?>