<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>
    <div class="container-fluid">
        <ul id="headlines">
            <?php foreach ($results['articles'] as $article) { ?>
            <li>
                <h2>
                    <span class="created"><?php echo date('j F', $article->created)?></span><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars($article->title)?></a>
                </h2>
                <p class="summary"><?php echo substr(htmlspecialchars($article->title), 0, 100)?></p>
            </li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
