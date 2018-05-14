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

<h1 align="center">Please Enter the Employees Information</h1>


    <form method="POST" action="Fhandler.php">
     <table align="center" border="0" style="border-collapse">
		<tr>
			<td align="right">Purchase Date:</td>
			<td align="left"><input type="text" id="datepicker" name="mpdate" size="12" placeholder="YYYY-MM-DD"></td>
		</tr>
		<tr>
			<td align="right">Cost:</td>
			<td align="left"><input type="text" name="mcost" size="12"></td>
		</tr>
		<tr>
			<td align="right">Description:</td>
			<td align="left"><input type="text" name="mdesc" size="12"></td>
		</tr>
		<tr>
			<td align="right">Vendor:</td>
			<td align="left"><input type="text" name="vendor" size="12"></td>
		</tr>	
		<tr>
			<td align="right">Material Purchased For:</td>
			<td align="left">
			  <select name="jobnum">
				  <?php
				  require_once('eurm.php');

					try {
						$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

						$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						//preparing the sql statement
						$STH = $dbc->prepare('SELECT JobName,JobID FROM Jobs');
						 
						$STH->setFetchMode(PDO::FETCH_ASSOC);
						$STH->execute();

						//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
						while($emprow = $STH->fetch()) {
						echo "<option value=".$emprow['JobID'].">".$emprow['JobName']."</option>";
						}

						}
					catch(PDOException $e)
						{
						echo "Database Operations Failed: " . $e->getMessage();
						}
				  ?>
			  </select>
			</td>
		</tr>
		<tr>
			<td><input type="hidden" name="empnum" value="<?php session_start(); echo $_SESSION['empid']; ?>"</td>
		</tr>
		<tr>
		
			<td align="right"><input type='reset' value='Reset' name='reset'></td>
			<td align="left"><input type="submit" value="Submit" name="instmat"></td>
	
		</tr>		
	</table>
       </form>
      

 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>