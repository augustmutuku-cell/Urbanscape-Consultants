<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'mail.yourdomain.com';   // 🔴 CHANGE
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@yourdomain.com';   // 🔴 CHANGE
        $mail->Password   = 'EMAIL_PASSWORD';        // 🔴 CHANGE
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('info@yourdomain.com', 'Website Contact');
        $mail->addAddress('info@yourdomain.com');

        $mail->Subject = 'New Website Message';
        $mail->Body    = "Name: $name\nEmail: $email\n\n$message";

        $mail->send();
        echo "✅ Message sent successfully!";
    } catch (Exception $e) {
        echo "❌ Mail error: {$mail->ErrorInfo}";
    }
}
