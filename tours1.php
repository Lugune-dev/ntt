<!-- Tour Service Card -->
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
  text-shadow: 0 0 10px #fff, 0 0 20px maroon, 0 0 30px maroon;
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
  <div class="card shadow border-0 mx-auto" style="max-width: 700px;">>
  <div class="image-wrapper position-relative">
      <img src="images/121514140_337910954166749_1999663873425030986_n.jpg" class="card-img-top" alt="Hotels in Tanzania" style="max-height: 400px; object-fit: cover;">

      <!-- Title overlay on image -->
      <h2 class="hotel-heading">Tanzania Tour Packages</h2>
    </div>
    <div class="card-body text-center">
      <p class="card-text lead" style="font-weight: bold">
        Discover Tanzania's breathtaking destinations with our curated tour packages:
      </p>

      <ul class="list-unstyled text-start mx-auto" style="max-width: 500px;">
        <li>✓ Serengeti National Park – Safari Adventures</li>
        <li>✓ Mount Kilimanjaro – Hiking & Trekking</li>
        <li>✓ Zanzibar – Beach Getaways & Historical Tours</li>
        <li>✓ Ngorongoro Crater – Wildlife & Scenery</li>
        <li>✓ Arusha, Manyara, Tarangire – Customizable trips</li>
      </ul>
      <hr style="color:maroon; font-weight: bold; height: 4px;">
      <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
      <button class="btn booking-btn mt-3" onclick="openTourForm()">Book a Tour</button>
    </div>
  </div>
</div>
<!-- Tour Booking Modal -->
<div class="form-modal" id="tourModal">
  <div class="form-box">
    <div class="close-btn" onclick="closeTourForm()">&times;</div>

    <form action="process_tour_booking.php" method="POST">
      <center>
        <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
        <hr style="color:maroon; font-weight: bold; height: 4px;">
      </center>

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

      <div class="mb-3">
        <label for="destination" class="form-label">Select Destination</label>
        <select class="form-select" name="destination" required>
          <option value="">-- Choose Destination --</option>
          <option value="Serengeti Safari">Serengeti Safari</option>
          <option value="Kilimanjaro Trek">Kilimanjaro Trek</option>
          <option value="Zanzibar Beach">Zanzibar Beach</option>
          <option value="Ngorongoro Crater">Ngorongoro Crater</option>
          <option value="Tarangire/Manyara">Tarangire / Lake Manyara</option>
          <option value="Custom Tour">Custom Tour (Describe Below)</option>
        </select>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="start_date" class="form-label">Start Date</label>
          <input type="date" class="form-control" name="start_date" required>
        </div>
        <div class="col-md-6">
          <label for="end_date" class="form-label">End Date</label>
          <input type="date" class="form-control" name="end_date" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="group_size" class="form-label">Number of Travelers</label>
        <input type="number" class="form-control" name="group_size" min="1" required>
      </div>

      <div class="mb-3">
        <label for="requests" class="form-label">Special Requests (Optional)</label>
        <textarea class="form-control" name="requests" rows="3" placeholder="Anything you'd like to tell us..."></textarea>
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
  function openTourForm() {
    document.getElementById("tourModal").style.display = "flex";
  }

  function closeTourForm() {
    document.getElementById("tourModal").style.display = "none";
  }

  window.onclick = function (event) {
    const modal = document.getElementById("tourModal");
    if (event.target === modal) {
      closeTourForm();
    }
  };
</script>
<?php
require "footer.php";
?>