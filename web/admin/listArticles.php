<?php include "include/header.php" ?>
<body>
    <?php include "include/navbar.php" ?>
    <div class="container-fluid d-flex justify-content-center">
        <div class="w-25 m-auto py-5">
            <?php if (isset($results['errorMessage'])){ ?>
            <div class="errorMessage"><?php echo $results['errorMessage']?></div>
            <?php } ?>
            <div class="list-group">
                <h3 class="pb-4">My Articles</h3>
                <?php foreach ($results['articles'] as $article) { ?>
                <a href="index.php?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo htmlspecialchars($article->title)?></h5>
                        <small><?php echo date('F j\, Y', $article->created)?></small>
                    </div>
                    <p class="mb-1"><?php echo htmlspecialchars(substr($article->content, 0, 250))?></p>
                    <small>Submitted by <?php echo $article->author?></small>
                </a>
                <?php } ?>
                <a href="admin.php?action=newArticle" class="btn btn-outline-dark mt-3"><i class="fas fa-plus px-1"></i>Create New Article</a>
            </div>            
        </div>
    </div>
</body>
</html>
