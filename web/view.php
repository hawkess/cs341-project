<?php include "include/header.php" ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<body>
   <?php include "include/navbar.php" ?>
    <div class="container-fluid">
        <h1 class="w-75"><?php echo htmlspecialchars($results['article']->title)?></h1>
        <p class="author">Written by <?php echo $results['article']->author</p>
        <p class="created">Published on <?php echo date('j F Y', $results['article']->created)?></p>
        <div class="w-75"><?php echo $results['article']->content?></div>
        <?php 
        if($results['article']->user_id == $_SESSION["user_id"])
        {
            echo '<div class="w-75"></div>
            <a type="button" class="btn btn-primary" href="admin.php?action=editArticle">Edit Article</button>
            <a type="button" class="btn btn-danger" href="admin.php?action=deleteArticle">Delete Article</button>
            </div>';
        }
        ?>
</body>
</html>
