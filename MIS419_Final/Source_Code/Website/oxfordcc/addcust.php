<!DOCTYPE html>
<html>
<head>
 
<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
include("navbar.php");
$nn = new OxfordNav();
echo $nn->Onavbar();
?>

<h1 align="center">Please Enter the Customer Information</h1>
<form name="aform" method="POST" action="Handler.php">
	<table align="center" border="0" style="border-collapse">
		<tr>
			<td align="right">Customer Organization:</td>
			<td align="center"><input type="text" name="corg" size="12"></td>
		</tr>
		<tr>
			<td align="right">First Name:</td>
			<td align="center"><input type="text" name="cfname" size="12"></td>
		</tr>
		<tr>
			<td align="right">Last Name:</td>
			<td align="center"><input type="text" name="clname" size="12"></td>
		</tr>
		<tr>
			<td align="right">Street Address:</td>
			<td align="center"><input type="text" name="caddr" size="12"></td>
		</tr>	
		<tr>
			<td align="right">City:</td>
			<td align="center"><input type="text" name="ccity" size="12"></td>
		</tr>
		<tr>
			<td align="right">State:</td>
			<td align="center"><input type="text" name="cstate" size="12"></td>
		</tr>
		<tr>
			<td align="right">Phone Number:</td>
			<td align="center"><input type="text" name="cphone" size="12"></td>
		</tr>
		<tr>
			<td align="right">Email:</td>
			<td align="center"><input type="text" name="cemail" size="12"></td>
		</tr>
		<tr>
			<td align="right"><input type='reset' value='Reset' name='reset'></td>
			<td align="left"><input type="submit" value="Submit" name="inscust"></td>
		</tr>		
	</table>
</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>