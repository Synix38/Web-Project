<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" type="image/png" href="img/RR_logo_favicon.png">
    <style>
        body {
            margin: 0;
            padding-top: 0;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .banner {
            position: relative;
            display: flex;
            width: 100vw; 
            height: auto; 
            object-fit: cover; 
            margin-top: 0;
            z-index: 1; 
        }

        .content {
            display: flex;
            justify-content: space-between;
            margin: 40px auto; 
            width: 80%; 
            position: relative;
            z-index: 2; 
        }

        .section {
            width: 45%; 
            padding: 20px;
            box-sizing: border-box;
            margin: 0; 
        }

        .section p {
            font-size: 1.2em; 
            line-height: 1.5; 
            text-align: justify; 
            margin: 0; 
        }

        .team {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .member {
            text-align: center;
            margin: 10px;
        }

        .member img {
            border-radius: 50%;
            width: 180px;
            height: 180px;
        }

        @media (max-width: 820px) {
            .content {
                flex-direction: column;
                width: 90%; 
                margin: 20px auto; 
            }

            .section {
                width: 100%; 
                margin-bottom: 20px;
            }

            .banner {
                height: 300px;
            }

            .team {
                flex-direction: column;
                align-items: center;
            }

            .member {
                width: 100%;
                max-width: 300px;
                margin: 20px auto;
            }

            .member img {
                width: 150px;
                height: 150px;
            }
        }

        @media (max-width: 430px) {
            .content {
                flex-direction: column;
                width: 100%;
                margin: 20px auto;
            }

            .banner {
                height: 180px;
            }

            .section {
                width: 100%; 
                padding: 20px; 
            }

            .team {
                flex-direction: column; 
                align-items: center; 
            }

            .member {
                margin: 10px 0;
                width: 100%; 
            }

            .member img {
                width: 150px; 
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <img src="img/about_us_banner.jpg" alt="About Us Banner" class="banner">

    <div class="content">
        <div class="section">
            <p>The RoadRages Website is an innovative forum platform designed for car enthusiasts and those who may not be as familiar with vehicles. Our site serves as a vibrant community where users can connect, share experiences, and seek advice in a supportive environment. Whether you're facing a specific issue with your car or simply looking for workshop recommendations, RoadRages offers valuable insights from fellow members who understand the challenges and joys of car ownership. We strive to cultivate a fun and welcoming atmosphere, making it easy for everyone to engage with the automotive world, share their stories, and find support along the way. Additionally, our platform encourages discussions on a wide range of topics, including car maintenance tips, modifications, and personal automotive journeys, ensuring that every visitor feels included and valued. As we look to the future, we envision RoadRages evolving into a fully grown social media platform, expanding its features to facilitate even deeper connections and interactions among users. This will enable us to foster a more dynamic community where enthusiasts can showcase their vehicles, share photos, and engage in real-time discussions. We are excited to embark on this journey together, enhancing the user experience and building a global network of automotive lovers.</p>
        </div>
        <div class="section">
            <p>As university students and passionate car enthusiasts, we recognized a unique opportunity to create a platform that fosters connections among individuals who share a love for vehicles. Our goal is to establish a welcoming space where both seasoned car enthusiasts and newcomers can come together to exchange knowledge and experiences. We believe that the insights from more experienced car owners can provide invaluable advice and tips to those who are just beginning their journey into the automotive world. Additionally, we envision a lively forum where users can share their experiences, amusing stories, and even challenges they've faced with their vehicles through engaging discussion threads. This sense of community not only enriches our platform but also encourages meaningful interactions among members. As we continue to grow, we aspire to expand the website's features, enhancing user experience and accessibility for car lovers around the globe. If you ever need assistance, have questions, or simply wish to connect with us, please don't hesitate to reach out through our “Contact Us” page. We're always here to help and look forward to being a part of your automotive journey!</p>
        </div>
    </div>

    <div class="team">
        <div class="member">
            <img src="img/marcus.jpg" alt="Marcus Chan Renzhi">
            <h4>Marcus Chan Renzhi</h4>
            <p>TP073877</p>
            <p>Group leader, in charge of the About Us, Contact Us, and Manage Profile pages.</p>
        </div>
        <div class="member">
            <img src="img/sean.jpg" alt="Sean Yap Shi Xuan">
            <h4>Sean Yap Shi Xuan</h4>
            <p>TP074058</p>
            <p>Group Member, in charge of the entire forum page as well as the bookmark functionalities.</p>
        </div>
        <div class="member">
            <img src="img/darren.jpg" alt="Kong Zheng Yang">
            <h4>Kong Zheng Yang</h4>
            <p>TP073370</p>
            <p>Group member, in charge of the login and register pages respectively.</p>
        </div>
        <div class="member">
            <img src="img/fia.jpg" alt="Putri Nurdania Binti Don @ Abdullah">
            <h4>Putri Nurdania Binti Don @ Abdullah</h4>
            <p>TP073238</p>
            <p>Group member, in charge of the wokrshop recommendations and FAQ pages respectively.</p>
        </div>
    </div>

<?php include 'footer.php'; ?>
</body>
</html>