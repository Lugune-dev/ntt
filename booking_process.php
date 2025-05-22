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
$phone       = $_POST['phone'] ?? ''; // <-- New line added
$departure   = $_POST['departure'] ?? '';
$destination = $_POST['destination'] ?? '';
$travel_date = $_POST['date'] ?? '';
$passengers  = $_POST['passengers'] ?? '';

// === Insert into database ===
try {
    $stmt = $pdo->prepare("INSERT INTO flight_bookings (name, email, phone, departure, destination, travel_date, passengers) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $departure, $destination, $travel_date, $passengers]);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error saving booking: " . $e->getMessage();
    header("Location: booking_form.php");
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
    $mail->setFrom('luguneshadrack@gmail.com', 'Flight Booking Team');
    $mail->addAddress($email, $name);
    $mail->addAddress('luguneshadrack@gmail.com', 'Admin');
    $mail->Subject = 'Flight Booking Confirmation';
    $mail->Body    = "Dear $name,\n\nThank you for booking your flight with us.\n\n"
        . "Phone Number: $phone\n"
        . "Departure Airport: $departure\n"
        . "Destination Airport: $destination\n"
        . "Date of Travel: $travel_date\n"
        . "Number of Passengers: $passengers\n\n"
        . "We will contact you soon with more details.\n\n"
        . "Best regards,\nFlight Booking Team";

    $mail->send();
} catch (Exception $e) {
    $_SESSION['error'] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: booking_form.php");
    exit();
}

// === Redirect to success page ===
$_SESSION['success'] = "Your flight booking was submitted successfully!";
header("Location: booking_success.php");
exit();
?>
