<?php
require "header.php";
?>
<style>
  html {
    scroll-behavior: smooth;
  }

  .text-maroon {
    color: maroon;
  }

  .booking-btn {
    background-color: maroon;
    color: white;
    padding: 12px 30px;
    font-size: 1.1rem;
    border-radius: 30px;
    border: none;
    transition: all 0.3s ease;
  }

  .booking-btn:hover {
    background-color: #a00000;
  }

  /* Booking Form Modal Styles */
  .form-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .form-box {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    width: 90%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
  }

  .form-box .close-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
  }

  .form-box .close-btn:hover {
    color: red;
  }
  .hotel-heading {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  color: white;
  font-size: 1rem;
  font-weight: bold;
  /* text-shadow: 0 0 10px #fff, 0 0 20px maroon, 0 0 30px maroon; */
  /* animation: glow 1.5s ease-in-out infinite alternate; */
  background-color: rgba(128, 0, 0, 0.8); /* Optional: darken background for contrast */
  padding: 10px 20px;
  border-radius: 10px;
}

/* Optional glowing animation */
@keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px maroon, 0 0 30px maroon;
  }
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px red, 0 0 40px red;
  }
}
</style>
<div class="container py-5">
  <div class="card shadow border-0 mx-auto" style="max-width: 700px;">

    <div class="card-body text-center">
    <div class="image-wrapper position-relative">
      <img src="images/hire.jpg" class="card-img-top" alt="Hotels in Tanzania" style="max-height: 400px; object-fit: cover;">

      <!-- Title overlay on image -->
      <h2 class="hotel-heading">Car Hire Services</h2>
    </div>
      <p class="card-text lead" style="font-weight: bold">
        Explore Tanzania in comfort. Our Travel & Tour department offers flexible car rental options for your journey.
      </p>

      <ul class="list-unstyled text-start mx-auto" style="max-width: 500px;">
        <li>✓ Self-drive or chauffeur-driven cars</li>
        <li>✓ Daily, weekly & long-term rental options</li>
        <li>✓ SUVs, sedans, 4x4s, and minibuses</li>
        <li>✓ Pickup & drop-off at airports or hotels</li>
        <li>✓ Professional, licensed drivers available</li>
      </ul>
      <hr style="color:maroon; font-weight: bold; height: 4px;">
      <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
      <button class="btn booking-btn mt-3" onclick="openCarHireForm()">Book Car Hire</button>
    </div>
  </div>
</div>
<!-- Car Hire Booking Modal -->
<div class="form-modal" id="carHireModal">
  <div class="form-box">
    <div class="close-btn" onclick="closeCarHireForm()">&times;</div>

    <form action="process_car_hire_booking.php" method="POST">
      <center>
        <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
        <hr style="color:maroon; font-weight: bold; height: 4px;">
      </center>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="name" class="form-label" style="font-weight: bold">Full Name</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label" style="font-weight: bold">Email Address</label>
          <input type="email" class="form-control" name="email" required>
        </div>
      </div>
      <div class="col-md-6">
  <label for="phone" class="form-label" style="font-weight: bold">Phone Number</label>
  <input type="tel" class="form-control" name="phone" required>
</div>


      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label" style="font-weight: bold">Pickup Location</label>
          <input type="text" class="form-control" name="pickup_location" required>
        </div>
        <div class="col-md-6">
          <label class="form-label" style="font-weight: bold">Drop-off Location</label>
          <input type="text" class="form-control" name="dropoff_location" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label" style="font-weight: bold">Pickup Date</label>
          <input type="date" class="form-control" name="pickup_date" required>
        </div>
        <div class="col-md-6">
          <label class="form-label" style="font-weight: bold">Return Date</label>
          <input type="date" class="form-control" name="return_date" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label" style="font-weight: bold">Vehicle Type</label>
        <select class="form-select" name="vehicle_type" required>
          <option value="">-- Select Vehicle --</option>
          <option value="Sedan">Sedan</option>
          <option value="SUV">SUV</option>
          <option value="4x4">4x4</option>
          <option value="Minibus">Minibus</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label" style="font-weight: bold">Rental Option</label><br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="rental_option" value="Self-drive" required>
          <label class="form-check-label" style="font-weight: bold">Self-drive</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="rental_option" value="With Driver" required>
          <label class="form-check-label" style="font-weight: bold">With Driver</label>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label" style="font-weight: bold">Additional Notes</label>
        <textarea class="form-control" name="notes" rows="3"></textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-lg text-white" style="background-color: maroon;">Submit Booking</button>
      </div>
    </form>
  </div>
</div>
<a href="https://wa.me/0763103703" class="whatsapp-icon" target="_blank">
  <i class="fab fa-whatsapp"></i>
</a>
<script>
  function openCarHireForm() {
    document.getElementById("carHireModal").style.display = "flex";
  }

  function closeCarHireForm() {
    document.getElementById("carHireModal").style.display = "none";
  }

  // Optional: close modal when clicking outside
  window.onclick = function(event) {
    const modal = document.getElementById("carHireModal");
    if (event.target === modal) {
      closeCarHireForm();
    }
  };
</script>

<?php
require "footer.php";
?>