<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconn.php';

$userID = $_SESSION['userID'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'add_forum') {
    $forum_header = isset($_POST['forum_header']) ? trim($_POST['forum_header']) : '';
    $forum_text = isset($_POST['forum_text']) ? trim($_POST['forum_text']) : '';
    
    if (!empty($forum_header) && !empty($forum_text)) {
        $sql = "SELECT MAX(forumID) AS max_id FROM forums";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $new_forumID = $row['max_id'] + 1;
         
        $sql = "INSERT INTO forums (forumID, userID, forum_header, forum_text, posted_date) VALUES (?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "iiss", $new_forumID, $userID, $forum_header, $forum_text);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: forum-details.php?forumID=" . $new_forumID . "&userID=" . $userID);
            exit();
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Forum</title>
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
        .textarea-container {
            margin: 20px 0;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
            font-size: 1em;
            font-family: inherit;
            resize: none;
        }
        textarea {
            height: 150px;
        }
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .submit-button, .cancel-button {
            font-size: 1em;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none; 
            text-decoration: none; 
            color: white; 
        }
        .submit-button {
            background-color: #007bff;
        }
        .submit-button:hover {
            background-color: #0056b3;
        }
        .cancel-button {
            margin-left: 10px;
            background-color: #dc3545;
        }
        .cancel-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<?php include "header.php" ?>
    <div class="forum-container">
        <h2 class="forum-header"><b>Want To Start A Forum?</b></h2>
        
        <form method="POST">
            <input type="hidden" name="action" value="add_forum">
            <div class="textarea-container">
                <label for="forum_header">Header:</label>
                <input type="text" id="forum_header" name="forum_header" required>
            </div>
            <div class="textarea-container">
                <label for="forum_text">Main Text:</label>
                <textarea id="forum_text" name="forum_text" required></textarea>
            </div>
            <div class="action-buttons">
                <button type="submit" class="submit-button">Create Forum</button>
                <a class="cancel-button" href="forum-main.php?userID=<?php echo $userID; ?>">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>