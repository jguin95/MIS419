<?php
session_start();
$servername = 'localhost';
$username = 'u100';
$password = 'password';
$dbname = 'PracDB';
$dbname2 = 'MIS419DB';

if($_SESSION['Access'] == 'accountant'){
$username = 'accountant101';
$password = 'P@ssw0rd11';
}
?>