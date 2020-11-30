<?php
include "adminheader.php";
$user_data=array();
$User= new User();
$dbconn=new  dbconnection();



if (isset($_POST['submit'])) {
    
    $user_data['name']=isset($_POST['name'])?$_POST['name']:'';
    $user_data['mobile']=isset($_POST['mobile'])?$_POST['mobile']:'';
    $user_data['isblock']=isset($_POST['isblock'])?$_POST['isblock']:'';
    $user_data['user_id']=$_GET['edit'];
    $sql=$User->edit_user($user_data['user_id'], $user_data['name'], $user_data['mobile'], $user_data['isblock'],  $dbconn->conn);
    
}

if (isset($_GET['edit'])) {
    $user_id=$_GET['edit'];
    $sql=$User->get_user($user_id, $dbconn->conn);
   $user_data = $sql[0];
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
    <h2>Update</h2>
        <form id="updateForm" action="edituser.php?edit=<?php echo trim($_GET['edit']);?>" method="POST" enctype="multipart/form-data">
            <label for="name">Name:<input type="text" value="<?php echo $user_data['name']; ?>" name="name"></label>
             <label for="mobile">Mobile:<input type="text" value="<?php echo $user_data['mobile']; ?>"  name="mobile"></label>
            <label for="isblock">Status
            <select name="isblock" id="isblock">
            <option value="--select--">--select--</option>
            <option value="0">Unblock</option>
            <option value="1">Block</option>
            </select></label><p><input type="submit" name="submit" value="Update"><a href='manageuser.php'>Click here to see updated records</a></p>
        </form>
    </div>

<?php include "../footer.php"; ?>