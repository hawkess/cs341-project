<?php
require("cms.php");
$action = isset($_GET['action']) ? $_GET['action'] : "";

switch ($action) {
    case 'archive':
        archive();
        break;
    case 'viewArticle':
        viewArticle();
        break;
    case 'welcome':
        welcome();
        break;
    default:
        homepage();
}

function archive() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = isset($data) ? $data['results'] : array();
  $results['totalRows'] = isset($data) ? $data['totalRows'] : 0;
  $results['pageTitle'] = "CSE 341 CMS Archive";
  require("archive.php");
}

function viewArticle() {
  if (!isset($_GET["articleId"]) || !$_GET["articleId"]) {
    homepage();
    return;
  }

  $results = array();
  $results['article'] = Article::getById((int)$_GET["articleId"]);
  $results['pageTitle'] = "CSE 341 CMS | " . $results['article']->title . "";
  require("view.php");
}

function homepage() {
  $results = array();
  $data = Article::getList(HOMEPAGE_NUM_ARTICLES);
    if ($data) {
      $results['articles'] = $data['results'];
      $results['totalRows'] = $data['totalRows'];
    }
  $results['pageTitle'] = "CSE 341 CMS";
  require("homepage.php");
}

function welcome() {
    $results = array();
    $results['pageTitle'] = "CSE 341 Welcome";
    require("welcome.php");
}
?>