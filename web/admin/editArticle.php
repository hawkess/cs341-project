<?php include "../include/header.php" ?>
     <body>
     <?php include "../include/navbar.php" ?>
      <div id="adminHeader">
        <h2>CSE 341 CMS Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars($_SESSION['username'])?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
      </div>
      <h1><?php echo $results['pageTitle']?></h1>
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>
<?php if (isset($results['errorMessage'])) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
        <ul>
          <li>
            <label for="title">Article Title</label>
            <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars($results['article']->title)?>" />
          </li>
          <li>
            <label for="content">Article Content</label>
            <textarea name="content" id="content" placeholder="The content of the article" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars($results['article']->content)?></textarea>
          </li>
          <li>
            <label for="created">Publication Date</label>
            <input type="date" name="created" id="created" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['article']->created ? date("Y-m-d", $results['article']->created) : "" ?>" />
          </li>
        </ul>
        <div class="buttons">
          <input type="submit" name="saveChanges" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
      </form>
<?php if ($results['article']->id) { ?>
      <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>
</body>
</html>
