<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <link rel="stylesheet" href = "style.css">
    <style>
        .main-container{
            position: relative;
        }

        .img-container{
            justify-content: center;
            text-align: center;
        }

        #pfp{
            width: 150px;
            height: 150px;
        }
        
        .img-profilebackground{
            position: absolute;
            right: 0;
            top: 0;
            width: 60vw; 
            height: 100vh;
        }

        .img-profilebackground img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }

        .btn-facebook{
            display: inline-block; 
            padding: 5px 20px;
            font-size: 12px;
            text-align: center;
            text-decoration: none; 
            color: white;
            background-color: #3b5998; 
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            margin-left: 30px;
        }

        .btn-google{
            display: inline-block; 
            padding: 5px 20px;
            font-size: 12px;
            text-align: center;
            text-decoration: none; 
            color: white; 
            background-color: #3b5998; 
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            margin-left: 30px;
        }

        .btn-facebook:hover{
                background-color: #2d4373;  
            }

        .btn-google:hover {
                background-color: #2d4373;
            }
            
        .accountregister {
            display: flex;
            justify-content: center;  
            align-items: center;     
            font-size: 10px;
            margin-top: 10px;
            margin-left: -200px;
        }

        .accountregister label {
            font-size: 10px;
        }

        .accountregister button {
            text-decoration: underline;
            font-size: 10px;
            background: none;
            border: none;
            color: blue;
            cursor: pointer;
            margin-left: 5px;  
        }

        .accountregister button:hover {
            text-decoration: none;
            color: darkblue;
        }

   
@media (min-width: 1024px) and (max-width: 1366px) and (orientation: landscape) {
    .main-container{
        margin-left: -150px;
    }
    .email, .password {
        margin-left: -90px; /* Add more space between email/password fields */
        width: 100%;
    }
    .loginbutton{
        margin-left: -90px;
    }

    .loginwith{
        font-size: 14px;
        margin-left: -90px;
    }
    .accountregister label, {
        margin-left: -200px;

    }
    .btn-facebook{
        margin-left:-90px;
    }
   .accountregister{
        margin-left:-400px;
   } 
        
}
    




/* Responsive Design */
@media (max-width: 768px) {
    #pfp {
        width: 100%;
        max-width: 150px;
        height: auto;
    }

    .img-profilebackground {
        display: none; /* Hide background on smaller screens */
    }

    .btn-facebook, .btn-google {
        margin-left: 0;
        width: 90%; /* Full-width on smaller screens */
        font-size: 15px;
        margin-bottom: 10px;

    }

    /* Add more space at the top to lower the form */
    .main-container {
        padding-top: 30px; /* Adjust this value to control how far down the form moves */
        min-height: 30vh;   /* Ensures the container takes most of the screen */
    }

    /* Adjust alignment for account registration */
    .accountregister {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .accountregister label, .accountregister button {
        margin-left: -110px;
        font-size: 12px;
    }

    /* Additional spacing between elements to spread content */
    .email, .password {
        margin-bottom: -10px; /* Add more space between email/password fields */
    }

    button {
        font-size: 16px;
        margin-bottom: 20px; /* Add spacing below login button */
    }

    .loginwith {
        font-size: 14px;
        margin-bottom: 20px; /* Space below "Login with" label */
    }
}
    </style>
</head>
<body>
    <div class=header>
        <?php include "header.php"; ?>
    </div>
    <form action="database.php" method="POST">
        <div class="main-container">
            <div class="img-container">
            <img src="img/df_pfp.png" id="pfp"alt="profile picture"><br>
            </div>
        </div>

        <div class="email">
            <br><label for="email">Enter Your Email</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required><br>
        </div>
         
        <div class="password">
            <br><label for="password">Enter Your Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
        </div>

        <br>
        <br>
        <div class="loginbutton">
        <button type="submit" style="width:400px; height:35px;" >Login</button> 
        </div>
        <br>

        <div class="accountregister">
            <label style="font-size:14px;">Not a member?</label> 
            <button onclick="location.href='register.php'" type="register" style="text-decoration: underline; font-size:14px;">Register Now</button> 
        </div>

        <div class="img-profilebackground">
            <img src="img/carpic.png" id="background" alt="car background"><br>
        </div>
        
    </form>
</body>
</html> 