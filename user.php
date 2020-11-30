<?php
session_start();
require_once "db_config.php";
class User {
    public $user_id;
    public $user_name;
    public $name;
    public $dateofsignup;
    public $mobile;
    public $isblock;
    public $passwrd;
    public $is_admin;
    function login($user_name, $passwrd, $conn) {
        $passwrd = md5($passwrd);
        $sql = 'SELECT * FROM `users` where
`user_name`="'.$user_name.'" AND `passwrd`="'.$passwrd.'"' ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['userdata']=array('user_id'=>$row['user_id'], 'user_name'=> $row['user_name'], 'name'=>$row['name'], 'passwrd'=>$row['passwrd'], 'mobile'=>$row['mobile'], 'is_block'=>$row['is_block'] );
                if ($row['is_admin'] ==1) {
                    header('location:admin/admindashboard.php');
                } elseif ($row['isblock']==1) {
                    header('location:login.php');
                } else {
                    header('location:index.php');
                }
            }
        } else {
            $rtn="Login Failed !";
        }
    }
    function register($user_name, $name, $passwrd, $repassword, $mobile, $isblock,  $conn) {
        $errors =array();
        if ($passwrd != $repassword) {
            $errors[] =array('msg'=>'password does not match');
        }
        if ($user_name=='') {
            $errors[] =array('msg'=>'Name is required and must be unique') ;
        }
        if ($name=='') {
            $errors[] =array('msg'=>'Username is required');
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/" ,$name)) {
                $errors[]=array('msg'=>'Only letters and white space allowed in name') ;
            }
        }
        if ($passwrd=='') {
            $errors[] =array('msg'=>'Password is required');
        }
        if ($mobile=='') {
            $errors[] =array('msg'=>'Mobile no. is required');
        } else {
            if (!is_numeric($mobile)) {
                $errors[]=array('msg'=>'Invalid Mobile no. format');
            }
        }
        if (sizeof($errors)==0) {
            $sql = "INSERT INTO `users`(`user_name`,`name`, `passwrd`, `mobile`, `isblock`) VALUES('".$user_name."','".$name."', '".md5($passwrd)."', '".$mobile."', '".$isblock."')" ;
            if ($conn->query($sql) === true) {
                echo "New record created successfully";
            } else {
                $errors[] = array('input'=>'form','msg'=>$conn->error);
            }
        }
            return  $errors;


    }
    function manage_user($conn)
    {

        $row = array();
        $sql = "SELECT * FROM `users` " ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;

    }
    function display_approveduser($conn)
    {

        $row = array();
        $sql = "SELECT * FROM `users` WHERE `isblock`=0 " ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;

    }
    function display_pendinguser($conn)
    {

        $row = array();
        $sql = "SELECT * FROM `users` WHERE `isblock`=1 " ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($arr = $result->fetch_assoc()) {
                $row[]= $arr;
            }

        }
        return $row;

    }
    function delete_users($user_id, $conn) {
        $sql = "DELETE FROM users WHERE `user_id`='".$user_id."'";
        if ($conn->query($sql) === true) {
            header('Location:manageuser.php');
            echo "Record deleted successfully";
        } else {
            $errors[]=array('msg'=>$conn->error);
        }
    }
    function get_user($user_id, $conn) {
        $results = array();
        $sql = "SELECT * FROM `users` where `user_id`=$user_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              array_push($results, $row);
            }
        }
        return $results;
    }
    function delete_user($user_id, $conn) {
        $sql = "DELETE FROM users WHERE `user_id`='".$user_id."'";
        if ($conn->query($sql) === true) {
            header('Location:login.php');
            echo "Record deleted successfully";
        } else {
            $errors[]=array('msg'=>$conn->error);
        }
    }
    function update_user($user_id, $user_name, $name, $passwrd, $repassword, $mobile,  $conn) {
        $errors=array();
        if ($passwrd != $repassword) {
            $errors[] =array('msg'=>'password does not match');
        }
        if ($user_name=='') {
            $errors[] =array('msg'=>'Username is required and must be unique') ;
        }
        if ($name=='') {
            $errors[] =array( 'msg'=>'Name is required');
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $errors[]=array('msg'=>'Only letters and white space allowed in username') ;
            }
        }
        if ($passwrd=='') {
            $errors[] =array('msg'=>'Password is required');
        }
        if ($mobile=='') {
            $errors[] =array('msg'=>'mobile is required');
        } else {
            if (!is_numeric($mobile)) {
                $errors[]=array('msg'=>'Invalid mobile no. format');
            }
        }
        if (sizeof($errors)==0) {
            $sql="UPDATE users SET `user_name`='".$user_name."',`name`='".$name."', `passwrd`='".$passwrd."', `mobile`='".$mobile."', `is_admin`='".$is_admin."' WHERE `user_id`=$user_id" ;
            if ($conn->query($sql) === true) {
                $sql1= "SELECT * FROM users where `user_id`='".$user_id."'";
                $res = $conn->query($sql1);
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $_SESSION['userdata'] = array('name' => $row['name'],'user_name' => $row['user_name'],'user_id' => $row['user_id'], 'passwrd'=> $row['passwrd'], 'mobile'=>$row['mobile']) ;
                        echo '<h2>Your data for the user'.' '.$_SESSION['useredit']['user_name'].' is updated</h2>' ;
                    }
                } else {
                    $errors[]=array('input'=>'form','msg'=>'Invalid Updation');
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }
            $conn->close();
        }
        return  $errors;
    }
    function edit_user($user_id, $name, $mobile, $isblock, $conn)
    {
        $sql="UPDATE users SET `name`='".$name."', `mobile`='".$mobile."', `isblock`='".$isblock."' WHERE `user_id`=$user_id" ;
        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM users where `user_id`='".$user_id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    echo '<h2>Your data for the user'.' '.$row['user_name'].' is updated</h2>' ;
                    if ($row['isblock']==0) {
                        $sql="UPDATE users SET `dateofsignup`=now()  WHERE  `user_id`='".$user_id."' " ;
                        if ($conn->query($sql) === true) {
                            echo 'Signin Approved';
                        }
                    }
                }
            } else {
                $errors[]=array('input'=>'form','msg'=>'Invalid Updation');
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }

}
?>
