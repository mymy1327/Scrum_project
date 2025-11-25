<?php
session_start();
 
// check if the user is logged in, if not then redirect to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //&header("location: Navigation_bar.html");
    //exit;}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nature Music</title>
    <link rel = "stylesheet" href = "https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=MeaCulpa' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="nav_bar.css">
    <link rel="stylesheet" href="content.css">
    <link rel="stylesheet" href="footer.css">
    <!-- Logo shows next to the page title -->
    <link rel="icon" href="pictures/logo.png">
  </head>
  <body>
    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>
    <!-- Navigation Bar -->
    <div class="welcome_text">
      <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
        <p class="welcome">Welcome to Nature Music, user <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</p>
      <?php else: ?>
        <p class="welcome">Welcome to Nature Music!</p>
      <?php endif; ?>
    </div>
    <div class="nav_bar_container">
      <a href="Navigation_bar.php">
    <img class="logo" src="pictures/logo.png" alt="Logo">
</a>
      <div class="search_nav_link_container">
    <!-- Search bar -->
      <div class="search-container">
        <div class="search_bar_form justify-content-center">
        <input class="search_bar" id="search-input" oninput="handleSearch()" type="text" placeholder="Search">
        <button class="search_button justify-content-center" id="search-button" onclick="performSearch()"><i class='bx bx-search'></i></button>
        </div>
        <div>
          <ul class="search-results" id="search-results">
            </ul>
          <div id="notification" class="notification">
            Product has been added to cart!
          </div>
        </div>
      </div>
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Navigation_bar.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Deals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Category Items</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="string_instruments.php">String Instruments</a></li>
              <li><a class="dropdown-item" href="drums_and_percussion.php">Drums And Percussion</a></li>
              <li><a class="dropdown-item" href="keyboards_and_pianos.php">Keyboards And Pianos</a></li>
              <li><a class="dropdown-item" href="live_sound.php">Live Sound & Pro Audio</a></li>
              <li><a class="dropdown-item" href="home_audio.php">Home Audio</a></li>
              <li><a class="dropdown-item" href="studio.php">Studio And Recording</a></li>
              <li><a class="dropdown-item" href="wind.php">Wind Instruments</a></li>
            </ul>
        </li>
      </ul></div>
    <!-- Cart and log in -->
      <div class="cart_login">
        <a href="cart_review.php" id="cart_icon"><i class='bx bxs-cart'></i></a>
        <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
          <a href="logout.php"><i class="bx bx-log-out bx-flip-horizontal"></i></a>
        <?php else: ?>
        <a href="login.php"><i class='bx bxs-user'></i></a>
        <?php endif; ?>
      </div>
    </div>
    <!-- Banner -->
    <div class="banner_container">
      <img class="banner_image" src="pictures/image.jpeg" alt="Banner">
      <h3 class="banner_text_top">DISCOVER</h3>
      <h3 class="banner_text_bottom">SOUND OF DREAMS</h3>
    
    <!-- Warranty banner -->
    <div class="warranty_container row justify-content-center">
      <div class="delivery col-3 row">
        <i class="bx bxs-truck col-2"></i>
        <div class="delivery_text col-10"><h3>FREE DELIVERY</h3>
          <p>Fast & Secure</p></div>
        </div>
        <div class="interest col-3 row">
          <i class='bx bx-chat'></i>
          <div class="support_text col-10"><h3>INTEREST FREE</h3>
            <p>Online 24 Hours</p></div>
          </div>
        <div class="warranty col-3 row">
          <i class="bx bx-badge-check"></i>
          <div class="warranty_text col-10"><h3>WARRANTY</h3>
            <p>365 A Day</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Welcome line -->
    <div class="line_container row">
      <div class="line"></div>
      <h2 class="special_text">Special</h2>
      <p class="free_text">Free Guitar Lessons!</p>
      <p class="purchase_text">Purchase any guitar over $500 and receive a one hour guitar lesson free.</p>
    </div>
    

    <!-- Instruments categories start -->
    <p class="ensimmainen title edit">SHOP BY CATEGORIES</p>
    <hr>
    <div class="koko">
        <div class="category">
            <div class="icons">
                <a href="string_instruments.php"><span class="circle">&#9679;</span>
                <img src="pictures/guitar.png" alt="guitar"></a>
            </div>
            <p>String Instruments</p>
        </div>
        <div class="category">
            <div class="icons">
                <a href="drums_and_percussion.php"><span class="circle">&#9679;</span>
                <img src="pictures/drums.png" alt="drums"></a>
            </div>
            <p>Drums And Percussion</p>
        </div>
        <div class="category">
            <div class="icons">
                <a href="keyboards_and_pianos.php"><span class="circle">&#9679;</span>
                <img src="pictures/piano.png" alt="piano"></a>
            </div>
            <p>Keyboards And Pianos</p>
        </div>
        <div class="category">
            <div class="icons">
                <a href="live_sound.php"><span class="circle">&#9679;</span>
                <img src="pictures/microphone.png" alt="microphone"></a>
            </div>
            <p>Live Sound & Pro Audio</p>
        </div>
        <div class="category">
            <div class="icons">
                <a href="home_audio.php"><span class="circle">&#9679;</span>
                <img src="pictures/speakers.png" alt="speakers"></a>
            </div>
            <p>Home Audio</p>
        </div>
        <div class="category">
            <div class="icons">
                <a href="studio.php"><span class="circle">&#9679;</span>
                <img src="pictures/speaker.png" alt="speaker" class="img2"></a>
            </div>
            <p>Studio And Recording</p>
        </div>

        <div class="category" data-category="wind-instruments">
            <div class="icons">
                <a href="wind.php"><span class="circle">&#9679;</span>
                <img src="pictures/wind-instruments.png" alt="saxophone"></a>
            </div>
            <p>Wind instruments</p>
        </div>
    </div>
    <!-- Instruments categories end -->

    <!-- Cards that show the best sellers -->
    <p class="toinen title">BEST SELLER</p>
    <hr>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-4 mb-4">
          <div class="card add-to-cart-btn" data-name="Red Drums" data-price="2400 €" data-image="pictures/redDrums.png">
            <img src="pictures/redDrums.png" class="card-img-top" alt="red drums">
            <div class="card-body">
              <h5 class="card-title">Red Pearl Drums</h5>
              <p class="card-text">Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä</p>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-4">
          <div class="card add-to-cart-btn" data-name="Electric Guitar" data-price="700 €" data-image="pictures/electricguitar.png">
            <img src="pictures/electricguitar.png" class="card-img-top" alt="electric guitar">
            <div class="card-body">
              <h5 class="card-title">Electric Guitar</h5>
              <p class="card-text">Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä</p>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-4">
          <div class="card add-to-cart-btn" data-name="Speaker" data-price="1500 €" data-image="pictures/loudspeakers.png">
            <img src="pictures/loudspeakers.png" class="card-img-top" alt="loud speakers">
            <div class="card-body">
              <h5 class="card-title">Loud Speakers</h5>
              <p class="card-text">Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Cards section end -->

    <!-- Section that tells about the company -->
    <p class="kolmas title">ABOUT US</p>
    <hr>
    <div class="container2">
        <img src="pictures/roomWithInstruments.jpg" alt="room with instruments" id="room">
        <div class="text-section">
            <h2>Nature Music Center</h2>
            <p class="image-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type
            specimen book. It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was popularised in the
            1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
            more recently with desktop publishing software like Aldus PageMaker including
            versions of Lorem Ipsum.
            <br><br>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
            printer took a galley of type and scrambled it to make a type specimen book. It has survived
            not only five centuries, but also the leap into electronic typesetting, remaining essentially
            unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem
            Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
            versions of Lorem Ipsum.
            </p>
        </div>
    </div>
    <!-- Section end -->

    <!-- Footer -->
    <footer>

    <div class="footer-container">

        <div class="text">
            <a href="Navigation_bar.php"><img src="pictures/logo.png" alt="Nature Music"></a>
            <p>Lorem ipsum dolor sit amet consectetur. <br>
            Consequat fermentum viverra auctor nibh <br> eleifend sed lorem. </p>

             <!--Icons social medias -->
             <div class="icon">
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>    
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter-icon lucide-twitter"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin-icon lucide-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg></a>
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram-icon lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
            </div>
        </div>

        <div class="Pages_content">
            <h3 style="font-size: 20px;">Pages</h3>
            <p><a href="about.php">About Us</a></p>
            <p><a href="#">Contact Info</a></p>
            <p><a href="#">Track Location</a></p>
            <p><a href="#">Career</a></p>
        </div>
        <div class="BackLinks_content">
            <h3 style="font-size: 20px;">Back Links</h3>
            <p><a href="#">Brand</a></p>
            <p><a href="#">Social Links</a></p>
            <p><a href="#">Company Registration</a></p>
            <p><a href="#">My Orders</a></p>
        </div>

        <div class="WorkHours_content">
            <h3 style="font-size: 20px;">Work Hours</h3>
            <div class="hour">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock3-icon lucide-clock-3"><path d="M12 6v6h4"/><circle cx="12" cy="12" r="10"/></svg>
                <p>24/7</p>
            </div>
            <div class="phone">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/></svg>
                <p>+94 76 00 00 000</p>
            </div>
            <p>Our Support and Sales team is available <br> 24/7 to answer your queries</p>
        </div>
    </div>

    <div class="low">
        <small>Copyright © 2023 GoTaxi | Design by @HansanikaSulakshani </small>
        <small><a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a></small>
    </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="search_function.js"></script>
  </body>
</html>