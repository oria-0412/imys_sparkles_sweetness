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
if (empty($name) || empty($email) || empty($phone_number) || empty($course_option)) {
    die("Error: All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email format.");
}

if (!preg_match("/^\d{10}$/", $phone_number)) {
    die("Error: Invalid phone number. Must be 10 digits.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO PersonalInfo (name, email, phone_number, course_option) 
        VALUES (?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE 
        course_option = ?");
$stmt->bind_param("sssss", $name, $email, $phone_number, $course_option, $course_option);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to the Thank You page
    header("Location: thank-you.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
