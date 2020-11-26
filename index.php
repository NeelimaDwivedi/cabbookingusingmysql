
<?php 
session_start();
if (!isset($_SESSION['userdata'])) {
    include 'logintab.php';
    //echo "hii";
} else {
    include 'header.php';
}

$sql=array();


$Location= new Location();
$dbconn=new  dbconnection();
$sql=$Location->display_location($dbconn->conn);



    
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Book Rides
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    data:{p:pick, d:drop, l:luggage, c:cab},
                    success: function(result) {
                        console.log(result);
                        $('#result').html(result);
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
            <select name="cabtype" id="cab-type">
            <option value="">--select--</option>
            <option>Ced Micro</option>
            <option>Ced Mini</option>
            <option>Ced Royal</option>
            <option>Ced SUV</option>
            </select></label>
            <label for="luggage">Luggage:<input type="text"  name="luggage" id="luggage"></label>
            <p><button type="buttton" name="calculatefare" id="btn">total Fare</button></p>
            <label for="distance">Total Distance :<input type="text"  name="distance"></label>
            <label for="fare">Total Fare:<input type="text"  name="fare"></label>
            <p><input type="submit" name="Book Now" value="Book Now"></p>
        </form>
    </div>
</body>
</html>
<?php 
require_once 'footer.php';
?>