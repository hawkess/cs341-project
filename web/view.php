<?php include "include/header.php" ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<body>
    <?php include "include/navbar.php" ?>
    <div class="container-fluid d-flex justify-content-center">
    <div class="w-25 m-auto py-5"
        <div class="container">
            <h3><?php echo htmlspecialchars($results['article']->title)?></h3>
            <p id="author"><?php echo $results['article']->author?></p>
            <p id="created"><?php echo date('F j\, Y', $results['article']->created)?></p>
            <div><?php echo $results['article']->content?></div>
            <?php
        if(isset($_SESSION["loggedin"])) 
        {
            if($results['article']->user_id == $_SESSION["user_id"])
            {
                echo '<div class="w-75">
                <a type="button" class="btn btn-primary" href="admin.php?action=editArticle&articleId=' . $results['article']->id . '"><i class="fas fa-pen px-1"></i>Edit</button>
                <a type="button" class="btn btn-danger" href="admin.php?action=deleteArticle&articleId=' . $results['article']->id . '"><i class="fa fa-trash-o px-1"></i>Delete</button>
                </div>';
            }
        }
        ?>
        </div>
</body>
</html>
