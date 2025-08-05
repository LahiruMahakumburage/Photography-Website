<?php
session_start(); // Start the session to manage user login state

$servername = "localhost";
$username = "root";
$password = ""; // Your database password, if any
$dbname = "mlismore"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // If connection fails, show an alert and redirect
    die("<script>alert('Database connection failed. Please try again later.'); window.location.href = 'login.php';</script>");
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    // Using real_escape_string to escape special characters for safety in direct query,
    // but this DOES NOT prevent all SQL injection if not used consistently and correctly.
    $usr = $conn->real_escape_string(trim($_POST["usr"]));
    $pwd = $conn->real_escape_string(trim($_POST["pwd"])); // Get plain password, escape for query

    // Basic input validation
    if (empty($usr) || empty($pwd)) {
        echo "<script>alert('Please enter both username and password.');</script>";
    } else {
        // Construct SQL query directly (INSECURE without prepared statements)
        // This is where SQL Injection can happen if $usr is not properly escaped.
        $sql = "SELECT id, usr, pwd FROM `member` WHERE usr = '$usr'";

        // Execute the query
        $result = $conn->query($sql);

        // Check if query was successful
        if ($result === false) {
            echo "<script>alert('An error occurred during login. Please try again later.');</script>";
            error_log("SQL Error: " . $conn->error); // Log the actual SQL error for debugging
        } elseif ($result->num_rows === 1) {
            // User found, fetch their data
            $user = $result->fetch_assoc();
            $plain_password_from_db = $user['pwd']; // Plain text password from DB

            // Direct comparison of plain text passwords (HIGHLY INSECURE)
            if ($pwd === $plain_password_from_db) {
                // Password is correct, start a session
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['usr'] = $user['usr'];

                echo "<script>alert('Login successful !');</script>";
                echo "<script>window.location.href = 'index.php';</script>";
                exit; // Always exit after a redirect
            } else {
                // Password mismatch
                echo "<script>alert('Invalid username or password.');</script>";
            }
        } else {
            // No user found with that username
            echo "<script>alert('Invalid username or password.');</script>";
        }
    }
}

// Close database connection
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Malcolm Lismore Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="images/wave.png">
	<div class="container">
		<div class="img">
			<img src="images/bg.svg">
		</div>
		<div class="login-content">
			<form action="login.php" method="post">
				<img src="images/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="usr">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="pwd">
            	   </div>
            	</div>
            	<a href="register.php">Not a member ? Register Now</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
