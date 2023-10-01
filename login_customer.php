<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
if (empty($_POST['customer_username']) || empty($_POST['customer_password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$customer_username=$_POST['customer_username'];
$customer_password=$_POST['customer_password'];

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
require 'connection.php';
$conn = Connect();

// SQL query to fetch information of registerd users and finds user match.
$query2="select * from admin where username='$customer_username' And password='$customer_password' ";
$stmt2=mysqli_query($conn,$query2);
$row2=mysqli_fetch_assoc($stmt2);
$query3="select * from clients where client_username='$customer_username' And client_password='$customer_password' ";
$stmt3=mysqli_query($conn,$query3);
$row3=mysqli_fetch_assoc($stmt3);
$query = "SELECT customer_username, customer_password FROM customers WHERE customer_username=? AND customer_password=? LIMIT 1";
// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt -> bind_param("ss", $customer_username, $customer_password);
$stmt -> execute();
$stmt -> bind_result($customer_username, $customer_password);
$stmt -> store_result();

if ($stmt->fetch())  //fetching the contents of the row
{
	$_SESSION['login_customer']=$customer_username; // Initializing Session
	header("location: index.php"); // Redirecting To Other Page
}
elseif($row2['username']==$customer_username && $row2['password']==$customer_password)
{	
	header("location: dashboard.php");
}  
elseif($row3['client_username']==$customer_username && $row3['client_password']==$customer_password){
	$_SESSION['login_client']=$customer_username; // Initializing Session
	header("location: index.php"); // Redirecting To Other Page
}
else{
	header("location: error.html");
}
mysqli_close($conn); // Closing Connection
}
}
?>