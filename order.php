<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "newpassword"; // Replace with your database password
$dbname = "imys_sparkles_sweetness"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the Orders table
$sql = "SELECT name, email, phone_number, sweets, other_sweet, quantity FROM Orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Sweets</th>
            <th>Other Sweet</th>
            <th>Quantity</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['phone_number'] . "</td>
                <td>" . $row['sweets'] . "</td>
                <td>" . ($row['other_sweet'] ? $row['other_sweet'] : 'N/A') . "</td>
                <td>" . $row['quantity'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No orders found.";
}

// Close the connection
$conn->close();
?>
