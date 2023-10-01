<?php 


session_start();
require 'connection.php';
$conn = Connect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Rent & Relax</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container">

    <form action="payment.php" method="get">

        <div class="row">

            <div class="col">
<?php
$sql="select fare from rentedcams";
$result2=mysqli_query($conn,$sql);
$rows=mysqli_fetch_array($result2)  
    ?>

                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>Username :</span>
                    <label for="html" name="username"><?php echo $_SESSION['login_customer'];?></label>
                </div>
                <div class="inputBox">
                    <span>Phone number</span>
                    <input type="tel" maxlength="10" minlength="10" name="customer_phone" pattern="[0-9]+" placeholder="9876543210" required="">
                </div>
                <div class="inputBox">
                    <span>Cam Name :</span>
                    <input type="text" name="cam_name" placeholder="Eg:Nikon" required="">
                </div>
                <div class="inputBox">
                    <span>Model Name :</span>
                    <input type="text" name="cam_nameplate" placeholder="Eg:D5600" required="">
                </div>

                <!-- <div class="flex">
                    <div class="inputBox">
                        <span>state :</span>
                        <input type="text" name="state" placeholder="State">
                    </div>
                    <div class="inputBox">
                        <span>pincode :</span>
                        <input type="text" name="pincode" placeholder="123456">
                    </div> -->
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>
                <h2>SCAN THIS QR CODE</h2>
                <img src="assets/img/qr.png" alt="" width="300" height="300" style="border:2px solid #454545;">
                <br><label for="total_amount">After paying ₹<?php echo $rows['fare'];?> Click below button 👇</label><br>
            <input type="submit" name="submit"value="Click After Paying" class="submit-btn">
                                    
    </form>
    <?php ?>
</div>    
    
</body>
</html>


<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');

*{
  font-family: 'Poppins', sans-serif;
  margin:0; padding:0;
  box-sizing: border-box;
  outline: none; border:none;
  text-transform: capitalize;
  transition: all .2s linear;
}

.container{
  display: flex;
  justify-content: center;
  align-items: center;
  padding:25px;
  min-height: 100vh;
  background: linear-gradient(90deg, #ffee00 60%, #ffd000 40.1%);
}

.container form{
  padding:20px;
  width:700px;
  background: #fff;
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
}

.container form .row{
  display: flex;
  flex-wrap: wrap;
  gap:15px;
}

.container form .row .col{
  flex:1 1 250px;
}

.container form .row .col .title{
  font-size: 20px;
  color:#333;
  padding-bottom: 5px;
  text-transform: uppercase;
}

.container form .row .col .inputBox{
  margin:15px 0;
}

.container form .row .col .inputBox span{
  margin-bottom: 10px;
  display: block;
}

.container form .row .col .inputBox input{
  width: 100%;
  border:1px solid #ccc;
  padding:10px 15px;
  font-size: 15px;
  text-transform: none;
}

.container form .row .col .inputBox input:focus{
  border:1px solid #000;
}

.container form .row .col .flex{
  display: flex;
  gap:15px;
}

.container form .row .col .flex .inputBox{
  margin-top: 5px;
}

.container form .row .col .inputBox img{
  height: 34px;
  margin-top: 5px;
  filter: drop-shadow(0 0 1px #000);
}

.container form .submit-btn{
  width: 100%;
  padding:12px;
  font-size: 17px;
  background: #27ae60;
  color:#fff;
  margin-top: 5px;
  cursor: pointer;
}

.container form .submit-btn:hover{
  background: #2ecc71;
}

</style>