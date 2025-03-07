<?php 
    session_start();
    include 'dbconn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userID = $_SESSION['userID'];
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $phone_num = mysqli_real_escape_string($connection, $_POST['phone']);
        $message = mysqli_real_escape_string($connection, $_POST['message']);

        $query = "INSERT INTO contactus (userID, email, phone_num, message) VALUES ('$userID', '$email', '$phone_num', '$message')";

        if (mysqli_query($connection, $query)) {
            echo '<script>alert("Message sent successfully!")</script>';
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }

    mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <style>
        body {
            padding: 0;
            margin: 0;  
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        
        .acc-main-container {
            display:flex;
            align-items:flex-start;
            position:relative;
            width:80%;
            height:520px;
            top:40px;
            left:10%;
            background: rgb(235, 233, 233);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding:20px;
            border-radius: 8px;
            flex-wrap: wrap;
            margin-bottom: 80px;
        }
        

        .img-container {
            margin-right: 20px;
            flex: 1;
        }

        .img-container img {
            width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2)
        }

        .details-container {
            display: block;
            width: calc(100% - 370px);
            padding: 10px;
        }

        .contact-us {
            display: block;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .contact-us h1 {
            font-size: 33px;
            color: #000;
        }

        .name-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            width: 100%;
        }

        .fullname {
            width: 100%;
        }

        .fullname input {
            width: 90%;
            height: 30px;
            padding: 8px;
            box-sizing: border-box;
            color: #000;
        }

        .fullname h2, .phone h2, .message h2{
            font-size: 17px;
            color: #000;
        }

        .phone {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .phone input {
            width: 90%;
            height: 30px;
            padding: 8px;
            box-sizing: border-box;
            color: #000;
        }
        
        .message {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        textarea {
            width:90%;
            height: 150px;
            resize: none;
            padding: 8px;
            box-sizing: border-box;
        }

        @media (max-width: 431px) {
            .acc-main-container {
                width: 100%; 
                height: auto;
                flex-direction: column;
                padding: 10px;
                align-items: center; 
                margin: 0;
                top: 0;
                left: 0; 
            }

            .img-container {
                width: 100%; 
                margin-right: 0; 
                margin-bottom: 20px;
                flex: 1;
            }
            
            .img-container img {
                width: 95%;
                height: 200px;
            }

            .details-container {
                width: 100%; 
                padding: 0;
            }

            .contact-us h1 {
                font-size: 28px; 
            }

            .fullname h2, .phone h2, .message h2 {
                font-size: 15px; 
            }

            .fullname input, .phone input {
                width: 95%; 
                height: 40px; 
            }

            textarea {
                width: 95%;
                height: 200px;
            }

            .submit-container {
                display: flex; 
                justify-content: center; 
                margin-top: 10px; 
                width: 100%; 
            }

            .submit-button {
                background-color: #007BFF;
                color: white; 
                border: none; 
                padding: 10px 20px; 
                border-radius: 5px;
                cursor: pointer; 
                font-size: 16px; 
                width: 100%; 
                max-width: 300px; 
            }

            .submit-button:hover {
                background-color: #0056b3; 
            }
        }

        @media (max-width: 820px) {
            .acc-main-container {
                width: 95%; 
                height: auto;
                left: 0;
                top: 0; 
                flex-direction: column; 
                padding: 15px;
                align-items: center; 
                margin: 20px auto; 
            }

            .img-container {
                width: 100%; 
                margin-right: 0;
                margin-bottom: 20px;
            }

            .img-container img {
                width: 100%;
                height: 800px;
            }

            .details-container {
                width: 100%;
                padding: 0;
            }

            .contact-us h1 {
                font-size: 32px;
            }

            .fullname h2, .phone h2, .message h2 {
                font-size: 16px; 
            }

            .fullname input, .phone input {
                width: 95%;
                height: 40px;
            }

            textarea {
                width: 95%; 
                height: 200px; 
            }

            .submit-container {
                display: flex; 
                justify-content: center; 
                margin-top: 10px; 
                width: 100%; 
            }

            .submit-button {
                background-color: #007BFF;
                color: white;
                border: none;
                padding: 10px 20px; 
                border-radius: 5px; 
                cursor: pointer;
                font-size: 16px; 
                width: 100%; 
                max-width: 300px;
            }

            .submit-button:hover {
                background-color: #0056b3;
            }
        }
    </style>
</head>
<body>

    <?php 
    include "header.php"; 
    ?>
    
    <form action="" method="post">

        <div class="acc-main-container">

            <div class="img-container">
                <img src="img/contact_us.jpg" alt="contactus">
            </div>

            <div class="details-container">
                <div class="contact-us">
                    <h1>Contact Us</h1>
                </div>

                <div class="name-container">
                    <div class="fullname">
                        <h2>Email:</h2>
                        <input type="email" name="email" id="email">
                    </div>
                </div>

                <div class="phone">
                    <h2>Phone Number:</h2>
                    <input type="text" name="phone" id="phone">
                </div>

                <div class="message">
                    <h2>Message:</h2>
                    <textarea name="message" id="message" rows="1" column="1"></textarea>
                </div>

                <div class="submit-container">
                    <button type="submit" class="submit-button">Send</button>
                </div>
                
            </div>
        </div>
    </form>

    <?php include "footer.php"; ?>
</body>
</html>