<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/styles_d.css" />
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
        <a href="../dashboard.php">Dashboard</a>
        <a href="#">Profile</a>
        <a href="sbooking.php">Bookings</a>
        <a href="smails.php" class="active">Mails</a>
        <a href="smembers.php">Members</a>
        

      </div>
    </nav>

    <div class="main-body">
      <h2>Mails</h2>
      

      <div class="history_lists">
        <div class="list1">
          <div class="row">
            
            
          </div>
          <table>
            
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                
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

                    $sql = "SELECT id, fname, usr from member";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["usr"] . "</td></tr>";
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