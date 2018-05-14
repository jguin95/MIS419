<?php
session_start();

unset($_SESSION['ValidUser']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['Access']);
unset($_SESSION['empid']);
header('Location: https://www.guinhq.com/oxfordcc/HP1.php');
die();
?>