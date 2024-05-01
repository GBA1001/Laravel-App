<?php
namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{
    public function sendEmail($recipient, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            // SMTP settings for Zoho Mail
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host       = 'smtp.zoho.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'postitapp@zohomail.com';
            $mail->Password   = 'zoho@asad1212'; // Replace with your password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL
            $mail->Port       = 465;

            // Set email parameters
            $mail->setFrom('postitapp@zohomail.com', 'PostItApp');
            $mail->addAddress($recipient);

            // Set email content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            // Send email
            $mail->send();
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}