<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>
    <div class="container-fluid">
        <h1 class="w-75"><?php echo htmlspecialchars($results['article']->title)?></h1>
        <p class="created">Published on <?php echo date('j F Y', $results['article']->created)?></p>
        <div class="w-75"><?php echo $results['article']->content?></div>        
    </div>
</body>
</html>
