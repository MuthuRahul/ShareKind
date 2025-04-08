<?php
$user = $_POST['fullName'];
$email = $_POST['email'];
$num = $_POST['mobile'];
$dob = $_POST['dob'];
$pass1 = $_POST['passwords'];
$pass2 = $_POST['confirmPasswords'];

if (!empty($user) && !empty($email) && !empty($num) && !empty($dob) && !empty($pass1) && !empty($pass2)) {

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "sign";

    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email is already registered
    $stmt = $conn->prepare("SELECT email FROM signup WHERE email = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "<script>alert ('Email is already registered!');window.location.href='signup.html';</script>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    // Check if the phone number is already registered
    $stmt = $conn->prepare("SELECT mobile FROM signup WHERE mobile = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $num);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "<script>alert ('Mobile number is already registered!');window.location.href='signup.html';</script>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    if ($pass1 === $pass2) {
        // Prepare the SQL query
        $stmt = $conn->prepare("INSERT INTO signup (user, email, mobile, dob, passwords) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind the parameters to the query
        $stmt->bind_param("sssss", $user, $email, $num, $dob, $pass1);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Successfully Registered!'); window.location.href='sklogin.html';</script>";
        } else {
            echo "<script>alert('Error during registration. Please try again.'); window.location.href='signup.html';</script>";
        }
        exit();
    } else {
        // If passwords don't match, show an alert and redirect to signup page
        echo "<script>alert('Passwords do not match! Please retype the password correctly.'); window.location.href='signup.html';</script>";
    }
    
    $stmt->close();
    $conn->close();

} else {
    echo "All fields are required!";
}

?>