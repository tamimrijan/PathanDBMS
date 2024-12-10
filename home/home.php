<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="upre.png" />
    <title>পাঠান এ আপনাকে স্বাগতম</title>
    <style>
        /* CSS Variables for easier theming */
        :root {
            --primary-color: #b23a48;
            --secondary-color: #333333; /* Black color for secondary use */
            --bg-color: rgba(0, 0, 0, 0.8);
            --footer-bg: rgba(0, 0, 0, 0.9); /* Solid dark for footer background */
            --hover-color: white;
            --font-family: 'Li Ador Noirrit SemiBold', 'Times New Roman', Times, serif;
            --highlight-shadow: 0 0 10px rgba(178, 58, 72, 0.8);
        }

        /* General Styles */
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            font-family: var(--font-family);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--secondary-color);
        }

        .content {
            flex: 1;
            text-align: center;
            padding: 80px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scrollText {
            0% { transform: translateY(100%); }
            100% { transform: translateY(0); }
        }

        .content h2, .content .subheading, .project-details h3 {
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            animation: scrollText 4s cubic-bezier(0.25, 1, 0.5, 1) forwards, fadeIn 1s;
            animation-delay: 1s; /* Delay to sync animations */
        }

        .highlight {
            color: var(--primary-color);
            text-shadow: var(--highlight-shadow);
        }

        .content h2 {
            color: var(--secondary-color); /* Black main text */
        }

        .subheading {
            display: block;
            font-size: 1.25rem;
            color: var(--primary-color); /* Red subheading */
            margin: 20px 0;
            animation-delay: 1.5s;
        }

        .project-details {
            margin-top: 30px;
        }

        .project-details h3, .project-details h4 {
            position: relative;
            margin-bottom: 10px;
            color: var(--secondary-color); /* Black text */
        }

        .project-details h4 {
            font-size: 1.25rem;
            font-weight: normal;
            animation-delay: 2.5s;
        }

        header {
            width: 100%;
            text-align: center;
            padding: 15px 0;
            box-shadow: none; /* Remove any shadow */
        }

        .footer {
            background-color: var(--footer-bg);
            color: #ffffff; /* White text */
            text-align: center;
            padding: 15px 0;
            width: 100%;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.2);
        }

        .footer p, .footer a {
            margin: 0;
            font-size: 14px;
        }

        .footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--hover-color);
        }

        @media screen and (max-width: 768px) {
            .content {
                padding: 60px 10px;
            }

            .content h2 {
                font-size: 2rem;
            }

            .content .subheading {
                font-size: 1rem;
            }
            
            .project-details h3 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <?php include('header.php'); ?>
    </header>

    <div class="content">
        <h2>Welcome to <span class="highlight">পাঠান Courier Management Service</span></h2>
        <p class="subheading">The Fastest Courier Service of North South University</p>

        <div class="project-details">
            <h3>DBMS PROJECT BY <span class="highlight">TAMIM & FARZANA</span></h3>
            <h4>Group 03</h4>
        </div>
    </div>

    <div class="footer">
        <p>&copy; ২০২৪ পাঠান - NSU এর ১ নাম্বার ডিজিটাল প্লাটফর্ম.</p>
        <p>✨ Made By Tamim And Farzana</p>
        <a href="../mailme.html">Contact Us</a>
    </div>
</body>
</html>