<!DOCTYPE html>
<html>
<head>

<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
include("navbar.php");
$nn = new OxfordNav();
echo $nn->Onavbar();

$editcustnum = $_GET['empnum'];

require_once('cru100.php');
try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);

		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//preparing the sql statement
		$STH = $dbc->prepare('SELECT * FROM Customer WHERE CustID='.$editcustnum);
		 
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();

		$empFound = false;
		if($emprow = $STH->fetch()) 
		{
			$empFound = true;
			
			$Corg = $emprow['Corg'];
			$efname = $emprow['Cfname'];
			$elname = $emprow['Clname'];
			$edob = $emprow['Caddr'];
			$ephone = $emprow['Ccity'];
			$email = $emprow['Cstate'];
			$hiredate = $emprow['Cphone'];
			$firedate = $emprow['Cemail'];

		}

	}
catch(PDOException $e)
	{
		echo "Database Operations Failed: " . $e->getMessage();
	}
if($empFound) {
?>
<h1 align="center">Please update the customer information</h1>
<form name="aform" method="POST" action="Handler.php">
	<table align="center" border="0" style="border-collapse">
		<tr>
			<td align="right">Organization:</td>
			<td align="center"><input type="text" name="corg" value="<?php echo $Corg; ?>" ></td>
		</tr>
		<tr>
			<td align="right">First Name:</td>
			<td align="center"><input type="text" name="cfname" value="<?php echo $efname; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Last Name:</td>
			<td align="center"><input type="text" name="clname" value="<?php echo $elname; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Street Address:</td>
			<td align="center"><input type="text" name="caddr" value="<?php echo $edob; ?>" ></td>
		</tr>
		<tr>
			<td align="right">City:</td>
			<td align="center"><input type="text" name="ccity" value="<?php echo $ephone; ?>" ></td>
		</tr>	
		<tr>
			<td align="right">State:</td>
			<td align="center"><input type="text" name="cstate" value="<?php echo $email; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Phone Number:</td>
			<td align="center"><input type="text" name="cphone" value="<?php echo $hiredate; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Email:</td>
			<td align="center"><input type="text" name="cemail" value="<?php echo $firedate; ?>" ></td>
		</tr>
		
		<tr>
			<td align="right"><input type="hidden" name="fcustnum" value="<?php echo $editcustnum; ?>"></td>
			<td align="center">
			<input type='button' value='Cancel' onclick="window.location.href='https://www.guinhq.com/oxfordcc/custdt.php'" /> <input type='submit' value='Submit' name='editcust'>
			</td>
		</tr>		
	</table>
</form>
<?php 
} // end if($empFound) block
?>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>