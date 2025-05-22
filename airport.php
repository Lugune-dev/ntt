<!-- Airport Transfer Card -->
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
<div class="container py-4">
  <div class="card shadow border-0 mx-auto" style="max-width: 700px;">
  <div class="image-wrapper position-relative">
      <img src="images/airport.webp" class="card-img-top" alt="Hotels in Tanzania" style="max-height: 400px; object-fit: cover;">

      <!-- Title overlay on image -->
      <h4 class="hotel-heading"> Airport Transfer Services</h4>
    </div>
    <div class="card-body text-center">
      <p class="card-text lead" style="font-weight: bold">
        Reliable and affordable airport transfers across Tanzania. Available through our Travel and Tour services.
      </p>

      <ul class="list-unstyled text-start mx-auto" style="max-width: 500px;">
        <li>✓ One-way & round-trip rides</li>
        <li>✓ Private or shared transfers</li>
        <li>✓ Meet & Greet at airport</li>
        <li>✓ Hotel or lodge drop-off</li>
        <li>✓ Executive & group vehicles</li>
      </ul>
      <hr style="color:maroon; font-weight: bold; height: 4px;">
      <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
      <button class="btn booking-btn mt-3" onclick="openForm()">Book Airport Transfer</button>
    </div>
  </div>
</div>

<!-- Airport Transfer Booking Modal -->
<div class="form-modal" id="formModal">
  <div class="form-box">
    <div class="close-btn" onclick="closeForm()">&times;</div>


    <form action="process_transfer_booking.php" method="POST">
      <center>
        <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
        <hr style="color:maroon; font-weight: bold; height: 4px;">
      </center>

      <!-- User Info -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" name="email" required>
        </div>
      </div>
      <div class="col-md-6">
  <label for="phone" class="form-label">Phone Number</label>
  <input type="tel" class="form-control" name="phone" required>
</div>

      <!-- Travel Info -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="pickup" class="form-label">Pickup Location</label>
          <input type="text" class="form-control" name="pickup" required>
        </div>
        <div class="col-md-6">
          <label for="dropoff" class="form-label">Drop-off Location</label>
          <input type="text" class="form-control" name="dropoff" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="date" class="form-label">Travel Date</label>
          <input type="date" class="form-control" name="date" required>
        </div>
        <div class="col-md-6">
          <label for="time" class="form-label">Travel Time</label>
          <input type="time" class="form-control" name="time" required>
        </div>
      </div>

      <!-- Services Selection -->
      <div class="mb-3">
        <label class="form-label">Select Services Needed:</label><br>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="services[]" value="One-way transfer" id="service1">
          <label class="form-check-label" for="service1">One-way transfer</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="services[]" value="Round-trip transfer" id="service2">
          <label class="form-check-label" for="service2">Round-trip transfer</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="services[]" value="Meet & Greet service" id="service3">
          <label class="form-check-label" for="service3">Meet & Greet service</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="services[]" value="Executive vehicle" id="service4">
          <label class="form-check-label" for="service4">Executive/Luxury vehicle</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="services[]" value="Shared transfer" id="service5">
          <label class="form-check-label" for="service5">Shared transfer</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="services[]" value="Luggage assistance" id="service6">
          <label class="form-check-label" for="service6">Luggage assistance</label>
        </div>
      </div>

      <!-- Notes -->
      <div class="mb-3">
        <label for="notes" class="form-label">Special Requests or Notes</label>
        <textarea class="form-control" name="notes" rows="3"></textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-lg text-white" style="background-color: maroon;">Submit Booking</button>
      </div>
    </form>
  </div>
</div>
<script>
  function openForm() {
    document.getElementById("formModal").style.display = "flex";
  }

  function closeForm() {
    document.getElementById("formModal").style.display = "none";
  }

  // Optional: Close the modal when clicking outside the form box
  window.onclick = function (event) {
    if (event.target == document.getElementById("formModal")) {
      closeForm();
    }
  }
</script>
<?php
   require "footer.php";
 ?>