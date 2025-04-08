<?php
$user = $_POST['name'];
$email = $_POST['email'];
$num = $_POST['amount'];
if (!empty($user) && !empty($email) && !empty($num)) {

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "sign";

    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        $stmt = $conn->prepare("INSERT INTO dono (name, email, amount) VALUES (?, ?, ?)");
        // Bind the parameters to the query
        $stmt->bind_param("sss", $user, $email, $num);
        if ($stmt->execute()) {
            echo "<script>alert('Donated Successfully !'); window.location.href='home.html';</script>";
        } else {
            echo "<script>alert('Error during Donation. Please try again.'); window.location.href='demo.html';</script>";
        }
    
        exit();
    $stmt->close();
    $conn->close();

} 
?>