<?php
require_once("cms.php");
if(session_status() === PHP_SESSION_NONE) session_start();
$action = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

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
    case 'resetpassword':
        resetPassword();
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
    require("login.php");
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
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) 
    {
        $results = array();
        $results['pageTitle'] = "CSE 341 CMS Reset Password";
        header("location: resetpassword.php");
        return;
    }
    else
    {
        header("location: admin.php?action=login");
        return;
    }
}

function newArticle() {
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) 
    {
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
            require("admin/editArticle.php");
        }
    }
    else
    {
        header("location: admin.php?action=login");
        return;
    }
}


function editArticle() {
  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) 
    {
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
            require("admin/editArticle.php");
        }
    }
    else
    {
        header("location: admin.php?action=login");
        return;
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
          $article->delete($_SESSION["user_id"]);
          header("Location: admin.php?status=articleDeleted");
    }
    else
    {
        header("location: admin.php?action=login");
        return;
    }
}


function listArticles() {
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) 
    {
            $results = array();
            $data = Article::getByUser($_SESSION['user_id']);
            $results['articles'] = isset($data) ? $data['results'] : array();
            $results['totalRows'] = isset($data) ? $data['totalRows'] : 0;
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
            require("admin/listArticles.php");
    }
    else
    {
        header("location: admin.php?action=login");
        return;
    }
}
?>
