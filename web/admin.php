<?php
require_once("cms.php");
if(session_status() === PHP_SESSION_NONE) session_start();
$action = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

if ($action != "login" && $action != "logout" && !$username) 
{
  login();
  exit;
}

switch ($action) 
{
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'register':
    register();
    break;
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  case 'deleteArticle':
    deleteArticle();
    break;
  default:
    listArticles();
}


function login() {
  $results = array();
  $results['pageTitle'] = "CSE 341 CMS Login";

  if (isset($_POST['login'])) 
  {
    if ($_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD) 
    {
      $_SESSION['username'] = ADMIN_USERNAME;
      $_SESSION['loggedin'] = true;
      header("Location: welcome.php");
    } 
      else 
      {
          $results['errorMessage'] = "Incorrect username or password. Please try again.";
          require("login.php");
      }
  } 
    else 
    {
        require("login.php");
    }
}


function logout() {
    $_SESSION = array();
    session_destroy();
    header("location: admin.php?action=login");
    return;
}

function register() {
    $results = array();
    $results['pageTitle'] = "CSE 341 CMS Register";
    require("register.php");
}

function resetPassword() {
    $results = array();
    $results['pageTitle'] = "CSE 341 CMS Reset Password";
    require("resetpassword.php");
}

function newArticle() {
    $results = array();
    $results['pageTitle'] = "New Article";
    $results['formAction'] = "newArticle";

    if (isset($_POST['saveChanges'])) 
    {
        $article = new Article;
        $article->storeFormValues($_POST);
        $article->insert();
        header("Location: admin.php?status=changesSaved");
    } 
    elseif (isset($_POST['cancel'])) 
    {
        header("Location: admin.php");
    }
    else 
    {
        $results['article'] = new Article;
        require("/admin/editArticle.php");
    }
}


function editArticle() {

  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";

    if (isset($_POST['saveChanges'])) 
    {
        if (!$article = Article::getById((int)$_POST['articleId'])) 
        {
          header("Location: admin.php?error=articleNotFound");
          return;
        }
        
        $article->storeFormValues($_POST);
        $article->update();
        header("Location: admin.php?status=changesSaved");
    } 
    elseif (isset($_POST['cancel'])) 
    {
        header("Location: admin.php");
    } 
    else 
    {
        $results['article'] = Article::getById((int)$_GET['articleId']);
        require("/admin/editArticle.php");
    }

}


function deleteArticle() {
    if (!$article = Article::getById((int)$_GET['articleId'])) 
    {
        header("Location: admin.php?error=articleNotFound");
        return;
    }
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) 
    {
          $article->delete();
          header("Location: admin.php?status=articleDeleted");
    }
    
}


function listArticles() {
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) 
    {
        if (!$article = Article::getById((int)$_GET['articleId'])) 
        {
            $results = array();
            $data = Article::getByUser();
            $results['articles'] = $data['results'];
            $results['totalRows'] = $data['totalRows'];
            $results['pageTitle'] = "My Articles";

            if (isset($_GET['error'])) 
            {
                if ($_GET['error'] == "articleNotFound") $results['errorMessage'] = "Error: Article not found.";
            }

            if (isset($_GET['status'])) 
            {
                if ($_GET['status'] == "changesSaved") $results['statusMessage'] = "Your changes have been saved.";
                if ($_GET['status'] == "articleDeleted") $results['statusMessage'] = "Article deleted.";
            }
            require(TEMPLATE_PATH . "/admin/listArticles.php");
        }
    }
    else
    {
        header("location: admin.php?action=login");
        return;
    }
}
?>
