<?php
include_once 'adminheader.php';

echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">' ;
$sql=array();

$Location= new Location();
$dbconn=new  dbconnection();
$sql=$Location->manage_location($dbconn->conn);
if (isset($_GET['delete'])) {
    $location_id=$_GET['delete'];
    $sql=$Location->delete_location($location_id, $dbconn->conn);

}
if (isset($_POST['distance-asc'])) {
    $sql=$Location->display_distancewiseasc($dbconn->conn);
}
if (isset($_POST['distance-desc'])) {
    $sql=$Location->display_distancewisedesc($dbconn->conn);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>CEDCAB</title>
</head>
<body>
    <div id="main1">
    <div id="main1">
    <div class="dropdown1">
      <span>Display sorted data</span>
      <div class="dropdown1-content">
      <form  method="POST" action="">
            <li><input type="submit" name="distance-asc" value="Sort by distance( in ascending order)"></li>
            <li><input type="submit" name="distance-desc" value="Sort by distance( in descending order)"></li>
      </form>
      </div>
    </div>
    <h2 class="managelocheading">Manage Location</h2>
    <table class="managelocation">

        <thead>
            <tr>
            <th>Location Id</th>
            <th>Location Name</th>
            <th>Location Distance</th>
            <th>Is Available</th>
            <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>


    <?php
    foreach ($sql as $v) {
        echo '<tr>';
        echo '<td>'.$v['location_id'].'</td>';
        echo '<td>'.$v['name'].'</td>';
        echo '<td>'.$v['distance'].'</td>';
        if ($v['is_available']==1) {
            echo '<td>Yes</td>';
        }
        if ($v['is_available']==0) {
            echo '<td>No</td>';
        }
        echo "<td><a href='editlocation.php?edit= $v[location_id]'><i class='material-icons'>edit</i></a></td>" ;
        echo "<td><a href='managelocation.php?delete= $v[location_id]'><i class='material-icons'>delete</i></a></td>" ;

        echo '</tr>';

    }
    ?>
    </tbody>
    </table>
    </div>
</body>
</html>

<?php include "../footer.php"; ?>