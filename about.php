<?php
require "header.php";
?>
  <style>
    .about-section {
      padding: 60px 0;
      background-color: #f8f9fa;
    }
    .about-image {
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .highlight {
      color: #007bff;
      font-weight: bold;
    }
  </style>
</head>
<body>

<!-- About Us Section -->
<section class="about-section">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Image Column -->
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="images/121002594_205958200928099_2921847592695449157_n.jpg" alt="Nival Travel and Tours" class="about-image">
      </div>
      
      <!-- Text Column -->
      <div class="col-md-6">
        <h2 class="mb-4">About <span class="highlight">Nival Travel and Tours</span></h2>
        <p>
          At <strong>Nival Travel and Tours</strong>, we believe that travel is not just about reaching a destination—it's about the experience, the journey, and the memories you create along the way.
        </p>
        <p>
          Founded with a passion for exploration and a commitment to exceptional customer service, our mission is to make every trip seamless, exciting, and tailored to your dreams. Whether you're planning a family vacation, a honeymoon, a group tour, or a solo escape, we've got you covered.
        </p>
        <p>
          Our services include:
        </p>
        <ul class="list-unstyled">
          <li><i class="fas fa-check-circle text-primary"></i> Customized holiday packages</li>
          <li><i class="fas fa-check-circle text-primary"></i> Airport pickups and transfers</li>
          <li><i class="fas fa-check-circle text-primary"></i> Hotel bookings and upgrades</li>
          <li><i class="fas fa-check-circle text-primary"></i> Visa assistance and travel insurance</li>
          <li><i class="fas fa-check-circle text-primary"></i> Guided tours and cultural experiences</li>
        </ul>
        <p>
          Let us turn your travel dreams into reality. Discover the world with <strong>Nival Travel and Tours</strong>—where every journey begins with a story.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- Bootstrap JS and Font Awesome -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<?php
require "footer.php";
?>