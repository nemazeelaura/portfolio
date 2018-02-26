<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// define('DB_SERVER', 'localhost');
define('DB_SERVER', 'mysql.lauranemazee.com');
define('DB_USERNAME', 'nemazee_user');
define('DB_PASSWORD', 'ArvDen@99');
define('DB_NAME', 'nemazee_portfolio_db');
// define('DB_TABLE', 'contact');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>