<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "yy-mm-dd",
      showWeek: true,
      firstDay: 1
    });
    $("#datepicker").datepicker("setDate", new Date());
  } );
  </script>

 
  
<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
Session_Start();
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/oxfordcc/navbar.php";
include($path);
If($_SESSION['Access'] == 'employee'){
$ne = new OxfordNav();
echo $ne->Enavbar();
}
elseif($_SESSION['Access'] == 'owner' || $_SESSION['Access'] == 'accountant'){
$ne = new OxfordNav();
echo $ne->Onavbar();
}
elseif($_SESSION['Access'] == 'foreman'){
$ne = new OxfordNav();
echo $ne->Fnavbar();
}
elseif($_SESSION['Access'] == 'secretary'){
$ne = new OxfordNav();
echo $ne->Snavbar();
}
else {
header('location: https://www.guinhq.com/oxfordcc/login.php');
}
?>


<h1 align="center">Welcome back, <?php echo $_SESSION['fname']; ?> </h1>
<br />
<h2 align="center">Please enter your hours</h2>

<form method="POST" action="Ehandler.php">
     <table align="center" border="0" style="border-collapse">
		<tr>
			<td align="right">Date:</td>
			<td align="left"><input type="text" id="datepicker" name="date" size="12" placeholder="YYYY-MM-DD"></td>
		</tr>
		<tr>
			<td align="right">Job:</td>
			<td align="left">
			  <select name="jobnum">
				  <?php
				  require_once('eurm.php');

					try {
						$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

						$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						//preparing the sql statement
						$STH = $dbc->prepare('SELECT JobName,JobID FROM Jobs WHERE Active=1');
						 
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
		<td align="right">Hours Worked:</td>
		<td align="left"><input type="text" name="hours" size="12"></td>
		</tr>
		<tr>
			<td><input type="hidden" name="empnum" value="<?php session_start(); echo $_SESSION['empid']; ?>"</td>
		</tr>
		<tr>
			<td align="right"><input type='reset' value='Reset' name='reset'></td>
			<td align="left"><input type="submit" value="Submit" name="insthrs"></td>
	
		</tr>		
	</table>
       </form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>