<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconn.php';

$forumID = isset($_GET['forumID']) ? intval($_GET['forumID']) : 0;
$userID = $_SESSION['userID'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    $sql = "SELECT likes, bookmark FROM engagement WHERE forumID = ? AND userID = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $forumID, $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $likes = 0;
    $bookmarks = 0;
    
    if (mysqli_num_rows($result) > 0) {
        $engagement = mysqli_fetch_assoc($result);
        $likes = $engagement['likes'];
        $bookmarks = $engagement['bookmark'];
    }
    
    if ($action === 'like') {
        $likes = 1; 
    } elseif ($action === 'unlike') {
        $likes = 0; 
    } elseif ($action === 'bookmark') {
        $bookmarks = 1; 
    } elseif ($action === 'unbookmark') {
        $bookmarks = 0; 
    }

    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE engagement SET likes = ?, bookmark = ? WHERE forumID = ? AND userID = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "iiii", $likes, $bookmarks, $forumID, $userID);
    } else {
        $sql = "INSERT INTO engagement (forumID, userID, likes, bookmark) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "iiii", $forumID, $userID, $likes, $bookmarks);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
        exit();
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_stmt_error($stmt)]);
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['forum_comment'])) {
    $forum_comment = isset($_POST['forum_comment']) ? trim($_POST['forum_comment']) : '';
    
    if (!empty($forum_comment)) {
        $sql = "INSERT INTO comments (forumID, userID, forum_comment, posted_date) VALUES (?, ?, ?, NOW())";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $forumID, $userID, $forum_comment);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?forumID=" . $forumID . "&userID=" . $userID);
            exit();
        }
    }
}

$sql = "
    SELECT f.forumID, f.userID, f.forum_header, f.forum_text, f.posted_date, u.username 
    FROM forums f
    JOIN userdetails u ON f.userID = u.userID
    WHERE f.forumID = ?";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "i", $forumID);
mysqli_stmt_execute($stmt);
$forumResult = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($forumResult) > 0) {
    $forum = mysqli_fetch_assoc($forumResult);
} else {
    die("Forum not found.");
}

$sql = "
    SELECT c.commentID, c.userID, c.forum_comment, c.posted_date, u.username
    FROM comments c
    JOIN userdetails u ON c.userID = u.userID
    WHERE c.forumID = ?
    ORDER BY c.posted_date DESC";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "i", $forumID);
mysqli_stmt_execute($stmt);
$commentsResult = mysqli_stmt_get_result($stmt);

$sql = "SELECT likes, bookmark FROM engagement WHERE forumID = ? AND userID = ?";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "ii", $forumID, $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$likes = false;
$bookmarks = false;

if (mysqli_num_rows($result) > 0) {
    $engagement = mysqli_fetch_assoc($result);
    $likes = ($engagement['likes'] == 1); 
    $bookmarks = ($engagement['bookmark'] == 1); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($forum['forum_header']); ?></title>
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333; /*Temp Background Colour*/
            margin: 0;
        }
        .forum-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .forum-header {
            font-size: 1.8em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .forum-metadata {
            font-size: 0.9em;
            color: #555;
        }
        .forum-text {
            margin: 20px 0;
        }
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            margin-left: 10px;
            font-size: 1.5em;
            color: black; 
            transition: color 0.3s; 
        }
        .button:hover {
            color: #007bff; 
        }
        .filled-bookmark {
            color: blue; /*Remember to change the fill color for bookmark */
        }
        .filled-heart {
            color: red; /*Remember to change the fill color for heart */
        }
        .back-button {
            display: inline-block;           
            margin: 5px 0;                 
            padding: 10px 15px;           
            background-color: #007bff;     
            color: white;                 
            text-decoration: none;        
            border-radius: 5px;           
            font-size: 1em;             
            transition: background-color 0.3s; 
        }

        .back-button:hover {
            background-color: #0056b3;      
        }
        .comments-section {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            padding-bottom: 20px; 
        }
        .comment {
            border-bottom: 1px solid #ccc; 
            padding: 10px 0; 
            margin: 0; 
        }
        .comment:not(:last-child) {
            margin-bottom: 15px;
        }
        .comment-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .comment-text {
            margin-bottom: 5px;
        }
        .no-comments {
            text-align: center;
            font-style: italic;
            color: #888;
        }
        #commentForm {
            position: relative;
            margin-top: 20px;
        }
        .comment-box-container {
            position: relative;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden; 
        }
        #commentForm textarea {
            width: 100%;
            height: 100px; 
            padding: 10px;
            border: none;
            box-sizing: border-box;
            resize: none;
            outline: none;
        }
        #commentForm button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        #commentForm button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include "header.php" ?>
<a href="forum-main.php?userID=<?php echo $userID; ?>" class="back-button">Back</a>
    <div class="forum-container">
        
        <div class="forum-header"><?php echo htmlspecialchars($forum['forum_header']); ?></div>
        <div class="forum-metadata">Posted by <?php echo htmlspecialchars($forum['username']); ?> on <?php echo date('d-m-Y', strtotime($forum['posted_date'])); ?></div>
        <div class="forum-text"><?php echo nl2br(htmlspecialchars($forum['forum_text'])); ?></div>

        
        <div class="action-buttons">
            <button id="bookmarkButton" class="button" onclick="toggleBookmark()">
                <i id="bookmarkIcon" class="far fa-bookmark"></i>
            </button>
            <button id="heartButton" class="button" onclick="toggleHeart()">
                <i id="heartIcon" class="far fa-heart"></i>
            </button>
        </div>

        <br><br>

        <h3>Comments</h3>
        <div id="commentForm">
            <div class="comment-box-container">
                <form method="POST">
                    <input type="hidden" name="forumID" value="<?php echo $forumID; ?>">
                    <textarea name="forum_comment" required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>

        <div class="comments-section">
            <?php if ($commentsResult->num_rows > 0): ?>
                <?php while ($comment = $commentsResult->fetch_assoc()): ?>
                    <div class="comment">
                        <div class="comment-header">User <?php echo htmlspecialchars($comment['username']); ?> | <?php echo date('d-m-Y', strtotime($comment['posted_date'])); ?></div>
                        <div class="comment-text"><?php echo nl2br(htmlspecialchars($comment['forum_comment'])); ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-comments">No comments yet.</p>
            <?php endif; ?>
        </div>
    </div>

    
    <script>
        const forumID = <?php echo $forumID; ?>;
        const userID = <?php echo $userID; ?>;

        document.addEventListener("DOMContentLoaded", function() {
            const heartIcon = document.getElementById('heartIcon');
            const bookmarkIcon = document.getElementById('bookmarkIcon');

            heartIcon.classList.toggle('fas', <?php echo json_encode($likes); ?>);
            heartIcon.classList.toggle('far', !<?php echo json_encode($likes); ?>);
            heartIcon.classList.toggle('filled-heart', <?php echo json_encode($likes); ?>);

            bookmarkIcon.classList.toggle('fas', <?php echo json_encode($bookmarks); ?>);
            bookmarkIcon.classList.toggle('far', !<?php echo json_encode($bookmarks); ?>);
            bookmarkIcon.classList.toggle('filled-bookmark', <?php echo json_encode($bookmarks); ?>); 
        });

        function updateEngagement(action, isActive, iconElement, activeClass, inactiveClass, filledClass) {
            const originalState = iconElement.classList.contains(activeClass);
            iconElement.classList.toggle(activeClass, isActive);
            iconElement.classList.toggle(inactiveClass, !isActive);
            iconElement.classList.toggle(filledClass, isActive);

            fetch('', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=' + action + '&forumID=' + forumID + '&userID=' + userID
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Error updating engagement:', data.error);
                    iconElement.classList.toggle(activeClass, originalState);
                    iconElement.classList.toggle(inactiveClass, !originalState);
                    iconElement.classList.toggle(filledClass, originalState); 
                }
            })
            .catch(error => {
                console.error('Error:', error);
                iconElement.classList.toggle(activeClass, originalState);
                iconElement.classList.toggle(inactiveClass, !originalState);
                iconElement.classList.toggle(filledClass, originalState);
            });
        }

        function toggleHeart() {
            const heartIcon = document.getElementById('heartIcon');
            const isLiked = heartIcon.classList.contains('fas');
            updateEngagement(isLiked ? 'unlike' : 'like', !isLiked, heartIcon, 'fas', 'far', 'filled-heart'); 
        }

        function toggleBookmark() {
            const bookmarkIcon = document.getElementById('bookmarkIcon');
            const isBookmarked = bookmarkIcon.classList.contains('fas');
            updateEngagement(isBookmarked ? 'unbookmark' : 'bookmark', !isBookmarked, bookmarkIcon, 'fas', 'far', 'filled-bookmark'); 
        }
    </script>
</body>
</html>