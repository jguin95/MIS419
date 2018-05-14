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
<h1 align="center">Customer Information</h1><a href="addcust.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add A New Customer"><i class="fas fa-user-plus"></i></button></a><br />

<table id="employeetable" class="table table-striped table-bordered" cellspacing="0" width="100%">

<thead>
	<tr>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>Organization</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Street Address</th>
	<th>City</th>
	<th>State</th>
	<th>Phone Number</th>
	<th>Email</th>
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
		$STH = $dbc->prepare('SELECT CustID,Corg,Cfname,Clname,Caddr,Ccity,Cstate,Cphone,Cemail from Customer');
		 
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();

		//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
		while($emprow = $STH->fetch()) {
			
			$editLink = "<a href='editcust.php?empnum=" . $emprow['CustID'] ."'>";
			echo "<tr><td align='center'>".
			$editLink . "<button type='button' class='btn btn-link' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fas fa-pencil-alt'></i></button></a></td><td>".
			$emprow['CustID']."</td><td>".
			$emprow['Corg']."</td><td>".
			$emprow['Cfname']."</td><td>".
			$emprow['Clname']."</td><td>".
			$emprow['Caddr']."</td><td>".
			$emprow['Ccity']."</td><td>".
			$emprow['Cstate']."</td><td>".
			$emprow['Cphone']."</td><td>".
			$emprow['Cemail']."</td></tr>";
			
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