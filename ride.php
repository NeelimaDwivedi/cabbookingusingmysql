<?php
//session_start();
require_once "db_config.php";

class Ride {

    public $ride_id;
    public $cabtype;
    public $ride_date;
    public $from;
    public $to;
    public $total_distance;
    public $luggage;
    public $total_fare;
    public $status;
    public $user_id;

    public function book_ride($cabtype, $ridedate, $from, $to, $total_distance, $luggage, $total_fare, $status, $user_id, $conn)
    {

        $sql = "INSERT INTO `ride` (`cabtype`,`ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `user_id`) VALUES('".$cabtype."','".$ridedate."', '".$from."', '".$to."', '".$total_distance."', '".$luggage."', '".$total_fare."', '".$status."', '".$user_id."')" ;
        if ($conn->query($sql) === true) {
                echo "<h3>Thank you for booking ride check your invoice!</h3>";
        } else {
                $errors[] = array('input'=>'form','msg'=>$conn->error);
        }
    }
    function display_allrides($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`='".$user_id."'" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_pendingrides($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`='".$user_id."' AND  `status`=1" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_completerides($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`='".$user_id."' AND  `status`=2" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_cancelrides($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `status`=0" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_completedrides($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `status`=2" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_pendingride($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `status`=1" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function manage_rides($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` " ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;

    }

    function delete_rides($ride_id, $conn) {
        $sql = "DELETE FROM ride WHERE `ride_id`='".$ride_id."'";
        if ($conn->query($sql) === true) {
            header('Location:managerides.php');
            echo "Record deleted successfully";
        } else {
            $errors[]=array('msg'=>$conn->error);
        }
    }

    function calculate_fare($user_id, $conn)
    {
        $sql=" SELECT SUM(`total_fare`) FROM ride WHERE `status` =2 AND  `user_id`='".$user_id."' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

        }
        return $row;


    }
    function calculate_totalfare($conn)
    {
        $sql=" SELECT SUM(`total_fare`) FROM ride WHERE `status` =2 ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

        }
        return $row;
    }
    function get_ride($ride_id, $conn)
    {
        $results = array();
        $sql = "SELECT * FROM `ride` where `ride_id`=$ride_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              array_push($results, $row);
            }
        }
        return $results;
    }
    function edit_ridedetailes($ride_id, $ride_date, $total_distance, $luggage, $total_fare, $status, $conn)
    {
        $sql="UPDATE ride SET `ride_date`='".$ride_date."', `total_distance`='".$total_distance."', `luggage`='".$luggage."', `total_fare`='".$total_fare."', `status`='".$status."' WHERE `ride_id`=$ride_id" ;
        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM ride where `ride_id`='".$ride_id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    echo '<h2>Your data for the ride ID'.' '.$row['ride_id'].' is updated</h2>' ;
                }
            } else {
                $errors[]=array('input'=>'form','msg'=>'Invalid Updation');
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }
    function display_monthwiseasc($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`=$user_id ORDER BY `ride_date` ASC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_monthwisedesc($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`=$user_id ORDER BY  `ride_date` DESC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_datewiseasc($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`=$user_id ORDER BY `ride_date` ASC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_datewisedesc($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`=$user_id ORDER BY `ride_date` DESC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }

    function display_pricewiseasc($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`=$user_id ORDER BY `total_fare` ASC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_pricewisedesc($user_id, $conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` WHERE `user_id`=$user_id ORDER BY `total_fare` DESC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_allmonthwiseasc($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` ORDER BY `ride_date` ASC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_allmonthwisedesc($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` ORDER BY  `ride_date` DESC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_alldatewiseasc($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` ORDER BY `ride_date` ASC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_alldatewisedesc($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` ORDER BY `ride_date` DESC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }

    function display_allpricewiseasc($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` ORDER BY `total_fare` ASC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_allpricewisedesc($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `ride` ORDER BY `total_fare` DESC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
}

?>