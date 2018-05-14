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
?>

<h1 align="center">Please Enter the Employees Information</h1>
<form name="aform" method="POST" action="EmpInsert.php">
	<table align="center" border="0" style="border-collapse">
		<tr>
			<td align="right">First Name:</td>
			<td align="center"><input type="text" name="fname" size="12"></td>
		</tr>
		<tr>
			<td align="right">Last Name:</td>
			<td align="center"><input type="text" name="lname" size="12"></td>
		</tr>
		<tr>
			<td align="right">Date of Birth:</td>
			<td align="center"><input type="text" class="datepick" id="date_1" name="dob" size="12" placeholder="YYYY-MM-DD"></td>
		</tr>
		<tr>
			<td align="right">Phone Number:</td>
			<td align="center"><input type="text" name="phone" size="12"></td>
		</tr>	
		<tr>
			<td align="right">Email Address:</td>
			<td align="center"><input type="text" name="email" size="12"></td>
		</tr>
		<tr>
			<td align="right">Employees Password:</td>
			<td align="center"><input type="text" name="pw" size="12"></td>
		</tr>
		<tr>
			<td align="right">Date Hired:</td>
			<td align="center"><input type="text" class="datepick" id="date_2" name="hiredate" size="12" placeholder="YYYY-MM-DD"></td>
		</tr>
		<tr>
			<td align="right">Date Fired:</td>
			<td align="center"><input type="text" class="datepick" id="date_3" name="firedate" size="12" placeholder="YYYY-MM-DD"></td>
		</tr>
		<tr>
			<td align="right">Hourly Pay Rate:</td>
			<td align="center"><input type="text" name="hrlywage" size="12"></td>
		</tr>
		<tr>
			<td align="right">Employees access level</td>
			<td align="center">
				<select name="urmlevel">
				    <option value="owner">Owner</option>
				    <option value="secretary">Secretary</option>
				    <option value="foreman">Foreman</option>
				    <option value="employee">Employee</option>
				    <option value="accountant">Accountant</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Are they an active Employee?:</td>
			<td align="center"><input type="radio" name="btn" value="1">Yes<input type="radio" name="btn" value="0">No<br></td>
		</tr>
		<tr>
			<td align="right"><input type='reset' value='Reset' name='reset'></td>
			<td align="left"><input type="submit" value="Submit" name="b1"></td>
	
		</tr>		
	</table>
</form>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>