<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop Recommendations</title>
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <link rel="stylesheet" href="style.css">
    <style>
        * body {
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

        }

        main {
            padding: 20px;
        }

        .workshop-recommendations h1 {
            margin-bottom: 20px;
        }

        .workshop {
            display: flex;
            flex-wrap: wrap; 
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f5f5f5;
            align-items: center;
        }

        .workshop-image img {
            width: 100%; 
            max-width: 488px;
            height: auto;
        }

        .workshop-details {
            margin-left: 20px;
            flex: 1;
        }

        .workshop-details h2 {
            margin-bottom: 10px;
        }

        .workshop-details p {
            margin-bottom: 10px;
        }

        .read-more {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .read-more:hover {
            background-color: #0056b3;
        }

        footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #000;
            color: #fff;
        }

        .footer-logo img {
            width: 100px;
            height: 40px;
        }

        footer nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #f4f4f4;
        }

        footer nav a:hover {
            color: #007bff;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 820px) {
            .header {
                padding: 10px;
            }

            .logo img {
                width: 100px; /* Smaller logo on medium screens */
            }

            .nav-bar {
                flex: 2;
                justify-content: space-between; /* Space items evenly */
                width: 100%; /* Ensure nav bar takes full width */
            }

            .nav-bar a {
                padding: 0 8px; /* Reduce space between nav links */
                font-size: 14px; /* Smaller font for smaller screens */
            }

            .pfp img {
                width: 30px; /* Smaller profile image on medium screens */
                height: 30px;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 10px;
                flex-wrap: wrap;
            }

            .logo img {
                width: 100px; /* Further reduce logo width on small screens */
            }

            .nav-bar {
                flex: 2;
                justify-content: space-around; /* Distribute nav links evenly */
                width: 100%; /* Nav bar takes full width */
            }

            .nav-bar a {
                padding: 0 5px; /* Further reduce space between links */
                font-size: 12px; /* Smaller font size */
            }

            .pfp img {
                width: 30px; /* Smaller profile picture for small screens */
                height: 30px;
            }

            .workshop {
                flex-direction: column;
                align-items: center;
            }

            .workshop-image img {
                max-width: 100%; /* Full width for smaller screens */
            }

            footer {
                padding: 10px;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            footer nav a {
                margin: 5px 0;
            }
        }


    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="workshop-recommendations">
            <h1 style="text-align: center">WORKSHOP RECOMMENDATIONS LIST</h1>

            <div class="workshop">
                <div class="workshop-image">
                    <img src="img/88.jpg" alt="Workshop Image">
                </div>
                <d class="workshop-details">
                    <h2>88 Tint Shop</h2>
                    <p><b>Description:</b>
                        Car window tinting services of high quality for different tastes of customers.
                        Comply with JPJ tints or go extreme with full dark tints for your own privacy.
                        Using only top-grade films to protect your car from UV rays and heat, and give an amazing look to your car.
                    </p>
                    <p>Review: ★★★★☆</p>
                    <a href="workshop88.php">
                    <button class="read-more"><b>Read More</b></button>
                    </a>
                </div>
            </div>

            <div class="workshop">
                <div class="workshop-image">
                    <img src="img/PA.jpg" alt="Workshop Image">
                </div>
                <div class="workshop-details">
                    <h2>Project'A</h2>
                    <p><b>Description:</b> Specializes in European car modification and offers several performance upgrade packages.
                        From increased torque and horsepower to fine-tuning the exhaust, suspension, and aerodynamics.
                    </p>
                    <p>Review: ★★★★★</p>
                    <a href="workshopPA.php">
                    <button class="read-more"><b>Read More</b></button>
                    </a>
                </div>
            </div>
        </section>
    </main>
<?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>