<?php
session_start();

if(isset($_POST['email'])) 	  $tmpEmail = $_POST['email'];
if(isset($_POST['password']))     $tmpPW = $_POST['password'];

if(!$_SESSION['ValidUser']) {
	
	require_once('cru100.php');

	try 
	{
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
		
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//compute the hashed version of the password the user entered
		$LoginPassword = hash('sha256', $tmpPW);
		
		$STH = $dbc->prepare('SELECT * from employees WHERE Email=:param_email AND EPassword=:param_password');
		$STH->bindParam(':param_email', $tmpEmail);
		$STH->bindParam(':param_password', $LoginPassword);	
		 
		//set the fetch mode
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();
		
		$recordsFound = 0;
		//echo "email: " . $tmpEmail . "<br>";
		//echo "raw password: " . $tmpPW . "<br>";
		//echo "md5 password: " . $LoginPassword . "<br>";
		
		while($row = $STH->fetch()) {
			
			If($row['Active'] == true){
			$_SESSION['ValidUser'] = true;
			$_SESSION['Access'] = $row['URMLevel'];
			$_SESSION['fname'] = $row['EFname'];
			$_SESSION['lname'] = $row['ELname'];
			$_SESSION['empid'] = $row['EmpID'];
			$recordsFound = $recordsFound + 1;
			}
		}
		
		//echo "recordsFound: " . $recordsFound . "<br>";
		//die();
		if($recordsFound == 0 ) {
			echo "<html><script language='JavaScript'>alert('Invalid Login Information!'),history.go(-1)</script></html>";
			header('Location: https://www.guinhq.com/oxfordcc/login.php');
			
		}
		elseif($_SESSION['Access'] == 'employee'){
		header('Location: https://www.guinhq.com/oxfordcc/employee/ehp.php');
		}
		elseif($_SESSION['Access'] == 'foreman'){
		header('Location: https://www.guinhq.com/oxfordcc/forman/fhp.php');
                }
                elseif($_SESSION['Access'] == 'secretary'){
		header('Location: https://www.guinhq.com/oxfordcc/sec/Sechp.php');
                }
	}
	catch(PDOException $e)
		{
		header('Location: https://www.guinhq.com/oxfordcc/login.php');
		die();
	}
}
If($_SESSION['Access'] == 'employee'){
header('Location: https://www.guinhq.com/oxfordcc/employee/ehp.php');
}
elseif($_SESSION['Access'] == 'foreman'){
header('Location: https://www.guinhq.com/oxfordcc/forman/fhp.php');
}
elseif($_SESSION['Access'] == 'secretary'){
header('Location: https://www.guinhq.com/oxfordcc/sec/Sechp.php');
}
?><!DOCTYPE html>
<html>
<head>
			<title>Oxford Construction Co.</title>
			<link rel='shortcut icon' href='npic.ico' />
			<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
			<link rel='stylesheet' type='text/css' href='mystyle.css'>
			</head>
			<body>
			
			<nav class='navbar navbar-expand-sm bg-primary navbar-dark'>
			  <a class='navbar-brand' href='mainmenu.php'>
			    <img src='npic.png' width='30' height='30' class='d-inline-block align-top' alt=''>
			    Oxford Construction Company
			  </a>
			  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarText' aria-controls='navbarText' aria-expanded='false' aria-label='Toggle navigation'>
			    <span class='navbar-toggler-icon'></span>
			  </button>
			  <div class='collapse navbar-collapse' id='navbarText'>
			    <ul class='navbar-nav mr-auto'>
			      <li class='nav-item active'>
			        <a class='nav-link' href='HP1.php'>Home<span class='sr-only'>(current)</span></a>
			      </li>
			
			      <li class='nav-item dropdown'>
			        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			          Manage Employees
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/datatable.php'>View Active Employees</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/inactivedatatable.php'>View Inactive Employees</a>
			          <div class='dropdown-divider'></div>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/employeeform.php'>Add a New Employee</a>
			        </div>
			      </li>
			
			      <li class='nav-item dropdown'>
			        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			          Materials
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/Matdt.php'>Materials Used</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/addmat.php'>New Material</a>
			        </div>
			      </li>
			      
			      <li class='nav-item dropdown'>
			        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			          Jobs
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/jobsdt.php'>Active Jobs</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/inactivejobs.php'>Inactive Jobs</a>
			          <div class='dropdown-divider'></div>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/jobform.php'>Add a New Job</a>
			        </div>
			      </li>
			      
			      <li class='nav-item dropdown'>
			        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			          Customers
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/custdt.php'>Customer Info</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/addcust.php'>New Customer</a>
			        </div>
			      </li>
			      
			      <li class='nav-item dropdown'>
			        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			          Employee Actions
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/employee/ehp.php'>Log Hours</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/forman/fhp.php'>Approve Hours</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/employee/fpdf/econfirm.php'>View Paystubs</a>
			        </div>
			      </li>
			      
			      <li class='nav-item dropdown'>
			        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			          Reports
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/ActiveJobReport.php'>Active Jobs</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/InActiveJobReport.php'>Inactive Jobs</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/SumSuppliers.php'>Supplies Report</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/payroll.php'>Payroll Report</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/Selectreport.php'>Monthly Report</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/Yearly_Sub.php'>Yearly Report</a>
			        </div>
			      </li>
			
			    </ul>
			    <span class='navbar-text'>
			    <?php echo $_SESSION['fname'].' '.$_SESSION['lname'].' | '; ?>
				
				<a href='https://www.guinhq.com/oxfordcc/logout.php'>Logout</a>
			    </span>
			  </div>
			</nav>
			<br />


<h2 align="center">Welcome to The Oxford Construction Company website! (<?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>)</h2>


 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>