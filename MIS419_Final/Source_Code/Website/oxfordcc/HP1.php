<!DOCTYPE html>
<html>
<head>
<title>Oxford Construction Co.</title>
<link rel="shortcut icon" href="npic.ico" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>

<nav class='navbar navbar-expand-sm bg-primary navbar-dark'>
  <a class="navbar-brand" href="HP1.php">
    <img src="npic.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Oxford Construction Company
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="mainmenu.php">Employee area<span class="sr-only">(current)</span></a>
      </li>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          About Us
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Company Mission</a>
          <a class="dropdown-item" href="#">Company Vision</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Contact Info</a>
        </div>
      </li>

    </ul>
    <span class="navbar-text">
      <?php session_start(); echo $_SESSION['fname']." ".$_SESSION['lname']; ?>
	<a href="https://www.guinhq.com/oxfordcc/login.php">Login</a>
	<a href="https://www.guinhq.com/oxfordcc/logout.php">Logout</a>
    </span>
  </div>
</nav>

<p><a href="https://www.guinhq.com/oxfordcc/HP1.php"><img src="occ.png" alt="Oxford Construction Home" width="500" height="200"></a></p>

<p>This is the webpage that will be viewed by people who are not affiliated with the company.</p>
<p>This page can be customized with any public information about the company that management would like to display.</p>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>