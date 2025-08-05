<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mlismore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string(trim($_POST["name"]));
    $email = $conn->real_escape_string(trim($_POST["email"]));
    $phone_num = $conn->real_escape_string(trim($_POST["phone_num"]));
    $appoiment_date = $conn->real_escape_string(trim($_POST["appoiment_date"]));

    if (empty($name) || empty($email) || empty($phone_num) || empty($appoiment_date)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
    } else {
        $sql = "INSERT INTO `booking` (`name`, `email`, `phone_num`, `appoiment_date`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
        } else {
            $stmt->bind_param("ssss", $name, $email, $phone_num, $appoiment_date);

            if ($stmt->execute()) {
                echo "<script>alert('Your Appointment Request Has Been Send. We Will Contact You Soon!');</script>";
                echo "<script>window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Error submitting booking !: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        }
    }
}

$conn->close();

?>

<?php include 'includes/header.php'; ?>

<script>document.body.classList.add("booking-page-body");</script>

<div class="background">
    <div class="booking-form">
        <h2>Appointment Booking Form</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone_num">Phone Number:</label>
            <input type="text" name="phone_num" id="phone_num" required>

            <label for="appoiment-date">Appointment Date:</label>
            <input type="date" name="appoiment_date" id="appoiment_date" required>

            <button type="submit">Book Now</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>