<!DOCTYPE html>
<html>
<head>

<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
Session_Start();
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/oxfordcc/navbar.php";
include($path);
If($_SESSION['Access'] == 'employee'){
header('location: https://www.guinhq.com/oxfordcc/employee/ehp.php');
}
elseif($_SESSION['Access'] == 'owner'){
$ne = new OxfordNav();
echo $ne->Onavbar();
}
elseif($_SESSION['Access'] == 'foreman'){
header('location: https://www.guinhq.com/oxfordcc/forman/fhp.php');
}
elseif($_SESSION['Access'] == 'accountant'){
$ne = new OxfordNav();
echo $ne->Anavbar();
}
elseif($_SESSION['Access'] == 'secretary'){
$ne = new OxfordNav();
echo $ne->Snavbar();
}
else {
header('location: https://www.guinhq.com/oxfordcc/login.php');
}

echo "<h1 align='center'>Welcome back, ".$_SESSION['fname']."!</h1>";
?>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>