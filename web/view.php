<?php include "include/header.php" ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<body>
    <?php include "include/navbar.php" ?>
    <div class="container-fluid d-flex justify-content-center">
        <div class="w-25 m-auto py-5">
            <h3><?php echo htmlspecialchars($results['article']->title)?></h3>
            <p class="my-0"><?php echo $results['article']->author?></p>
            <p class="mb-1"><?php echo date('F j\, Y', $results['article']->created)?></p>
            <div><?php echo $results['article']->content?>
            <?php
            if (isset($_SESSION["loggedin"]))
            {
                if ($results['article']->user_id == $_SESSION["user_id"])
                {
                    echo '<div class="buttons pt-3">
                    <a type="button" class="btn btn-dark" href="admin.php?action=editArticle&articleId=' . $results['article']->id . '"><i class="fas fa-pen pr-2"></i>Edit</a>
                    <a href="" id="delete" class="btn btn-outline-danger"><i class="fa fa-trash-o pr-2"></i>Delete</a>
                    <?php } ?>   
                </div>';
                }
            }
            ?>
            </div>
        </div>
            <script type="text/javascript">
        $('#delete').on('click', function() {
            if (return confirm('Are you sure?'))
                {
                    $.post("admin.php", { action: "deleteArticle", articleId: "<?php echo $results['article']->id ?>" });
                }
        });
    </script>
</body>
</html>
