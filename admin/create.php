<?php
// --------- File: create.php --------- 

// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$name = $email = $subject = $message = "";
$name_err = $email_err = $subject_err = $message_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
    // Validate name`
            // Bind variables to the prepared statement as parameters
			// "ssss" = all 4 variables are strings
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_subject, $param_message);
            
            // Set parameters
            $param_name 	= $name;
            $param_email 	= $email;
            $param_subject 	= $subject;
			$param_message 	= $message;
			
			// DEBUG
			// echo "PARAM_NAME =" . $param_name .  " EMAIL =" . $param_email . " SUBJECT =" . $param_subject . " Message =" .  $param_message . "<br>";
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add new contact record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>email</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
                            <label>subject</label>
                            <textarea name="subject" class="form-control"><?php echo $subject; ?></textarea>
                            <span class="help-block"><?php echo $subject_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                            <label>Message</label>
                            <input type="text" name="message" class="form-control" value="<?php echo $message; ?>">
                            <span class="help-block"><?php echo $message_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>