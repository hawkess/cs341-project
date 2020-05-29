<?php include "include/header.php" ?>
     <body>
     <?php include "include/navbar.php" ?>
      <div id="adminHeader">
        <h2>CSE 341 CMS </h2>
      </div>
      <h1>My Articles</h1>
<?php if (isset($results['errorMessage'])){ ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

    <?php foreach ($results['articles'] as $article) { ?>
    <li>
        <h2>
            <span class="created"><?php echo date('j F', $article->created)?></span><a href="index.php?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars($article->title)?></a>
        </h2>
        <p class="summary"><?php echo htmlspecialchars(substr($article->content, 0, 100))?></p>
    </li>
    <?php } ?>
</body>
</html>