<?php
session_start();
require_once "db_config.php";
class Location {
    public $Location_id;
    public $name;
    public $distance;
    public $is_available;

    function add_location($is_available, $distance, $name, $conn) {
        $errors =array();
        if (!is_numeric($distance)) {
            $errors[] =array('msg'=>'Enter a valid numeric value');
        }
        if ($name=='') {
            $errors[] =array('msg'=>'Name is required') ;
        }
        if (sizeof($errors)==0) {
            $sql = "INSERT INTO `location`(`distance`,`name`, `is_available`) VALUES('".$distance."','".$name."','".$is_available."')" ;
            if ($conn->query($sql) === true) {
                echo "New record created successfully";
            } else {
                $errors[] = array('input'=>'form','msg'=>$conn->error);
            }
        }
            return  $errors;

    }
    function display_location($conn) {
        $row = array();
        $sql = 'SELECT `name`, `distance`  FROM `location` WHERE `is_available`=1';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row[] = $result->fetch_assoc()) {

            }

        }
        return $row;
    }
    function get_distance($conn, $location) {
        $row=array();
        $sql="SELECT `distance` FROM `location` WHERE `name`='".$location."'";
        $result=$conn->query($sql);
        if ($result->num_rows>0) {
            while ($row[]=$result->fetch_assoc()) {
                return $row[0]['distance'];
            }
        }
    }
    function Manage_location($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `location` " ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function delete_location($location_id, $conn) {
        $sql = "DELETE FROM `location` WHERE `location_id`='".$location_id."'";
        if ($conn->query($sql) === true) {
            header('Location:managelocation.php');
            echo "Record deleted successfully";
        } else {
            $errors[]=array('msg'=>$conn->error);
        }
    }
    function get_location($location_id, $conn)
    {
        $results = array();
        $sql = "SELECT * FROM `location` where `location_id`=$location_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              array_push($results, $row);
            }
        }
        return $results;
    }
    function edit_location($location_id, $name, $distance, $is_available,  $conn)
    {
        $sql="UPDATE `location` SET `name`='".$name."', `distance`='".$distance."', `is_available`='".$is_available."' WHERE `location_id`=$location_id" ;
        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM `location` where `location_id`='".$location_id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    echo '<h2>Your data for the Location'.' '.$row['name'].' is updated</h2>' ;

                }
            } else {
                $errors[]=array('input'=>'form','msg'=>'Invalid Updation');
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }
    function display_distancewisedesc($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `location` ORDER BY `distance` DESC" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;
    }
    function display_distancewiseasc($conn)
    {
        $row = array();
        $sql = "SELECT * FROM `location` ORDER BY `distance` ASC" ;
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