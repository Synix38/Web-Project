<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconn.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); 
    exit();
}

$userID = $_SESSION['userID'];
$order_by = (isset($_GET['sort']) && $_GET['sort'] === 'oldest') ? 'ASC' : 'DESC';

$sql = "SELECT engagement.forumID, forums.forum_header
        FROM engagement
        JOIN forums ON engagement.forumID = forums.forumID
        WHERE engagement.UserID = $userID AND engagement.Bookmark = 1
        ORDER BY forums.forumID $order_by";

$result = mysqli_query($connection, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

$bookmarks = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bookmarks[] = $row; 
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <style>
        /* Main acc details box */
        .acc-main-container {
            display: flex;
            align-items: flex-start;
            position: relative;
            width: 900px;
            height: auto; /* Adjust height to auto for content */
            top: 60px;
            left: 170px;
            background: #f5f5f5; /* Light background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }
        /* Items in the list */
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
            background: #d0d0d0; /* Slightly darker for active */
            color: #fff;
        }
        .acc-nav ul li a:hover {
            background: #007bff; /* Blue background on hover */
            color: #fff;
            transition: 0.2s;
        }
        .bookmark-item {
            display: block; 
            width: 600px;
            margin-bottom: 10px; 
            padding: 15px; 
            background: white; 
            border-radius: 5px; 
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); 
            transition: box-shadow 0.2s, background-color 0.2s; 
            font-family: Arial, sans-serif; 
            color: #202124; 
            text-decoration: none;
        }

        .bookmark-item:hover {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2); 
            background-color: #f1f3f4; 
        }
    </style>

</head>
<body>
    <?php include "header.php"; ?>
    <div class="acc-main-container">
        <div class="acc-nav">
            <ul>
                <li><a href="manage_profile.php">Account Details</a></li>
                <li><a href="acc_bkmrk.php" class="active">Bookmarks</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="acc-container">
            <div class="bookmark-list">
                <?php if (count($bookmarks) > 0): ?>
                    <?php foreach ($bookmarks as $forum): ?>
                        <a href="forum-details.php?forumID=<?php echo htmlspecialchars($forum['forumID']); ?>" class="bookmark-item">
                            <?php echo htmlspecialchars($forum['forum_header']); ?>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No bookmarks.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>