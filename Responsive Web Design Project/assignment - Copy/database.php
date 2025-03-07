<?php
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $con = new mysqli("localhost", "root", "", "roadrages");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM userdetails WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();

            if ($password === $data['password']) {
                $_SESSION['userID'] = $data['userID'];
                header("Location: forum-main.php");
                exit();
            } else {
                echo "<script>
                    alert('Incorrect email or password, please try again.');
                    window.location.href = 'login.php';
                </script>";
                exit();
            }
        } else {
            echo "<script>
                alert('Incorrect email or password, please try again.');
                window.location.href = 'login.php';
            </script>";
            exit();
        }
        $stmt->close();
    }
    $con->close();
}
?>
