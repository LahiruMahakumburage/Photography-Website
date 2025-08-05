<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="css/styles_d.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
  <header class="header">
    <div class="logo">
      <a href="#">Malcolm Lismore</a>
      <div class="search_box">
        <input type="text" placeholder="Search Malcolm Lismore">
        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
      </div>
    </div>

    <div class="header-icons">
      <i class="fas fa-bell"></i>
      <div class="account">
        <img src="./pic/img.jpg" alt="">
        <h4>Admin</h4>
      </div>
    </div>
  </header>
  <div class="container">
    <nav>
      <div class="side_navbar">
        <span>Main Menu</span>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="#">Profile</a>
        <a href="tables/sbooking.php">Bookings</a>
        <a href="tables/smails.php">Mails</a>
        <a href="tables/smembers.php">Members</a>
        

      </div>
    </nav>

    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Welcome to Malcolm Lismore</h1>
        <span>Photography in Scotland</span>
        <button>Bookings</button>
      </div>

      <div class="history_lists">
        <div class="list1">
          <div class="row">
            <h4>Bookings</h4>
            
          </div>
          <table>
            
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
              </tr>
              <?php
                    

                    $servername = "localhost";
                    $username = "root";
                    $password = ""; // Your database password, if any
                    $dbname = "mlismore"; // Your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id, name, email, phone_num, appoiment_date from booking";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone_num"] . "</td><td>" . $row["appoiment_date"] . "</td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "string"; 
                    }

                    ?>

        
            
          </table>
        </div>
        

        <div class="list2">
          
        </div>
      </div>
    </div>

    <div class="sidebar">
      

    </div>
  </div>
</body>
</html>
</span>