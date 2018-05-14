<?php
//post values from the submission page
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pw = $_POST['pw'];
$hiredate = $_POST['hiredate'];
$firedate = $_POST['firedate'];
$active = $_POST['btn'];
$urmlevel = $_POST['urmlevel'];
$wage = $_POST['hrlywage'];

$hpassword = hash('sha256',$pw);

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
	$sql = "INSERT INTO employees (EFname,ELname,EDOB,EPhone,Email,EPassword,HireDate,FireDate,Active,URMLevel,hrlywage) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
	$ins = $dbc->prepare($sql);        

	$ins->bindParam(1, $fname);
	$ins->bindParam(2, $lname);
	$ins->bindParam(3, $dob);
	$ins->bindParam(4, $phone);
	$ins->bindParam(5, $email);
	$ins->bindParam(6, $hpassword);
	$ins->bindParam(7, $hiredate);
	$ins->bindParam(8, $firedate);
	$ins->bindParam(9, $active);
	$ins->bindParam(10, $urmlevel);
	$ins->bindParam(11, $wage);

	$ins->execute();
}
Catch(PDOException $e)
{
	Echo "ERROR: Failed to Insert to the database";
	Exit;
}
echo "<html><script language='JavaScript'>alert('Employee Added Successfully!'),history.go(-1)</script></html>";
header('Refresh: 5; URL=http://www.guinhq.com/oxfordcc/employeeform.php');
//exit;
?>