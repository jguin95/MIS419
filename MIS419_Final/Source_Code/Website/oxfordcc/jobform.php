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

<h1 align="center">Please Enter the Job Information</h1>


    <form method="POST" action="Handler.php">
     <table align="center" border="0" style="border-collapse">
		<tr>
			<td align="right">Job Name:</td>
			<td align="left"><input type="text" name="jobname" size="12"></td>
		</tr>
		<tr>
			<td align="right">Start Date:</td>
			<td align="left"><input type="text" class="datepick" id="date_1" name="jobstartdate" size="12" placeholder="YYYY-MM-DD"></td>
		</tr>
		<tr>
			<td align="right">End Date:</td>
			<td align="left"><input type="text" class="datepick" id="date_2" name="jobenddate" size="12" placeholder="YYYY-MM-DD"></td>
		</tr>
		<tr>
			<td align="right">Is this an active Job?:</td>
			<td align="left"><input type="radio" name="btn" value="1">Yes <input type="radio" name="btn" value="0">No<br></td>
		</tr>	
		<tr>
			<td align="right">Customer:</td>
			<td align="left">
			  <select name="custnum">
				  <?php
				  require_once('cru100.php');

					try {
						$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);

						$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						//preparing the sql statement
						$STH = $dbc->prepare('SELECT CustID,Corg,Cfname,Clname FROM Customer');
						 
						$STH->setFetchMode(PDO::FETCH_ASSOC);
						$STH->execute();

						//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
						while($emprow = $STH->fetch()) {
						echo "<option value=".$emprow['CustID'].">".$emprow['Corg'].": ".$emprow['Cfname']." ".$emprow['Clname']."</option>";
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
		
			<td align="right"><input type='reset' value='Reset' name='reset'></td>
			<td align="left"><input type="submit" value="Submit" name="instjob"></td>
	
		</tr>		
	</table>
 </form>
      

 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>