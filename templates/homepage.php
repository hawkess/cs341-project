<?php include "templates/include/header.php" ?>
<body>
   <?php include "templates/include/navbar.php" ?>
    <div class="container-fluid">
        <ul id="headlines">
            <?php foreach ($results['articles'] as $article) { ?>
            <li>
                <h2>
                    <span class="created"><?php echo date('j F', $article->publicationDate)?></span><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars($article->title)?></a>
                </h2>
                <p class="summary"><?php echo htmlspecialchars($article->summary)?></p>
            </li>
            <?php } ?>
        </ul>
        <p><a href="./?action=archive">View Archive</a></p>
    </div>
</body>
</html>
