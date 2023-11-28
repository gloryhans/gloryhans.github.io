<!-- This will allow an email to actually be sent to me -->
<!-- NOT WORKABLE YET -->


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data with validation
    $senderEmail = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    // Validate all fields
    if (!$senderEmail || empty($subject) || empty($message)) {
        http_response_code(400);
        echo "Please fill out all fields with valid information.";
        exit();
    }

    // Set your email address as the recipient
    $recipientEmail = "gloriagracehansen@gmail.com";

    // Set email headers
    $headers = "From: $senderEmail\r\n";
    $headers .= "Reply-To: $senderEmail\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Send the email
    if (mail($recipientEmail, $subject, $message, $headers)) {
        // Respond with a success message
        echo "Email sent successfully!";
    } else {
        // Handle email sending failure
        http_response_code(500);
        echo "Failed to send email. Please try again later.";
    }

    exit();
}
?>
