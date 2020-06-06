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
            <div class="page-header pb-4">
                <h2>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
            </div>
            <div class="list-group">
               <a href="admin.php" class="list-group-item list-group-item-action"><i class="fas fa-cog pr-2"></i>Manage Articles</a>
                <a href="admin.php?action=resetpassword" class="list-group-item list-group-item-action list-group-item-warning"><i class="fas fa-unlock-alt pr-2"></i>Reset Password</a>
                <a href="admin.php?action=logout" class="list-group-item list-group-item-action list-group-item-dark"><i class="fas fa-power-off pr-2"></i>Sign Out</a>
            </p>
        </div>
    </div>
</body>
</html>

