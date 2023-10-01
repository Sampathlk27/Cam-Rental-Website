<html>

  <head>
    <title> Customer Signup | Rent & Relax </title>
  </head>
  <?php session_start(); ?>
  <link rel="shortcut icon" type="image/png" href="assets/img/logo.png.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">

    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 

  <body>
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
                        <a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['login_client']; ?></a>
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
                        <a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <li>
                        <a href="#">History</a>
                    </li>
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
                    <li>
                        <a href="clientlogin.php">Employee</a>
                    </li>
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

<?php

require 'connection.php';
$conn = Connect();

function GetImageExtension($imagetype) {
    if(empty($imagetype)) return false;
    
    switch($imagetype) {
        case 'assets/img/cams/bmp': return '.bmp';
        case 'assets/img/cams/gif': return '.gif';
        case 'assets/img/cams/jpeg': return '.jpg';
        case 'assets/img/cams/png': return '.png';
        default: return false;
    }
}

$cam_name = $conn->real_escape_string($_POST['cam_name']);
$cam_nameplate = $conn->real_escape_string($_POST['cam_nameplate']);
$specs=$conn->real_escape_string($_POST['specs']);
$price_per_day = $conn->real_escape_string($_POST['price_per_day']);

$cam_availability = "yes";




if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name=$_FILES["uploadedimage"]["name"];
    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
    $imgtype=$_FILES["uploadedimage"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename=$_FILES["uploadedimage"]["name"];
    $target_path = "assets/img/cams/".$imagename;

    if(move_uploaded_file($temp_name, $target_path)) {
        

        $query = "INSERT into cams(cam_name,cam_nameplate,specs,cam_img,price_per_day,cam_availability) VALUES('" . $cam_name . "','" . $cam_nameplate . "','" . $specs . "','".$target_path."','" . $price_per_day . "','" . $cam_availability ."')";
        $success = $conn->query($query);

        
    } 

}



$query1 = "SELECT cam_id from cams where cam_nameplate = '$cam_nameplate'";

$result = mysqli_query($conn, $query1);
$rs = mysqli_fetch_array($result, MYSQLI_BOTH);
$cam_id = $rs['cam_id'];
 

$query2 = "INSERT into clientcams(cam_id,client_username) values('" . $cam_id ."','" . $_SESSION['login_client'] . "')";
$success2 = $conn->query($query2);

if (!$success){ ?>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        Camera with the same model number already exists!
        <?php echo $conn->error; ?>
        <br><br>
        <a href="entercam.php" class="btn btn-default"> Go Back </a>
</div>
<?php	
}
else {
    header("location: entercam.php"); //Redirecting 
}

$conn->close();

?>

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