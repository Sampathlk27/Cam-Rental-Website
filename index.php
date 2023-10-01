<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent & Relax</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="assets/css/style3.css">
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
    <div class="bgimg-1">
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading" style="color: black">Rent & Relax</h1>
                            <p class="intro-text">
                                Online Camera Rental Service
                            </p>
                            <a href="#sec2" class="btn btn-circle page-scroll blink" >
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">Available Cameras</h3>
<br>
        <section class="menu-content">
            <?php
            $sql1 = "SELECT * FROM cams WHERE cam_availability='yes'";
            $result1 = mysqli_query($conn,$sql1);

            if(mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)){
                    $cam_id = $row1["cam_id"];
                    $cam_name = $row1["cam_name"];
                    $cam_nameplate=$row1["cam_nameplate"];
                    $specs=$row1["specs"];
                    $price_per_day = $row1["price_per_day"];
                    $cam_img = $row1["cam_img"];
                    ?>
            <a href="booking.php?id=<?php echo($cam_id) ?>">
            <form action="<?php echo $specs; ?>" target="__blank">
                
            
            <div class="sub-menu" >
            <img class="card-img-top" src="<?php echo $cam_img; ?>" alt="Card image cap">
            <br>
            <h5><b> <?php echo $cam_name; ?>&nbsp;<?php echo $cam_nameplate;?> </b></h5>
            
           <h6><b> Rent @ <?php echo (" Rs." . $price_per_day . "/DAY");?></h6></b> 

          
           <b><button  style="border: none; background:none; color:grey; " class="btn btn-link btn-sm" >Specification</button></b>  
                    
            </div>
            </form>
            </a>  
            <?php }}
            else {
                ?>
<h1> No cameras available :( </h1>
                <?php
            }
            ?>
        </section>

        
    </div>

    <div class="bgimg-2">
        <center>
    <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Request A Call back
        </h2>
      </div>
      <div class="row">
        <div class="col" style="margin-left:auto ;margin-right:auto">
          <div class="form_container">
            <form action="msg.php" method="post" >
              <div class="form-row">
                <div class="form-group col">
                  <input type="text" class="form-control"  name="customer_name" pattern="[a-zA-Z]+" placeholder="Name ">
                </div>
                <div class="form-group col ">
                  <input type="numeric" class="form-control" name="customer_phone" pattern="[0-9]+" placeholder="Phone">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <input type="email" class="form-control" name="email" placeholder="Email id">
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="msg" placeholder="Message">
              </div>
              <div class="d-flex justify-content-center">
                <button type="submit" class="" name="btnsubmit" >Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    </div>
  </section>
  </center>

        <div class="caption">
        
            <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;"></span>
            
        </div>
    </div>


    <!-- Container (Contact Section) -->
    <!-- -->
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
    <!-- <script>
        function myMap() {
            myCenter = new google.maps.LatLng(25.614744, 85.128489);
            var mapOptions = {
                center: myCenter,
                zoom: 12,
                scrollwheel: true,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

            var marker = new google.maps.Marker({
                position: myCenter,
            });
            marker.setMap(map);
        }
    </script>
    <script>
        function sendGaEvent(category, action, label) {
            ga('send', {
                hitType: 'event',
                eventCategory: category,
                eventAction: action,
                eventLabel: label
            });
        };
    </script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCuoe93lQkgRaC7FB8fMOr_g1dmMRwKng&callback=myMap" type="text/javascript"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="assets/js/theme.js"></script>
</body>

</html>
