<?php include 'adminheader.php';

echo "you are superadmin";


if (isset($_POST['managerides'])) {
    header('Location:managerides.php');
}
if (isset($_POST['manageuser'])) {
    header('Location:manageuser.php');
}
if (isset($_POST['managefares'])) {
    header('Location:managefares.php');
}
if (isset($_POST['addlocation'])) {
    header('Location:addlocation.php');
}
if (isset($_POST['managelocation'])) {
    header('Location:managelocation.php');
}

?>
<form id="adminAction" method="POST">
    <input type="submit" name="managerides" value="MANAGE RIDES">
    <input type="submit" name="manageuser" value="MANAGE USER">
    <input type="submit" name="managefares" value="MANAGE FARES">
    <input type="submit" name="addlocation" value="ADD lOCATIONS" >
    <input type="submit" name="managelocation" value="MANAGE lOCATIONS" >
</form>

<?php include "../footer.php"; ?>