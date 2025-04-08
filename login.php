<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['email'];
    $password = $_POST['passwords'];

    // Check if the fields are empty
    if (empty($username) || empty($password)) {
        echo "<script>alert ('Both fields are Required!');window.location.href='sklogin.html';</script>";
        exit(); // Stop further processing
    }

    // Database connection details
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "sign";

    // Create database connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to check the user's credentials
    $SELECT = "SELECT * FROM signup WHERE email = ? AND passwords = ? LIMIT 1";
    
    // Prepare the statement
    $stmt = $conn->prepare($SELECT);
    if (!$stmt) {
        die("SQL prepare failed: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ss", $username, $password);
    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    // Check if a matching record is found
    if ($stmt->num_rows == 1) {
        // Valid user, create session and redirect to index.html
        $_SESSION['email'] = $username;  // Store username in session
        echo "<script>alert ('Login Successfully!');window.location.href='home.html';</script>";
    }
    else {
        // Invalid credentials
        echo "<script>alert ('Email ID or Password Incorrect');window.location.href='sklogin.html';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
 // End output buffering and flush the output
?>
