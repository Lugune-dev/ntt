<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Appointment Success</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if (isset($_SESSION['success'])): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '<?php echo $_SESSION['success']; ?>',
      confirmButtonColor: 'maroon'
    }).then(() => {
      window.location.href = 'index.php'; // Redirect to homepage or another section
    });
  </script>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

</body>
</html>
