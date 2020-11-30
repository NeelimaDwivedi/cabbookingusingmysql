<?php
include "header.php";
$sql=array();


if (isset($_POST['submit'])) {
    $name=isset($_POST['name'])?$_POST['name']:'';
    $user_name=isset($_POST['username'])?$_POST['username']:'';
    $passwrd=isset($_POST['password'])?$_POST['password']:'';
    $repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
    $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';
    $user_id=$_SESSION['userdata']['user_id'];
    $User= new User();
    $dbconn=new dbconnection();
    $sql=$User->update_user($user_id, $user_name, $name, $passwrd, $repassword, $mobile,  $dbconn->conn) ;
    
    
}


?>
<html>
<head>
    <title>
        Update
    </title>
</head>
<body>
    <div id="errors">
    <?php if (sizeof($sql)>0) : ?>
            <ul>
            <?php foreach($sql as $k=>$v): ?>
                <?php foreach($v as $v1): ?>
                    <li><?php echo $v1; ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </ul>
    <?php endif; ?>
    </div>
    <div id="main1">
    <h2>Update</h2>
        <form id="updateForm" action="updateuser.php" method="POST" enctype="multipart/form-data">
            <label for="name">Name:<input type="text" value="<?php echo $_SESSION['userdata']['name']; ?>" name="name"></label>
            <label for="username">Username:<input type="text" value="<?php echo $_SESSION['userdata']['user_name']; ?>" name="username" disabled></label>
            <label for="password">Password:<input type="password" value="<?php echo $_SESSION['userdata']['passwrd']; ?>" name="password"></label>
            <label for="repassword">Re-Password:<input type="password" value="<?php echo $_SESSION['userdata']['passwrd']; ?>" name="repassword"></label>
            <label for="mobile">Mobile:<input type="text" value="<?php echo $_SESSION['userdata']['mobile']; ?>"  name="mobile"></label>
            <p><input type="submit" name="submit" value="Update"></p>
        </form>
    </div>

<?php include "footer.php"; ?>
