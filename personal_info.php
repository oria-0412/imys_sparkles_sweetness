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

// Validate and sanitize input
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone_number = trim($_POST['phone']);
$course_option = trim($_POST['course-option']);

// Basic input validation
if (empty($name) || empty($email) || empty($phone) || empty($course_option)) {
    die("Error: All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email format.");
}

if (!preg_match("/^\d{10}$/", $phone)) {
    die("Error: Invalid phone number. Must be 10 digits.");
}

// Escape strings for security
$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$phone_number = $conn->real_escape_string($phone);
$course_option = $conn->real_escape_string($course_option);

// Insert or update data in the PersonalInfo table
$sql = "INSERT INTO PersonalInfo (name, email, phone_number, course_option) 
        VALUES ('$name', '$email', '$phone_number', '$course_option') 
        ON DUPLICATE KEY UPDATE 
        course_option = '$course_option';

if ($conn->query($sql) === TRUE) {
    // Redirect to the Thank You page
    header("Location: thank-you.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
