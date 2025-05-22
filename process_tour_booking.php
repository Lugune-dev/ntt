<?php
session_start();
require "db.php";

// === Load Composer's autoloader ===
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// === Get form data ===
$name        = $_POST['name'] ?? '';
$email       = $_POST['email'] ?? '';
$phone       = $_POST['phone'] ?? ''; // <-- Added phone
$destination = $_POST['destination'] ?? '';
$start_date  = $_POST['start_date'] ?? '';
$end_date    = $_POST['end_date'] ?? '';
$group_size  = $_POST['group_size'] ?? '';
$requests    = $_POST['requests'] ?? '';

// === Insert into database ===
try {
    $stmt = $pdo->prepare("INSERT INTO tour_bookings (name, email, phone, destination, start_date, end_date, group_size, requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $destination, $start_date, $end_date, $group_size, $requests]);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error saving booking: " . $e->getMessage();
    header("Location: tour_booking_form.php");
    exit();
}

// === Send confirmation email using PHPMailer ===
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'luguneshadrack@gmail.com';
    $mail->Password   = 'pxsh jmcp fkcp oesz';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Email content
    $mail->setFrom('luguneshadrack@gmail.com', 'Tour Booking');
    $mail->addAddress($email, $name);
    $mail->addAddress('luguneshadrack@gmail.com', 'Admin');
    $mail->Subject = 'Tour Booking Confirmation';
    $mail->Body    = "Dear $name,\n\nThank you for booking a tour with us.\n\n"
        . "Phone Number: $phone\n"
        . "Destination: $destination\n"
        . "Dates: $start_date to $end_date\n"
        . "Group Size: $group_size\n\n"
        . "We will contact you shortly with the next steps.\n\n"
        . "Best regards,\nYour Travel Team";

    $mail->send();
} catch (Exception $e) {
    $_SESSION['error'] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: tour_booking_form.php");
    exit();
}

// === Redirect to success page ===
$_SESSION['success'] = "Your tour booking was submitted successfully!";
header("Location: tour_booking_success.php");
exit();
?>
