<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// define('DB_SERVER', 'localhost');
define('DB_SERVER', 'mysql.lauranemazee.com');
define('DB_USERNAME', 'moominmamma');
define('DB_PASSWORD', 'OkkiMan@77');
define('DB_NAME', 'nemazee_portfolio_db');
// define('DB_TABLE', 'employees');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>