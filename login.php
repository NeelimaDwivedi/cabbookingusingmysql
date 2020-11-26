<?php   
$errors=array();
require_once 'db_config.php';
require_once 'user.php';
if (isset($_POST['submit'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $User= new User();
    $dbconn=new  dbconnection();
    $sql=$User->login($username, $password, $dbconn->conn);
    echo $sql;
}
if (isset($_POST['registerpage'])) {
    header('Location:register.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Login
    </title>
    <link type="text/css" rel="stylesheet" href="style.css?t=1">
</head>
<body>
    <div id="errors">
        <?php if(sizeof($errors)>0) : ?>
            <ul>
            <?php foreach($errors as $error): ?>
                <li><?php echo $error['msg']; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <di id="main1">
        <h1>Login</h1>
        <form id="signinForm" action="" method="POST" enctype="multipart/form-data">
            <label for="username">Username:<input type="text"  name="username"></label>
            <label for="password">Password:<input type="password"  name="password"></label>
            <p><input type="submit" name="submit" value="Login"><input type="submit" name="registerpage" value="Register"></p>
        </form>
    </div>
</body>
</html>