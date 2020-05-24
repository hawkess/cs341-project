<?php include "include/header.php" ?>
<body>
   <?php include "include/navbar.php" ?>
    <div class="container-fluid">
        <h1>Article Archive</h1>
        <ul id="headlines" class="archive">
            <?php foreach ($results['articles'] as $article) { ?>
            <li>
                <h2>
                    <span class="created"><?php echo date('j F Y', $article->created)?></span><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars($article->title)?></a>
                </h2>
                <p class="summary"><?php echo htmlspecialchars($article->summary)?></p>
            </li>
            <?php } ?>
        </ul>
        <p><?php echo $results['totalRows']?> article<?php echo ($results['totalRows'] != 1) ? 's' : '' ?> in total.</p>
        <p><a href="./">Return to Homepage</a></p>
    </div>
</body>
</html>