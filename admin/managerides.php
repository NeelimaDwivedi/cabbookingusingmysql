<?php
require_once 'adminheader.php';
echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
$sql=array();
$user_id=$_SESSION['userdata']['user_id'];
$Ride= new Ride();
$dbconn=new  dbconnection();
$sql=$Ride->manage_rides($dbconn->conn);
if (isset($_GET['delete'])) {
    $ride_id=$_GET['delete'];
    $sql=$Ride->delete_rides($ride_id, $dbconn->conn);

}

if (isset($_POST['month-asc'])) {
    $sql=$Ride->display_allmonthwiseasc($dbconn->conn);
}
if (isset($_POST['month-desc'])) {
    $sql=$Ride->display_allmonthwisedesc($dbconn->conn);
}

if (isset($_POST['date-asc'])) {
    $sql=$Ride->display_alldatewiseasc($dbconn->conn);
}
if (isset($_POST['date-desc'])) {
    $sql=$Ride->display_alldatewisedesc($dbconn->conn);
}

if (isset($_POST['price-asc'])) {
    $sql=$Ride->display_allpricewiseasc($dbconn->conn);
}
if (isset($_POST['price-desc'])) {
    $sql=$Ride->display_allpricewisedesc($dbconn->conn);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>CEDCAB</title>
</head>
<body>
    <div id="main1">
    <div class="dropdown1">
      <span>Display sorted data</span>
      <div class="dropdown1-content">
      <form  method="POST" action="">
            <li><input type="submit" name="month-asc" value="Sort by month( in ascending order)"></li>
            <li><input type="submit" name="month-desc" value="Sort by month( in descending order)"></li>
            <li><input type="submit" name="date-asc" value="Sort by date( in ascending order)"></li>
            <li><input type="submit" name="date-desc" value="Sort by date( in descending order)"></li>
            <li><input type="submit" name="price-asc" value="Sort by fare( in ascending order)" ></li>
            <li><input type="submit" name="price-desc" value="Sort by fare( in descending order)"></li>
        </form>
      </div>
    </div>
    <h2 class="h2heading">All Rides</h2>
    <table class="managerides">

        <thead>
            <tr>
            <th>Ride Id</th>
            <th>Ride date</th>
            <th>User Id</th>
            <th>Total distance</th>
            <th>Luggage Price</th>
            <th>Total Fare</th>
            <th>Ride Status</th>
            <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>


    <?php
    foreach ($sql as $v) {
        echo '<tr>';
        echo '<td>'.$v['ride_id'].'</td>';
        echo '<td>'.$v['ride_date'].'</td>';
        echo '<td>'.$v['user_id'].'</td>';
        echo '<td>'.$v['total_distance'].'</td>';
        echo '<td>'.$v['luggage'].'</td>';
        echo '<td>'.$v['total_fare'].'</td>';
        if ($v['status']==1) {
            echo '<td>Pending</td>';
        }
        if ($v['status']==0) {
            echo '<td>Cancel</td>';
        }
        if ($v['status']==2) {
            echo '<td>Complete</td>';
        }
        echo "<td><a href='editrides.php?edit= $v[ride_id]'><i class='material-icons'>edit</i></a></td>" ;
        echo "<td><a href='managerides.php?delete= $v[ride_id]'><i class='material-icons'>delete</i></a></td>" ;

        echo '</tr>';

    }
    ?>
    </tbody>
    </table>
    </div>
</body>
</html>

<?php
require_once '../footer.php';
?>