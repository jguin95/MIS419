<?php

//Inserts new materials
if(isset($_POST['instmat'])){
	$mpdate = $_POST['mpdate'];
	$mcost = $_POST['mcost'];
	$mdesc = $_POST['mdesc'];
	$vendor = $_POST['vendor'];
	$jobnum = $_POST['jobnum'];
	$empnum = $_POST['empnum'];
	
   require_once('cru100.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
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
   header('Location: https://www.guinhq.com/oxfordcc/Matdt.php');
}	

//Edits and updates a material
if(isset($_POST['editmat'])){
	$mpdate = $_POST['mpdate'];
	$mcost = $_POST['mcost'];
	$mdesc = $_POST['mdesc'];
	$vendor = $_POST['vendor'];
	$jobnum = $_POST['jobnum'];
	
	$matid = $_POST['matnum'];
	
	require_once('cru100.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
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
   header('Location: https://www.guinhq.com/oxfordcc/Matdt.php');

}

//inserts a new job
if(isset($_POST['instjob'])){

	$jname = $_POST['jobname'];
	$sdate = $_POST['jobstartdate'];
	$edate = $_POST['jobenddate'];
	$active = $_POST['btn'];
	$cnum = $_POST['custnum'];
	
	//$jobid = $_POST['jobnum'];
	
	require_once('cru100.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare('Insert into Jobs (JobName,JobStartDate,JobEndDate,Active,Custid) Values (?,?,?,?,?)');
		$STH->bindParam(1,$jname);
		$STH->bindParam(2,$sdate);	
		$STH->bindParam(3,$edate);	
		$STH->bindParam(4,$active);	
		$STH->bindParam(5,$cnum);			
		$STH->execute();
	
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
	if ($active==true){
	header('Location: http://www.guinhq.com/oxfordcc/jobsdt.php');
	}
	else{
	header('Location: http://www.guinhq.com/oxfordcc/inactivejobs.php');
	}
}

//edits and updates job info
if(isset($_POST['editjob'])){

	$jname = $_POST['jobname'];
	$sdate = $_POST['jobstartdate'];
	$edate = $_POST['jobenddate'];
	$active = $_POST['btn'];
	$cnum = $_POST['custnum'];
	
	$jobid = $_POST['jobnum'];
	
	require_once('cru100.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare('UPDATE Jobs SET JobName=?,JobStartDate=?,JobEndDate=?,Active=?,Custid=? WHERE JobID='.$jobid);
		$STH->bindParam(1,$jname);
		$STH->bindParam(2,$sdate);	
		$STH->bindParam(3,$edate);	
		$STH->bindParam(4,$active);	
		$STH->bindParam(5,$cnum);			
		$STH->execute();
	
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
	if ($active==true){
	header('Location: http://www.guinhq.com/oxfordcc/jobsdt.php');
	}
	else{
	header('Location: http://www.guinhq.com/oxfordcc/inactivejobs.php');
	}
	
}

//Deletes a Job
if(isset($_POST['deletejob'])){

	$dnum = $_POST['jobnum'];
	$active = $_POST['active'];
	
	require_once('cru100.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare('DELETE FROM Jobs WHERE JobID='.$dnum);			
		$STH->execute();
	
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
	if ($active==true){
	header('Location: http://www.guinhq.com/oxfordcc/jobsdt.php');
	}
	else{
	header('Location: http://www.guinhq.com/oxfordcc/inactivejobs.php');
	}
}

//inserts new customer information
if(isset($_POST['inscust'])){

	$corg = $_POST['corg'];
	$cfname = $_POST['cfname'];
	$clname = $_POST['clname'];
	$caddr = $_POST['caddr'];
	$ccity = $_POST['ccity'];
	$cstate = $_POST['cstate'];
	$cphone = $_POST['cphone'];
	$cemail = $_POST['cemail'];
	
   require_once('cru100.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare('Insert into Customer (Corg,Cfname,Clname,Caddr,Ccity,Cstate,Cphone,Cemail) VALUES (?,?,?,?,?,?,?,?)');
		$STH->bindParam(1,$corg);
		$STH->bindParam(2,$cfname);	
		$STH->bindParam(3,$clname);	
		$STH->bindParam(4,$caddr);	
		$STH->bindParam(5,$ccity);	
		$STH->bindParam(6,$cstate);
		$STH->bindParam(7,$cphone);
		$STH->bindParam(8,$cemail);		
		$STH->execute();
	
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
   header('Location: https://www.guinhq.com/oxfordcc/custdt.php');
}


//edits and updates customer information
if(isset($_POST['editcust'])){

	$corg = $_POST['corg'];
	$cfname = $_POST['cfname'];
	$clname = $_POST['clname'];
	$caddr = $_POST['caddr'];
	$ccity = $_POST['ccity'];
	$cstate = $_POST['cstate'];
	$cphone = $_POST['cphone'];
	$cemail = $_POST['cemail'];
	
	$cnum = $_POST['fcustnum'];
	
   require_once('cru100.php');
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
		$STH = $dbc->prepare('UPDATE Customer SET Corg=?,Cfname=?,Clname=?,Caddr=?,Ccity=?,Cstate=?,Cphone=?,Cemail=? WHERE CustID='.$cnum);
		$STH->bindParam(1,$corg);
		$STH->bindParam(2,$cfname);	
		$STH->bindParam(3,$clname);	
		$STH->bindParam(4,$caddr);	
		$STH->bindParam(5,$ccity);	
		$STH->bindParam(6,$cstate);
		$STH->bindParam(7,$cphone);
		$STH->bindParam(8,$cemail);		
		$STH->execute();
	
		}
	catch(PDOException $e)
		{
			echo "Database Operations Failed: " . $e->getMessage();
		}
   header('Location: https://www.guinhq.com/oxfordcc/custdt.php');
}
?>