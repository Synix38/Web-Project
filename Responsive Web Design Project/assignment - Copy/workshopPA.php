<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop Recommendations</title>
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            color: black;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: white;
        }

        .back-button {
            display: inline-block;
            margin: 5px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1em;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: grey;
        }

        main {
            padding: 20px;
        }

        .workshop-recommendations h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 30px;
        }

        .carousel-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .workshop-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .workshop-description,
        .workshop-info,
        .workshop-review {
            width: 30%;
            padding: 10px;
            background-color: #f5f5f5;
            border: 2px solid #ddd;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .workshop-description h2,
        .workshop-info h2,
        .workshop-review h2 {
            margin-bottom: 10px;
        }

        .review-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .review-item img {
            width: 70px;
            height: 70px;
            margin-right: 10px;
        }

        /* Fix the Google Map */
        .google-map iframe {
            width: 100%;
            height: 250px;
            border: none;
        }

        footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #000;
        }

        footer nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #f4f4f4;
        }

        footer nav a:hover {
            color: #007bff;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .header .logo {
                font-size: 20px;
            }

            .nav-bar a {
                padding: 0 10px;
                font-size: 16px;
            }

            .pfp img {
                width: 35px;
                height: 35px;
            }

            .workshop-details {
                flex-direction: column;
            }

            .workshop-description,
            .workshop-info,
            .workshop-review {
                width: 100%;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: row;
                justify-content: space-between;
            }

            .nav-bar {
                flex-direction: row;
                justify-content: space-around;
                width: 100%;
            }

            .nav-bar a {
                font-size: 14px;
                padding: 10px;
            }

            .pfp img {
                width: 30px;
                height: 30px;
            }

            .workshop-description,
            .workshop-info,
            .workshop-review {
                padding: 15px;
                border-radius: 15px;
            }

            .workshop-description h2,
            .workshop-info h2,
            .workshop-review h2 {
                font-size: 20px;
            }

            .review-item img {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .header {
                flex-wrap: wrap;
                padding: 10px;
            }

            .logo img {
                width: 100px;
            }

            .nav-bar {
                flex-direction: row;
                justify-content: space-around;
                width: 100%;
            }

            .nav-bar a {
                padding: 5px;
                font-size: 12px;
            }

            .pfp img {
                width: 25px;
                height: 25px;
            }

            .workshop-recommendations h1 {
                font-size: 24px;
            }

            .workshop-description,
            .workshop-info,
            .workshop-review {
                width: 100%;
                margin-bottom: 10px;
            }

            .google-map iframe {
                height: 200px;
            }

            .review-item img {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div>
            <button class="back-button" onclick="window.history.back();"></b>Back</b></button>
        </div>
        <section class="workshop-recommendations">
            <h1>WORKSHOP RECOMMENDATIONS</h1>
            <div class="carousel-image">
                <img src="img/projectA.png" alt="Workshop Image" width="200">
            </div>

            <div class="workshop-details">
                <div class="workshop-description">
                    <h2>Workshop Details</h2>
                    <p><b>Workshop Domain:</b> Automobile Modification</p>
                    <p><b>Specializing:</b> Engine Control Unit (ECU) tuning services</p>
                    <p><b>Car Requirement:</b> European Cars (Porsche, BMW, Ferrari)</p>
                </div>

                <div class="workshop-info">
                    <h2>Project'A</h2>
                    <p><b>Operation Day:</b> Monday - Saturday </p>
                    <p><b>Operation Hour:</b> 10am-7pm</p>
                    <div class="google-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.737568702179!2d101.59562487319664!3d3.1636969530667445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc49f65fad40c3%3A0xc38e577d3f851371!2sProject&#39;A!5e0!3m2!1sen!2smy!4v1729427252449!5m2!1sen!2smy" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="348" height="100"></iframe>
                    </div>
                </div>

                <div class="workshop-review">
                    <h2>Workshop Review</h2>
                    <div class="review-item">
                        <img src="img/pfp2.png" alt="Reviewer Image">
                        <p>One of the best ECU modification! workers are friendly :D</p>
                    </div>
                    <div class="review-item">
                        <img src="img/pfp1.png" alt="Reviewer Image">
                        <p>Brought my Ferrari here. Service all okay, can come again.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="script.js"></script>
    <?php include 'footer.php'?>;
</body>
</html>