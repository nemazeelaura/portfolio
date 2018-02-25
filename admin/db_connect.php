<?php
// --- db_connect.php ---
// This file makes the connection to the MySQL database
// $host = "localhost";               // Localhost - Uncomment if you developeing on local host
$host     = "mysql.lauranemazee.com"; // Dreamhost 
$user     = "moominmamma";            // the username specified when setting up the database
$password = "OkkiMan@77";             // the password specified when setting up the database
$database = "nemazee_portfolio_db";   // the database name chosen when setting up the database 

// Connect to the database
$link = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno($link)) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// echo 'Connected successfully to DB';
?>