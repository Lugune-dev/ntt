<?php
session_start();
require "db.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? ''; // ✅ New phone field
    $pickup_location = $_POST['pickup_location'] ?? '';
    $dropoff_location = $_POST['dropoff_location'] ?? '';
    $pickup_date = $_POST['pickup_date'] ?? '';
    $return_date = $_POST['return_date'] ?? '';
    $vehicle_type = $_POST['vehicle_type'] ?? '';
    $rental_option = $_POST['rental_option'] ?? '';
    $notes = $_POST['notes'] ?? '';

    // Insert into database
    try {
        $sql = "INSERT INTO car_hire_bookings (name, email, phone, pickup_location, dropoff_location, pickup_date, return_date, vehicle_type, rental_option, notes) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $phone, $pickup_location, $dropoff_location, $pickup_date, $return_date, $vehicle_type, $rental_option, $notes]);
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error saving booking: " . $e->getMessage();
        header("Location: car_hire_form.php");
        exit();
    }

    // Send emails
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'uguneshadrack@gmail.com';
        $mail->Password   = 'pxsh jmcp fkcp oesz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet    = 'UTF-8';

        // Confirmation to user
        $mail->setFrom('luguneshadrack@gmail.com', 'Car Hire Service');
        $mail->addAddress($email, $name);
        $mail->addAddress('luguneshadrack@gmail.com', 'Admin');
        $mail->Subject = "Car Hire Booking Confirmation";
        $mail->isHTML(true);
        $mail->Body = "
            <h3>Thank you for booking with us!</h3>
            <p>Here are your booking details:</p>
            <ul>
                <li><strong>Name:</strong> {$name}</li>
                <li><strong>Email:</strong> {$email}</li>
                <li><strong>Phone:</strong> {$phone}</li>
                <li><strong>Pickup Location:</strong> {$pickup_location}</li>
                <li><strong>Drop-off Location:</strong> {$dropoff_location}</li>
                <li><strong>Pickup Date:</strong> {$pickup_date}</li>
                <li><strong>Return Date:</strong> {$return_date}</li>
                <li><strong>Vehicle Type:</strong> {$vehicle_type}</li>
                <li><strong>Rental Option:</strong> {$rental_option}</li>
                <li><strong>Notes:</strong> {$notes}</li>
            </ul>
        ";
        $mail->send();

        // Admin notification
        $mail->clearAddresses();
        $mail->addAddress('luguneshadrack@gmail.com', 'Admin');
        $mail->Subject = "New Car Hire Booking";
        $mail->Body = "
            <h3>New Car Hire Booking Request</h3>
            <ul>
                <li><strong>Name:</strong> {$name}</li>
                <li><strong>Email:</strong> {$email}</li>
                <li><strong>Phone:</strong> {$phone}</li>
                <li><strong>Pickup Location:</strong> {$pickup_location}</li>
                <li><strong>Drop-off Location:</strong> {$dropoff_location}</li>
                <li><strong>Pickup Date:</strong> {$pickup_date}</li>
                <li><strong>Return Date:</strong> {$return_date}</li>
                <li><strong>Vehicle Type:</strong> {$vehicle_type}</li>
                <li><strong>Rental Option:</strong> {$rental_option}</li>
                <li><strong>Notes:</strong> {$notes}</li>
            </ul>
        ";
        $mail->send();

        $_SESSION['success'] = "Your car hire booking has been successfully submitted! We will contact you shortly.";
        header("Location: thank_you.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = "Booking saved but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: car_hire_form.php");
        exit();
    }
}
