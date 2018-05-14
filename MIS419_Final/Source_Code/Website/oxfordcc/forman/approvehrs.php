<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
  
<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
Session_Start();
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/oxfordcc/navbar.php";
include($path);
If($_SESSION['Access'] == 'employee'){
header('location: https://www.guinhq.com/oxfordcc/employee/ehp.php');
}
elseif($_SESSION['Access'] == 'owner' || $_SESSION['Access'] == 'accountant'){
$ne = new OxfordNav();
echo $ne->Onavbar();
}
elseif($_SESSION['Access'] == 'foreman'){
$ne = new OxfordNav();
echo $ne->Fnavbar();
}
else {
header('location: https://www.guinhq.com/oxfordcc/mainmenu.php');
}


$empnum = $_GET['enum'];
$jobnum = $_GET['jnum'];
$weeknum = $_GET['wnum'];

require_once('eurm.php');
try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//preparing the sql statement
		$STH = $dbc->prepare('SELECT EmpID,EFname,ELname, JobName,Hours.JobID AS JID, Weeknum, Approved_hrs, Unapproved_hrs, Wages 
							  FROM employees, Jobs, Hours 
							  WHERE Hours.EmployeeID='.$empnum.'
							  AND Hours.JobID='.$jobnum.'
							  AND Hours.Weeknum='.$weeknum.'
							  AND Hours.EmployeeID=employees.EmpID
							  AND Hours.JobID=Jobs.JobID');
		 
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();

		$empFound = false;
		if($emprow = $STH->fetch()) 
		{
			$empFound = true;
			$name = $emprow['EFname'].' '.$emprow['ELname'];
			$jname = $emprow['JobName'];
			$week = $emprow['Weeknum'];
			$ahrs = $emprow['Approved_hrs'];
			$uhrs = $emprow['Unapproved_hrs'];
			//$wage = $emprow['Wages'];
		}

	}
catch(PDOException $e)
	{
		echo "Database Operations Failed: " . $e->getMessage();
	}
if($empFound) {
?>
<h1 align="center">Please Approve the appropriate amount of Hours</h1>

<form name="aform" method="POST" action="Fhandler.php">
	<table align="center" border="0" style="border-collapse">

		<tr>
			<td align="right">Employee:</td>
			<td align="left"><input type="text" name="name" value="<?php echo $name; ?>" readonly></td>
		</tr>
		<tr>
			<td align="right">Job:</td>
			<td align="left"><input type="text" name="job" value="<?php echo $jname; ?>" readonly></td>
		</tr>
		<tr>
			<td align="right">Week Number:</td>
			<td align="left"><input type="text" name="weeknum" value="<?php echo $week; ?>"></td>
		</tr>
		<tr>
			<td align="right">Approved Hours:</td>
			<td align="left"><input type="text" name="ahrs" value="<?php echo $ahrs; ?>"></td>
		</tr>	
		<tr>
			<td align="right">Unapproved Hours:</td>
			<td align="left"><input type="text" name="uhrs" value="<?php echo $uhrs; ?>"></td>
		</tr>	
		<tr>
<td><input type="hidden" name="empnum" value="<?php echo $empnum; ?>"><input type="hidden" name="jobnum" value="<?php echo $jobnum; ?>"></td>
</tr>
		<tr>
			<td align="right"><input type='button' value='Cancel' onclick="window.location.href='https://www.guinhq.com/oxfordcc/forman/fhp.php'" /></td>
			<td align="left"><input type="submit" value="Submit" name="aprovehrs"></td>
		</tr>		
	</table>
</form>
<?php 
} // end if($empFound) block
?>
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>