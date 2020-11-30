<?php include 'adminheader.php';

?>
<!DOCTYPE html>
<html>
    <head>
    <title>CEDCAB</title>
    </head>
    <body>

        <div class="section blue"><a href="approveduser.php"><h2>Active users</h2></a>
            <?php
                $sql=array();
                $User= new User();
                $dbconn=new  dbconnection();
                $sql=$User->display_approveduser($dbconn->conn);
                $c=sizeof($sql);
                echo "<b>".$c."</b>";
            ?>
        </div>
        <div class="section yellow"><a href="pendinguser.php"><h2>Pending users</h2></a>
        <?php
                $sql=array();
                $User= new User();
                $dbconn=new  dbconnection();
                $sql=$User->display_pendinguser($dbconn->conn);
                $c=sizeof($sql);
                echo "<b>".$c."</b>";
            ?>
        </div>
        <div class="section orange"><a href="manageuser.php"><h2>Total users</h2></a>
        <?php
                $sql=array();
                $User= new User();
                $dbconn=new  dbconnection();
                $sql=$User->manage_user($dbconn->conn);
                $c=sizeof($sql);
                echo "<b>".$c."</b>";
        ?>
        </div>
        <div class="section blue"><a href="managerides.php"><h2>Total rides</h2></a>
        <?php
                $sql=array();
                $Ride= new Ride();
                $dbconn=new  dbconnection();
                $sql=$Ride->manage_rides($dbconn->conn);
                $c=sizeof($sql);
                echo "<b>".$c."</b>";
        ?>
        </div>
        <div class="section yellow"><a href="completedrides.php"><h2>Complete rides</h2></a>
        <?php
                $sql=array();
                $Ride= new Ride();
                $dbconn=new  dbconnection();
                $sql=$Ride->display_completedrides($dbconn->conn);
                $c=sizeof($sql);
                echo "<b>".$c."</b>";
        ?>
        </div>
        <div class="section orange"><a href="pendingrides.php"><h2>Pending rides</h2></a>
        <?php
                $sql=array();
                $Ride= new Ride();
                $dbconn=new  dbconnection();
                $sql=$Ride->display_pendingride($dbconn->conn);
                $c=sizeof($sql);
                echo "<b>".$c."</b>";
        ?>
        </div>
        <div class="section blue"><a href="cancelrides.php"><h2>Cancel rides</h2></a>
        <?php
                $sql=array();
                $Ride= new Ride();
                $dbconn=new  dbconnection();
                $sql=$Ride->display_cancelrides($dbconn->conn);
                $c=sizeof($sql);
                echo "<b>".$c."</b>";
        ?>
        </div>
        <div class="section yellow"><a href="managelocation.php"><h2>Available  location</h2></a>
        <?php
                $sql=array();
                $Location= new Location();
                $dbconn=new  dbconnection();
                $sql=$Ride->manage_rides($dbconn->conn);
                $c=sizeof($sql);
                echo "<b>".$c."</b>";
        ?>
        </div>
        <div class="section orange"><a href="completedrides.php"><h2>Total Earnings</h2></a>
        <?php
                $sql=array();
                $Ride= new Ride();
                $dbconn=new  dbconnection();
                $sql=$Ride->calculate_totalfare($dbconn->conn);
                foreach ($sql as $v) {
                    echo "<b id='earn'>$".$v."</b>";
                }
        ?>
        </div>

        <!-- <div class="section"></div> -->

    </body>
</html>
<?php include "../footer.php"; ?>