<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nival Travel and Tours</title>
  <link rel="stylesheet" href="stylesheet/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      padding-top: 70px;
    }

    .hero-slide {
      height: 500px;
      background-size: cover;
      background-position: center;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
    }

    .hero-content h1, .hero-content p {
      color: white;
    }

    .hero-content h1 {
      font-size: 3rem;
    }

    .hero-content p {
      font-size: 1.5rem;
    }

    .destination-dropdown {
      display: none;
      position: absolute;
      background-color: #fff;
      padding: 10px;
      z-index: 999;
      top: 100%;
      left: 0;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .nav-item.destination:hover .destination-dropdown {
      display: flex;
      gap: 10px;
    }

    .destination-dropdown img {
      width: 150px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
    }

    .nav-item.destination {
      position: relative;
    }

    @media (max-width: 991.98px) {
      .navbar-collapse {
        background-color: #198754;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        padding: 10px 0;
      }

      .navbar-nav {
        flex-direction: column;
        align-items: flex-start;
        padding-left: 20px;
      }

      .navbar-nav .nav-item {
        width: 100%;
        margin-bottom: 10px;
      }

      .navbar-nav .nav-link {
        padding: 10px 0;
        font-size: 16px;
      }

      .destination-dropdown {
        display: none;
        position: absolute;
        background-color: #fff;
        padding: 10px;
        z-index: 1000;
      }

      .destination-dropdown img {
        width: 100px;
        margin: 5px;
        display: block;
        border-radius: 5px;
      }
    }

    @media (min-width: 768px) {
      .destination:hover .destination-dropdown {
        display: block;
      }
    }

    @media (max-width: 991.98px) {
      .custom-mobile-menu {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 80%;
        max-width: 300px;
        background-color: #198754;
        z-index: 1050;
        padding: 20px;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
      }

      .custom-mobile-menu.show {
        transform: translateX(0);
      }

      .close-menu {
        font-size: 30px;
        background: none;
        border: none;
        color: white;
        position: absolute;
        top: 10px;
        right: 15px;
        z-index: 1060;
      }

      .navbar-nav {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        margin-top: 50px;
      }

      .navbar-toggler {
        z-index: 1061;
      }
    }
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
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="https://www.instagram.com/nivaltravelntours" target="_blank">
      <img src="images/logo.jpg" alt="Nival Logo" style="height: 60px; width: 60px; margin-right: 10px; border-radius:30px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse custom-mobile-menu" id="navbarNav">
      <button class="close-menu d-lg-none">×</button>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php" style="font-weight: bold; color:white">HOME</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php" style="font-weight: bold; color:white">ABOUT US</a></li>
        <li class="nav-item"><a class="nav-link" href="service.php" style="font-weight: bold; color:white">SERVICES</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact" style="font-weight: bold; color:white" onclick="showContact()">CONTACT</a></li>
        <li class="nav-item">
          <button 
            id="specialOfferBtn" 
            class="btn btn-warning nav-link text-light ms-2" 
            style="font-weight: bold; background-color: maroon; color: white; border:none;"
          >
            SPECIAL OFFERS
          </button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- SPECIAL OFFERS Section -->
<section 
  id="special-offer" 
  style="
    display: none;
    position: fixed;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    padding: 40px 20px;
    background-color: #f8f9fa;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    border-radius: 10px;
    max-width: 600px;
    width: 90%;
    z-index: 1050;
  ">
  <h2 class="text-center mb-4" style="color: maroon; border-bottom: 3px solid maroon; display: inline-block;">
    SPECIAL OFFERS
  </h2>
  <ul class="list-group list-group-flush mt-4 mx-auto">
    <li class="list-group-item"><i class="fas fa-gift"></i> Discounted Holiday Packages</li>
    <li class="list-group-item"><i class="fas fa-car"></i> Free Airport Transfers</li>
    <li class="list-group-item"><i class="fas fa-hotel"></i> Complimentary Hotel Upgrades</li>
    <li class="list-group-item"><i class="fas fa-globe"></i> Group Tour Discounts</li>
    <li class="list-group-item"><i class="fas fa-camera"></i> Free Travel Photography Sessions</li>
    <li class="list-group-item"><i class="fas fa-passport"></i> Visa Assistance and Fast-Track Processing</li>
    <li class="list-group-item"><i class="fas fa-bus"></i> Discounted City Tours</li>
  </ul>
  <button id="closeSpecialOffer" style="margin-top:20px; background-color: maroon" class="btn btn-danger w-100">Close</button>
</section>

<script>
  const toggler = document.querySelector('.navbar-toggler');
  const menu = document.getElementById('navbarNav');
  const closeMenuBtn = document.querySelector('.close-menu');

  toggler.addEventListener('click', function () {
    menu.classList.add('show');
  });

  closeMenuBtn.addEventListener('click', function () {
    menu.classList.remove('show');
  });

  document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
    link.addEventListener('click', () => {
      if (menu.classList.contains('show')) {
        menu.classList.remove('show');
      }
    });
  });

  const specialOfferBtn = document.getElementById('specialOfferBtn');
  const specialOfferSection = document.getElementById('special-offer');
  const closeSpecialOfferBtn = document.getElementById('closeSpecialOffer');

  specialOfferBtn.addEventListener('click', () => {
    specialOfferSection.style.display = 'block';
  });

  closeSpecialOfferBtn.addEventListener('click', () => {
    specialOfferSection.style.display = 'none';
  });
  function showContact() {
  Swal.fire({
    title: '<span style="color: maroon;">📞 Contact Us</span>',
    html: `
      <div style="font-size: 16px; color: black;">
        <span style="color: maroon;">📍</span> <b>Address:</b> Dar es Salaam, Tanzania<br>
        <span style="color: maroon;">📞</span> <b>Phone:</b> <a href="https://wa.me/255763103703" target="_blank" style="color: black; text-decoration: underline;">+255 763 103 703</a><br>
        <span style="color: maroon;">📧</span> <b>Email:</b> <span style="color: black;">support@nivaltravel&tour.com</span>
      </div>
    `,
    icon: 'info',
    iconColor: 'maroon',
    confirmButtonText: 'Close',
    confirmButtonColor: 'maroon'
  });
}

</script>

</body>
</html>
