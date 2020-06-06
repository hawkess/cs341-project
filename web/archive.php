<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>        
    <div class="container-fluid d-flex justify-content-center">
       <h1>Article Archive</h1>
        <div class="list-group">
            <?php foreach ($results['articles'] as $article) { ?>
            <a href="index.php?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo htmlspecialchars($article->title)?></h5>
                    <small><?php echo date('F j\, Y', $article->created)?></small>
                </div>
                <p class="mb-1"><?php echo htmlspecialchars(substr($article->content, 0, 250))?></p>
                <small><?php echo $article->author?></small>
            </a>
            <?php } ?>
        </div>
        <p><?php echo $results['totalRows']?> article<?php echo ($results['totalRows'] != 1) ? 's' : '' ?> in total.</p>
    </div>        
</body>
</html>
