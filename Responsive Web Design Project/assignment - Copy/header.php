<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        body {
            margin: 0;  
            font-family: Arial, sans-serif;
        }
        .header {
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #000;
            padding: 10px 22px; 
            box-sizing: border-box; 
            z-index: 10;
        }
        .header .logo {
            color: white;
            font-size: 24px;
            text-decoration: none;
        }
        .header .logo img {
            max-width: 100%;
            height: auto;
            width: 100px;
        }
        .nav-bar {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }
        .nav-bar a {
            color: white;
            text-decoration: none;
            padding: 0 20px;
            font-size: 16px;
            white-space: nowrap;
        }
        .nav-bar a:hover {
            text-decoration: underline;
        }
        .pfp {
            position: relative;
            display: inline-block;
            margin-left: 20px;
            z-index: 10;
        }
        .pfp img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .pfp-img {
            width: 35px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            width: 150px;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 11;
        }
        .dropdown a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            z-index: 4;
        }
        .dropdown a:hover {
            background-color: #ddd;
        }
        .pfp:hover .dropdown {
            display: block;
        }

        @media (max-width: 431px) {
            .header {
                padding: 10px 10px;
                min-height: 60px;
            }
            
            .nav-bar a {
                padding: 0 10px;
                font-size: 10px;
            }

            .header .logo {
                font-size: 16px;
            }

            .header .logo img {
                width: 80px;
            }

            .pfp img {
                width: 35px;
                height: 35px;
            }

            .dropdown {
                width: 100px; 
            }

            .dropdown a {
                padding: 10px 20px; 
                font-size: 10px; 
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="forum-main.php" class="logo">
            <img src="img/RR_logo.png" alt="RR Logo"> </a>
        <div class="nav-bar">
            <a href="forum-main.php">Home</a>
            <a href="workshop.php">Workshop</a>
            <a href="about_us.php">About Us</a>
            <a href="contact_us.php">Contact Us</a>
            <div class="pfp">
                <div class="pfp-img">
                <?php 
                    include 'dbconn.php';

                    if (!isset($_SESSION['userID'])) {
                        echo '<img src="img/df_pfp.png" alt="Profile Picture">';
                    } else {
                        $userID = $_SESSION['userID'];
                        $select_query = "SELECT pfp FROM userdetails WHERE userID = '$userID'";
                        $result = mysqli_query($connection, $select_query);
                        
                        if ($result && mysqli_num_rows($result) > 0) {
                            $fetch = mysqli_fetch_assoc($result);
                            $pfp_path = 'uploaded_img/' . $fetch['pfp'];

                            if ($fetch['pfp'] && file_exists($pfp_path)) {
                                echo '<img src="' . $pfp_path . '" alt="Profile Picture">';
                            } else {
                                echo '<img src="img/df_pfp.png" alt="Default Profile Picture">';
                            }
                        } else {
                            echo '<img src="img/df_pfp.png" alt="Default Profile Picture">';
                        }
                    }
                    ?>
                </div>
                <!-- <img src="img/df_pfp.png" alt="Profile Picture"> -->
                <div class="dropdown">
                    <a href="manage_profile.php">Settings</a>
                    <a href="bookmark.php">Bookmarks</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
