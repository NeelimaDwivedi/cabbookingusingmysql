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
   
}
   
 ?>