<?php
if(session_status() === PHP_SESSION_NONE) session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>
    <div class="page-header">
        <h1>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    <p>
        <a href="resetpassword.php" class="btn btn-warning">Reset Your Password</a>
        <a href=".?action=logout" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>