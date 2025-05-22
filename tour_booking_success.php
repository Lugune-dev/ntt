<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tour Booking Success</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if (isset($_SESSION['success'])): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Thank you!',
      text: '<?php echo $_SESSION['success']; ?>',
      confirmButtonColor: 'maroon'
    }).then(() => {
      window.location.href = 'index.php'; // Change to your homepage or tours page
    });
  </script>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

</body>
</html>
