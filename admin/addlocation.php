<?php 
require_once 'adminheader.php';
$sql=array();
if (isset($_POST['submit'])) {
    
    $name=isset($_POST['name'])?$_POST['name']:'';
    $distance=isset($_POST['distance'])?$_POST['distance']:'';
    $is_available= 1;
    $Location= new Location();
    $dbconn=new dbconnection();
    $sql=$Location->add_location($is_available, $distance, $name, $dbconn->conn) ;

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Add Location
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
        <h1>Add Location</h1>
        <form id="signupForm" action="" method="POST" enctype="multipart/form-data">
            <label for="name">Location Name:<input type="text"  name="name" placeholder="Enter location name"></label>
            <label for="distance">Distance:<input type="text"  name="distance" placeholder="enter distance in km"></label>
            <p><input type="submit" name="submit" value="Add Location"></p>
        </form>
    </div>
</body>
</html>
<?php 
require_once '../footer.php';
?>