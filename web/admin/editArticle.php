<?php include "include/header.php" ?>

<body>
    <?php include "include/navbar.php" ?>
    <div class="container-fluid d-flex justify-content-center">        
        <div class="container w-25 m-auto py-5">
        <h2 class="ml-1"><?php echo $results['pageTitle']?></h2>
            <form class="py-2" action="admin.php?action=<?php echo $results['formAction']?>" method="post">
                <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>" />
                <?php if (isset($results['errorMessage'])) { ?>
                <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
                <?php } ?>
                <div class="form-group">
                    <label for="title">Article Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars($results['article']->title)?>" />
                </div>
                <div class="form-group">
                    <label for="content">Article Content</label>
                    <textarea class="form-control" name="content" id="content" placeholder="The content of the article" required maxlength="100000" rows="5"><?php echo htmlspecialchars($results['article']->content)?></textarea>
                </div>
                <div class="buttons">
                    <input type="submit" class="btn btn-success" name="saveChanges" value="Save Changes" />
                    <input type="submit" class="btn btn-outline-danger" formnovalidate name="cancel" value="Cancel" />
                </div>
            </form>
            <?php if ($results['article']->id) { ?>
            <a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a>
            <?php } ?>
        </div>
    </div>
</body>
</html>
