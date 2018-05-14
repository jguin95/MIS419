<?php
session_start();
$servername = 'localhost';
$username = 'empuser121';
$password = 'PW123';
$dbname = 'MIS419DB';

if($_SESSION['Access'] == 'accountant'){
$username = 'accountant101';
$password = 'P@ssw0rd11';
}
?>