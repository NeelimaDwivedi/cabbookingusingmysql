<?php
//error_reporting(0);
require_once '../db_config.php';
require_once '../user.php';
require_once '../location.php';
require_once '../ride.php';

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:../login.php');
}

if (isset($_POST['delete'])) {
    $user_id=$_SESSION['userdata']['user_id'];
    $User= new User();
    $dbconn=new dbconnection();
    $sql1=$User->delete_user($user_id, $dbconn->conn);

}

?>

<html>
<head>
    <title>
        Admin Panel
    </title>
    <link href="../style.css?t=1" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="header">
        <h1 id="logo"><span class="green">CED</span><span class="yellow">CAB</span></h1>
        <?php
        echo '<h2>Welcome'.' '.$_SESSION['userdata']['user_name'].'</h2>';
        ?>

<div class="navbar">
<a href="admindashboard.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Rides
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
	  <a href="managerides.php">All Rides</a>
      <a href="completedrides.php">Completed Rides</a>
      <a href="pendingrides.php">Pending Rides</a>
      <a href="cancelrides.php">Cancel Rides</a>
	</div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Location
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
	  <a href="addlocation.php">Add Location</a>
      <a href="managelocation.php">Display Location</a>
	</div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Users
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
	  <a href="manageuser.php">All Users</a>
      <a href="approveduser.php">Approved Users</a>
      <a href="pendinguser.php">Pending Users</a>
	</div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Account
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
	<form  method="POST" action="">
	 	<li><input type="submit" name="logout" value="Logout"></li>
    	<li><input type="submit" name="delete" value="Delete Account" ></li>
	</form>
	</div>
  </div>
</div>
</div>