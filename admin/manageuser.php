
<?php 
include "adminheader.php";
$sql=array();
echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';

    $User= new User();
    $dbconn=new  dbconnection();
    $sql=$User->manage_user($dbconn->conn);
    echo '<pre>';
    print_r($sql);
    echo '<pre>';
include "../footer.php"; ?>
