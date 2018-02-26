<?php
// Include config file
require_once 'config.php';

// Validate fields: https://www.w3schools.com/php/php_form_url_email.asp 

// Define variables and initialize with empty values
$name = $email = $subject = $message = "";
$name_err = $email_err = $subject_err = $message_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
	
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = 'Please enter a valid name.';
    } else{
        $name = $input_name;
    }
	
	// Validate EMAIL
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = 'Please enter an email.'; 
    } elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
        $email_err = 'Please enter a valid email.';		
    } else{
        $email = $input_email;
    }
    
    // Validate SUBJECT
    $input_subject = trim($_POST["subject"]);
    if(empty($input_subject)){
        $subject_err = 'Please enter an subject.';     
    } else{
        $subject = $input_subject;
    }
	
     // Validate MESSAGE
    $input_message= trim($_POST["message"]);
    if(empty($input_subject)){
        $message_err = 'Please enter an message.';     
    } else{
        $message = $input_message;
    }
    
    // Check input errors before inserting in database
 
	if(empty($name_err) && empty($email_err) && empty($subject_err) && empty($message_err)){
        // Prepare an update statement
		$sql = "UPDATE contact SET name=?, email=?, subject=? , message=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
			// "ssssi" = 4 variables are strings, last one is integer
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_email, $param_subject, $param_message, $param_id);
            
            // Set parameters
            $param_name 	= $name;
            $param_email 	= $email;
            $param_subject 	= $subject;
			$param_message 	= $message;
			$param_id = $id;
			
			// DEBUG
			// echo "PARAM_NAME =" . $param_name .  " EMAIL =" . $param_email . " SUBJECT =" . $param_subject . " Message =" .  $param_message . "<br>";
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM contact WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name    = $row["name"];
                    $email   = $row["email"];
                    $subject = $row["subject"];
					$message = $row["message"];
					
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" value="<?php echo $subject; ?>">
                            <span class="help-block"><?php echo $subject_err;?></span>
                        </div>
						 <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                            <label>Message</label>
                            <input type="text" name="message" class="form-control" value="<?php echo $message; ?>">
                            <span class="help-block"><?php echo $message_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>