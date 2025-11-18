<?php
require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){


    if(empty(trim($_POST["username"]))){
        $username_err = "Enter username";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Enter password";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password needs to be at least 6 characters";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
        
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            
            $param_username = $username;
            
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            
            if(mysqli_stmt_execute($stmt)){
                echo "Sign up sucessfully! You can <a href='login.php'>login</a> now.";
            } else{
                echo "Error.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <link href="https://fonts.google.com/specimen/Quicksand">
    <link href="register.css" rel="stylesheet">
    <link rel="icon" href="pictures/logo.png">
  </head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1 class="main-text">Sign Up</h1>
        <input class="user-input" type="text" placeholder="Username/Email" required>
        <input class="password-input" type="text" placeholder="Password" required>
        <button class="submit-button" type="submit">Sign up</button>
    </form>
</body>
</html>