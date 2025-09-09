<!-- Modern Navbar with Logo and Custom Color -->
<nav class="navbar navbar-expand-lg navbar-dark py-0 shadow-sm sticky-top animate__animated animate__fadeInDown">
  <div class="container"> <!-- Container for alignment -->
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center py-0" href="#">
      <img src="assets/img/logo.png" alt="eoffice.lk Logo" height="65" class="d-inline-block align-text-top me-2 my-1">
      <!-- <span class="fw-bold">E-Office.lk</span> -->
    </a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-house-door-fill"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#"><i class="bi bi-person-circle"></i> Profile</a>
        </li>
      </ul>

      <!-- Right-aligned search & profile -->
      <div class="d-flex" role="search">
        <a href="<?php echo baseUrl('logout.php'); ?>" class="btn btn-outline-light btn-sm mb-2 mb-sm-2 mb-md-2 mb-lg-2" type="button"><i class="bi bi-box-arrow-in-left"></i> Logout</a>
      </div>
    </div>
  </div>
</nav>