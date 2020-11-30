
<?php 
session_start();
if (!isset($_SESSION['userdata'])) {
    include 'logintab.php';
} else {
    include 'header.php';
}

$sql=array();

$Location= new Location();
$dbconn=new  dbconnection();
$sql=$Location->display_location($dbconn->conn);

if (isset($_POST['booknow'])) {
    if (isset($_SESSION)) {
        $cabtype=isset($_POST['cabtype'])?$_POST['cabtype']:'';
        $ride_date=isset($_POST['date'])?$_POST['date']:'';
        $from=isset($_POST['pickup'])?$_POST['pickup']:'';
        $to=isset($_POST['drop'])?$_POST['drop']:'';
        $total_distance=isset($_POST['distance'])?$_POST['distance']:'';
        $luggage=isset($_POST['luggage'])?$_POST['luggage']:'';
        $total_fare=isset($_POST['fare'])?$_POST['fare']:'';
        $user_id=$_SESSION['userdata']['user_id'];
        $_SESSION['rideinfo']=array('cabtype'=>$cabtype, 'ride_date'=>$ride_date, 'from'=>$from, 'to'=>$to, 'total_distance'=>$total_fare, 'total_fare'=>$total_fare, 'luggage'=>$luggage, 'user_id'=>$user_id) ;
        $status=1;
        $Ride= new Ride();
        $sql1=$Ride->book_ride($cabtype, $ride_date, $from, $to, $total_distance, $luggage, $total_fare, $status, $user_id, $dbconn->conn) ;
    } 
    
    
}


    
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Book Rides
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function myfun(){
            var cab=document.getElementById('cab-type').value;
            if(cab==='CedMicro'){
                let eleman = document.getElementById('luggage');
                eleman.setAttribute("disabled", true);
               
            }else{
                let ele = document.getElementById('luggage');
                ele.removeAttribute("disabled");
            }
        }

    </script>
    <script>
        $(document).ready(function() {
            $('#btn').click(function(ev) {
                var emp="--select--";
                var date=document.getElementById('date').value;
                var pick=document.getElementById('pickup').value;
                var drop=document.getElementById('drop').value;
                var luggage=document.getElementById('luggage').value;
                var cab=document.getElementById('cab-type').value;
                if(pick==emp){
                    alert("Please select Pickup point");
                    return;
                }
                if(drop==emp){
                    alert("Please select Drop point");
                    return;
                }
                if(cab==emp){
                    alert("Please select Cab type");
                    return;
                }
                if(pick==drop){
                    alert("choose different drop point");
                    return;
                }
                if (isNaN(luggage)) {
                text = "luggage Input not valid";
                alert(text);
                return;
                }
                ev.preventDefault();
                $.ajax({
                    url: "ajax.php",
                    type: "post",
                    data:{da:date, p:pick, d:drop, l:luggage, c:cab},
                    success: function(result) {
                        console.log(result);
                        var display = JSON.parse(result);
                        $('#distance').val(display['distance']);
                        $('#fare').val(display['fare']);
                    }
                    
                
                });
            });
        });
    </script>
     
</head>
<body>
    <div id="main1">
        <h1>Book Rides</h1>
        <form id="signupForm" action="" method="POST" enctype="multipart/form-data">
            <label for="date">Ride Date:<input type="date" id="date" name="date"></label>
            <label for="pickup">Pickup
            <select name="pickup" id="pickup">
            <option value="">--select--</option>
            <?php foreach($sql as $s)
            {
                echo "<option>".$s['name']."</option>";
            }?>
            </select></label>
            <label for="drop">Drop
            <select name="drop" id="drop">
            <option name="" value="">--select--</option>
            <?php foreach ($sql as $s)
            {
                echo "<option>".$s['name']."</option>";
            }?>
            </select></label>
            <label for="cabtype">Cabtype
            <select name="cabtype" id="cab-type" onchange="myfun()">
            <option value="">--select--</option>
            <option>CedMicro</option>
            <option>CedMini</option>
            <option>CedRoyal</option>
            <option>CedSUV</option>
            </select></label>
            <label for="luggage">Luggage:<input type="text"  name="luggage" id="luggage"></label>
            <p><button type="buttton" name="calculatefare" id="btn">total Fare</button></p>
            <!-- <div id="distance"></div> -->
            <label for="distance">Total distance:<input type="text" id="distance" name="distance"></label>
            <label for="fare">Total Fare:<input type="text" id="fare" name="fare"></label>
            <p><input type="submit" name="booknow" value="Book Now"></p>
        </form>
    </div>
</body>
</html>
<?php 
require_once 'footer.php';
?>