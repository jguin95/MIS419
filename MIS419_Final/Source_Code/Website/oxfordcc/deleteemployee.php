<!DOCTYPE html>
<html>
<head>

<?php
//Inherited class that has the navbar in it so I don't have to edit the damn thing 500 times
include("navbar.php");
$nn = new OxfordNav();
echo $nn->Onavbar();

echo "<h1 align='center'>Are you sure you want to permanently delete this employee?</h1>";
echo "<h2 align='center'>(Note: It's reccommended that you mark former employees inactive)</h2>";
echo "<br />";

$delempnum = $_GET['empnum'];

require_once('cru100.php');
try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);

		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//preparing the sql statement
		$STH = $dbc->prepare('SELECT * FROM employees WHERE EmpID='.$delempnum);
		 
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();

		$empFound = false;
		if($emprow = $STH->fetch()) 
		{
			$empFound = true;
			$active = $emprow['Active'];
			$empName = trim($emprow['EFname']) . " " . $emprow['ELname'];
			echo "<p>Employee to delete: " . $empName . "</p>";
		}

	}
catch(PDOException $e)
	{
		echo "Database Operations Failed: " . $e->getMessage();
	}
if($empFound) {
?>

<form action="removeemployee.php" method="POST">
	<input type="hidden" name="Fempnum" value="<?php echo $delempnum; ?>">
	<?php
	if ($active == true){
			echo "<p><input type='button' value='Cancel' onclick="."window.location.href='https://www.guinhq.com/oxfordcc/datatable.php'"." /> <input type='submit' value='Submit' name='b1'></p>";
			}
			else{
			echo "<p><input type='button' value='Cancel' onclick="."window.location.href='https://www.guinhq.com/oxfordcc/inactivedatatable.php'"." /> <input type='submit' value='Submit' name='b2'></p>";
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