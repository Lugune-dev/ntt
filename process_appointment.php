<?php
session_start();
require "db.php";

// Load Composer's autoloader for PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get form data safely
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';
$type = $_POST['appointment_type'] ?? '';
$notes = $_POST['notes'] ?? '';

// Insert into database with try/catch
try {
    $stmt = $pdo->prepare("INSERT INTO appointments (name, email, phone, date, time, appointment_type, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $date, $time, $type, $notes]);
    
} catch (PDOException $e) {
    $_SESSION['error'] = "Error saving to database: " . $e->getMessage();
    header("Location: appointment_form.php");
    exit();
}

// Send confirmation email with PHPMailer
$mail = new PHPMailer(true);

try {
    // SMTP setup (example using Gmail SMTP)
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'luguneshadrack@gmail.com';      // Your Gmail
    $mail->Password   = 'pxsh jmcp fkcp oesz';         // Your App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Email sender and recipient
 // Email sender and recipient
$mail->setFrom('luguneshadrack@gmail.com', 'Travel & Tour Team');
$mail->addAddress($email, $name); // Send to user
$mail->addAddress('luguneshadrack@gmail.com', 'Admin'); // Send to yourself

// Email content
$mail->Subject = 'Appointment Confirmation';
$mail->Body    = "Dear $name,\n\nThank you for scheduling an appointment with us.\n\nDetails:\nDate: $date\nTime: $time\nType: $type\n\nWe’ll get in touch with you shortly.\n\nBest regards,\nTravel & Tour Team";

$mail->send();
} catch (Exception $e) {
    $_SESSION['error'] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: appointment_form.php");
    exit();
}

// Success feedback
$_SESSION['success'] = "Your appointment has been successfully scheduled!";
header("Location: appointment_success.php");
exit();
?>
