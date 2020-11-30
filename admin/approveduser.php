<?php 
require_once 'adminheader.php';
echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
$sql=array();
$User= new User();
$dbconn=new  dbconnection();
$sql=$User->display_approveduser($dbconn->conn);

?>
<!DOCTYPE html>
<html>
<head>
    <title>CEDCAB</title>
</head>
<body>
    <div id="main1">
    <h2 class="h2heading">Approved Users</h2>
    <table class=" users">

        <thead>
            <tr>
            <th>User Id</th>
            <th>User Name</th>
            <th>Name</th>
            <th>Signup Date</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Password</th>
            <th>Role</th>
            </tr>
        </thead>
        <tbody>
            
        
    <?php 
    foreach ($sql as $v) {
        echo '<tr>';
        echo '<td>'.$v['user_id'].'</td>';
        echo '<td>'.$v['user_name'].'</td>';
        echo '<td>'.$v['name'].'</td>';
        echo '<td>'.$v['dateofsignup'].'</td>';
        echo '<td>'.$v['mobile'].'</td>';
        if ($v['isblock']==1) {
            echo '<td>Block</td>';
        }
        if ($v['isblock']==0) {
            echo '<td>unblock</td>';
        }
        echo '<td>'.$v['passwrd'].'</td>';
      
        if ($v['is_admin']==1) {
            echo '<td>Admin</td>';
        }
        if ($v['is_admin']==0) {
            echo '<td>User</td>';
        }        
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