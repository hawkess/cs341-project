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
  default:
    homepage();
}

function archive() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
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
  $data = Article::getList(10);
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "CSE 341 CMS";
  require("homepage.php");
}
?>