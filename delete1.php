<html>
 <head>
 <title>Admin Dashboard</title>

    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png.png">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/font/material-design-icons/Material-Design-Icons.woff'><link rel="stylesheet" href="./style.css">
<script src="js/script.js"></script>
<link rel="stylesheet" href="assets/css/style.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
    

<?php
require 'connection.php';
$conn = Connect(); 
                        if(isset($_GET['delete']))
                        {
                            $tid=$_GET['delete'];
                            $result2=mysqli_query($conn,"delete from clientcams where cam_id=$tid");
                            $row=$result2;
                            $result1=mysqli_query($conn,"delete from cams where cam_id=$tid");
                            $row=$result1;
                            ?>
                             <script >swal({
                            title: "SUCCESS",
                            text: "DELETED SUCCESSFULLY",
                            icon: "success",
                            }).then(function() {
            window.location.href = "products.php";
        });</script>
                            <?php
                            
                        }
                        ?>
                        
                        </body>
                        </html>