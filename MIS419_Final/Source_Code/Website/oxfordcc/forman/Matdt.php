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
$ne = new OxfordNav();
echo $ne->Fnavbar();
}
elseif($_SESSION['Access'] == 'accountant'){
$ne = new OxfordNav();
echo $ne->Anavbar();
}
else {
header('location: https://www.guinhq.com/oxfordcc/login.php');
}
?>

<p> </p>
<h1 align="center">Material Purchases Log</h1><a href="addmat.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add A New Material"><i class="fas fa-plus-circle fa-lg"></i></button></a><br />

<table id="employeetable" class="table table-striped table-bordered" cellspacing="0" width="100%">

<thead>
	<tr>
	<th>&nbsp;</th>
	<th>Entry Number</th>
	<th>Purchase Date</th>
	<th>Material Cost</th>
	<th>Description</th>
	<th>Vendor</th>
	<th>Job</th>
	<th>Purchaser</th>
	</tr>
</thead>
<tbody>
	<?php 

	//Database credentials 
	require_once('eurm.php');

	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//preparing the sql statement
		$STH = $dbc->prepare('SELECT MatID,MPDate,MCost,MDesc,Vendor,JobName,EFname,ELname 
							  FROM Materials, Jobs, employees 
							  WHERE Materials.JobNum=Jobs.JobID 
							  AND Materials.EmpNum=employees.EmpID');
		 
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();

		//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
		while($emprow = $STH->fetch()) {
			
			
			$editLink = "<a href='editmaterial.php?matnum=" . $emprow['MatID'] ."'>";
			$name = $emprow['EFname'].' '.$emprow['ELname'];
			echo "<tr><td align='center'>".
			$editLink . "<button type='button' class='btn btn-link' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fas fa-pencil-alt'></i></button></a></td><td>".
			$emprow['MatID']."</td><td>".
			$emprow['MPDate']."</td><td>".
			$emprow['MCost']."</td><td>".
			$emprow['MDesc']."</td><td>".
			$emprow['Vendor']."</td><td>".
			$emprow['JobName']."</td><td>".
			$name."</td></tr>";
			
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