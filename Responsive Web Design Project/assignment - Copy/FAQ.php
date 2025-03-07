<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Section with Header and Footer</title>
    <link rel="stylesheet" href="styles.css">
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Helvetica', Arial, sans-serif;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    background-color: #fff;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    text-align: center;
}

h1 {
    font-size: 2.5em;
    margin-bottom: 30px;
    font-weight: 600;
    color: black;
}

.icon-row {
    display: flex;
    justify-content: center; 
    align-items: center;
    margin-bottom: 40px;
}

.icon-box {
    width: 230px;
    height: 230px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: transform 0.3s ease;
}

.icon-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.faq-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.faq-box {
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 25px 30px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 200px;
    border-radius: 10px;
    transition: box-shadow 0.3s ease;
}

.faq-box:hover {
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
}

.faq-box h2 {
    font-size: 1.7em;
    margin-bottom: 20px;
    color: #333;
    font-weight: 600;
}

.faq-box p {
    font-size: 1.1em;
    color: #555;
    line-height: 1.7;
    padding: 10px 0;
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

@media (max-width: 768px) {
    .icon-row {
        flex-direction: column; 
        justify-content: center;
    }

    .icon-box {
        margin-bottom: 20px;
    }

    .faq-grid {
        grid-template-columns: 1fr;
    }

    .faq-box {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .header {
        flex-wrap: wrap;
    }

    .nav-bar {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 10px;
    }

    .nav-bar a {
        padding: 8px 12px;
        font-size: 14px;
    }

    .pfp img {
        width: 35px;
        height: 35px;
    }

    .go_icon, .stop_icon, .faq_icon {
        display: none;
    }

    .icon-row{
        display: none;
    }

    .icon-box {
        width: 100px;
        height: 100px;
        margin: auto;
    }

    h1 {
        font-size: 2em;
    }

    .faq-box h2 {
        font-size: 1.5em;
    }

    .faq-box p {
        font-size: 1em;
    }

    footer {
        flex-direction: column;
        text-align: center;
    }

    footer nav {
        margin-top: 10px;
    }

    footer nav a {
        margin: 5px 10px;
        font-size: 14px;
    }
}


    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1 style = "color: black;">Frequently Asked Questions</h1>


        <div class="icon-row">
            <div class="icon-box">
                <img src="img/stop.png" alt="Icon" class="stop_icon">
            </div>
            <div class="icon-box">
                <img src="img/faq.png" alt="Icon" class="faq_icon">
            </div>
            <div class="icon-box">
                <img src="img/go.png" alt="Icon" class="go_icon">
            </div>
        </div>

        <div class="faq-grid">
            <div class="faq-box">
                <h2>What is RoadRagers?</h2>
                <p>RoadRagers is an online neighborhood for serious car enthusiasts. From the hard-core gearhead to the novice, who is just learning about the world of motorized transportation, RoadRagers is the place to share information, discuss the latest and hottest automotive trends, and delve into anything about cars that tickles a person's fancy. Technical advice, spirited discussion on modification, racing, and the latest innovation within the industry—this is home for all vehicle enthusiasts. Be it restoration of classics, fine-tuning high-performance machines, or simply curiosity about cars—RoadRagers has it all. Join in and be a part of the ever-growing automotive family!</p>
            </div>
            <div class="faq-box">
                <h2>Do We Receive Profit?</h2>
                <p>No profit is gained from this website by our team. RoadRagers is purely a passion project; it was made for fun, not for business. We want to give back to the local automotive community by promoting and giving exposure to local workshops so they may reap higher profits in return. We also wish to contribute our quota to enhancing the local car scene by providing a platform for fellow car enthusiasts to connect with workshops, share recommendations, and learn about trusted service providers. All we want is a way to give something back to the community that shares our love for cars, without any financial motive.</p>
            </div>
            <div class="faq-box">
                <h2>Any Payment For Posting?</h2>
                <p>Absolutely not! We don’t charge for features or listings. Our goal is to support the automotive community and help local businesses thrive. If you're interested in being featured on our website, feel free to email us at roadragers@gmail.com. We’d love to showcase your workshop, event, or automotive service, so don’t hesitate to reach out! No hidden fee will be charge, feel free to boost your service and workshop in the forum as well. Email us your details such as shop photo and location</p>
            </div>
            <div class="faq-box">
                <h2>Is the website Malaysia-Based?</h2>
                <p>Yes, currently it is based in Malaysia with a high concentration on the Klang Valley
                     area. But we are now delighted to announce that this website would be extended to cover all 14 states
                        within Malaysia soon. With the car enthusiast culture at its prime across 
                        the nation, we want to make sure every single state has equal opportunities
                         through our platform, be it searching for local car meetups, workshops or simply communicating with fellow car enthusiasts.</p>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>
</htm>