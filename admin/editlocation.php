<?php require_once 'adminheader.php';
$location_data=array();
$Location= new Location();
$dbconn=new  dbconnection();
if (isset($_POST['submit'])) {
    $location_data['is_available']=isset($_POST['available'])?$_POST['available']:'';
    $location_data['name']=isset($_POST['name'])?$_POST['name']:'';
    $location_data['distance']=isset($_POST['distance'])?$_POST['distance']:'';
    $location_data['location_id']=$_GET['edit'];
    $sql=$Location->edit_location($location_data['location_id'], $location_data['name'], $location_data['distance'], $location_data['is_available'], $dbconn->conn);
}

if (isset($_GET['edit'])) {
    $location_id=$_GET['edit'];
    $sql=$Location->get_location($location_id, $dbconn->conn);
   $location_data = $sql[0];
}

?>

<html>
<head>
    <title>
          Update Location
    </title>
</head>
<body>
    <div id="errors">
    <?php //if (sizeof($sql)>0) : ?>
            <ul>
            <?php //foreach($sql as $k=>$v): ?>
                <?php //foreach($v as $v1): ?>
                    <li><?php //echo $v1; ?></li>
                <?php //endforeach; ?>
            <?php //endforeach; ?>
            </ul>
            <?php //endif; ?>
    </div>
    <div id="main1">
    <h2>Update Location</h2>
        <form id="updateForm" action="editlocation.php?edit=<?php echo trim($_GET['edit']);?>" method="POST" enctype="multipart/form-data">
            <label for="name">Name:<input type="text" value="<?php echo $location_data['name']; ?>" name="name"></label>
            <label for="distance">Distance:<input type="text" value="<?php echo $location_data['distance']; ?>" name="distance"></label>
            
            <label for="available">Available
            <select name="available" id="available">
            <option value="--select--">--select--</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
            </select></label><p><input type="submit" name="submit" value="Update"><a href='managelocation.php'>Click here to see updated records</a></p>
        </form>
    </div>
<?php require_once '../footer.php'; ?>