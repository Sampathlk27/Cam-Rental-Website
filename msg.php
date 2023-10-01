<html>
    <head>
    <title>Rent & Relax</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png.png">
    </head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <body>
<?php
    require 'connection.php';
    $conn = Connect();
if(isset($_POST['btnsubmit']))
{
$customer_name = $_POST['customer_name'];
$customer_phone = $_POST['customer_phone'];
$email = $_POST['email'];
$msg = $_POST['msg'];
$sql="insert into feedback (customer_name,customer_phone,email,msg) values ('$customer_name','$customer_phone','$email','$msg')";
mysqli_query($conn,$sql);
?>
 <script >Swal.fire({
                            title: "Message Sent",
                            text: "Our agents will contact you shortly.. :)",
                            icon: "success",
                            }).then(function() {
            window.location.href = "index.php";
        });</script>
    <?php  
}
?>
 </body>
</html>