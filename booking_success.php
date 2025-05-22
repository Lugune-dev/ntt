<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Booking Success</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if (isset($_SESSION['success'])): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '<?php echo addslashes($_SESSION['success']); ?>',
      confirmButtonColor: 'maroon'
    }).then(() => {
      window.location.href = 'index.php'; // Redirect to homepage or another page
    });
  </script>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

</body>
</html>
