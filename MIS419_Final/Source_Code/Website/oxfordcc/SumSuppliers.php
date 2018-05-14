<!DOCTYPE HTML>
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
    $( "#datepicker" ).datepicker({ dateFormat: 'mm' });
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
header('location: https://www.guinhq.com/oxfordcc/forman/fhp.php');
}
elseif($_SESSION['Access'] == 'secretary'){
$ne = new OxfordNav();
echo $ne->Snavbar();
}
else {
header('location: https://www.guinhq.com/oxfordcc/login.php');
}
?>


<h1 align="center">Please select the report month</h1>


<form name="aform" method="POST" action="https://www.guinhq.com/oxfordcc/employee/fpdf/supplierpdf.php">
	<table align="center" border="0" style="border-collapse">
		<tr>
			<td align="right">Month:</td>
			<td align="left"><input name="month" id="datepicker" class="datepicker" size="10" placeholder="MM"/></td>
		</tr>
		<tr>
			<td>
				<input type="hidden" name="empnum" value="<?php session_start(); echo $_SESSION['empid']; ?>">
                <input type="hidden" name="fname" value="<?php  echo $_SESSION['fname']; ?>">
                <input type="hidden" name="lname" value="<?php  echo $_SESSION['lname']; ?>">
			</td>
		</tr>
		<tr>
			<td align="right"><input type='button' value='Cancel' onclick="window.location.href='https://www.guinhq.com/oxfordcc/mainmenu.php'" /></td>
			<td align="left"><input type="submit" value="View Report" name="btn"></td>
		</tr>		
	</table>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>