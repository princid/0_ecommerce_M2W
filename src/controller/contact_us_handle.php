<?php
session_start();
// Required files to send mail using PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['number'];
    $message_form = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($mobile) && !empty($message_form)) {
        // CODE TO SEND MAIL AFTER ORDER PLACING
        require '../../mailer_file/PHPMailer-master/src/PHPMailer.php';
        require '../../mailer_file/PHPMailer-master/src/Exception.php';
        require '../../mailer_file/PHPMailer-master/src/SMTP.php';

        // Email content
        $to = 'rahul.mind2web@gmail.com';
        $subject = "Message from contact us form";
        $message = "Message Details:\n\n";
        $message .= "Name: $name\n\n";
        $message .= "Email: $email\n\n";
        $message .= "Mobile number: $mobile\n\n";
        $message .= "Message: $message_form\n\n";
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rahul.mind2web@gmail.com';
            $mail->Password = 'rrprzzsoczcghept';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom($email, $name);
            $mail->addAddress($to, 'Shopingo Team');

            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->send();
            $_SESSION['contact_form_success'] = "Thankyou... We have recived your message";
            header("Location: ../view/contact-us.php");
            exit;
        } catch (Exception $e) {
            echo "Email sending failed. Error: " . $mail->ErrorInfo;
        }
    } else {
        $_SESSION['server_validation_contactForm'] = "Please Fill All Fields";
        header("Location: ../view/contact-us.php");
        exit;
    }
}
?>