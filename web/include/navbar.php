<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="homepage.php">CSE 341 CMS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="index.php">Home</a>
      <a class="nav-item nav-link" href="admin.php">My Articles</a>
      <a class="nav-item nav-link" href="index.php?action=archive">Archive</a>
      <?php 
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
            {
                echo '<a class="nav-item nav-link" href="welcome.php">My Profile</a>';
                echo '<a class="nav-item nav-link" href="admin.php?action=logout>Logout</a>'
            }
            else
            {
                echo '<a class="nav-item nav-link" href="admin.php?action=login">Login</a>';
            } ?>
    </div>
  </div>
</nav>
