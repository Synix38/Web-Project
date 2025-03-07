<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $phonenumber = htmlspecialchars(trim($_POST['phonenumber']));
    $gender = htmlspecialchars(trim($_POST['gender']));

    echo "Raw Password: " . $password . "<br>";

    $conn = new mysqli("localhost", "root", "", "roadrages");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {

        $default_pfp = 'df_pfp.png';

        $stmt = $conn->prepare("INSERT INTO userdetails (username, email, password, phonenumber, gender, pfp) VALUES (?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssss", $username, $email, $password, $phonenumber, $gender, $default_pfp);

        if ($stmt->execute()) {

            $_SESSION['userID'] = $conn->insert_id;
            header("Location: forum-main.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>