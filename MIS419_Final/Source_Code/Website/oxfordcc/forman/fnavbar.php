<?php
Class OxfordNav{
	
	Public Function Fnavbar(){
		session_start();
		If(!$_SESSION['ValidUser']){
			header('Location: https://www.guinhq.com/oxfordcc/login.php');
		} 
		If($_SESSION['Access'] == 'employee'){
			header('Location: https://www.guinhq.com/oxfordcc/mainmenu.php');
		}
		echo "
			<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
			<link rel='stylesheet' type='text/css' href='https://www.guinhq.com/oxfordcc/mystyle.css'>
			</head>
			<body>
			
			<nav class='navbar navbar-expand-lg navbar-light bg-light'>
			  <a class='navbar-brand' href='https://www.guinhq.com/oxfordcc/forman/fhp.php'>
			    <img src='https://www.guinhq.com/oxfordcc/npic.png' width='30' height='30' class='d-inline-block align-top' alt=''>
			    Oxford Construction Company
			  </a>
			  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarText' aria-controls='navbarText' aria-expanded='false' aria-label='Toggle navigation'>
			    <span class='navbar-toggler-icon'></span>
			  </button>
			  <div class='collapse navbar-collapse' id='navbarText'>
			    <ul class='navbar-nav mr-auto'>
			      <li class='nav-item active'>
			        <a class='nav-link' href='https://www.guinhq.com/oxfordcc/HP1.php'>Home<span class='sr-only'>(current)</span></a>
			      </li>";
			If($_SESSION['Access'] == 'owner'){
			echo "
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
			          Reports
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/ActiveJobReport.php'>Active Jobs</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/InActiveJobReport.php'>Inactive Jobs</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/Selectreport.php'>Monthly Report</a>
			          <a class='dropdown-item' href='https://www.guinhq.com/oxfordcc/Yearly_Sub.php'>Yearly Report</a>
			        </div>
			      </li>";
			}
			echo "
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
			          Materials
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='Matdt.php'>Materials Used</a>
			          <a class='dropdown-item' href='addmat.php'>New Material</a>
			        </div>
			      </li>
			
			    </ul>
			    <span class='navbar-text'>";
			    echo $_SESSION['fname'].' '.$_SESSION['lname'].' ';
				echo "<a href='https://www.guinhq.com/oxfordcc/login.php'>Login</a>
				<a href='https://www.guinhq.com/oxfordcc/logout.php'>Logout</a>
			    </span>
			  </div>
			</nav>";
	}
}


?>