<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php" ?> 
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #555;
        }
        .page-header {
            background: linear-gradient(135deg, rgba(0, 204, 0, 0.8), rgba(255, 255, 255, 0.3)), url('images/privacy-header.jpg') no-repeat center center;
            background-size: cover;
            color: #fff;
            padding: 80px 0;
            text-align: center;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        .privacy-section {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: -80px;
            z-index: 2;
        }

        .privacy-section h1 {
            color: #2c3e50;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .privacy-section h4 {
            color: #2c3e50;
            font-size: 22px;
            margin-top: 30px;
            font-weight: 600;
        }

        .privacy-section p {
            color: #666;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .privacy-section ul {
            margin-left: 20px;
            margin-bottom: 20px;
        }

        .privacy-section li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
        }

        .privacy-section ul li::before {
            content: "✔";
            color: #27ae60;
            margin-right: 8px;
        }
        .contact-section {
            background-color: #f7f7f7;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }

        .contact-section h4 {
            color: #2c3e50;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .contact-section p {
            font-size: 16px;
            color: #777;
        }
        .breadcrumb-item a {
            color: #2c3e50;
        }

        .breadcrumb-item.active {
            color: #27ae60;
        }
    </style>
</head>
<body>

    <?php include "includes/navber.php" ?>
    <?php include "includes/modalSearch.php" ?>

    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Privacy Policy</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">Privacy Policy</li>
        </ol>
    </div>
    <div class="container py-5">
        <div class="privacy-section">
            <h1 class="text-center mb-4">Privacy Policy</h1>
            <h4>1. Introduction</h4>
            <p>Welcome to Our Company. We respect your privacy and are committed to protecting it through this Privacy Policy.</p>

            <h4>2. Information We Collect</h4>
            <p>We may collect various types of information, including but not limited to:</p>
            <ul>
                <li>Personal Information (name, email, phone number, address, etc.)</li>
                <li>Non-Personal Information (IP address, browser type, device information, etc.)</li>
                <li>Cookies and Tracking Technologies</li>
            </ul>

            <h4>3. How We Use Your Information</h4>
            <p>We use the collected information to:</p>
            <ul>
                <li>Provide, operate, and improve our services</li>
                <li>Communicate with you</li>
                <li>Personalize your experience</li>
                <li>Ensure security and prevent fraud</li>
                <li>Comply with legal obligations</li>
            </ul>

            <h4>4. How We Share Your Information</h4>
            <p>We do not sell your personal information. However, we may share it with:</p>
            <ul>
                <li>Service providers assisting in our operations</li>
                <li>Legal authorities if required by law</li>
                <li>Business partners with your consent</li>
            </ul>

            <h4>5. Data Security</h4>
            <p>We implement security measures to protect your personal information from unauthorized access, alteration, or disclosure. However, no method of transmission over the internet is 100% secure.</p>

            <h4>6. Your Rights and Choices</h4>
            <ul>
                <li>Accessing, correcting, or deleting your information</li>
                <li>Opting out of marketing communications</li>
                <li>Restricting data processing</li>
            </ul>

            <h4>7. Third-Party Links</h4>
            <p>Our website may contain links to third-party sites. We are not responsible for their privacy practices, so we encourage you to read their policies.</p>

            <h4>8. Changes to This Policy</h4>
            <p>We may update this Privacy Policy periodically. Changes will be posted on this page with an updated effective date.</p>

            <h4>9. Contact Us</h4>
            <p>If you have any questions about this Privacy Policy, please contact us at:</p>

            <div class="contact-section">
                <h4>Contact Information</h4>
                <p>Email: houthengsela@gmail.com</p>
                <p>Phone: +855 963622336</p>
                <p>Address: Khan Dangkao, Phnom Penh City, Country</p>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>

</body>
</html>