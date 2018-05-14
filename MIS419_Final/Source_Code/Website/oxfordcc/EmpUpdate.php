<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$email = $_POST['email'];
//$pw = $_POST['pw'];
$hiredate = $_POST['hiredate'];
$firedate = $_POST['firedate'];
$active = $_POST['btn'];
$urmlevel = $_POST['urmlevel'];
$wage = $_POST['hrlywage'];
$enum = $_POST['fempnum'];

require_once('cru100.php');

//Database connection
Try
	{
	$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
	}
Catch (PDOException $e)
	{
	Echo "Failed to connect to the database: ".$e->getMessage();
	exit;
	}
	
//Database insert
Try
{
	$sql = "UPDATE employees SET EFname=?, ELname=? ,EDOB=? ,EPhone=? ,Email=?,HireDate=?,FireDate=?,Active=?,URMLevel=?,hrlywage=? WHERE EmpID=".$enum;
	$ins = $dbc->prepare($sql);        

	$ins->bindParam(1, $fname);
	$ins->bindParam(2, $lname);
	$ins->bindParam(3, $dob);
	$ins->bindParam(4, $phone);
	$ins->bindParam(5, $email);
	//$ins->bindParam(6, $hpassword);
	$ins->bindParam(6, $hiredate);
	$ins->bindParam(7, $firedate);
	$ins->bindParam(8, $active);
	$ins->bindParam(9, $urmlevel);
	$ins->bindParam(10, $wage);

	$ins->execute();
}
Catch(PDOException $e)
{
	Echo "ERROR: Failed to Insert to the database";
	Exit;
}

//if they're an active employee send them to the active table
if ($active==true){
header('Location: http://www.guinhq.com/oxfordcc/datatable.php');
}
else{
header('Location: http://www.guinhq.com/oxfordcc/inactivedatatable.php');
}
//exit;
?>