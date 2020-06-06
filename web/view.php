<?php include "include/header.php" ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<body>
    <?php include "include/navbar.php" ?>
    <div class="container-fluid d-flex justify-content-center">
        <div class="w-25 m-auto py-5" <div class="container">
            <h3><?php echo htmlspecialchars($results['article']->title)?></h3>
            <h5 id="author"><?php echo $results['article']->author?></h5>
            <h5 id="created"><?php echo date('F j\, Y', $results['article']->created)?></h5>
            <div><?php echo $results['article']->content?></div>
        </div>
        <?php
        if (isset($_SESSION["loggedin"]))
        {
            if ($results['article']->user_id == $_SESSION["user_id"])
            {
                echo '<div class="w-75">
                <a type="button" class="btn btn-primary" href="admin.php?action=editArticle&articleId=' . $results['article']->id . '"><i class="fas fa-pen pr-2"></i>Edit</button>
                <a type="button" class="btn btn-danger" href="admin.php?action=deleteArticle&articleId=' . $results['article']->id . '"><i class="fa fa-trash-o pr-2"></i>Delete</button>
                </div>';
            }
        }
        ?>
    </div>
</body>
</html>
