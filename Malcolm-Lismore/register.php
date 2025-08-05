<?php

$servername = "localhost";
$username = "root";
$password = ""; // Your database password, if any
$dbname = "mlismore"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error for debugging, but don't expose too much info to the user
    error_log("Connection Failed: " . $conn->connect_error);
    die("<script>alert('Database connection failed. Please try again later.');</script>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and trim input data
    $fname = $conn->real_escape_string(trim($_POST["fname"]));
    $usr = $conn->real_escape_string(trim($_POST["usr"]));
    // --- START: MODIFIED CODE ---
    // NO HASHING: Storing plain text password. HIGHLY INSECURE.
    $pwd = $conn->real_escape_string(trim($_POST["pwd"]));
    $cpwd = $conn->real_escape_string(trim($_POST["cpwd"]));
    // --- END: MODIFIED CODE ---

    // Basic server-side validation
    if (empty($fname) || empty($usr) || empty($pwd) || empty($cpwd)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
    } elseif ($pwd !== $cpwd) {
        echo "<script>alert('Password and Confirm Password do not match.');</script>";
    } else {
        // --- START: MODIFIED CODE ---
        // Insert plain text password into the database. HIGHLY INSECURE.
        // Make sure your 'pwd' column in the 'member' table is large enough for the password string (e.g., VARCHAR(255))
        $sql = "INSERT INTO `member` (`fname`, `usr`, `pwd`,`cpwd`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            // Error preparing statement
            error_log("Error preparing statement: " . $conn->error);
            echo "<script>alert('An error occurred. Please try again later.');</script>";
        } else {
            // Bind parameters for plain text password
            // 's' for string type for each parameter
            $stmt->bind_param("ssss", $fname, $usr, $pwd, $cpwd); // Binding plain $pwd directly
        // --- END: MODIFIED CODE ---

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Thank You! You have become a member!');</script>";
                echo "<script>window.location.href = 'index.php';</script>"; // Keep this if you want the alert first
            } else {
                // Error executing statement
                error_log("Error during registration: " . $stmt->error);
                echo "<script>alert('Error registering! Please try a different username or try again later.');</script>";
            }
            // Close the statement
            $stmt->close();
        }
    }
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Malcolm Lismore Register Form</title>
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
            <form action="register.php" method="post">
                <img src="images/avatar.svg">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <h5>Full Name</h5>
                        <input type="text" class="input" name="fname">
                   </div>
                </div>
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
                        <input type="text" class="input" name="pwd">
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                        <h5>Confirm Password</h5>
                        <input type="text" class="input" name="cpwd">
                   </div>
                </div>
                <a href="login.php">Already Member ? Login Now.</a>
                <input type="submit" class="btn" value="Register">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>