<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>
    <div class="container-fluid">
        <ul id="headlines">
            <?php foreach ($results['articles'] as $article) { ?>
            <li>
                <h2>
                    <a href="index.php?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars($article->title)?></a>
                </h2>
                <p id="created"><?php echo date('j F', $article->created)?></p>
                <p id="author">Written by <?php echo $article->author?></p>
                <p id="summary"><?php echo htmlspecialchars(substr($article->content, 0, 100))?></p>
            </li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
