<!DOCTYPE html>
<html>
<head>

<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
include("navbar.php");
$nn = new OxfordNav();
echo $nn->Onavbar();

echo "<h1 align='center'>Are you sure you want to permanently delete this job?</h1>";
echo "<h2 align='center'>(Note: It's reccommended that you mark past jobs inactive)</h2>";
echo "<br />";
$deljobnum = $_GET['empnum'];

require_once('cru100.php');
try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);

		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//preparing the sql statement
		$STH = $dbc->prepare('SELECT JobName,Active FROM Jobs WHERE JobID='.$deljobnum);
		 
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();

		$empFound = false;
		if($emprow = $STH->fetch()) 
		{
			$empFound = true;
			$active = $emprow['Active'];
			$empName = trim($emprow['JobName']);
			echo "<p>Job to delete: " . $empName . "</p>";
		}

	}
catch(PDOException $e)
	{
		echo "Database Operations Failed: " . $e->getMessage();
	}
if($empFound) {
?>

<form action="Handler.php" method="POST">
	<input type="hidden" name="jobnum" value="<?php echo $deljobnum; ?>">
	<input type="hidden" name="active" value="<?php echo $active; ?>">
	<?php
	if ($active == true){
			echo "<p><input type='button' value='Cancel' onclick="."window.location.href='https://www.guinhq.com/oxfordcc/jobsdt.php'"." /> <input type='submit' value='Delete' name='deletejob'></p>";
			}
			else{
			echo "<p><input type='button' value='Cancel' onclick="."window.location.href='https://www.guinhq.com/oxfordcc/inactivejobs.php'"." /> <input type='submit' value='Delete' name='deletejob'></p>";
			}
	?>
</form>
<?php 
} // end if($empFound) block
?>

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>