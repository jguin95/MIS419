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
    $('.datepick').datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      minDate: new Date(1930, 2 - 1, 26),
      maxDate: "+1D",
      yearRange: '1930:2018',
    });
  } );
  </script>
<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
include("navbar.php");
$nn = new OxfordNav();
echo $nn->Onavbar();

$editempnum = $_GET['empnum'];

require_once('cru100.php');
try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);

		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//preparing the sql statement
		$STH = $dbc->prepare('SELECT * FROM employees WHERE EmpID='.$editempnum);
		 
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();

		$empFound = false;
		if($emprow = $STH->fetch()) 
		{
			$empFound = true;

			$efname = $emprow['EFname'];
			$elname = $emprow['ELname'];
			$edob = $emprow['EDOB'];
			$ephone = $emprow['EPhone'];
			$email = $emprow['Email'];
			$hiredate = $emprow['HireDate'];
			$firedate = $emprow['FireDate'];
			$active = $emprow['Active'];
			$urmlevel = $emprow['URMLevel'];
			$wage = $emprow['hrlywage'];
		}

	}
catch(PDOException $e)
	{
		echo "Database Operations Failed: " . $e->getMessage();
	}
if($empFound) {
?>
<h1 align="center">Please update the employees information</h1>
<form name="aform" method="POST" action="EmpUpdate.php">
	<table align="center" border="0" style="border-collapse">
		<tr>
			<td align="right">First Name:</td>
			<td align="center"><input type="text" name="fname" value="<?php echo $efname; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Last Name:</td>
			<td align="center"><input type="text" name="lname" value="<?php echo $elname; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Date of Birth:</td>
			<td align="center"><input type="text" class="datepick" id="date_1" name="dob" value="<?php echo $edob; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Phone Number:</td>
			<td align="center"><input type="text" name="phone" value="<?php echo $ephone; ?>" ></td>
		</tr>	
		<tr>
			<td align="right">Email Address:</td>
			<td align="center"><input type="text" name="email" value="<?php echo $email; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Date Hired:</td>
			<td align="center"><input type="text" class="datepick" id="date_2" name="hiredate" value="<?php echo $hiredate; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Date Fired:</td>
			<td align="center"><input type="text" class="datepick" id="date_3" name="firedate" value="<?php echo $firedate; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Hourly Pay Rate:</td>
			<td align="center"><input type="text" name="hrlywage" value="<?php echo $wage; ?>" ></td>
		</tr>
		<tr>
			<td align="right">Employees access level:</td>
			<td align="center">
				<select name="urmlevel">
				    <option selected="selected"><?php echo $urmlevel; ?></option>
				    <option value="owner">owner</option>
				    <option value="secretary">secretary</option>
				    <option value="foreman">foreman</option>
				    <option value="employee">employee</option>
				    <option value="accountant">accountant</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Are they an active Employee?:</td>
			<td align="left">
				<?php if ($active==true){
					echo "<input type='radio' name='btn' value='1' checked='checked'>Yes <input type='radio' name='btn' value='0'>No<br></td>";
				}
				else{
					echo "<input type='radio' name='btn' value='1'>Yes <input type='radio' name='btn' value='0' checked='checked'>No<br></td>";
				}
				?>
		</tr>
		<tr>
			<td align="right"><input type="hidden" name="fempnum" value="<?php echo $editempnum; ?>"></td>
			<td align="center">
			<?php
			if ($active == true){
			echo "<input type='button' value='Cancel' onclick="."window.location.href='https://www.guinhq.com/oxfordcc/datatable.php'"." /> <input type='submit' value='Submit' name='b1'></td>";
			}
			else{
			echo "<input type='button' value='Cancel' onclick="."window.location.href='https://www.guinhq.com/oxfordcc/inactivedatatable.php'"." /> <input type='submit' value='Submit' name='b2'></td>";
			}
			?>
			</td>
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