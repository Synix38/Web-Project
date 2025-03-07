<!-- footer.php -->
<footer>
    <div class="footer-content">
        <p>&copy; <?php echo date("Y"); ?> RoadRages. All rights reserved.</p>
        <ul class="footer-links">
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
            <li><a href="FAQ.php">FAQ Page</a></li>
        </ul>
        <div class="social-media">
            <p>Follow us on LinkedIn:</p>
            <a href="https://www.linkedin.com/in/marcus-chan-ab1657292/" target="_blank">Marcus Chan</a> |
            <a href="https://www.linkedin.com/in/sean-yap-9b69022a2/" target="_blank">Sean Yap</a> |
            <a href="https://www.linkedin.com/in/marcus-chan-ab1657292/" target="_blank">Zheng Yang</a> |
            <a href="https://www.linkedin.com/in/putri-nurdania-binti-don-748a69235/" target="_blank">Putri Nurdania</a>
        </div>
    </div>
</footer>

<style>
    footer {
        background-color: #000;
        color: white; 
        padding: 20px 0; 
        text-align: center;
        position: relative;
        bottom: 0;
        right: 0;
        margin: 0;
        margin-right: 0;
        width: 100%;
        margin-top: 30px;
    }

    .footer-content {
        margin: 0 auto; /* Center content */
        max-width: 1200px; /* Optional: set a max width for larger screens */
    }

    .footer-links {
        list-style: none; /* Remove list bullets */
        padding: 0; /* Remove padding */
        margin: 10px 0 0; /* Adjust margin */
    }

    .footer-links li {
        display: inline; /* Display links inline */
        margin: 0 15px; /* Add spacing between links */
    }

    .footer-links a {
        color: white; /* Link color */
        text-decoration: none; /* Remove underline */
    }

    .footer-links a:hover {
        text-decoration: underline; /* Underline on hover */
    }

    .social-media {
        margin-top: 10px; /* Add space above social media links */
    }

    .social-media a {
        color: white; /* Social media link color */
        text-decoration: none; /* Remove underline */
        margin: 0 5px; /* Add spacing between social media links */
    }

    .social-media a:hover {
        text-decoration: underline;
    }
</style>