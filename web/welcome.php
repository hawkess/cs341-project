<?php
if(session_status() === PHP_SESSION_NONE) session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: admin.php?action=login");
    exit;
}

$results['pageTitle'] = "CSE 341 Welcome Page";
?>
<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>
   <div class="container-fluid">
   <div class="w-25 m-auto py-5">
    <div class="page-header">
        <h2>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    <p>
        <a href="admin.php?action=resetpassword" class="btn btn-warning"><i class="fas fa-unlock-alt px-1"></i>Reset Password</a>
        <a href="admin.php?action=logout" class="btn btn-danger"><i class="fas fa-power-off px-1"></i>Sign Out</a>
    </p>
    </div>
    </div>
</body>
</html>