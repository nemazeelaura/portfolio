<?php

   Class Contact {
   	static public function find() {
   		$servername = 'localhost';
   		$username = 'root';
   		$password = 'root';
   		$dbname = 'contacts_db';
   		$mysql_connection = new mysqli($servername, $username, $password, $dbname);

    if($mysql_connection->connect_error){
	    $mysql_connection->close();
	    die('Connection Failed: ' . $mysql_connection->connect_error);
   	} else {
	    $sql = "SELECT * FROM contacts;";
	    $results = $mysql_connection->query($sql);
	    return $results;
    }
  
  }
 
      static public function create($name, $email, $phone, $message) {
      $servername = 'localhost';
      $username = 'root';
      $password = 'root';
      $dbname = 'contacts';
      $mysql_connection = new mysqli($servername, $username, $password, $dbname);

    if($mysql_connection->connect_error){
      $mysql_connection->close();
      die('Connection Failed: ' . $mysql_connection->connect_error);
    } else {
      $sql = "INSERT INTO contacts (name, email, phone, message) VALUES ('".$name."', '".$email."', '".$phone."', '."$message"'):";
        $mysql_connection->query($sql);
      return $results;
    }

  }


}

?>   