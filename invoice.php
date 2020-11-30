<?php
 require_once 'header.php';
        
//      echo '<pre>';
//   print_r($_SESSION['rideinfo']);
//       echo '</pre>';   


?>
<!DOCTYPE html>
<html>
    <head>
        <title>CEDCAB</title>
    </head>
    <body>
        <div id="main1">
            <h2 class="h2heading">Invoice</h2>
            <table class="invoice">
                <thead>
                    <tr>
                        <th>Cab Type</th>
                        <th>Ride Date</th>
                        <th>Pickup</th>
                        <th>Drop</th>
                        <th>Total Distance</th>
                        <th>Total Fare</th>
                        <th>Luggage</th>
                        <th>User Id</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($_SESSION['rideinfo'] as $v) : ?>
                        <td><?php echo $v ?></td>
                    <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
       </div>
    </body>
</html>
<?php require_once 'footer.php' ?>