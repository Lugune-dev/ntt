<?php
session_start();
require 'vendor/autoload.php'; // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $pickup = $_POST['pickup'] ?? '';
    $dropoff = $_POST['dropoff'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $services = $_POST['services'] ?? [];
    $notes = $_POST['notes'] ?? '';

    $selected_services = implode(", ", $services);

    // 2. Save to Database
    $host = "localhost";
    $user = "sheddy";
    $pass = "**Lugun7";
    $db = "travel";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        $_SESSION['error'] = "Database connection error: " . $conn->connect_error;
        header('Location: booking_form.php');
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO airport_transfers (name, email, pickup, dropoff, travel_date, travel_time, services, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $pickup, $dropoff, $date, $time, $selected_services, $notes);

    if ($stmt->execute()) {
        // 3. Send Email with PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';       // SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'luguneshadrack@gmail.com'; // Your SMTP username
            $mail->Password   = 'pxsh jmcp fkcp oesz';    // Your SMTP password or app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('luguneshadrack@gmail.com', 'Travel & Tour Team');
            $mail->addAddress($email, $name);
            $mail->addAddress('luguneshadrack@gmail.com', 'Admin'); // Send to yourself
            $mail->isHTML(true);
            $mail->Subject = "Airport Transfer Booking Confirmation";
            $mail->Body    = "
                <h3>Thank you, $name!</h3>
                <p>Your airport transfer booking has been received.</p>
                <p><strong>Pickup:</strong> $pickup</p>
                <p><strong>Drop-off:</strong> $dropoff</p>
                <p><strong>Date:</strong> $date</p>
                <p><strong>Time:</strong> $time</p>
                <p><strong>Services:</strong> $selected_services</p>
                <p><strong>Notes:</strong> $notes</p>
                <br>
                <p>We will contact you shortly to confirm the details.</p>
            ";

            $mail->send();

            $_SESSION['success'] = "Booking confirmed! A confirmation email has been sent.";
            header('Location: booking_success.php');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = "Booking saved but email not sent. Mailer Error: {$mail->ErrorInfo}";
            header('Location: booking_form.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Error saving booking: " . $stmt->error;
        header('Location: booking_form.php');
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
