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

// Check for query errors
if (!$result) {
    die("Error executing query: " . $conn->error);
}

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
        // Escape output to prevent XSS
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $phone_number = htmlspecialchars($row['phone_number']);
        $sweets = htmlspecialchars($row['sweets']);
        $other_sweet = htmlspecialchars($row['other_sweet']);
        $quantity = htmlspecialchars($row['quantity']);

        echo "<tr>
                <td>$name</td>
                <td>$email</td>
                <td>$phone_number</td>
                <td>$sweets</td>
                <td>" . ($other_sweet ? $other_sweet : 'N/A') . "</td>
                <td>$quantity</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No orders found.";
}

// Close the connection
$conn->close();
?>
