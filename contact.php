<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>

    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png.png">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/font/material-design-icons/Material-Design-Icons.woff'><link rel="stylesheet" href="./style.css">
<script src="js/script.js"></script>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!-- partial:index.partial.html -->
<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
</head>

<body>

  <ul id="slide-out" class="side-nav fixed z-depth-2">
    <li class="center no-padding">
      <div class="indigo darken-2 white-text" style="height: 180px;">
        <div class="row">
          <img style="margin-top: 5%;" width="100" height="100" src="assets/img/logo.png" class="circle responsive-img" />

          <p style="margin-top: -13%;">
            ADMIN
          </p>
        </div>
      </div>
    </li>

    <!-- <li id="dash_dashboard"><a class="waves-effect" href="#!"><b>Dashboard</b></a></li> -->

    <ul class="collapsible" data-collapsible="accordion">
      <li id="dash_users">
        <div id="dash_users_header" class="collapsible-header waves-effect"><b>Users</b></div>
        <div id="dash_users_body" class="collapsible-body">
          <ul>
            <li id="users_seller">
              <a class="waves-effect" style="text-decoration: none;" href="clientsignup.php">Client</a>
            </li>

            <li id="users_customer">
              <a class="waves-effect" style="text-decoration: none;" href="customertable.php">Customer</a>
            </li>
          </ul>
        </div>
      </li>

      <li id="dash_products">
        <div id="dash_products_header" class="collapsible-header waves-effect"><b>Products</b></div>
        <div id="dash_products_body" class="collapsible-body">
          <ul>
            <li id="products_product">
              <a class="waves-effect" style="text-decoration: none;" href="products.php">Products</a>
              <a class="waves-effect" style="text-decoration: none;" href="orders.php">Orders</a>
            </li>
          </ul>
        </div>
      </li>
      <li id="dash_products">
        <div id="dash_products_header" class="collapsible-header waves-effect"><b>Messages</b></div>
        <div id="dash_products_body" class="collapsible-body">
          <ul>
            <li id="products_product">
              <a class="waves-effect" style="text-decoration: none;" href="contact.php">Call Back</a>
            </li>
          </ul>
        </div>
      </li>

      <!-- <li id="dash_categories">
        <div id="dash_categories_header" class="collapsible-header waves-effect"><b>Categories</b></div>
        <div id="dash_categories_body" class="collapsible-body">
          <ul>
            <li id="categories_category">
              <a class="waves-effect" style="text-decoration: none;" href="#!">Category</a>
            </li>

            <li id="categories_sub_category">
              <a class="waves-effect" style="text-decoration: none;" href="#!">Sub Category</a>
            </li>
          </ul>
        </div>
      </li> -->

      <li id="dash_brands">
        <!-- <div id="dash_brands_header" class="collapsible-header waves-effect"><b>Brands</b></div>
        <div id="dash_brands_body" class="collapsible-body"> -->
          <ul>
            <!-- <li id="brands_brand">
              <a class="waves-effect" style="text-decoration: none;" href="#!">Brand</a>
            </li> -->

            <!-- <li id="brands_sub_brand">
              <a class="waves-effect" style="text-decoration: none;" href="#!">Sub Brand</a>
            </li> -->
          </ul>
        </div>
      </li>
    </ul>
  </ul>

  <header>
     <ul class="dropdown-content" id="user_dropdown">
      <!-- <li><a class="indigo-text" href="#!">Profile</a></li> -->
      <li><a class="indigo-text" href="logout.php">Logout</a></li>
    </ul> 

     <nav class="indigo" role="navigation">
      <div class="nav-wrapper">
        <a data-activates="slide-out" class="button-collapse show-on-" href="#!"><img style="margin-top: 17px; margin-left: 5px;" src="https://res.cloudinary.com/dacg0wegv/image/upload/t_media_lib_thumb/v1463989873/smaller-main-logo_3_bm40iv.gif" /></a>

        <ul class="right hide-on-med-and-down">
          <li>
            <a class='right dropdown-button' href='' data-activates='user_dropdown' ><i class=' material-icons'>  account_circle</i></a>
          </li>
        </ul>

        <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
      </div>
    </nav> 

    <nav>
      <div class="nav-wrapper indigo darken-2">
        <a style="margin-left: 20px;" class="breadcrumb" href="dashboard.php">Admin</a>
        <a class="breadcrumb" href="#">Order Summary </a>

        <div style="margin-right: 20px;" id="timestamp" class="right"></div>
      </div>
    </nav>
  </header>

  <main>
  <div class="row">

<div style="padding: 35px;" align="center" class="card">
  <div class="row">
    <div class="left card-title">
      <b>Contact</b>
    </div>
  </div>  
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">Message</th>
    </tr>
  </thead>
  <?php
require 'connection.php';
$conn = Connect();
$sql="SELECT * from feedback";
$result=mysqli_query($conn,$sql);
while($rows=mysqli_fetch_assoc($result)){
?>
  <tbody>
    <tr>
      <td><?php echo $rows['customer_name']; ?></td>
      <td><?php echo $rows['customer_phone'];?></td>
      <td><?php echo $rows['email'];?></td>
      <td><?php echo $rows['msg']; ?></td>
    </tr>
    
  </tbody>
  <?php
}
?>

</table>    
          </div>
        </div>
      </div>



  </main>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>  
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
</body>

</html>
<!-- partial -->

  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js'></script><script  src="./script.js"></script>

</body>
</html>
