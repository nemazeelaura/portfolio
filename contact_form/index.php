<!DOCTYPE html>

<html>

<head>
    <title>Contact Form</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="table.css">
</head>

<body>

<div class="container">
    <h3>Lauranemazee.com Contact Form</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
		<div class="form-group">
            <label>Subject:</label>
            <input type="subject" name="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Message:</label>
            <textarea class="form-control" name="message" required></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
		<div class="form-group">
			<?php

			// Include file to connect to our DB
			require('db_connect.php');

			 // If form was submitted, process it
			if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

				// Extract all values from the form
				extract($_POST);

				// Insert submitted queries in MySQL Database
				$query = "INSERT INTO `contact` (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
				$result = mysqli_query($link, $query);

			}
				
				$name    = $_POST['name'];
				$email   = $_POST['email'];
				$subject = $_POST['subject'];
				$message = $_POST['message'];
	             
				// Create the email and send the message
				$to = 'info@lauranemazee.com'; 
				$email_subject = "Lauranemazee.com:  $subject";
				$email_body = "You have received a new message from your website contact form http://www.lauranemazee.com/contact_form/ \n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\Subject: $subject\n\nMessage:\n$message";
				$headers = "From: noreply@lauranemazee.com\n"; 
				$headers .= "Reply-To: $email_address";	
				mail($to,$email_subject,$email_body,$headers);
				return true;			

				// Close connection to the DB
				$link->close()
				?>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
        </div>
    </form>
</div>
</body>
</html>