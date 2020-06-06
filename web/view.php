<?php include "include/header.php" ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<script type="text/javascript">
    $(document).on('click', '#deleteConfirm', function() {
        event.preventDefault();
        console.log("This worked.");
        $('#deleteModal').modal('hide');
        $.post("admin.php?action=deleteArticle", {
            articleId: "<?php echo $results['article']->id ?>"
        }, function(data) {
            console.log(data); 
           // if (data > 0) {
//                window.location.href = "admin.php?status=articleDeleted";
//            }
//            else {
//                window.location.href = "admin.php?status=articleNotFound";
//            }
        });        
    });

</script>

<body>
    <?php include "include/navbar.php" ?>
    <?php 
    if (!isset($results['article'])) 
    {
        header("location: index.php");
    } ?>
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
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o pr-2"></i>Delete</button>
                    <?php } ?>
            </div>';
            }
            }
            ?>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete this article?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Once this article is deleted, it cannot be recovered. Are you sure you want to continue?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteConfirm">Delete</button>
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
