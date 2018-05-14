<?php

// The first line reads the raw post input that was sent to the server.
// Note that we are expecting a JSON array, not form fields.
$postdata = file_get_contents("php://input");

// debug code -- send whatever was posted right back to the client
//    so that it can be viewed if logged by the Android app
//echo $postdata;
//exit;

//{ "account_email":"someone@somewhere.com", "account_password":"mypassword"}

// parse the JSON string into an associative array called parsedJSON
$parsedJSON = json_decode($postdata, true);

// bail out if it's not valid JSON data
if($parsedJSON==null) exit;

// bail out if they did not send an email address value
if(!array_key_exists('account_email', $parsedJSON)) exit; // $parsedJSON['account_email'] = "someone@somewhere.com"

// bail out if they did not send a password value
if(!array_key_exists('account_password', $parsedJSON)) exit;

// note: this is where you would include the necessary database code to
// lookup the credentials that were passed from the application

 
// if they provided "aaa" for email address and "bbb" for password, let's 
// pretend the db lookup of their credentials succeeded
$dbLookupSuccess = 0;
$loginSS = 0;

$email = $parsedJSON['account_email'];
$password = $parsedJSON['account_password'];
$date = $parsedJSON['search_date'];

$servername = 'localhost';
$username = 'u100';
$password = 'password';
$dbname = 'PracDB';
$dbname2 = 'MIS419DB';

	try 
	{
		$dbc = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
		
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//compute the hashed version of the password the user entered
		$LoginPassword = hash('sha256', $password);
		
		$STH = $dbc->prepare('SELECT * from employees WHERE Email=:param_email AND EPassword=:param_password');
		$STH->bindParam(':param_email', $email);
		$STH->bindParam(':param_password', $LoginPassword);	

		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$STH->execute();
		
		while($row = $STH->fetch()) {
			if($row['URMLevel'] == 'owner'){
			$loginSS = 1;
			}
		}
	}
	catch (PDOException $e){
	echo "BADCONNECTION";
	}
if ($loginSS > 0){
	$db = new PDO("mysql:host=$servername;dbname=$dbname2", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$ST = $db->prepare("SELECT DATE, IFNULL( SUM( Approved_hrs ) , 0 ) AS AH, IFNULL( SUM( Unapproved_hrs ) , 0 ) AS UH, IFNULL( SUM( Wages ) , 0 ) AS SW
				FROM Hours
				GROUP BY DATE
				HAVING DATE ='".$date."'");
		$ST->execute();
		
		while($row = $ST->fetch()) {
		$arr = array( "Date_val" => $date, 
				"AH" => $row['AH'], 
				"UH" => $row['UH'],
				"Days_Wages" => $row['SW'] );  // $arr['Count_Value'] = 12
		$dbLookupSuccess = 1;
		}
	
}
 
if($dbLookupSuccess>0) {
	echo json_encode($arr);  // {"Count_Value": "12"}
} else {
	echo "INVALIDCREDENTIALS";
}

// See more at: http://www.semurjengkol.com/populating-android-listview-with-json-based-data-fetched-from-mysql-server-using-php/#sthash.Cm5BFS6C.dpuf



?>