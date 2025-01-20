<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.privateemail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@digitalfingers.shop'; // SMTP username
        $mail->Password   = 'Labello1.'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('info@digitalfingers.shop');

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Message from Digital Fingers';
        $mail->Body    = "You have received a new message from your website contact form.\n\nName: $name\nEmail: $email\nMessage:\n$message\n";

        $mail->send();
        echo "<script>alert('Message sent successfully! We will get back to you soon.'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message sending failed. Please try again later.'); window.location.href='index.html';</script>";
    }
}
?>
