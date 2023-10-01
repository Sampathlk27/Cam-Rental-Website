<html>
 <head>
 <title>Edit Dashboard</title>

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
                        if(isset($_GET['edit']))
                        {
                            $tid=$_GET['edit'];
                            $result2=mysqli_query($conn,"Update transactions set status='Paid' where id='$tid'");
                            $row=$result2;
                            ?>
                             <script >swal({
                            title: "SUCCESS",
                            text: "Updated SUCCESSFULLY",
                            icon: "success",
                            }).then(function() {
            window.location.href = "dashboard.php";
        });</script>
                            <?php
                            
                        }
                        ?>
                        
                        </body>
                        </html>