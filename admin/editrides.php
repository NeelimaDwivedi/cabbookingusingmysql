<?php
include "adminheader.php";
$ride_data=array();
$Ride= new Ride();
$dbconn=new  dbconnection();
if (isset($_GET['edit'])) {
    $ride_id=$_GET['edit'];
    $sql=$Ride->get_ride($ride_id, $dbconn->conn);
    $ride_data = $sql[0];
}

if (isset($_POST['submit'])) {

    $ride_data['ride_date']=isset($_POST['date'])?$_POST['date']:'';
    $ride_data['distance']=isset($_POST['distance'])?$_POST['distance']:'';
    $ride_data['luggage']=isset($_POST['luggage'])?$_POST['luggage']:'';
    $ride_data['total_fare']=isset($_POST['fare'])?$_POST['fare']:'';
    $ride_data['status']=isset($_POST['status'])?$_POST['status']:'';
    $ride_data['ride_id']=$_GET['edit'];
    $sql=$Ride->edit_ridedetailes($ride_data['ride_id'], $ride_data['ride_date'], $ride_data['distance'], $ride_data['luggage'], $ride_data['total_fare'], $ride_data['status'],  $dbconn->conn);

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
    <h2>Update Ride info</h2>
        <form id="updateForm" action="editrides.php?edit=<?php echo trim($_GET['edit']);?>" method="POST" enctype="multipart/form-data">
            <label for="rideid">Ride ID:<input type="text" value="<?php echo $ride_data['ride_id']; ?>" name="rideid" id="rideid" disabled></label>
            <label for="userid">User ID:<input type="text" value="<?php echo $ride_data['user_id']; ?>" name="userid" id="userid" disabled></label>
            <label for="date">Date:<input type="date" value="<?php echo $ride_data['date']; ?>" name="date" id="date" min=""></label>
            <label for="distance">Distance:<input type="text" value="<?php echo $ride_data['total_distance']; ?>" name="distance"></label>
            <label for="luggage">Luggage Price:<input type="text" value="<?php echo $ride_data['luggage']; ?>" name="luggage"></label>
            <label for="fare">Total Fare:<input type="text" value="<?php echo $ride_data['total_fare']; ?>" name="fare"></label>
            
            <label for="status">Ride Status
            <select name="status" id="status">
            <option value="--select--">--select--</option>
            <option value="2">Completed</option>
            <option value="1">Pending</option>
            <option value="0">Cancelled</option>
            </select></label><p><input type="submit" name="submit" value="Update"><a href='managerides.php'>Click here to see updated records</a></p>
        </form>
    </div>
</body>
<script>
        let today = new Date().toISOString().slice(0, 10);
         document.getElementById('date').setAttribute('min',today);
    </script>
</html>


<?php require_once '../footer.php' ?>
