<?php 
error_reporting(0);
require_once "location.php";
if (isset($_POST['login'])) {
    session_destroy();
    header('Location:login.php');
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
        <nav>
            <ul id="menu">
                <form  method="POST" action="">
                    <li id="left"><input type="submit" name="login" value="   Login"></li>
                </form>
            </ul>
        </nav>
    </div>
