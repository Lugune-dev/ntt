<?php
session_start();
require 'vendor/autoload.php'; // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection - assuming $pdo from your original db.php
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Get form data (sanitize if needed)
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? ''; // NEW
    $destination_country = $_POST['destination_country'] ?? '';
    $visa_type = $_POST['visa_type'] ?? '';
    $travel_date = $_POST['travel_date'] ?? '';
    $notes = $_POST['notes'] ?? '';

    // 2. Handle file upload
    $file_path = '';
    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['document']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['document']['name']);
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        move_uploaded_file($file_tmp, $upload_dir . $file_name);
        $file_path = $upload_dir . $file_name;
    }

    // 3. Save to database (updated with phone)
    $sql = "INSERT INTO visa_requests (name, email, phone, destination_country, visa_type, travel_date, notes, document_path)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$name, $email, $phone, $destination_country, $visa_type, $travel_date, $notes, $file_path]);

    if ($result) {
        // 4. Send emails with PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP setup
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'luguneshadrack@gmail.com';
            $mail->Password   = 'pxsh jmcp fkcp oesz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Email to user
            $mail->setFrom('luguneshadrack@gmail.com', 'Visa Processing Team');
            $mail->addAddress($email, $name);
            $mail->addAddress('luguneshadrack@gmail.com', 'Admin'); // Copy to self
            $mail->isHTML(true);
            $mail->Subject = "Visa Processing Request Received";
            $mail->Body    = "
                <h3>Thank you for your visa request!</h3>
                <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
                <p><strong>Destination:</strong> " . htmlspecialchars($destination_country) . "</p>
                <p><strong>Visa Type:</strong> " . htmlspecialchars($visa_type) . "</p>
                <p><strong>Travel Date:</strong> " . htmlspecialchars($travel_date) . "</p>
                <p><strong>Notes:</strong> " . nl2br(htmlspecialchars($notes)) . "</p>
                <br>
                <p>We will contact you soon with further information.</p>
            ";
            $mail->send();

            // Email to admin
            $mail->clearAddresses();
            $mail->addAddress('luguneshadrack@gmail.com');
            $mail->Subject = "New Visa Request from $name";
            $mail->Body = $mail->Body; // Same body

            $mail->send();

            // 5. Set session message and redirect
            $_SESSION['visa_success'] = true;
            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['visa_error'] = "Request saved but email sending failed: " . $mail->ErrorInfo;
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['visa_error'] = "Failed to save your request. Please try again.";
        header("Location: index.php");
        exit;
    }
}
?>
