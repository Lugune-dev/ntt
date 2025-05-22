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
  <div class="image-wrapper position-relative">
      <img src="images/visa.jpg" class="card-img-top" alt="Hotels in Tanzania" style="max-height: 400px; object-fit: cover;">

      <!-- Title overlay on image -->
      <h2 class="hotel-heading"> Visa Processing Services</h2>
    </div>
    <!-- <img src="images/visa.jpg" class="card-img-top" alt="Visa Processing" style="max-height: 400px; object-fit: cover;"> -->
    <div class="card-body text-center">
      <!-- <h2 class="card-title fw-bold">Visa Processing Services</h2> -->
      <p class="card-text lead" style="font-weight: bold">
        Simplify your travel planning. We assist with professional visa application and processing for various destinations.
      </p>

      <ul class="list-unstyled text-start mx-auto" style="max-width: 500px;">
        <li>✓ Tourist and business visa assistance</li>
        <li>✓ Document verification and guidance</li>
        <li>✓ Embassy appointment scheduling</li>
        <li>✓ Real-time application tracking</li>
        <li>✓ Support for Schengen, US, UK, UAE visas and more</li>
      </ul>
      <hr style="color:maroon; font-weight: bold; height: 4px;">
      <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
      <button class="btn booking-btn mt-3" onclick="openVisaForm()">Request Visa Help</button>
    </div>
  </div>
</div>
<!-- Visa Processing Booking Modal -->
<div class="form-modal" id="visaModal">
  <div class="form-box">
    <div class="close-btn" onclick="closeVisaForm()">&times;</div>

    <form action="process_visa_request.php" method="POST" enctype="multipart/form-data">
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
      <div class="col-md-6">
  <label for="phone" class="form-label">Phone Number</label>
  <input type="tel" class="form-control" name="phone" required>
</div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Destination Country</label>
          <input type="text" class="form-control" name="destination_country" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Visa Type</label>
          <select class="form-select" name="visa_type" required>
            <option value="">-- Select Visa Type --</option>
            <option value="Tourist">Tourist Visa</option>
            <option value="Business">Business Visa</option>
            <option value="Student">Student Visa</option>
            <option value="Transit">Transit Visa</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Planned Travel Date</label>
        <input type="date" class="form-control" name="travel_date" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Upload Supporting Document (Optional)</label>
        <input type="file" class="form-control" name="document">
      </div>

      <div class="mb-3">
        <label class="form-label">Additional Notes</label>
        <textarea class="form-control" name="notes" rows="3"></textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-lg text-white" style="background-color: maroon;">Submit Request</button>
      </div>
    </form>
  </div>
</div>
<a href="https://wa.me/0763103703" class="whatsapp-icon" target="_blank">
  <i class="fab fa-whatsapp"></i>
</a>

<script>
  function openVisaForm() {
    document.getElementById("visaModal").style.display = "flex";
  }

  function closeVisaForm() {
    document.getElementById("visaModal").style.display = "none";
  }

  window.onclick = function(event) {
    const modal = document.getElementById("visaModal");
    if (event.target === modal) {
      closeVisaForm();
    }
  };
</script>

<?php
require "footer.php";
?>