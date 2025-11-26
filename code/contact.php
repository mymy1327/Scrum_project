<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nature Music</title>
    <link rel = "stylesheet" href = "https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=MeaCulpa' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="nav_bar.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="contact.css">
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
          <a class="nav-link" aria-current="page" href="Navigation_bar.php">Home</a>
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
              <li><a class="dropdown-item" href="#">Drums And Percussion</a></li>
              <li><a class="dropdown-item" href="#">Keyboards And Pianos</a></li>
              <li><a class="dropdown-item" href="#">Live Sound & Pro Audio</a></li>
              <li><a class="dropdown-item" href="#">Home Audio</a></li>
              <li><a class="dropdown-item" href="#">Studio And Recording</a></li>
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
    <!-- Nav ends -->

    <!-- Contact us page content starts -->

    <!-- info on the right -->
    <div class="contact_page">
        <div class="contact_details">
            <h1>Contact details</h1>

            <div class="contact_item">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/></svg>
              <div class="contact_text">
                <p class="titles">Phone</p>
                <p class="info">+ 94 76 00 00 000</p>
              </div>
            </div>

            <div class="contact_item">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
              <div class="contact_text">
                <p class="titles">Email</p>
                <p class="info">contact@example.com</p>
              </div>
            </div>
          
            <div class="contact_item">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
              <div class="contact_text">
                <p class="titles">Address</p>
                <p class="info">123 Business Street, Suite 100, City,<br>State, ZIP</p>
              </div>
            </div>
        </div>

        <!-- form for sending message -->
        <div class="send_message">
            <h1>Send us a message</h1>
            <p>You are always welcome to contact us. Our <br>
        customer service is available Mon-Fri 9:00 a.m.- <br>
    8.00 p.m. and Sat-Sun 10.00 a.m.-6.00 p.m.</p>
            <form>
                <input type="text" placeholder="Enter your name*"required> 
                <input type="text" placeholder="Enter your last name*"required> 
                <input type="email" placeholder="Enter a valid email adress*"required> 
                <input type="tel" placeholder="Enter your phone number*"required> 
                <textarea placeholder="Write your message*"required></textarea> 
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    
    <!-- Contact us page content ends -->

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
            <p><a href="contact.php">Contact Info</a></p>
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
</body>
</html>