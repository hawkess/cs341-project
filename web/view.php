<?php include "include/header.php" ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<body>
    <?php include "include/navbar.php" ?>
    <div class="container-fluid d-flex justify-content-center">
        <div class="list-group">
            <?php foreach ($results['articles'] as $article) { ?>
            <a href="index.php?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo htmlspecialchars($article->title)?></h5>
                    <small><?php echo date('F j\, Y', $article->created)?></small>
                </div>
                <p class="mb-1"><?php echo htmlspecialchars(substr($article->content, 0, 250))?></p>
                <small><?php echo $article->author?></small>
                <?php
                    if(isset($_SESSION["loggedin"])) 
                    {
                        if($results['article']->user_id == $_SESSION["user_id"])
                        {
                            echo '<div>
                            <a type="button" class="btn btn-primary" href="admin.php?action=editArticle&articleId=' . $results['article']->id . '">Edit Article</button>
                            <a type="button" class="btn btn-danger" href="admin.php?action=deleteArticle&articleId=' . $results['article']->id . '">Delete Article</button>
                            </div>';
                        }
                    }
                ?>
            </a>
            <?php } ?>
        </div>
    </div>

</body>

</html>
