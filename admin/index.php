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
			// *** Display the content of the database underneath the form ***
			// FROM: http://webdevzoom.com/display-mysql-data-html-5-table-using-php/

			$sql = 'SELECT * FROM contact';
			$query = mysqli_query($link, $sql);

			if (!$query) {
				die ('SQL Error: ' . mysqli_error($conn));
			}
			?>
			<h1>Current content of database</h1>
			<table class="data-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Subject</th>
						<th>Message</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no 	= 1;
				while ($row = mysqli_fetch_array($query))
				{
					$amount  = $row['amount'] == 0 ? '' : number_format($row['amount']);
					echo '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['name'].'</td>
							<td>'.$row['subject'].'</td>
							<td>'.$row['message'].'</td>
						</tr>';
					$no++;
				}
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