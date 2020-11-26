<?php 
require_once "db_config.php";
require_once "user.php";
$sql=array();
if (isset($_POST['submit'])) {
    
        $name=isset($_POST['name'])?$_POST['name']:'';
        $user_name=isset($_POST['uname'])?$_POST['uname']:'';
        $passwrd=isset($_POST['password'])?$_POST['password']:'';
        $repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
        $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';
        $isblock=1;
        $User= new User();
        $dbconn=new dbconnection();
        $sql=$User->register($user_name, $name, $passwrd, $repassword, $mobile, $isblock, $dbconn->conn) ;

}
if (isset($_POST['loginpage'])) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Register
    </title>
    <link type="text/css" rel="stylesheet" href="style.css">
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
        <h1>Register</h1>
        <form id="signupForm" action="" method="POST" enctype="multipart/form-data">
            <label for="name">Name:<input type="text"  name="name"></label>
            <label for="uname">Username:<input type="text"  name="uname"></label>
            <label for="password">Password:<input type="password"  name="password"></label>
            <label for="repassword">Re-Password:<input type="password"  name="repassword"></label>
            <label for="mobile">Mobile:<input type="text"  name="mobile"></label>
            <p><input type="submit" name="submit" value="Submit"><input type="submit" name="loginpage" value="Login"></p>
        </form>
    </div>
</body>
</html>