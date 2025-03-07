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

$sql = "SELECT forums.forumID, forums.userID, forums.forum_header, forums.posted_date, userdetails.username 
        FROM forums 
        JOIN userdetails ON forums.userID = userdetails.userID
        ORDER BY forums.posted_date $order_by";
$result = mysqli_query($connection, $sql);

$forumData = mysqli_fetch_all($result, MYSQLI_ASSOC);
$totalForums = count($forumData);
$loadedForums = 0;
$loadLimit = 5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Page</title>
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff; 
            margin: 0;
            padding: 0;
        }
        
        h1 {
            text-align: center;
            color: #333;
        }
        .search-sort-container {
            max-width: 900px;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .search-bar {
            flex-grow: 1;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .sort-dropdown {
            margin-left: 20px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* change this later */
        .forum-container {
            max-width: 900px;
            margin: 0 auto;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .forum-post {
            padding: 20px;
            border-bottom: 1px solid #ccc;
            position: relative;
            min-height: 100px;
            cursor: pointer;
            display: block;
            text-decoration: none;
            color: inherit;
            transition: background-color 0.3s ease;
            width: calc(100% - 40px);
            margin: 0 auto;
        } 
        .forum-post:last-child {
            border-bottom: none;
        }
        .forum-post:hover {
            background-color: #f0f0f0;
        }
        .forum-header {
            font-size: 1.4em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .forum-metadata {
            font-size: 0.9em;
            color: #555;
            position: absolute;
            bottom: 20px;
        }
        .load-more {
            display: block;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            width: calc(100% - 40px);
            transition: background-color 0.3s ease;
        }
        .load-more:hover {
            background-color: #0056b3;
        }
        .add-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background-color: white; 
            color: black; 
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }
        .add-button:hover {
            background-color: #007bff;  
        }
    </style>
    <script>
    const userID = <?php echo json_encode($userID); ?>;

        let loadedForums = 0;
        let totalForums = <?php echo json_encode($totalForums); ?>; 
        const loadLimit = <?php echo json_encode($loadLimit); ?>;
        let forumData = <?php echo json_encode($forumData); ?>;

        function loadMoreForums() {
            const forumContainer = document.querySelector('.forum-container');
            if (loadedForums < totalForums) {
                const forumsToLoad = Math.min(loadLimit, totalForums - loadedForums);
                for (let i = 0; i < forumsToLoad; i++) {
                    const forum = forumData[loadedForums];
                    const forumPost = document.createElement('a');
                    forumPost.className = 'forum-post';
                    forumPost.href = 'forum-details.php?forumID=' + forum.forumID;

                    const forumHeader = document.createElement('div');
                    forumHeader.className = 'forum-header';
                    forumHeader.textContent = forum.forum_header;

                    const postedDate = new Date(forum.posted_date);
                    const formattedDate = ('0' + postedDate.getDate()).slice(-2) + '-' + 
                                        ('0' + (postedDate.getMonth() + 1)).slice(-2) + '-' + 
                                        postedDate.getFullYear();

                    const forumMetadata = document.createElement('div');
                    forumMetadata.className = 'forum-metadata';
                    forumMetadata.textContent = 'Posted by ' + forum.username + ' | Posted On: ' + formattedDate;

                    forumPost.appendChild(forumHeader);
                    forumPost.appendChild(forumMetadata);
                    forumContainer.appendChild(forumPost);
                    loadedForums++;
                }
            }
            if (loadedForums >= totalForums) {
                const loadMoreButton = document.querySelector('.load-more');
                loadMoreButton.textContent = 'No more content';
                loadMoreButton.style.backgroundColor = '#6c757d';
                loadMoreButton.style.cursor = 'not-allowed';
                loadMoreButton.removeAttribute('onclick'); 
            }
        }

        function searchForums() {
            const searchTerm = document.getElementById('forumSearch').value.toLowerCase();
            const forumContainer = document.querySelector('.forum-container');
            forumContainer.innerHTML = '';
            loadedForums = 0;
            
            const filteredForums = forumData.filter(forum => forum.forum_header.toLowerCase().includes(searchTerm));

            totalForums = filteredForums.length;
            filteredForums.forEach(forum => {
                const forumPost = document.createElement('a');
                forumPost.className = 'forum-post';
                forumPost.href = 'forum-details.php?forumID=' + forum.forumID;

                const forumHeader = document.createElement('div');
                forumHeader.className = 'forum-header';
                forumHeader.textContent = forum.forum_header;

                const forumMetadata = document.createElement('div');
                forumMetadata.className = 'forum-metadata';
                forumMetadata.textContent = 'Posted by User ' + forum.username + ' | Posted On: ' + forum.posted_date;

                forumPost.appendChild(forumHeader);
                forumPost.appendChild(forumMetadata);
                forumContainer.appendChild(forumPost);
                loadedForums++;
            });

            const loadMoreButton = document.querySelector('.load-more');
            loadMoreButton.style.display = filteredForums.length > loadLimit ? 'block' : 'none';
        }

        function sortForums() {
            const sortValue = document.getElementById('sortDropdown').value;
            window.location.href = window.location.pathname + '?sort=' + sortValue;
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadMoreForums(); 
        });
    </script>
</head>
<body>
    <?php include "header.php" ?>
    <div class="search-sort-container">
        <input type="text" id="forumSearch" class="search-bar" placeholder="Search forums..." oninput="searchForums()">
        <select id="sortDropdown" class="sort-dropdown" onchange="sortForums()">
            <option value="newest" <?php echo ($order_by == 'DESC') ? 'selected' : ''; ?>>Newest</option>
            <option value="oldest" <?php echo ($order_by == 'ASC') ? 'selected' : ''; ?>>Oldest</option>
        </select>
    </div>
    <div class="forum-container"></div>
    <a href="#" class="load-more" onclick="loadMoreForums()">Load More</a>

    <a href="forum-add.php?userID=<?php echo urlencode($userID); ?>" class="add-button">+</a>


<?php include 'footer.php'; ?>
</body>
</html>
