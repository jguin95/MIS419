<?php
session_start();
if(!$_SESSION['ValidUser']) {
	header('Location: https://www.mis419.com/login.php');
	die();
}

?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php 
$delEmpnumber = $_POST['Fempnum'];

// do some db stuff here

require_once('cru100.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$empSQL = 'SELECT * from employees WHERE EmpID = ' . $delEmpnumber;
	
	$STH = $conn->query($empSQL);
	 
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	$empFound = false;
	if($emprow = $STH->fetch()) {
		$empFound = true;
		//$empName = trim($emprow['EFname']) . " " . $emprow['ELname'];
		//echo "<p>Employee deleted: " . $empName . "</p>";
		$empDeleteSQL = 'DELETE from employees WHERE EmpID = ' . $delEmpnumber;
		$conn->exec($empDeleteSQL);
	}

    }
catch(PDOException $e)
    {
    echo "DB failed: " . $e->getMessage();
    }
    //echo "Success";
    header('Location: https://www.guinhq.com/oxfordcc/datatable.php');

?>
</body>
</html>