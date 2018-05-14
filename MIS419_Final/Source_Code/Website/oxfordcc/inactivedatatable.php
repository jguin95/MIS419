<!DOCTYPE html>
<html>
<head>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="mystyle.css">

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js">
	</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
	</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js">
	</script>
<script type="text/javascript" class="init">
$(document).ready(function() {
	$('#employeetable').DataTable();
} );
</script>

<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
include("navbar.php");
$nn = new OxfordNav();
echo $nn->Onavbar();
?>

<p> </p>
<h1 align="center">Inactive Employee Roster</h1><a href="employeeform.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add A New Employee"><i class="fas fa-user-plus"></i></button></a><br />

<table id="employeetable" class="table table-striped table-bordered" cellspacing="0" width="100%">

<thead>
	<tr>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>Employee ID</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Date of Birth</th>
	<th>Phone</th>
	<th>Email</th>
	<th>Hire Date</th>
	<th>Fire Date</th>
	<th>Access Level</th>
	<th>Hourly Pay Rate</th>
	</tr>
</thead>
<tbody>
	<?php 

	//Database credentials 
	require_once('cru100.php');

	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);

		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//preparing the sql statement
		$STH = $dbc->prepare('SELECT EmpID,EFname,ELname,EDOB,EPhone,Email,HireDate,FireDate,Active,URMLevel,hrlywage from employees');
		 
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();

		//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
		while($emprow = $STH->fetch()) {
			if ($emprow['Active']==false){
			$deleteLink = "<a href='deleteemployee.php?empnum=" . $emprow['EmpID'] ."'>";
			$editLink = "<a href='editemployee.php?empnum=" . $emprow['EmpID'] ."'>";
			echo "<tr><td align='center'>".
			$deleteLink . "<button type='button' class='btn btn-link' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fas fa-trash-alt'></i></button></a></td><td align='center'>".
			$editLink . "<button type='button' class='btn btn-link' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fas fa-pencil-alt'></i></button></a></td><td>".
			$emprow['EmpID']."</td><td>".
			$emprow['EFname']."</td><td>".
			$emprow['ELname']."</td><td>".
			$emprow['EDOB']."</td><td>".
			$emprow['EPhone']."</td><td>".
			$emprow['Email']."</td><td>".
			$emprow['HireDate']."</td><td>".
			$emprow['FireDate']."</td><td>".
			$emprow['URMLevel']."</td><td>".
			$emprow['hrlywage']."</td></tr>";
			}
		}

		}
	catch(PDOException $e)
		{
		echo "Database Operations Failed: " . $e->getMessage();
		}
	?>
</tbody>
</table>

 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>