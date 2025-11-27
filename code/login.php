<?php
session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Navigation_bar.php");
    exit;
}
 
require_once "config.php";
 
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Take info from form
    if(empty(trim($_POST["username"]))){
        $username_err = "Enter username";
        $display = 'block';
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Enter password";
        $display = "block";
    } else{
        $password = trim($_POST["password"]);
    }
 
    // Start validation
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        
                        // compare the password (ensure hashed password is a string)
                        if(is_string($hashed_password) && password_verify($password, $hashed_password)){
                            
                            // start a new session
                            session_start();
                            
                            // restore session data
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: Navigation_bar.php");
                        } else{
                            // password is not valid
                            $login_err = "Username or password is incorrect.";
                        }
                    }
                } else{
                    // username doesn't exist
                    $login_err = "Username or password is incorrect.";
                }
            } else{
                echo "Error. Please try again.";
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
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <link href="https://fonts.google.com/specimen/Quicksand">
    <link href="/scrum_project/code/css/register.css" rel="stylesheet">
    <link rel="icon" href="pictures/logo.png">
</head>
<body>
    <?php 
    if(!empty($login_err)){
        echo '<div>' . $login_err . '</div>';
    }        
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1 class="main-text">Login</h1>

        <input class="user-input" type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
        <span stlye="opacity: <?php echo $opacity; ?>"><?php echo $username_err; ?></span>

        <input class="password-input" type="password" name="password" placeholder="Password">
        <span stlye="opacity: <?php echo $opacity; ?>"><?php echo $password_err; ?></span>

        <button class="submit-button" type="submit" value="sign up" >Login</button>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
</body>
</html>