<?php
if(isset($_POST['aprovehrs'])){
	$week = $_POST['weeknum'];
	$empnum = $_POST['empnum'];
	$jobnum = $_POST['jobnum'];
	$ahrs = $_POST['ahrs'];
	$uhrs = $_POST['uhrs'];
	
   require('eurm.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare("Update Hours Set Approved_hrs=?,Unapproved_hrs=? WHERE EmployeeID=? AND JobID=? AND Weeknum=?");
		$STH->bindParam(1,$ahrs);
		$STH->bindParam(2,$uhrs);	
		$STH->bindParam(3,$empnum);	
		$STH->bindParam(4,$jobnum);	
		$STH->bindParam(5,$week);			
		$STH->execute();
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
				$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$vv = $db->prepare("Select hrlywage From employees Where EmpID=?");
				$vv->bindParam(1, $empnum);
				$vv->setFetchMode(PDO::FETCH_ASSOC);
				$vv->execute();
				While ($row = $vv->fetch()){
				$hrpay = $row['hrlywage'];
				}
			  
			  		try{
			  			$wageamt = ($ahrs * $hrpay);
						$d = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$d->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$ST = $d->prepare("Update Hours Set Wages=? WHERE EmployeeID=? AND JobID=? AND Weeknum=?");
						$ST->bindParam(1,$wageamt);	
						$ST->bindParam(2,$empnum);	
						$ST->bindParam(3,$jobnum);	
						$ST->bindParam(4,$week);			
						$ST->execute();
					   }
					Catch(PDOException $e){
						echo "2nd db opperation failed".$e->getMessage();
					  }
			  
   header('Location: https://www.guinhq.com/oxfordcc/forman/fhp.php');
}	

if(isset($_POST['instmat'])){
	$mpdate = $_POST['mpdate'];
	$mcost = $_POST['mcost'];
	$mdesc = $_POST['mdesc'];
	$vendor = $_POST['vendor'];
	$jobnum = $_POST['jobnum'];
	$empnum = $_POST['empnum'];
	
   require_once('eurm.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare('Insert into Materials (MPDate,MCost,MDesc,Vendor,JobNum,EmpNum) VALUES (?,?,?,?,?,?)');
		$STH->bindParam(1,$mpdate);
		$STH->bindParam(2,$mcost);	
		$STH->bindParam(3,$mdesc);	
		$STH->bindParam(4,$vendor);	
		$STH->bindParam(5,$jobnum);	
		$STH->bindParam(6,$empnum);		
		$STH->execute();
	
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
   header('Location: https://www.guinhq.com/oxfordcc/forman/Matdt.php');
}	

//Edits and updates a material
if(isset($_POST['editmat'])){
	$mpdate = $_POST['mpdate'];
	$mcost = $_POST['mcost'];
	$mdesc = $_POST['mdesc'];
	$vendor = $_POST['vendor'];
	$jobnum = $_POST['jobnum'];
	
	$matid = $_POST['matnum'];
	
	require_once('eurm.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare('UPDATE Materials SET MPDate=?,MCost=?,MDesc=?,Vendor=?,JobNum=? WHERE MatID='.$matid);
		$STH->bindParam(1,$mpdate);
		$STH->bindParam(2,$mcost);	
		$STH->bindParam(3,$mdesc);	
		$STH->bindParam(4,$vendor);	
		$STH->bindParam(5,$jobnum);			
		$STH->execute();
	
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
   header('Location: https://www.guinhq.com/oxfordcc/forman/Matdt.php');

}
?>