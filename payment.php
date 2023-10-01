<html>
    <head>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9%22%3E"> </script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<?php

session_start();
require 'connection.php';
$conn = Connect();
if (!isset($_SESSION['login_customer'])) {
    header("Location: index.php");
}

$sql="select total_amount from rentedcams";
$result2=mysqli_query($conn,$sql);
$rows=mysqli_fetch_array($result2);
    
$status="Unpaid";
$customer_username=$_SESSION['login_customer'];
$customer_phone=$_GET['customer_phone'];
$cam_name=$_GET['cam_name'];
$cam_nameplate=$_GET['cam_nameplate'];
$total_amount=$rows['total_amount'];
    if(isset($_GET['submit']))
{
  $sql1 = "INSERT INTO transactions(customer_username,customer_phone,cam_name,cam_nameplate,total_amount,status) values('$customer_username','$customer_phone','$cam_name','$cam_nameplate','$total_amount','$status')";
$result = mysqli_query($conn, $sql1);
 $alert="echo Paid";
header("Location:index.php")    
?>
 
          <?php

}
?>
</body>
</html>