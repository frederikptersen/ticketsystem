<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Ticketsystem</title>
    <link rel="stylesheet" href="./Assets/CSS/faqstyle.css">
</head>
<body>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <img src="./Assets/IMG/ticketing-system.ico" class="bi me-2" height="32px">
                <span class="fs-4">Ticketsystem</span>
            </a>
            <a href="ticket_create.php"><button type="button" class="btn btn-success me-2">Create Ticket</button></a>
            <a href="faq.php"><button type="button" class="btn btn-success me-2">FAQ</button></a>
            <a href="login.php"><button type="button" class="btn btn-success">Admin Login</button></a>
        </div>
    </header>
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <div class="faq">
            <div class="faq-item">
                <h2 class="faq-question">1. How do I reset my password?</h2>
                <div class="faq-answer">To reset your password, go to the login page and click on "Forgot Password". Follow the instructions to reset your password.</div>
            </div>
            <div class="faq-item">
                <h2 class="faq-question">2. How do I create a new ticket?</h2>
                <div class="faq-answer">To create a new ticket, click on the "Create Ticket" button on the homepage and fill out the required information.</div>
            </div>
            <!-- Add more FAQ items here -->
        </div>
    </div>
    <script src="./Assets/Javascript/faq.js"></script>
</body>
</html>