<?php
session_start();
require "db.php"; // Ensure this connects to your database

// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// === Get form data ===
$name       = $_POST['name'] ?? '';
$email      = $_POST['email'] ?? '';
$phone      = $_POST['phone'] ?? '';
$checkin    = $_POST['checkin'] ?? '';
$checkout   = $_POST['checkout'] ?? '';
$hotel      = $_POST['hotel'] ?? '';
$room_type  = $_POST['room_type'] ?? '';
$requests   = $_POST['requests'] ?? '';

// === Insert into database ===
try {
    $stmt = $pdo->prepare("INSERT INTO hotel_bookings (name, email, phone, checkin, checkout, hotel, room_type, requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $checkin, $checkout, $hotel, $room_type, $requests]);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error saving booking: " . $e->getMessage();
    header("Location: index.php#hotelModal"); // Adjust to your actual return page
    exit();
}

// === Send confirmation email ===
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'luguneshadrack@gmail.com';
    $mail->Password   = 'pxsh jmcp fkcp oesz'; // App-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Email content
    $mail->setFrom('luguneshadrack@gmail.com', 'Hotel Booking');
    $mail->addAddress($email, $name);
    $mail->addAddress('luguneshadrack@gmail.com', 'Admin'); // Copy to admin

    $mail->Subject = 'Hotel Booking Confirmation';
    $mail->Body    = "Dear $name,\n\n"
        . "Thank you for your hotel booking request. Here are your details:\n\n"
        . "Phone: $phone\n"
        . "Check-In: $checkin\n"
        . "Check-Out: $checkout\n"
        . "Hotel: $hotel\n"
        . "Room Type: $room_type\n"
        . "Additional Requests: $requests\n\n"
        . "We will contact you shortly to confirm availability.\n\n"
        . "Best regards,\nYour Hotel Booking Team";

    $mail->send();
} catch (Exception $e) {
    $_SESSION['error'] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: index.php#hotelModal"); // Adjust to actual page
    exit();
}

// === Redirect to success page ===
$_SESSION['success'] = "Your hotel booking was submitted successfully!";
header("Location: hotel_booking_success.php");
exit();
?>
