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
<a href="https://wa.me/0763103703" class="whatsapp-icon" target="_blank">
  <i class="fab fa-whatsapp"></i>
</a>

<div class="container py-5">
  <div class="card shadow border-0 mx-auto" style="max-width: 700px;">
    <div class="image-wrapper position-relative">
      <img src="images/hotel1.avif" class="card-img-top" alt="Hotels in Tanzania" style="max-height: 400px; object-fit: cover;">

      <!-- Title overlay on image -->
      <h2 class="hotel-heading">Hotel Booking Services</h2>
    </div>

    <div class="card-body text-center">
      <p class="card-text lead" style="font-weight: bold">
        Book top-rated hotels across Tanzania through our trusted travel network. We provide exclusive access to:
      </p>

      <ul class="list-unstyled text-start mx-auto" style="max-width: 500px;">
        <li>✓ Mount Meru Hotel – Arusha</li>
        <li>✓ Serena Hotels – Nationwide</li>
        <li>✓ Gran Melia Arusha</li>
        <li>✓ Hyatt Regency – Dar es Salaam</li>
        <li>✓ Four Points by Sheraton</li>
        <li>✓ Many more local & international luxury hotels</li>
      </ul>
      <hr style="color:maroon; font-weight: bold; height: 4px;">
      <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
      <button class="btn booking-btn mt-3" onclick="openHotelForm()">Book a Hotel</button>
    </div>
  </div>
</div>

<!-- Hotel Booking Modal -->
<div class="form-modal" id="hotelModal">
  <div class="form-box">
    <div class="close-btn" onclick="closeHotelForm()">&times;</div>

    <form action="process_hotel_booking.php" method="POST">
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
      <div>
      <label for="phone" class="form-label" style="font-weight: bold">Phone Number</label>
  <input type="tel" class="form-control" name="phone" required>
</div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label" style="font-weight: bold">Check-In Date</label>
          <input type="date" class="form-control" name="checkin" required>
        </div>
        <div class="col-md-6">
          <label class="form-label" style="font-weight: bold">Check-Out Date</label>
          <input type="date" class="form-control" name="checkout" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label" style="font-weight: bold">Preferred Hotel</label>
        <select class="form-select" name="hotel" required>
          <option value="">-- Select Hotel --</option>
          <option value="Mount Meru Hotel">Mount Meru Hotel</option>
          <option value="Serena Hotels">Serena Hotels</option>
          <option value="Gran Melia Arusha">Gran Melia Arusha</option>
          <option value="Hyatt Regency Dar es Salaam">Hyatt Regency Dar es Salaam</option>
          <option value="Four Points by Sheraton">Four Points by Sheraton</option>
          <option value="Other">Other (please specify below)</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label" style="font-weight: bold">Room Type</label>
        <select class="form-select" name="room_type" required>
          <option value="">-- Select Room Type --</option>
          <option value="Single Room">Single Room</option>
          <option value="Double Room">Double Room</option>
          <option value="Suite">Suite</option>
          <option value="Family Room">Family Room</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label" style="font-weight: bold">Additional Requests</label>
        <textarea class="form-control" name="requests" rows="3" placeholder="E.g. Airport pickup, early check-in..."></textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-lg text-white" style="background-color: maroon;">Submit Booking</button>
      </div>
    </form>
  </div>
</div>
<script>
  function openHotelForm() {
    document.getElementById("hotelModal").style.display = "flex";
  }

  function closeHotelForm() {
    document.getElementById("hotelModal").style.display = "none";
  }

  window.onclick = function (event) {
    const modal = document.getElementById("hotelModal");
    if (event.target === modal) {
      closeHotelForm();
    }
  };
</script>

<?php
require "footer.php";
?>