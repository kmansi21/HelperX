<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelperX</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php include_once('navbar.php');?>


    <!------===================================================== home ================================================================================= -->
    <section class="home">
    <div class="home-content">
        <img src="images/home.jpg" class="home-img">
        <div class="overlay">
            <h1>Welcome to HelperX</h1>
            <p>Your trusted platform for hiring professional Housekeepers.</p>
            <a href="#services" class="btn">Explore Services</a>
        </div>
    </div>
</section>
    <!------==================================================== About========================================================================== -->
    <section id="about" class="about">
    <h2 class="title">About Us</h2>
    <div class="about-container">
        <div class="about-content">
            <div class="about-text">
                <p>Welcome to <span class="highlight">HelperX</span>, your trusted platform for hiring professional home care services. Whether you're looking for an experienced <span class="highlight">housekeeper</span>, we’re here to provide peace of mind with the best professionals.</p>

                <h3><i class="far fa-paper-plane"></i> Our Mission</h3>
                <p>At <span class="highlight">HelperX</span>, we connect families with <span class="highlight">highly-skilled Housekeeper</span> to ensure a stress-free experience. We prioritize safety, professionalism, and convenience.</p>

                <h3><i class="far fa-star"></i> Why Choose HelperX?</h3>
                <ul>
                    <li><i class="fas fa-user-check"></i> Trusted Professionals: Verified, background-checked, and skilled.</li>
                    <li><i class="fas fa-award"></i> Experienced Staff: Years of expertise in housekeeping.</li>
                    <li><i class="fas fa-calendar-alt"></i> Flexible Scheduling: Services that fit your timeline and availability.</li>
                    <li><i class="fas fa-handshake"></i> Seamless Booking: Quick and hassle-free hiring process.</li>
                </ul>

                <a href="#services" class="btn"><i class="fas fa-arrow-right"></i> Explore Our Services</a>
            </div>
            <div class="about-image">
                <img src="images/work.jpg" alt="About HomeCare">
            </div>
        </div>
    </div>
</section>
    <!------============================================================== services====================================================== ==================================================== -->
  
<section id="services" class="services">
    <h2 class="title">Our Services</h2>
    <div class="service-container">
        <div class="service-grid">
            <!-- Mopping Service -->
            <div class="service-box">
                <img src="images/mop.png" alt="Mopping Service">
                <h4>Mopping </h4>
                <p>Keep your floors sparkling clean with our professional mopping services. We use eco-friendly cleaning products for a fresh, sanitized finish.</p>
                <a href="maid-hiring.php" class="btn request-btn">Request Service</a>
            </div>
            
            <!-- Dusting and Mopping Service -->
            <div class="service-box">
                <img src="images/dusting.jpg" alt="Dusting and Mopping Service">
                <h4>Dusting and Mopping</h4>
                <p>Our dusting and mopping service ensures that your home is free from dust and dirt while leaving your floors gleaming with cleanliness.</p>
                <a href="maid-hiring.php" class="btn request-btn">Request Service</a>
            </div>
            
            <!-- Utensil Cleaning Service -->
            <div class="service-box">
                <img src="images/utensil-cleaning.jpg" alt="Utensil Cleaning Service">
                <h4>Utensil Cleaning</h4>
                <p>We provide thorough utensil cleaning, ensuring that your dishes are sparkling clean and hygienic. No more grease or food residue!</p>
                <a href="maid-hiring.php" class="btn request-btn">Request Service</a>
            </div>
            
           <!-- Bathroom Cleaning Service -->
<div class="service-box">
    <img src="images/bathroom cleaning.jpg" alt="Bathroom Cleaning Service">
    <h4>Bathroom Cleaning</h4>
    <p>Our bathroom cleaning service ensures a spotless and germ-free space, tackling dirt, stains, and bacteria with professional-grade cleaning solutions.</p>
    <a href="maid-hiring.php" class="btn request-btn">Request Service</a>
</div>


           <!-- Cooking Service -->
<div class="service-box">
    <img src="images/cooking service.jpg" alt="Cooking Service">
    <h4>Cooking Service</h4>
    <p>Our cooking service provides delicious, home-cooked meals tailored to your preferences, ensuring a healthy and enjoyable dining experience.</p>
    <a href="maid-hiring.php" class="btn request-btn">Request Service</a>
</div>

            
        <!-- Other Services -->
<div class="service-box">
    <img src="images/other.jpg" alt="Other Services">
    <h4>Other Services</h4>
    <p>We offer additional services like grocery shopping, laundry, organizing, and customized cleaning to meet your specific needs.</p>
    <a href="maid-hiring.php" class="btn request-btn">Request Service</a>
</div>

        <div class="join-homecare">
            <h3>Join the HelperX Family</h3>
            <p>Let us handle your home cleaning needs while you focus on what matters most. Experience <strong>HelperX</strong> today!</p>
            <a href="#contact" class="btn">Contact Us</a>
        </div>
    </div>
</section>

    <!------============================================================== Contact====================================================== ==================================================== -->

<section id="contact">
<h2 class="title">Contact Us</h2>
    <div class="contact-container">
        <p>Feel free to reach out with any questions or concerns. We're here to help!</p>
        <div class="contact-items">
            <div class="contact-item">
                <i class="fa fa-phone"></i>
                <h3>Phone</h3>
                <p><a href="tel:+11234567890">+1 (123) 456-7890</a></p>
            </div>
            <div class="contact-item">
                <i class="fa fa-envelope"></i>
                <h3>Email</h3>
                <p><a href="mailto:contact@yourcompany.com">contact@yourcompany.com</a></p>
            </div>
            <div class="contact-item">
                <i class="fa fa-map-marker-alt"></i>
                <h3>Address</h3>
                <p>123 Your Street, City, Country</p>
            </div>
        </div>
    </div>
</section>
    <!------============================================================== Footer ====================================================== ==================================================== -->

<footer>
    <div class="footer-content">
      <div class="footer-services">
        <h3>Our Services</h3>
        <p>Professional Housekeeping  Services | Keeping Your Home Clean and Tidy</p>
      </div>
      <div class="contact-info">
        <h3>Contact Information</h3>
        <span>Phone: +1 (123) 456-7890</span>
        <span>Email: contact@yourcompany.com</span>
        <span>Address: 123 Your Street, City, Country</span>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 HelperX. All Rights Reserved.</p>
      <p><a href="#">Designed by @MK</a></p>
    </div>
  </footer>

</body>
</html>
