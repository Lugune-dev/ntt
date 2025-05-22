<?php require "header.php"; ?>
<style>
  html {
    scroll-behavior: smooth;
  }

  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
    background-color: #f8f9fa;
  }

  main {
    flex: 1;
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
    background-color: rgba(128, 0, 0, 0.8);
    padding: 10px 20px;
    border-radius: 10px;
  }

  /* .whatsapp-icon {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #25d366;
    color: white;
    font-size: 30px;
    padding: 10px 15px;
    border-radius: 50%;
    text-decoration: none;
    z-index: 999;
  }

  .whatsapp-icon:hover {
    background-color: #128c7e;
  } */
</style>

<main>
  <!-- Card Section -->
  <div class="container py-5">
    <div class="card shadow border-0 mx-auto" style="max-width: 700px;">
      <div class="image-wrapper position-relative">
        <img src="images/flight.webp" class="card-img-top" alt="Hotels in Tanzania" style="max-height: 400px; object-fit: cover;">
        <h4 class="hotel-heading">Ticketing for Flights Only</h4>
      </div>
      <div class="card-body text-center">
        <p class="card-text lead">We provide ticketing services for flights only. Book securely and affordably.</p>
        <hr style="color:maroon; font-weight: bold; height: 4px;">
        <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
        <button class="btn booking-btn mt-3" onclick="openForm()">Booking in Ticketing</button>
      </div>
    </div>
  </div>

  <!-- Booking Form Modal -->
  <div class="form-modal" id="formModal">
    <div class="form-box">
      <div class="close-btn" onclick="closeForm()">&times;</div>
      <form action="booking_process.php" method="POST">
        <center>
          <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 90px; margin-bottom: 20px; border-radius:30px">
          <hr style="color:maroon; font-weight: bold; height: 4px;">
        </center>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="name" class="form-label" style="font-weight: bold">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label" style="font-weight: bold">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
        </div>
        <div class="col-md-6">
  <label for="phone" class="form-label" style="font-weight: bold">Phone Number</label>
  <input type="tel" class="form-control" name="phone" required>
</div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="departure" class="form-label" style="font-weight: bold">Departure Airport</label>
            <input type="text" class="form-control" id="departure" name="departure" required>
          </div>
          <div class="col-md-6">
            <label for="destination" class="form-label" style="font-weight: bold">Destination Airport</label>
            <input type="text" class="form-control" id="destination" name="destination" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="date" class="form-label" style="font-weight: bold">Travel Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
          <div class="col-md-6">
            <label for="passengers" class="form-label" style="font-weight: bold">Number of Passengers</label>
            <input type="number" class="form-control" id="passengers" name="passengers" min="1" required>
          </div>
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-lg text-white" style="background-color: maroon;">Submit Booking</button>
        </div>
      </form>
    </div>
  </div>

  
</main>
<a href="https://wa.me/0763103703" class="whatsapp-icon" target="_blank">
  <i class="fab fa-whatsapp"></i>
</a>
<script>
  function openForm() {
    document.getElementById("formModal").style.display = "flex";
  }

  function closeForm() {
    document.getElementById("formModal").style.display = "none";
  }

  window.onclick = function (event) {
    if (event.target == document.getElementById("formModal")) {
      closeForm();
    }
  }
</script>

<?php require "footer.php"; ?>
