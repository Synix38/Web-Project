<?php
    include("addtodatabase.php");
    $default_pfp = 'df_pfp.png';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href = "style.css">
    <style>
        .registerpage{
            margin-top: 30px;
            margin-left: -30px;
        }

        .main-title{
            display: flex;
            justify-content: space-between;
            width: 600px; 
            font-size: 30px;
            margin-top:-100px;
            margin-left:125px;
        }

       
        .form-row {
            display: flex;
            justify-content: space-between;
            width: 600px; 
            margin: 0 auto; 
        }

        .form-row .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-row input {
            width: 200px; 
        }

        .img-carbackground2{
            position: absolute;
            right: 0;
            top: 0;
            width: 50vw; 
            height: 100vh;
        }

        .img-carbackground2 img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }
        
        .btn-joinnow {
            text-align: center;
            margin: 20px auto;
        }

        
        .accountlogin {
            display: flex;
            justify-content: center;  
            align-items: center;      
            font-size: 10px;
            margin-top: 10px;
            margin-left: -240px;
        }

        .accountlogin label {
            font-size: 10px;
        }

        .accountlogin button {
            text-decoration: underline;
            font-size: 10px;
            background: none;
            border: none;
            color: blue;
            cursor: pointer;
            margin-left: 5px;  
        }

        
        .accountlogin button:hover {
            text-decoration: none;
            color: darkblue;
        }

@media (min-width: 1024px) and (max-width: 1366px) and (orientation: landscape){

    .main-title {
       margin-left:50px;
    }

    .form-row {
        margin-left:-80px;
      
    }

    .btn-joinnow {
        margin-left:-80px;
       
    }

    .accountlogin {
        margin-left:-350px;
  
    }

    .gender-radio{
        margin-left: -50px;
    }
}
@media (max-width: 500px) {
    .registerpage {
        margin: 0;
        padding: 20px;
    }

    .main-title {
        font-size: 24px;
        margin-top: -60px;
        margin-left: 0;
        text-align: center;
        width: 100%; /* Make it responsive */
    }

    .form-row {
        flex-direction: column; /* Stack the form elements */
        width: 100%;
        margin: 0;
    }

    .form-row .form-group {
        width: 100%;
        margin-bottom: 10px;
    }

    .form-row input {
        width: 100%; /* Full width on small screens */
        margin-bottom: 10px;
    }

    .gender-radio {
        text-align: center;
        margin-left: 0;
    }

    .btn-joinnow {
        width: 70%;
        margin-left: -100px;
    }

    .accountlogin {
        justify-content: center;
        margin-left: 0;
        font-size: 12px;
    }

    .accountlogin button {
        font-size: 12px;
    }

    .img-carbackground2 {
        display: none; 
    }

    .header {
        width: 200%;
    }
}


    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <form action="addtodatabase.php" method="post" class="registerpage">
        <div class="img-carbackground2">
            <img src="img/carbackground2.png" id="registercarbackground" alt="carbackground2">
        </div>

        <div class="main-title">
            <h1>Road Rages</h1>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="username" style="text-align: center">Username</label>
                <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
            </div>
            
            <div class="form-group">
                <label for="email" style="text-align: center">Email Address</label>
                <input type="text" id="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>
        </div>
        <br>
        <div class="form-row">   
            <div class="form-group">
                <label for="password" style="text-align: center">Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
        </div>


            <div class="form-group">
                <label for="phonenumber" style="text-align: center">Phone Number</label>
                <input type="text" id="phonenumber" class="form-control" name="phonenumber" placeholder="Phone Number" required>
            </div>
        </div>
        <br>
           
        <div class="form-group">
            <label for="gender" style="text-align: center">Gender</label>
                <div class="gender-radio" style="display: flex; justify-content: space-between; width: 200px;">
                    <label for="male" class="radio-inline"><input type="radio" name="gender" value="male" id="male" required>Male</label>
                    <label for="female" class="radio-inline"><input type="radio" name="gender" value="female" id="female" required>Female</label>
                    <label for="others" class="radio-inline"><input type="radio" name="gender" value="others" id="others" required>Others</label>
                </div>
        </div>
       
        <br>
        <div class="btn-joinnow">
            <button type="join now" style="width: 600px; height:40px;">Join Now</button>
        </div>

        <div class="accountlogin">
            <label style="font-size:14px;">Have an account?</label> 
            <button onclick="location.href='login.php'" type="login" style="text-decoration: underline; font-size:14px;">Login</button> 
        </div>

    </form>
</body>
</html>