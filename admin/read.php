<?php
// Prepared statements are very useful against SQL injections.
// https://www.w3schools.com/php/php_mysql_prepared_statements.asp
// Read https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection 

// Check existence of id parameter before processing further
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
	
    // Include config file
    require_once 'config.php';
	 
    // Prepare a select statement
	 $sql = "SELECT * FROM contact WHERE id = ?";
	// echo "SQL = $sql";
    
    if($stmt = mysqli_prepare($link, $sql)){
		
		// Set parameters
        $param_id = trim($_GET["id"]);
		
        // Bind variables to the prepared statement as parameters
		// Syntax: bool mysqli_stmt_bind_param ( mysqli_stmt $stmt , string $types , mixed &$var1 [, mixed &$... ] )
		// 
		// - i: corresponding variable has type integer
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
			// echo "INSIDE IF 4 - ";
			
			// "result" is a mysqli_result object. This is the same object that mysqli_query returns. 
            $result = mysqli_stmt_get_result($stmt);
			
			// echo "Value of NUM ROWS = " . mysqli_num_rows($result);
			
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

				// Retrieve individual field value
                $name    = $row["name"];
                $email   = $row["email"];
                $subject = $row["subject"];
				$message = $row["message"];
				
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <p class="form-control-static"><?php echo $row["subject"]; ?></p>
                    </div>
					 <div class="form-group">
                        <label>Message</label>
                        <p class="form-control-static"><?php echo $row["message"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>