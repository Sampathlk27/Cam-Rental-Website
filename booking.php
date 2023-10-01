<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Rent Camera </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/logo.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
</head>
<body ng-app=""> 


      <!-- Navigation -->
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
                        <a href="#"><span class="glyphicon glyphicon-user"></span>  <?php echo $_SESSION['login_client']; ?></a>
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
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Inventory <span class="caret"></span> </a>
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
    
<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="POST">
        <br style="clear: both">
          <br>

        <?php
        $cam_id = $_GET["id"];
        $sql1 = "SELECT * FROM cams WHERE cam_id = '$cam_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $cam_name = $row1["cam_name"];
                $cam_nameplate = $row1["cam_nameplate"];
                $price_per_day = $row1["price_per_day"];
               
            }
        }

        ?>
 <?php
    // $maxtime=strtotime("-1 days",time());
    // $maxdate=date("Y-m-d",$maxtime);
    $mintime=strtotime("1 days",time());
    $mindate=date("Y-m-d",$mintime);

        ?>
        
          <!-- <div class="form-group"> -->
              <h5> Selected Camera:&nbsp;  <b><?php echo($cam_name);?></b></h5>
         <!-- </div> -->
         
          <!-- <div class="form-group"> -->
            <h5> Model Number &nbsp;<b> <?php echo($cam_nameplate);?></b></h5>
          <!-- </div>      -->
        <!-- <div class="form-group"> -->
        <?php $today = date("Y-m-d"); $t=date('Y-m-d H:i:s') ?>

          <label><h5>Start Date:</h5></label>
            <input type="date"  name="rent_start_date" min="<?php echo $today ?>" max="2023-01-01" required="">
            &nbsp; 
          <label><h5>End Date:</h5></label>
          <input type="date"  name="rent_end_date" min="<?php echo $today ?>" max="2023-01-01" required="">
        <!-- </div>      --> 
        
        <h5> Choose your Cam type:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="ac" ng-model="myVar"> <b>With Lens </b>&nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="non_ac" ng-model="myVar"><b> With-Out Lens </b>
                
    
        <div ng-switch="myVar"> 
        <div ng-switch-default>
                    <!-- <div class="form-group"> -->
                <h5>Rent <h5>    
                <!-- </div>    -->
                     </div>
                    <div ng-switch-when="ac">
                    <!-- <div class="form-group"> -->
                <h5>Rent <b><?php echo(" Rs. " . $price_per_day . "/DAY");?></b><h5>    
                <!-- </div>    -->
                     </div>
                     <div ng-switch-when="non_ac">
                     <!-- <div class="form-group"> -->
                     <h5>Rent: <b><?php echo("Currently Unavailable");?></b><h5> 
                <!-- </div>   -->
                     </div>
        </div>

         <h5> Charge type:  &nbsp;
           
            <input onclick="reveal()" type="radio" name="radio1" value="days"><b> Per DAY</b>

            
                <div ng-switch="myVar1">
                

                <?php
                        // $sql3 = "SELECT * FROM driver d WHERE d.driver_availability = 'yes' AND d.client_username IN (SELECT cc.client_username FROM clientcams cc WHERE cc.cam_id = '$cam_id')";
                        // $result3 = mysqli_query($conn, $sql3);

                        // if(mysqli_num_rows($result3) > 0){
                        //     while($row3 = mysqli_fetch_assoc($result3)){
                        //         $driver_id = $row3["driver_id"];
                        //         $driver_name = $row3["driver_name"];
                        //         $driver_gender = $row3["driver_gender"];
                        //         $driver_phone = $row3["driver_phone"];

                ?>

              
                </div>
                <input type="hidden" name="hidden_carid" value="<?php echo $cam_id; ?>">
                
         
           <input type="submit"name="submit" value="Rent Now" class="btn btn-warning pull-right">     
        </form>
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Note:</strong><span class="text-danger"> You will be charged  EXTRA for each day after the due date ends.</span></h6>
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