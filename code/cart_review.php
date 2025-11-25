<?php
session_start();
 
// check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Navigation_bar.php");
    exit;
}

$errorMessage = '';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$cartItems = [];

$servername = "localhost";
$username_db = "root"; 
$password_db = ""; 
$dbname = "user_controller";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // load cart items for the user
    $stmt = $conn->prepare("SELECT product_name, product_price, quantity, product_image FROM carts WHERE user_id = :user_id ORDER BY created_at DESC");
    $stmt->execute(['user_id' => $user_id]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // ... error ...
    $errorMessage = "error loading cart items";
}
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
    <link rel="stylesheet" href="cart_review.css">
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
          <a class="nav-link" href="#">About Us</a>
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

    <!-- My cart -->
    <div class="container2">
        <div class="container">
            <div class="delivery-form">
                <!-- Form stars -->
                <form action="save.php" method="post" onsubmit="updateProductsInput()">
                    <h2>Delivery</h2>
                    <div class="row">
                        <!-- Country dropdown -->
                        <div class="mb-3">
                            <label for="country"></label>
                            <select class="form-select" id="country" name="country" required>
                                <option value="" disabled selected>Country</option>
                                <option>Finland</option>
                                <option>Sweden</option>
                                <option>Norway</option>
                                <option>Iceland</option>
                                <option>Denmark</option>
                                <option>UK</option>
                                <option>France</option>
                                <option>Spain</option>
                                <option>Vietnam</option>
                            </select>
                        </div>
                        <!-- First and Last name on same line -->
                        <div class="col-md-6 mb-3">
                            <label for="first"></label>
                            <input type="text" class="form-control" id="first" placeholder="First name" name="first" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last"></label>
                            <input type="text" class="form-control" id="last" placeholder="Last name" name="last" required>
                        </div>
                    </div>
                    <!-- Address full width -->
                    <div class="mb-3">
                        <label for="address"></label>
                        <input type="text" class="form-control" id="address" placeholder="Address" name="address" required>
                    </div>
                    <div class="row">
                        <!-- Postal code and City on same line -->
                        <div class="col-md-6 mb-3">
                            <label for="postal"></label>
                            <input type="text" class="form-control" id="postal" placeholder="Postal code" name="postal" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city"></label>
                            <input type="text" class="form-control" id="city" placeholder="City" name="city" required>
                        </div>
                    </div>
                    <!-- Phone on its own line -->
                    <div class="mb-3">
                        <label for="phone"></label>
                        <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" required>
                    </div>
                    <!-- My cart things -->
                </div>
            </div>
            <div id="root"></div>
            <div class="sidebar">
                <?php if (!empty($errorMessage)): ?>
                    <p style="color: red;"><?php echo $errorMessage; ?></p>
                <?php elseif (empty($cartItems)): ?>
                    <p>Your cart is empty</p>
                <?php else: ?>
                    <div class="head"><p class="my_cart">My Cart</p></div>
                    <?php $total = 0; ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>  <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cartItems as $item): 
                            $item_price_float = (float)$item['product_price'];
                            $item_quantity_int = intval($item['quantity']);
                            $total += $item_price_float * $item_quantity_int;
                        ?>
                            <tr>
                                <td>
                                    <?php if (!empty($item['product_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($item['product_image']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo $item_quantity_int; ?></td>
                                <td><?php echo number_format($item_price_float, 2); ?>€</td>

                                <td>
                                    <i class="bx bxs-trash delete-item-icon" 
                                        data-product-name="<?php echo htmlspecialchars($item['product_name']); ?>">
                                    </i>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="foot">
                        <h3>Total</h3>
                        <h2 id="total"><?php echo number_format($total,2); ?>€</h2>
                    </div>
                <?php endif; ?>
              <input type="hidden" name="products" id="products" value="[]">
              <script>
                const cart = <?php echo json_encode($cartItems); ?>;
              </script>
              <button class='checkout' type="submit" id="Checkout" style="font-size: 17px;">Checkout ➙</button>
            </div>
        </div>
    </form>
    <!-- Form ends -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="search_function.js"></script>
    <script src="cart_review.js"></script>
</body>
</html>