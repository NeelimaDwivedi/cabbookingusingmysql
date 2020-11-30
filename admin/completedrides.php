<?php require_once 'adminheader.php';
$sql=array();
$user_id=$_SESSION['userdata']['user_id'];
$Ride= new Ride();
$dbconn=new  dbconnection();
$sql=$Ride->display_completedrides($dbconn->conn);
$sql1=$Ride->calculate_totalfare($dbconn->conn);

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
    <?php foreach($sql1 as $v) {
        echo "<h3>Total amount you spent:</h3><b>$".$v."</b><br><br>";
    } ?>
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
    <h2 class="h2heading">Completed Rides</h2>
    <table class="history">

        <thead>
            <tr>
            <th>Ride Id</th>
            <th>Ride date</th>
            <th>User Id</th>
            <th>Total distance</th>
            <th>Luggage Price</th>
            <th>Total Fare</th>
            <th>Ride Status</th>
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
        echo '</tr>';

    }
    ?>
    </tbody>
    </table>
    </div>
</body>
</html>
<?php require_once '../footer.php'; ?>