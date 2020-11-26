<?php
include "adminheader.php";
$sql=array();
if (isset($_GET['edit'])) {
    $uid=$_GET['edit'];
    $User= new User();
    $dbconn=new dbconnection();
    $sql1=$User->get_user($uid, $dbconn->conn);

}

if (isset($_POST['submit'])) {
    $name=isset($_POST['name'])?$_POST['name']:'';
    $user_name=isset($_POST['username'])?$_POST['username']:'';
    $passwrd=isset($_POST['password'])?$_POST['password']:'';
    $repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
    $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';
    $is_admin=isset($_POST['role'])?$_POST['role']:'';
    $isblock=isset($_POST['status'])?$_POST['status']:'';
    $user_id=$_SESSION['useredit']['user_id'];
    $User= new User();
    $dbconn=new dbconnection();
    $sql=$User->edit_user($user_id, $user_name, $name, $passwrd, $repassword, $mobile, $is_admin, $isblock, $dbconn->conn) ;
    
    
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
                <?php  foreach($v as $v1): ?>
                    <li><?php echo $v1; ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </ul>
    <?php  endif; ?>
    </div>
    <div id="main1">
    <h2>Update</h2>
        <form id="updateForm" action="edituser.php" method="POST" enctype="multipart/form-data">
            <label for="name">Name:<input type="text" value="<?php echo $_SESSION['useredit']['name']; ?>" name="name"></label>
            <label for="username">Username:<input type="text" value="<?php echo $_SESSION['useredit']['user_name']; ?>" name="username"></label>
            <label for="password">Password:<input type="password" value="<?php echo $_SESSION['useredit']['password']; ?>" name="password"></label>
            <label for="repassword">Re-Password:<input type="password" value="<?php echo $_SESSION['useredit']['password']; ?>" name="repassword"></label>
            <label for="mobile">Mobile:<input type="text" value="<?php echo $_SESSION['useredit']['mobile']; ?>"  name="mobile"></label>
            <label for="role">Admin Status:<input type="text" value="<?php echo $_SESSION['useredit']['is_admin']; ?>"  name="role"></label>
            <label for="status">Blocked Status:<select name="status"> <option name="select">--select--</option><option  value="1" name="blocked">Blocked</option><option value="0" name="unblocked">unblocked</option></select></label>
            <p><input type="submit" name="submit" value="Update"><a href='manageuser.php'>Click here to see updated records</a></p>
        </form>
    </div>

<?php include "../footer.php"; ?>
