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
    $phone_num = $conn->real_escape_string(trim($_POST["phone_num"]));
    $email = $conn->real_escape_string(trim($_POST["email"]));
    $message = $conn->real_escape_string(trim($_POST["message"]));

    if (empty($name) || empty($email) || empty($phone_num) || empty($message)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
    } else {
        $sql = "INSERT INTO `mails` (`name`, `phone_num`, `email`, `message`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
        } else {
            $stmt->bind_param("ssss", $name, $phone_num, $email, $message);

            if ($stmt->execute()) {
                echo "<script>alert('Your Mail Request Has Been Send. We Will Contact You Soon!');</script>";
            } else {
                echo "<script>alert('Error submitting mail !: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        }
    }
}

$conn->close();

?>

<?php include 'includes/header.php'; ?>

<!-- Contact section -->
    <section class="contact bg-light" id="contact">
        <div class="container">

            <div class="box">
                <h2 class="title">
                    Need help with professional photography? Let's work together!
                </h2>
                <ul>
                    <li>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span>+94 70 1113 740</span>
                    </li>
                    <li>
                        <i class="fa fa-at" aria-hidden="true"></i>
                        <span>info@malcolmlismore.com</span>

                    </li>
                    <li>
                        <i class="fa fa-location-pin" aria-hidden="true"></i>
                        <span>North West coast, Scotland</span>
                    </li>
                </ul>

            </div>

            <div class="box">
                <div class="box-r">
                    <div class="form-box">
                        <div class="form-title">
                            <h2>Get in touch</h2>
                        </div>
                        <form action="contact.php" method="post">
                            <div class="one-line">
                                <div class="box-input">
                                    <i class="far fa-user"></i>
                                    <input type="text" name="name" id="" class="text" placeholder="Full Name..">
                                </div>
                                <div class="box-input">
                                    <i class="fa fa-phone"></i>
                                    <input type="text" name="phone_num" id="" class="text" placeholder="Your Phone">
                                </div>
                            </div>

                            <div class="box-input">
                                <i class="fa fa-at"></i>
                                <input type="email" name="email" id="" class="text" placeholder="Email..">
                            </div>
                            <div class="box-input">
                                
                                <textarea name="message" id="" cols="30" rows="5" placeholder="Your Message.."></textarea>
                            </div>
                            <button class="btn-send">Contact us</button>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </section>
    <!-- Contact section -->

<?php include 'includes/footer.php'; ?>