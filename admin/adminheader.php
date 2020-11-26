<?php
error_reporting(0);
require_once '../db_config.php';
require_once '../user.php';
require_once '../location.php';

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

        <nav>
            <ul id="menu">
                <li><a href="admindashboard.php">Home</a></li>
                <form  method="POST">
                    <li><input type="submit" name="logout" value="   Logout"></li>
                    <li><input type="submit" name="delete" value="Delete Account" ></li>
                </form>

            </ul>
        </nav>
    </div>