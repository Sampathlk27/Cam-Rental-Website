<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<title>Rent & Relax</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png.png">
<link rel="shortcut icon" type="image/png" href="assets/img/logo.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   Rent & Relax </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercam.php">Add Camera</a></li>
        
              <li> <a href="clientview.php">View</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span>  <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Inventory <span class="camet"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncam.php">Return Now</a></li>
              <li> <a href="mybookings.php"> My Bookings</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <!-- <li>
                        <a href="clientlogin.php">Employee</a>
                    </li> -->
                    <li>
                        <a href="customerlogin.php">Login</a>
                    </li>
                    <li>
                        <a href="faq/index.php"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<body>

<?php 
$id = $_GET["id"];
$distance = NULL;
$distance_or_days = $conn->real_escape_string($_POST['distance_or_days']);
$fare = $conn->real_escape_string($_POST['hid_fare']);
$total_amount = $distance_or_days * $fare;
$cam_return_date = date('Y-m-d');
$return_status = "R";
$login_customer = $_SESSION['login_customer'];

$sql0 = "SELECT rc.id, rc.rent_end_date, rc.charge_type, rc.rent_start_date, c.cam_name, c.cam_nameplate FROM rentedcams rc, cams c WHERE id = '$id' AND c.cam_id = rc.cam_id";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
            $rent_end_date = $row0["rent_end_date"];  
            $rent_start_date = $row0["rent_start_date"];
            $cam_name = $row0["cam_name"];
            $cam_nameplate = $row0["cam_nameplate"];
            $charge_type = $row0["charge_type"];
    }
}

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

$extra_days = dateDiff("$rent_end_date", "$cam_return_date");
$total_fine = $fare*$extra_days + ($fare*25/100) * $extra_days ;

$duration = dateDiff("$rent_start_date","$rent_end_date");

if($extra_days>0) {
    $total_amount = $total_amount + $total_fine;  
}

if($charge_type == "days"){
    $no_of_days = $distance_or_days;
    $sql1 = "UPDATE rentedcams SET cam_return_date='$cam_return_date', no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
} 

$result1 = $conn->query($sql1);

if ($result1){
     $sql2 = "UPDATE cams c,  rentedcams rc SET c.cam_availability='yes' WHERE rc.cam_id=c.cam_id AND rc.customer_username = '$login_customer' AND rc.id = '$id'";
     $result2 = $conn->query($sql2);
}
else {
    echo $conn->error;
}
?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Camera Returned</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Thank you for visiting Rent & Relax! </h2>

    <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <h5 class="text-center">Please read the following information about your order.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <!-- <h3 style="color: orange;">Your booking has been received and placed into out order processing system.</h3> -->
                <br>
                <h4>Please make a note of your <strong>order number</strong> now and keep in the event you need to communicate with us about your order.</h4>
                <br>
                <h3 style="color: orange;">Invoice <?php echo "$id"; ?></h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Camera Name: </strong> <?php echo $cam_name;?></h4>
                <br>
                <h4> <strong>Model Number:</strong> <?php echo $cam_nameplate; ?></h4>
                <br>
                <h4> <strong>Rent :&nbsp;</strong>  Rs. <?php 
            if($charge_type == "days"){
                    echo ($fare . "/Day");
                } 
            ?></h4>
                <br>
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Rent End Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>Return Date: </strong> <?php echo $cam_return_date; ?> </h4>
                <br>
                <?php if($charge_type == "days"){?>
                    <h4> <strong>Number of Day(s):</strong> <?php echo $distance_or_days; ?>Day(s)</h4>
                <?php  } ?>
                <br>
                <?php
                    if($extra_days > 0){
                        
                ?>
                <h4><b> Total Days of Rent : </b> <?php echo $no_of_days + $extra_days;?> Days.</h4>
                <br>
                <h4> <strong>Total Fine:</strong> <label class="text-danger"> Rs. <?php echo $total_fine; ?>/- </label> for <?php echo $extra_days;?> extra days.</h4>
                <br>
                <?php } ?>
                <h4> <strong>Total Amount: </strong> Rs. <?php echo $total_amount; ?>/-     </h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
            <a href="pay.php" class="btn btn-secondary">PAY NOW</a>
        </div>
    </div>

</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> Rent & Relax</h5>
                </div>
                <a href="https://goo.gl/maps/wBYZZD9URt7LsAhz9" class="material-icons" style='font-size:30px;' target="__blank">location_on</a>
                &nbsp;
                <a href="tel:7907882054" class="material-icons" style='font-size:30px;'>call</a>
            </div>
        </div>
    </footer>
</html>