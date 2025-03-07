<?php 
    session_start();
    include 'dbconn.php';

    if (isset($_POST['btnUpdate'])) {
        $userID = $_SESSION['userID'];
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $fname = mysqli_real_escape_string($connection, $_POST['fname']);
        $lname = mysqli_real_escape_string($connection, $_POST['lname']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $bio = mysqli_real_escape_string($connection, $_POST['bio']);
        $gender = mysqli_real_escape_string($connection, $_POST['gender']);

        if (!isset($_SESSION['userID'])) {
            header('location:login.php');
            exit;
        }

        $profile_updated = false;

        $query = "UPDATE userdetails 
                SET username='$username', 
                fname='$fname', lname='$lname', 
                email='$email', bio='$bio', gender='$gender'
                WHERE userID ='$userID'";

        if (mysqli_query($connection, $query)) {
            $profile_updated = true;
        } else {
            $_SESSION['profile_update_error'] = true;
        }

        $select = mysqli_query($connection, "SELECT * FROM userdetails WHERE userID = '$userID'") or die('query failed: ' . mysqli_error($connection));
        $fetch = mysqli_fetch_assoc($select);

        $old_pass = mysqli_real_escape_string($connection, $_POST['old_pass']);
        $update_pass = mysqli_real_escape_string($connection, $_POST['update_pass']); 
        $new_pass = mysqli_real_escape_string($connection, $_POST['new_pass']); 
        $confirm_new_pass = mysqli_real_escape_string($connection, $_POST['confirm_new_pass']); 

        if (!empty($new_pass) && !empty($confirm_new_pass)) {
            if ($update_pass != $old_pass) {
                $_SESSION['password_error'] = "Old password is incorrect, please try again.";
                $profile_updated = false;
            } elseif ($new_pass != $confirm_new_pass) {
                $_SESSION['password_error'] = "Your new passwords do not match, please try again.";
                $profile_updated = false;
            } else {
                $password_update_query = "UPDATE `userdetails` SET password = '$new_pass' WHERE userID = '$userID'";
                if (mysqli_query($connection, $password_update_query)) {
                    $_SESSION['password_updated'] = true;
                } else {
                    $_SESSION['password_update_error'] = true;
                    $profile_updated = false;
                }
            }
        }

        $update_image = $_FILES['update_image']['name'];
        $update_image_size = $_FILES['update_image']['size'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'uploaded_img/' . $update_image;

        if (!empty($update_image)) {
            $current_pfp = $fetch['pfp'];
    
            if ($update_image_size > 2000000) {
                $_SESSION['image_error'] = "Maximum file size is 2MB, please try again.";
            } else {
                $old_image_path = 'uploaded_img/' . $current_pfp;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
    
                if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
                    $image_update_query = mysqli_query($connection, "UPDATE userdetails SET pfp = '$update_image' WHERE userID = '$userID'") 
                    or die('query failed: ' . mysqli_error($connection));
    
                    if ($image_update_query) {
                        $_SESSION['image_updated'] = true;
                        $_SESSION['profile_picture'] = $update_image_folder; 
                    }
                } else {
                    $_SESSION['image_error'] = "Failed to upload the image. Please try again.";
                }
            }
        }

        if ($profile_updated) {
            $_SESSION['profile_updated'] = true;
        }

        header("Location: manage_profile.php");
        exit;
    }

    if (isset($_SESSION['profile_updated'])) {
        echo "<script>alert('Profile has been updated!');</script>";
        unset($_SESSION['profile_updated']);
    }

    if (isset($_SESSION['password_updated'])) {
        echo '<script>alert("Password updated successfully!");</script>';
        unset($_SESSION['password_updated']);
    }

    if (isset($_SESSION['password_error'])) {
        echo '<script>alert("' . $_SESSION['password_error'] . '");</script>';
        unset($_SESSION['password_error']);
    }

    if (isset($_SESSION['image_updated'])) {
        echo '<script>alert("Profile picture updated successfully!");</script>';
        unset($_SESSION['image_updated']);
    }

    if (isset($_SESSION['image_error'])) {
        echo '<script>alert("' . $_SESSION['image_error'] . '");</script>';
        unset($_SESSION['image_error']);
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: block;
            flex-direction: column;
            min-height: 100vh;
        }

        form {
            width: 400px;
            height: 350px;
            padding: 100px;
            background:#fff;
            margin-top: -75px;
        }
        
        .acc-main-container {
            display: flex;
            align-items: center;
            justify-content: center; 
            position: relative;
            width: 1020px;
            height: 1125px;
            background: #f5f5f5;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 60px;
            margin: 0 auto;
            position: relative;
        }

        .acc-nav {
            display: flex;
            flex-direction: column;
            width: 180px;
            padding: 10px;
            margin-right: 40px;
            border-right: 2px solid #ccc;
            height: 100%;
        }

        .acc-nav ul {
            display: flex;
            flex-direction: column;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .acc-nav ul li {
            margin-bottom: 15px;
        }

        .acc-nav ul li a {
            text-decoration: none;
            color: #333;
            display: block;
            border-radius: 4px;
            padding: 10px;
        }

        .acc-nav ul li a.active {
            background: #2a2b3b;
            color: #fff;
        }

        .acc-nav ul li a:hover {
            background: black;
            color: #fff;
            display: block;
            transition: 0.1s;
        }

        .acc-details-container {
            display: block;
            width: calc(100% - 240px);
            padding: 10px;
            position: relative;
        }

        .image-container {
            position: relative;
            justify-content: center;
            margin-top: 25px;
            text-align: center;
        }   

        .circular-img {
            width: 175px;
            height: 175px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-container {
            margin-top: 15px;
        }

        .btn {
            width: 85px;
            height: 29px;
            margin: 0 10px;
            border-radius: 15px;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            background-color: #007BFF;
            color: white;
            border: none;
            line-height: 29px;
        }

        input[type="file"] {
            display: none;
        }

        .username {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .name-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .firstname, .lastname {
            width: 48%;
        }

        .firstname input, .lastname input {
            width: 79%;
            height: 30px;
            padding: 8px;
            box-sizing: border-box;
        }

        .email {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .username h1, .firstname h1, .lastname h1, .email h1, .bio h1 {
            font-size: 19px;
            color: #000;
        }

        .username input, .email input {
            width: 90%;
            height: 30px;
            padding: 8px;
            box-sizing: border-box;
        }

        .bio {
            margin-top: 10px;
        }

        textarea {
            width: 90%;
            height: 150px;
            padding: 8px;
            box-sizing: border-box;
            resize: none;
        }

        .gender {
            margin-bottom: 60px;
        }

        .gender h1 {
            font-size: 15px;
            color: #000;
        }

        .gender select {
            width: 200px;
            height: 22px;
            border-radius: 10px;
        }

        .password-container {
            margin-top: 20px;
        }

        .password-container h1{
            font-size: 19px;
            color: #000;
            margin-bottom: 20px;
        }

        .password-container input{
            width: 90%;
            height: 30px;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .submit-btn {
            width: 80px;
            height: 30px;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            position: relative; 
            margin-top: 10px;
            margin-left: 500px;
            font-size: 14px;
        }

        .submit-btn:hover{
            background-color: #333;
            color: #fff
        }

        @media (max-width: 820px) {
            .acc-main-container {
                flex-direction: column;
                width: 100%;
                padding: 10px;
            }

            .acc-nav {
                margin-bottom: 20px;
                display: none;
            }

            form {
                width: 100%;
                padding: 10px;
            }

            .acc-details-container {
                width: 100%;
            }

            .image-container {
                top: 20px;
            }

            .submit-btn {
                margin-left: auto; 
            }
        }

        @media (max-width: 430px) {
            .acc-nav {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
                padding: 10px;
                border-right: none; 
                border-bottom: 2px solid #ccc; 
                margin-bottom: 10px;
            }

            .acc-main-container {
                padding: 0;
            }

            .circular-img {
                width: 120px;
                height: 120px;
            }

            .submit-btn {
                width: 90%; 
                height: 30px;
                margin-left: 0;
                margin-top: 20px;
            }
        }
    </style>
    <script>
        function previewImage(event) {
            const image = document.getElementById('profile-pic');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</head>
<body>
    <?php
        include 'header.php';
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];

            $select = mysqli_query($connection, "SELECT * FROM `userdetails` WHERE userID = '$userID'") or die('query failed');

            if(mysqli_num_rows($select) > 0){
                $fetch = mysqli_fetch_assoc($select);
            }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
    
        <div class="acc-main-container">
            <div class="acc-nav">
                <ul>
                    <li><a href="manage_profile.php" class="active">Account Details</a></li>
                    <li><a href="bookmark.php">Bookmarks</a></li>
                    <li><a href="">Logout</a></li>
                </ul>
            </div>
            <div class="acc-details-container">

                <div class="image-container">
                    <?php
                        $profile_picture = empty($fetch['pfp']) ? 'img/df_pfp.png' : 'uploaded_img/' . $fetch['pfp'];
        
                        $_SESSION['profile_picture'] = $profile_picture;
                
                        echo '<img id="profile-pic" src="' . $profile_picture . '" alt="profile picture" class="circular-img">';
                    ?>
                    <div class="btn-container">
                        <label for="file-upload" class="btn">Edit</label>
                        <input type="file" class ="btn" id="file-upload" name="update_image" accept="image/jpg, image/jpeg, image/png" onchange="previewImage(event)">
                    </div>
                </div>

                <div class="username">
                    <h1>Username</h1>
                    <input type="text" name="username" id="username" 
                    value="<?php echo $fetch['username']; ?>">
                </div>

                <div class="name-container">
                    <div class="firstname">
                        <h1>First Name</h1>
                        <input type="text" name="fname" id="fname"
                        value="<?php echo $fetch['fname']; ?>">
                    </div>

                    <div class="lastname">
                        <h1>Last Name</h1>
                        <input type="text" name="lname" id="lname"
                        value="<?php echo $fetch['lname']; ?>">
                    </div>
                </div>

                <div class="email">
                    <h1>Email</h1>
                    <input type="email" name="email" id="email"
                    value="<?php echo $fetch['email']; ?>">
                </div>

                <div class="bio">
                    <h1>Bio</h1>
                    <textarea name="bio" id="bio" rows="10" cols="50" placeholder="Write your bio here..."><?php echo $fetch['bio']; ?></textarea>
                </div>

                <div class="gender">
                    <h1>Gender: </h1>
                    <select name="gender" id="gender">
                        <option value="male" <?php if($fetch['gender'] == 'male') echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if($fetch['gender'] == 'female') echo 'selected'; ?>>Female</option>
                        <option value="other" <?php if($fetch['gender'] == 'other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>

                <hr>

                <div class="password-container">
                    <h1>Change Password</h1>
                    <input type="hidden" name="old_pass" value="<?php echo $fetch['password'] ?>">
                    <input type="password" name="update_pass" id="update_password" placeholder="Current Password">
                    <input type="password" name="new_pass" id="new_password" placeholder="New Password">
                    <input type="password" name="confirm_new_pass" id="confirm_new_password" placeholder="Confirm New Password">
                </div>

                <input class ="submit-btn" type="submit" value="Submit" name="btnUpdate">
            </div>
        </div>
    </form>
    <?php 
            } else {
                echo "User not found.";
        }
    ?>
</body>
</html>
