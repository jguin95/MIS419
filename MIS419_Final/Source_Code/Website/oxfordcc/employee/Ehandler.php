<?php
if(isset($_POST['insthrs'])){
	$date = $_POST['date'];
	$hours = $_POST['hours'];
	$jobnum = $_POST['jobnum'];
	$empnum = $_POST['empnum'];
	
	$weeknum = "(SELECT WEEK('".$date."'))";
	
  	$servername = 'localhost';
	$username = 'empuser121';
	$password = 'PW123';
	$dbname = 'MIS419DB';

	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare("INSERT INTO Hours(EmployeeID, JobID, Weeknum, date, Unapproved_hrs) 
					VALUES (:empnum, :jobnum,".$weeknum.",:wdate, :hours) ON DUPLICATE 
					KEY UPDATE Unapproved_hrs = Unapproved_hrs + :hours");
		$STH->bindParam(':empnum',$empnum);
		$STH->bindParam(':jobnum',$jobnum);
		$STH->bindParam(':wdate',$date);		
		$STH->bindParam(':hours',$hours);			
		$STH->execute();
	
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
	//echo $weeknum;	
   echo "<html><script language='JavaScript'>alert('Hours Added Successfully!'),history.go(-1)</script></html>";
   header('Refreash:5; https://www.guinhq.com/oxfordcc/employee/ehp.php');
}	

?>