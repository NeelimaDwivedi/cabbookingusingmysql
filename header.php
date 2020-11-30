<?php
//error_reporting(0);

$errors=array();
require_once "db_config.php";
require_once "user.php";
require_once "location.php";
require_once "ride.php";
$user_id=$_SESSION['userdata']['user_id'];
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:index.php');
}
if (isset($_POST['update'])) {
    header('Location:updateuser.php');
}
if (isset($_POST['delete'])) {
    $User= new User();
    $dbconn=new dbconnection();
    $sql1=$User->delete_user($user_id, $dbconn->conn);

}

?>



<!DOCTYPE html>
<html>
<head>
	<title>
		CEDCAB
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>

	<div id="header">
		<h1 id="logo"><span class="green">CED</span><span class="yellow">CAB</span></h1>
		<?php
			echo '<h2>Welcome'.' '.$_SESSION['userdata']['user_name'].'</h2>';
		?>
		<div class="navbar">
  <a href="index.php">Book Rides</a>
  <a href="invoice.php">Invoice</a>
  <div class="dropdown">
    <button class="dropbtn">Rides
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
	  <a href="allrides.php">All Rides</a>
      <a href="completedrides.php">Completed Rides</a>
      <a href="pendingrides.php">Pending Rides</a>
	</div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Account
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
	<form  method="POST" action="">
		<li><input type="submit" name="update" value="Update"></li>
	 	<li><input type="submit" name="logout" value="Logout"></li>
    	<li><input type="submit" name="delete" value="Delete Account" ></li>
	</form>
	</div>
  </div>
</div>
</div>